<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">

    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css?v=3.2.0') }}">
    <title>INVOICE</title>
</head>

<body>
    <div class="container-fluid p-2">
        <div class="card card-primary">
            <div class="card-header text-center">
                <h1>Pendaftaran Berhasil!</h1>
            </div>
            <div class="card-body">
                <p>Dokumen akan segera dikirim setelah selesai dikerjakan oleh pihak dukcapil. Silahkan konfirmasi
                    pendaftaran dan pembayaran Anda dengan menekan ikon whatsapp di posisi kanan bawah layar Anda.</p>
                <p>Biaya pengiriman sebesar Rp 20.000. Kirim ke salah satu rekening bank di bawah ini.</p>
                <p><a href="{{ url()->previous() }}">Kembali ke formulir</a></p>
                <div class="card card-danger">
                    <div class="card-header">
                        BANK BNI
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item">No. Rek : 3001201897</li>
                            <li class="list-group-item">A/n : Koperasi Korpri Depok Bersahabat</li>
                        </ul>
                    </div>
                </div>
                <div class="card card-danger">
                    <div class="card-header">
                        BANK BJB
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item">No. Rek : 0085939742001</li>
                            <li class="list-group-item">A/n : Koperasi Korpri Depok Bersahabat</li>
                        </ul>
                    </div>
                </div>
                <div class="card card-danger">
                    <div class="card-header">
                        BANK BTN
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item">No. Rek : 0018401500062093</li>
                            <li class="list-group-item">A/n : Koperasi Korpri Depok Bersahabat</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="alert alert-warning" role="alert">
                    Batas akhir pembayaran pukul 14.00 WIB.
                </div>
            </div>
        </div>
    </div>

    <form action="https://api.whatsapp.com/send">
        <input type="hidden" name="phone" value="6287882622550">
        @if ($order->category_id == 1)
            <textarea class="d-none" name="text" id="text" cols="30" rows="10">
            Halo Admin, Saya sudah melakukan pendaftaran {{ strtoupper($order->category->name) }} dengan data sebagai berikut : 
            Nama : {{ $order->customer_name }}
            No. Pendaftaran : {{ $order->register_number }}
            NIK : {{ $order->id_card }}
            Alamat : {{ $order->address }}
            Kecamatan : {{ $order->district->name }}
            Kelurahan : {{ $order->village->name }}
        </textarea>
        @else
            <textarea class="d-none" name="text" id="text" cols="30" rows="10">
            Halo Admin, Saya sudah melakukan pendaftaran {{ strtoupper($order->category->name) }} dengan data sebagai berikut : 
            Nama Anak : {{ $order->customer_name }}
            No. Pendaftaran : {{ $order->register_number }}
            No. KK : {{ $order->id_card }}
            Nama Orangtua : {{ $order->customer_guardian }}
            Alamat : {{ $order->address }}
            Kecamatan : {{ $order->district->name }}
            Kelurahan : {{ $order->village->name }}
        </textarea>
        @endif
        <button type="submit" class="img-thumbnail rounded-circle" style="position: fixed; right: 10px; bottom: 10px;">
            <img src="{{ asset('img/wa.png') }}" alt="" width="80" class="img-thumbnail rounded-circle"
                style="opacity: 0.6;">
        </button>
    </form>

    <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>

    <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}?v=3.2.0"></script>

    <script>
        $(document).ready(function() {

        });
    </script>
</body>

</html>
