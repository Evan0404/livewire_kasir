<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\item;
use App\Models\transaksi;
use App\Models\kasir;

class Lwkasir extends Component
{


    // Penghitungan
    public $nama;
    public $harga;
    public $satuan;
    public $jumlah;
    public $sub;
    public $iditem;

    public $cekKode;
    public $kode;
    


    public $getItemId;
    public $getKasirId;
    public $formStatus = 0;

    public $total;
    public $dibayar;
    public $kembali;

    public $srcbeli;
    public $srcitem;


    public function render()
    {
        // Penghitungan Sub
        if ($this -> jumlah == "" or $this -> harga=="") {
            $this -> sub = $this -> harga;
        }else{
            $this -> sub = $this -> harga*$this->jumlah;
        }

        // Generate Kode Transaksi
        $q = transaksi::select('id_transaksi')->latest()->first();
        if ($q=="") {
            $this->cekKode = 1;
        }else{
            $this->cekKode = $q['id_transaksi']+1;
        }
        $this->kode = $this->cekKode.'TRSNKS'.auth()->user()->id;
        

        // Penghitungan total dibayar dan kembalian
        $this -> total = kasir::where('kode_kasir', $this->kode)->sum('sub');
        if ($this->dibayar == "" or $this -> total =="") {
            $this -> kembali = $this -> total;
        }else{
            $this -> kembali = $this -> dibayar - $this -> total;
        }

        // Pencarian
        if ($this -> srcitem !== "") {
            $data =[
                'no' => 1,
                'item' => item::where('user_id', auth()->user()->id)->where('nama_item', 'like', '%'.$this -> srcitem.'%')->orderBy('created_at', 'DESC')->get(),
                'beli' => kasir::join('items', 'kasirs.item_id', '=', 'items.id')->where('kasirs.user_id', auth()->user()->id)->where('kasirs.status', "proses")->where('kode_kasir', $this ->kode)->get()
            ];
        }elseif ($this -> srcbeli !== "") {
            $data =[
                'no' => 1,
                'item' => item::where('user_id', auth()->user()->id)->orderBy('created_at', 'DESC')->get(),
                'beli' => kasir::join('items', 'kasirs.item_id', '=', 'items.id')->where('kasirs.user_id', auth()->user()->id)->where('kasirs.status', "proses")->where('kode_kasir', $this ->kode)->where('nama_item', 'like', '%'.$this -> srcbeli.'%')->get()
            ];
        }else {
            $data =[
                'no' => 1,
                'item' => item::where('user_id', auth()->user()->id)->orderBy('created_at', 'DESC')->get(),
                'beli' => kasir::join('items', 'kasirs.item_id', '=', 'items.id')->where('kasirs.user_id', auth()->user()->id)->where('kasirs.status', "proses")->where('kode_kasir', $this ->kode)->get()
            ];

        }

        return view('livewire.lwkasir', $data)->extends('app')->section('content');
    }

    public function getItemId($id)
    {
        $this -> formStatus = 1;
        $data = item::find($id);
        $this -> nama = $data['nama_item'];
        $this -> harga = $data['harga_item'];
        $this -> satuan =$data['satuan'];
        $this -> getItemId = $data['id'];
    }

    public function tambah()
    {
        kasir::create([
            'kode_kasir' => $this -> kode,
            'item_id'=> $this -> getItemId,
            'user_id' => auth()->user()->id,
            'jumlah' => $this -> jumlah,
            'sub' => $this -> sub,
            'status' => "proses"
        ]);

        $this -> formStatus =0;
        $this -> getItemId="";
        $this -> satuan="";
        $this -> harga="";
        $this -> nama ="";
        $this -> jumlah="";
    }

    public function getIdKasir($id)
    {
        $this -> formStatus = 2;
        $data = kasir::join('items', 'kasirs.item_id', '=', 'items.id')->where('kasirs.user_id', auth()->user()->id)->where('kasirs.status', "proses")->where('id_kasir', $id)->first();
        $this -> nama = $data['nama_item'];
        $this -> harga = $data['harga_item'];
        $this -> satuan =$data['satuan'];
        $this -> getItemId = $data['id'];
        $this -> jumlah= $data['jumlah'];
        $this -> sub = $data['sub'];
        $this -> getKasirId = $data['id_kasir'];
    }

    public function update()
    {
        $query = kasir::where('id_kasir', $this->getKasirId)->update([
            'jumlah'=>$this -> jumlah,
            'sub'=>$this -> sub
        ]);
        $this -> formStatus =0;
        $this -> getItemId="";
        $this -> getKasirId="";
        $this -> satuan="";
        $this -> harga="";
        $this -> nama ="";
        $this -> jumlah="";
        $this -> sub="";
    }

    public function cancelUpdate()
    {
        $this -> formStatus =0;
        $this -> getItemId="";
        $this -> getKasirId="";
        $this -> satuan="";
        $this -> harga="";
        $this -> nama ="";
        $this -> jumlah="";
        $this -> sub="";

    }

    public function delete($id)
    {
        kasir::where('id_kasir', $id)->delete();
    }

    public function transaksi()
    {

        transaksi::create([
            'id_transaksi' => $this->cekKode,
            'kode_transaksi' => $this->kode,
            'total'=> $this -> total,
            'dibayar'=>$this -> dibayar,
            'kembalian'=>$this ->kembali,
            'user_id' => auth()->user()->id
        ]);

        kasir::where('kode_kasir', $this -> kode)->update([
            'status' => "clear"
        ]);

        $this -> formStatus = 0;
        $this -> getItemId="";
        $this -> getKasirId="";
        $this -> satuan="";
        $this -> harga="";
        $this -> nama ="";
        $this -> jumlah="";
        $this -> sub="";
        $this -> total ="";
        $this -> kembali="";
        $this -> dibayar="";
        $kode = $this->kode;
        // return redirect()->route('transaksi', $kode);
    }
}
