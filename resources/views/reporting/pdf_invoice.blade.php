<!doctype html>
<html lang="en">

<head>
    <title>Invoice</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <style>
            .page-break {
                page-break-after: always;
            }
        </style>
</head>

<body>
    @foreach ($orders as $order)
    <div class="container-fluid border rounded p-2 mb-1">
        <div class="border border-top-0 border-right-0 border-left-0">
            <b>Depok Cooperative Mart</b><br>
            <small>Jl Margonda Raya No. 54 | 087882622550</small>
        </div>
        <div class="text-center my-2">
            <strong>INVOICE DOKUMEN</strong>
        </div>
        <div class="text-right border border-top-0 border-right-0 border-left-0">
            Tanggal Daftar : {{ date('d/m/Y', strtotime($order->created_at)) }}
        </div>
        <table class="">
            <tr>
                <td>Nama</td>
                <td>: {{ucwords($order->customer_name)}}</td>
            </tr>
            <tr>
                <td>Telepon</td>
                <td>: {{$order->phone}}</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>: {{$order->address}}</td>
            </tr>
            <tr>
                <td>Kelurahan / Kecamatan</td>
                <td>: {{ ucwords(strtolower($order->district->name)) }} / {{ ucwords(strtolower($order->village->name)) }}</td>
            </tr>
        </table>
        <table class="table table-sm table-bordered">
            <thead>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Biaya Kirim</th>
                <th>Status Bayar</th>
            </thead>
            <tbody>
                <tr>
                    <td>{{ strtoupper($order->category->name) }}</td>
                    <td>1</td>
                    <td>Rp 20.000,00</td>
                    <td>{{ $order->paymentStatus->name }}</td>
                </tr>
                <tr>
                    <td colspan="2">
                        <label for="">Penerima: </label>
                        <textarea name="" id="" cols="30" rows="10"></textarea>
                    </td>
                    <td colspan="2">
                        <label for="">Pengirim: </label>
                        <textarea class="" name="" id="" cols="30" rows="10"></textarea>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    @if ($loop->iteration % 2 == 0 && $loop->iteration != count($orders))
    <div class="page-break"></div>
    @endif
    @endforeach
</body>

</html>
