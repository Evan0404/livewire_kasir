<div>
    <div class="pagetitle">
      <h1>Kasir</h1>
    </div>
    <div class="row">
        <div class="col-md-5">
            <div class="card shadow-lg p-3 pt-0">
                <h5 class="card-title mt-0">Penghitungan</h5>
                @if ($formStatus == 1)
                    <form  method="post" wire:submit.prevent="tambah">
                @elseif ($formStatus == 2)
                    <form  method="post" wire:submit.prevent="update">
                @else
                    <form  method="post" wire:submit.prevent="tambah">
                @endif
                    <label for="nama" class="form-label">Nama</label>
                    <input wire:model="nama" type="text" disabled class="form-control mb-2">
                    <div class="row">
                        <div class="col-8">
                            <label for="harga" class="form-label">Harga</label>
                            <div class="row">
                                <div class="col-7">
                                    <input wire:model="harga" type="number" class="form-control mb-2" disabled>
                                </div>
                                /
                                <div class="col-4">
                                    <input wire:model="satuan" type="text" disabled class="form-control mb-2">
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <label for="jumlah" class="form-label">Jumlah</label>
                            <input wire:model="jumlah" required  type="number" step="any" min="0" class="form-control mb-2">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label for="sub">Sub Total</label>
                            <input wire:model="sub" type="number" class="form-control mb-2" disabled>
                        </div>
                        <div class="col-6">
                            <label for="" class="form-label mb-0">Kode Transaksi</label>
                            <input type="text" class="form-control mb-2" disabled wire:model="kode">
                        </div>
                    </div>
                    @if ($formStatus == 1)
                        <button class="btn btn-primary w-100">Tambah</button>
                    @elseif ($formStatus == 2)
                        <div class="row">
                            <div class="col-6">
                                <button class="btn btn-primary w-100">Update</button>
                            </div>
                            <div class="col-6">
                                <button class="btn btn-secondary w-100" type="button" wire:click="cancelUpdate()">Batal</button>
                            </div>
                        </div>
                    @else
                        <button class="btn btn-primary w-100">Tambah</button>
                    @endif
                </form>
            </div>

            <div class="card shadow-lg p-3 pt-0">
                <h5 class="card-title mt-0">Item diBeli</h5>
                <div class="row">
                    <div class="col-9">
                        <input type="text" wire:model="srcbeli" class="form-control mb-0" placeholder="Cari...">
                    </div>
                    <div class="col-3">
                        <button class="btn btn-primary">Cari</button>
                    </div>
                </div>
                <div class="table-responsive overflow-auto" style="max-height: 300px;">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Harga</th>
                                <th>Jmlh</th>
                                <th>Sub</th>
                                <th>Act</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($beli as $data)
                                <tr>
                                    <td>{{$data -> nama_item}}</td>
                                    <td>{{number_format($data -> harga_item,0,',','.')}}</td>
                                    <td>{{$data -> jumlah}}</td>
                                    <td>{{number_format($data -> sub,0, ',', '.')}}</td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                            <button type="button" wire:click="getIdKasir({{$data -> id_kasir}})" class="btn btn-success"><i class="bi bi-pencil-square"></i></button>
                                            <button type="button" class="btn btn-danger" wire:click="delete({{$data -> id_kasir}})">X</button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row mt-2">
                    <div class="col-6">
                        <input type="number" required class="form-control mb-2" wire:model="total" disabled placeholder="Total">
                    </div>
                    <div class="col-6">
                        <input type="number" required class="form-control mb-2" wire:model="dibayar" placeholder="Dibayar">
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <input type="number" wire:model="kembali" placeholder="Kembalian" class="form-control mb-2" disabled>
                    </div>
                    <div class="col-6">
                        <button class="btn btn-primary w-100" wire:click="transaksi">Transaksi</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="card p-3 pt-0">
                <h5 class="card-title mt-0">Item diJual</h5>
                <div class="row">
                    <div class="col-8">
                        <input type="text" wire:model="srcitem" class="form-control mb-2" placeholder="Cari">
                    </div>
                    <div class="col-4">
                        <button class="btn btn-primary w-100">Cari</button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Stok</th>
                                <th>Harga</th>
                                <th>Act</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($item as $data)
                                <tr>
                                    <td>{{$data -> nama_item}}</td>
                                    <td>{{$data -> stok_item}} {{$data -> satuan}}</td>
                                    <td>{{number_format($data -> harga_item, 0 , ',', '.')}}/{{$data -> satuan}}</td>
                                    <td>
                                        <button class="btn btn-success" wire:click="getItemId({{$data -> id}})">+</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
