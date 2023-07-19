<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\transaksi;
use App\Models\kasir;

class Lwtransaksi extends Component
{

    public $src;
    public function render()
    {

        if ($this -> src !== "") {
            $data = [
                'no' => 1,
                'transaksi' => transaksi::where('user_id', auth()->user()->id)->where('kode_transaksi', 'like', '%'.$this -> src.'%')->get(),
                // 'detail' => kasir::where('kode_kasir', $kode)->get()

            ];
        }else{
            $data = [
                'no' => 1,
                'transaksi' => transaksi::where('user_id', auth()->user()->id)->get(),
                // 'detail' => kasir::where('kode_kasir', $kode)->get()

            ];
        }
        return view('livewire.lwtransaksi', $data)->extends('app')->section('content');
    }
}
