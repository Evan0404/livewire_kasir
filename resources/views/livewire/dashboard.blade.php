<div>
    <div class="pagetitle">
      <h1>Dashboard</h1>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="card shadow-lg">
                <div class="card-body">
                    <h5 class="">Pemasukan Hari ini</h5>
                    <h4>Rp {{number_format($hari,0,',','.')}},00</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-lg">
                <div class="card-body">
                    <h5 class="">Pemasukan Bulan ini</h5>
                    <h4>Rp {{number_format($bulan,0,',','.')}},00</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-lg">
                <div class="card-body">
                    <h5 class="">Pemasukan Tahun ini</h5>
                    <h4>Rp {{number_format($tahun,0,',','.')}},00</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-lg">
                <div class="card-body">
                    <h5 class="">Total Transaksi</h5>
                    <h4>{{$total}}x</h4>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="card shadow-lg p-3">
        <h4>Cari Transaksi</h4>
        <div class="row">
            <div class="col-md-4">
                <h5>Berdasarkan Tanggal</h5>
                <p style="font-size: 12px;">Pilih Tanggal yang sesuai untuk mencari transaksi pada bulan tersebut</p>
                <input type="date" class="form-control mb-2" wire:model="dtanggal">
                <div class="row">
                    <div class="col-6">
                        Total Transaksi
                        <input type="number" readonly wire:model="ttanggal" class="form-control mb-2">
                    </div>
                    <div class="col-6">
                        Total Pemasukan
                        <input type="number" disabled readonly wire:model="ptanggal" class="form-control mb-2">
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Act</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tbltanggal as $data)
                            <tr>
                                <td>{{$data -> kode_transaksi}}</td>
                                <td><a href="/transaksi/{{$data -> kode_transaksi}}" target="blank" class="btn btn-warning w-100">
                                    <i class="bi bi-printer"></i>
                                </a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-4">
                <h5>Berdasarkan Bulan</h5>
                <p style="font-size: 12px;">Pilih bulan dan tahun yang sesuai dengan menghiraukan tanggal untuk mencari transaksi pada bulan tersebut</p>
                {{-- <input type="year" class="form-control mb-2" wire:model="dbulan"> --}}
                <div class="row">
                    <div class="col-6">
                        <select wire:model="dbulan" class="form-control mb-2">
                            <option hidden>Pilih Bulan</option>
                            @for ($i = 1; $i <= 12 ; $i++)
                                @php
                                    if ($i <10) {
                                        echo "
                                        <option value=0$i>$i</option>
                                        ";
                                    }else{
                                        echo "
                                        <option value=$i>$i</option>
                                        ";
                                    }
                                @endphp
                            @endfor
                        </select>
                    </div>
                    <div class="col-6">
                        <select wire:model="dbulant" class="form-control mb-2">
                            <option hidden>Pilih Tahun</option>
                            @for ($i = 2022; $i <= 2100 ; $i++)
                                @php
                                    echo "
                                    <option value=$i>$i</option>
                                    ";
                                @endphp
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        Total Transaksi
                        <input type="number" readonly wire:model="tbulan" class="form-control mb-2">
                    </div>
                    <div class="col-6">
                        Total Pemasukan
                        <input type="number" disabled readonly wire:model="pbulan" class="form-control mb-2">
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Act</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tblbulan as $data)
                            <tr>
                                <td>{{$data -> kode_transaksi}}</td>
                                <td><a href="/transaksi/{{$data -> kode_transaksi}}" target="blank" class="btn btn-warning w-100">
                                    <i class="bi bi-printer"></i>
                                </a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-4">
                <h5>Berdasarkan Tahun</h5>
                <p style="font-size: 12px;">Pilih tahun yang sesuai dengan menghiraukan tanggal dan bulan untuk mencari transaksi pada tahun tersebut </p>
                <select name="" wire:model="dtahun" class="form-control mb-2" id="">
                    <option hidden>Pilih Tahun</option>
                    @php
                        for ($i=2022; $i < 2100; $i++) {
                            echo "
                            <option value=$i>$i</option>
                            ";
                        }
                    @endphp
                </select>
                <div class="row">
                    <div class="col-6">
                        Total Transaksi
                        <input type="number" readonly wire:model="ttahun" class="form-control mb-2">
                    </div>
                    <div class="col-6">
                        Total Pemasukan
                        <input type="number" disabled readonly wire:model="ptahun" class="form-control mb-2">
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Act</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tbltahun as $data)
                            <tr>
                                <td>{{$data -> kode_transaksi}}</td>
                                <td><a href="/transaksi/{{$data -> kode_transaksi}}" target="blank" class="btn btn-warning w-100">
                                    <i class="bi bi-printer"></i>
                                </a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
