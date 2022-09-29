<!doctype html>
<html lang="en">

<head>
    <title>Bukti Pengiriman</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        @media print {
            @page {
                size: portrait;
                padding: 25px;
            }
        }

        .page-break {
            page-break-after: always;
        }
    </style>
</head>

<body>
    @foreach ($orders as $order)
        <div class="card border-secondary mb-2 p-0">
            @if ($order->paymentStatus->id == 2)
            <img src="{{asset('img/icon_lunas.png')}}" width="200px" alt="" style="opacity: 0.2; position: absolute; top:0; right:5%">
            @endif
            <div class="card-body">
                <div class="row d-flex justify-content-between mb-2">
                    <div class="col-6">
                        <img class="p-0" src="{{ asset('img/logo.png') }}" alt="" width="80px">
                    </div>
                    <div class="col-6">
                        <h6>NO. INVOICE :  #INV{{$order->id . date('dmY', strtotime($order->created_at))}}</h6>
                    </div>
                    <div class="col-6">
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 border">
                        <p class="card-text">
                            <small>
                                <b>Depok Cooperative Mart</b>
                                <br>Jl Margonda Raya No. 54 | 087882622550
                            </small>
                        </p>
                        <p class="card-text">
                            <small>
                                <b>Kepada :</b>
                                <br>{{ ucwords($order->customer_name) }}
                                @if ($order->category->id == 2)
                                    <br>{{ $order->customer_guardian }} (orangtua/wali)
                                @endif
                                <br>{{ ucwords($order->address . ', ' . trim($order->village->name, '["]') . ', ' . trim($order->district->name, '["]') . ', ') }}
                                <br>{{ $order->phone }}
                            </small>
                        </p>
                    </div>
                    <div class="col-6 border">
                        <div class="row">
                            <div class="col-5">
                                <p>
                                    <small>
                                        Isi <br>
                                        Tagihan <br>
                                        Metode Pembayaran <br>
                                    </small>
                                </p>
                            </div>
                            <div class="col-7">
                                <p>
                                    <small>
                                        : {{ strtoupper($order->category->name) }} <br>
                                        : <strong>{{ strtoupper($order->paymentStatus->name) }}</strong> <br>
                                        : Transfer bank
                                    </small>
                                </p>
                            </div>
                        </div>
                        <div class="row border-top text-center">
                            <div class="col-6 border">
                                <small>
                                    <b>Penerima</b>
                                    <br><br><br><br><br>
                                </small>
                            </div>
                            <div class="col-6 border">
                                <small>
                                    <b>Pengirim</b>
                                    <br><br><br><br><br>
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        @if ($loop->iteration % 4 == 0 && $loop->iteration != count($orders))
            <div class="page-break"></div>
        @else
            <div></div>
        @endif
    @endforeach
    <script>
        window.print();
    </script>
</body>

</html>
