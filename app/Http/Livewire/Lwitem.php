<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\item;

class Lwitem extends Component
{


    public $nama;
    public $stok;
    public $satuan;
    public $harga;
    public $userid;
    public $iditemforUpdate;
    public $formStatus = 0;
    public $src;

    public function render()
    {
        $this->userid = auth()->user()->id;
        if ($this -> src !== "") {
            $data = [
                'no' => 1,
                'item' => item::where('user_id', auth()->user()->id)->where('nama_item', 'like', '%'.$this->src.'%')->orderBy('created_at', 'DESC')->get()
            ];
        }else{
            $data = [
                'no' => 1,
                'item' => item::where('user_id', auth()->user()->id)->orderBy('created_at', 'DESC')->get()
            ];
        }
        return view('livewire.lwitem', $data)->extends('app')->section('content');
    }

    public function insert()
    {
        item::create([
            'nama_item' => $this -> nama,
            'stok_item' => $this -> stok,
            'satuan' => $this -> satuan,
            'harga_item' => $this -> harga,
            'user_id' => auth()->user()->id
        ]);

        $this -> nama ="";
        $this -> stok ="";
        $this -> satuan = "";
        $this -> harga = "";
    }

    public function getIdUpdate($id)
    {
        $this -> formStatus = 1;
        $item = item::find($id);
        $this -> nama = $item['nama_item'];
        $this -> stok = $item['stok_item'];
        $this -> satuan = $item['satuan'];
        $this -> harga = $item['harga_item'];
        $this -> iditemforUpdate = $item['id'];
    }

    public function cancelUpdate()
    {
        $this -> nama ="";
        $this -> stok ="";
        $this -> satuan = "";
        $this -> harga = "";
        $this -> formStatus = 0;
        $this -> iditemforUpdate = "";
    }

    public function update()
    {
        item::where('id', $this->iditemforUpdate)->update([
            'nama_item' => $this -> nama,
            'stok_item' => $this -> stok,
            'satuan' => $this -> satuan,
            'harga_item' => $this -> harga,
        ]);
        $this -> nama ="";
        $this -> stok ="";
        $this -> satuan = "";
        $this -> harga = "";
        $this -> formStatus = 0;
        $this -> iditemforUpdate = "";
    }

    public function delete($id)
    {
        item::where('id', $id)->delete();
    }
}
