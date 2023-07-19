<div>
    <div class="pagetitle">
      <h1>Item For Sale</h1>
    </div>

    <center>
        <div class="card shadow-lg p-3" style="max-width: 600px;">
            @if($formStatus == 0)
            <form wire:submit.prevent="insert" method="post" enctype="multipart/form-data">
                <h3 class="card-title">Tambah Item yang diJual</h3>
            @elseif($formStatus !== 0)
            <h3 class="card-title">Edit Item yang diJual</h3>
            <form wire:submit.prevent="update" method="post" enctype="multipart/form-data">
            @endif
                <p class="form-label" align="left">Nama Item</p>
                <input wire:model="nama" type="text" id="name" required placeholder="ex: Item Name" class="form-control mb-2">
                <div class="row">
                    <div class="col-md-6">
                        <p class="form-label" align="left">Stok</p>
                        <input wire:model="stok" type="number" step="any" min="0" class="form-control mb-2" id="stok" required>
                    </div>
                    <div class="col-md-6">
                        <p class="form-label" align="left">Satuan</p>
                        <select wire:model="satuan" required id="satuan" class="form-control mb-2">
                            <option hidden>Pilih Satuan Item</option>
                            <option value="Kg">Kg</option>
                            <option value="Gram">Gram</option>
                            <option value="Liter">Liter</option>
                            <option value="Kotak">Kotak</option>
                            <option value="Bungkus">Bungkus</option>
                            <option value="Biji">Biji</option>
                            <option value="Tusuk">Tusuk</option>
                        </select>
                    </div>
                </div>
                <p class="form-label" align="left">Harga</p>
                <input wire:model="harga" type="number" required placeholder="ex: 10000" class="form-control">
                <br>
                @if($formStatus == 0)
                <button class="btn btn-primary w-100" >Tambah</button>
                @elseif($formStatus !== 0)
                <div class="row">
                    <div class="col-md-6">
                         <button class="btn btn-primary w-100" >Update</button>
                    </div>
                    <div class="col-md-6">
                        <button type="button" class="btn btn-secondary w-100" wire:click="cancelUpdate()">
                            Batal
                        </button>
                    </div>
                </div>
                @endif
            </form>
        </div>
    </center>
    <br>
    <div class="card shadow-lg p-3 ">
        <h5 class="card-title">Daftar Item Yang di Jual</h5>
        <div class="row">
            <div class="col-8">
                <input type="text" class="form-control mb-2" placeholder="Cari" wire:model="src">
            </div>
            <div class="col-4">
                <button class="btn btn-primary w-100" wire:click="render">Cari</button>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Stok</th>
                        <th>Harga</th>
                        <th>Act</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($item as $data)
                        <tr>
                            <td>{{$no++}}</td>
                            <td>{{$data -> nama_item}}</td>
                            <td>{{$data -> stok_item}} {{$data -> satuan}}</td>
                            <td>{{number_format($data -> harga_item, 0, ',', '.')}}/{{$data -> satuan}}</td>
                            <td>
                                <button class="btn btn-success" wire:click="getIdUpdate({{$data -> id}})">Edit</button>
                                <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete{{$data -> id}}">Hapus</button>
                            </td>
                        </tr>
                        <!-- Modal DELETE -->
                        <div class="modal fade" id="delete{{$data -> id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog bg-danger text-white">
                                <div class="modal-content bg-danger text-white">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Delete Item {{$data -> nama_item}}</h5>
                                    <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure to delete this item ?
                                    </div>
                                    <div class="modal-footer">
                                    <button wire:click="delete({{$data -> id}})" data-bs-dismiss="modal" class="btn btn-light">Hapus</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
