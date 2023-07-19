<div>
    <div class="pagetitle">
      <h1>Transaksi</h1>
    </div>
    <div class="card shadow-lg p-3">
        <div class="row">
            <div class="col-8">
                <input type="text" wire:model="src" placeholder="Cari..." class="form-control mb-2">
            </div>
            <div class="col-4">
                <button class="btn btn-primary" wire:click="render">Cari</button>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Transaksi</th>
                        <th>Total</th>
                        <th>Dibayar</th>
                        <th>Kembalian</th>
                        <th>Act</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transaksi as $data)
                        <tr>
                            <td>{{$no++}}</td>
                            <td>{{$data -> kode_transaksi}}</td>
                            <td>Rp {{number_format($data -> total, 0, ',', '.')}},00</td>
                            <td>Rp {{number_format($data -> dibayar, 0, ',', '.')}},00</td>
                            <td>Rp {{number_format($data -> kembalian, 0, ',', '.')}},00</td>
                            <td>
                                <button class="btn btn-warning" onclick="window.open('transaksi/{{$data -> kode_transaksi}}', 'width=340px,height=555,left=160,top=170')">
                                    <i class="bi bi-printer"></i>
                                </button>
                                {{-- <a class="btn btn-warning" target="blank" href="/transaksi/{{$data -> kode_transaksi}}"><i class="bi bi-printer"></i></a> --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
