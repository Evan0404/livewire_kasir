<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\kasir;
use App\Models\transaksi;
use App\Models\item;


class Dashboard extends Component
{
    public $dtanggal ="";
    public $ttanggal;
    public $ptanggal;

    public $dbulan ="";
    public $dbulant ="";
    public $tbulan;
    public $pbulan;

    public $dtahun ="";
    public $ttahun;
    public $ptahun;

    public function render()
    {
        $this->ttanggal=transaksi::whereDate('created_at', '=', $this -> dtanggal)->where('user_id', auth()->user()->id)->count();
        $this->ptanggal=transaksi::whereDate('created_at', '=', $this -> dtanggal)->where('user_id', auth()->user()->id)->sum('total');

        $this->tbulan=transaksi::whereMonth('created_at', '=', $this->dbulan)->whereYear('created_at', '=', $this->dbulant)->where('user_id', auth()->user()->id)->count();
        $this->pbulan=transaksi::whereMonth('created_at', '=', $this->dbulan)->whereYear('created_at', '=', $this->dbulant)->where('user_id', auth()->user()->id)->sum('total');

        $this->ptahun=transaksi::whereYear('created_at', '=', $this->dtahun)->where('user_id', auth()->user()->id)->sum('total');
        $this->ttahun=transaksi::whereYear('created_at', '=', $this->dtahun)->where('user_id', auth()->user()->id)->count();

        $data = [
            'hari' => transaksi::whereDate('created_at', '=', date('Y-m-d'))->where('user_id', auth()->user()->id)->sum('total'),
            'bulan' => transaksi::whereMonth('created_at', '=', date('m'))->whereYear('created_at','=', date('Y'))->where('user_id', auth()->user()->id)->sum('total'),
            'tahun' => transaksi::whereYear('created_at','=', date('Y'))->where('user_id', auth()->user()->id)->sum('total'),
            'total' => transaksi::where('user_id', auth()->user()->id)->count(),
            'tbltanggal' => transaksi::whereDate('created_at', '=', $this -> dtanggal)->where('user_id', auth()->user()->id)->get(),
            'tblbulan' => transaksi::whereMonth('created_at', '=', $this->dbulan)->whereYear('created_at', '=', $this->dbulant)->where('user_id', auth()->user()->id)->get(),
            'tbltahun' => transaksi::whereYear('created_at', '=', $this->dtahun)->where('user_id', auth()->user()->id)->get()
        ];
        return view('livewire.dashboard', $data)->extends('app')->section('content');

    }
}
