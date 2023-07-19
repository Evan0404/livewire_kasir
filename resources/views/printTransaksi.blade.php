<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Struk | {{ config('app.name', 'Laravel') }} </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  </head>
  <body>
    <br>
    <center>
        <h4 class="card-title">Bukti Pembayaran</h4>
        <br>
        <div class="mb-3" style="border-top: solid black 0.5px; max-width: 340px;border-bottom: solid black 0.5px;">
            <table class="w-100 table">
                <thead>
                    <tr>
                        <th>Items</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Sub</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($detail as $data)
                            <tr style="font-size: 12px; ">
                                <td>{{$data -> nama_item}}</td>
                                <td>Rp {{number_format($data -> harga_item,0,',','.')}}</td>
                                <td>{{$data -> jumlah}}x</td>
                                <td>Rp {{number_format($data -> sub,0,',','.')}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <p style="font-size: 15px;" align="right">Total : <b>Rp{{number_format($data -> total,0,',', '.')}},00</b> <br> Dibayar : <b>Rp{{number_format($data -> dibayar,0,',','.')}},00</b> <br> Kembalian : <b>Rp{{number_format($data -> kembalian,0,',','.')}},00</b></p>
        </div>
        <div style="max-width: 340px;" class="mt-3">
            Terimakasih Telah Berbelanja di
            <h5>{{ config('app.name', 'Laravel') }}</h5>
        </div>
    </center>

    <script>
        window.print()
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
  </body>
</html>
