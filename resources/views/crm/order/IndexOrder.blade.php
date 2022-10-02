@extends('layouts.app')
@php
$title = '';
$header = '';
if (request()->is('crm/order')) {
    $title = 'Manajemen Konsumen';
    $header = 'Manajemen Konsumen';
} elseif (request()->is('invoice')) {
    $title = 'Cetak Invoice';
    $header = 'Cetak Invoice';
} elseif (request()->is('crm/operation/payment')) {
    $title = 'Pembayaran';
    $header = 'Pembayaran';
} elseif (request()->is('crm/operation/shipment')) {
    $title = 'Pengiriman';
    $header = 'Pengiriman';
} elseif (request()->is('crm/trash')) {
    $title = 'Sampah';
    $header = 'Sampah';
}
@endphp

@section('title', $title)
@section('header', $header)

@section('content')
    <div class="card">
        <div class="card-header bg-secondary">FILTER PANEL</div>
        <div class="card-body">
            <form action="" id="form-filter">
                <div class="row">
                    <div class="col-sm-12 col-md-10">
                        <div class="row border rounded p-1">
                            <div class="col-md-4 col-sm-12 mb-2">
                                <div class="form-group">
                                    <label for="">Nama</label>
                                    <input type="text" autocomplete="off" value="{{ request()->get('customer_name') }}" name="customer_name"
                                        id="customer_name" class="form-control" placeholder="Masukan satu nama saja"
                                        >
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12 mb-2">
                                <div class="form-group">
                                    <label for="">NIK</label>
                                    <input type="text" autocomplete="off" value="{{ request()->get('id_card') }}" name="id_card" id="id_card"
                                        class="form-control" placeholder="Masukan satu NIK/KK saja">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12 mb-2">
                                <label>Periode :</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="far fa-calendar-alt"></i>
                                        </span>
                                    </div>
                                    <input type="text" autocomplete="off" name="created_at" value="{{ request()->get('created_at') }}"
                                        class="form-control float-right" id="reservation" >
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12 mb-2">
                                <div class="form-group">
                                    <label for="">No. WA</label>
                                    <input type="text" autocomplete="off" value="{{ request()->get('phone') }}" name="phone" id="id_card"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12 mb-2">
                                <label for="register_number">Jenis Dokumen :</label>
                                <select class="select2 w-100 form-control" name="category_id" id="category_id">
                                    <option value="">Semua</option>
                                    @foreach ($categories as $item)
                                        <option value="{{ $item->id }}"
                                            @if ($item->id == request()->get('category_id')) selected @endif>
                                            {{ strtoupper($item->name) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 col-sm-12 mb-2">
                                <label for="register_number">Status Bayar :</label>
                                <select class="select2 w-100 form-control" name="payment_statuses_id" id="payment_id">
                                    <option value="">Semua</option>
                                    @foreach ($paymentStatus as $item)
                                        <option value="{{ $item->id }}"
                                            @if ($item->id == request()->get('payment_statuses_id')) selected @endif>
                                            {{ strtoupper($item->name) }}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="col-md-4 col-sm-12 mb-2">
                                <label for="register_number">Status Kirim :</label>
                                <select class="select2 w-100 form-control" name="shippment_statuses_id" id="shipment_id">
                                    <option value="">Semua</option>
                                    @foreach ($shipmentStatus as $item)
                                        <option value="{{ $item->id }}"
                                            @if ($item->id == request()->get('shippment_statuses_id')) selected @endif>
                                            {{ strtoupper($item->name) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 col-sm-12 mb-2">
                                <label for="register_number">Kelurahan :</label>
                                <select class="select2 w-100 form-control" name="village_id" id="village_id">
                                    <option value="">Semua</option>
                                    @foreach ($villages as $item)
                                        <option value="{{ $item->id }}"
                                            @if ($item->id == request()->get('village_id')) selected @endif>
                                            {{ strtoupper($item->name) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 col-sm-12 mb-2">
                                <label for="register_number">Kecamatan :</label>
                                <select class="select2 w-100 form-control" name="district_id" id="district_id">
                                    <option value="">Semua</option>
                                    @foreach ($districts as $item)
                                        <option value="{{ $item->id }}"
                                            @if ($item->id == request()->get('district_id')) selected @endif>
                                            {{ strtoupper($item->name) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 col-sm-12 mb-2">
                                <label for="limit">Limit :</label>
                                <select class="select2 w-100 form-control" name="limit" id="limit">
                                    <option value="10" @if (request()->get('limit') == 10) selected @endif>10</option>
                                    <option value="25" @if (request()->get('limit') == 25) selected @endif>25</option>
                                    <option value="50" @if (request()->get('limit') == 50) selected @endif>50</option>
                                    <option value="100" @if (request()->get('limit') == 100) selected @endif>100</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-2">
                        <button class="btn m-1 btn-primary w-100 align-middle" type="submit" name="filter"
                            value="1">Tampilkan</button>
                        <a href="{{ url('/crm/order') }}" class="btn w-100 m-1 btn-warning align-middle">Reset</a>
                    </div>
                </div>
            </form>

            <form action="{{ url('/crm/delete/multiple') }}" method="POST" id="form-delete">
                @csrf
                <input type="hidden" name="ids_orders" class="ids_orders" id="ids_orders">
            </form>

            <form action="{{ url('/invoice/multiple/print') }}" target="_blank" id="form-invoice">
                <input type="hidden" name="ids_order" class="ids_orders" id="ids_orders">
            </form>

            <form action="{{ url('/crm/trash/multidestroy') }}" method="POST" id="form-multi-forcedelete">
                @csrf
                <input type="hidden" name="ids_orders" class="ids_orders" id="ids_forcedelete">
            </form>

            <form action="{{ url('/crm/trash/multirestore') }}" method="POST" id="form-multi-restore">
                @csrf
                <input type="hidden" name="ids_orders" class="ids_orders" id="ids_orders">
            </form>

        </div>
    </div>
    <div class="card">
        <div class="card-header bg-secondary">TABEL KONSUMEN</div>
        <div class="card-body">
            <div class="row p-2 m-1 @if (request()->is('crm/operation/payment')) '' @else  border rounded @endif">
                <div class="col-12">
                    @if (request()->is('crm/order'))
                        <a href="{{ url('/crm/order/create') }}" class="btn btn-sm mx-1 btn-success">Buat Baru</a>
                        <button class="btn btn-sm mx-1 btn-danger" type="button" id="btn-multi-delete">Hapus</button>
                    @endif

                    @if (request()->is('invoice'))
                        <button type="button" class="btn btn-secondary m-1" id="print-multiple">Cetak</button>
                    @endif

                    @if (request()->is('crm/operation/shipment'))
                        <form action="{{ url('/crm/operation/shipment/multiupdate') }}" method="POST"
                            id="form-shipment">
                            @csrf
                            <div class="form-group">
                                <label for="address">Jenis Pengiriman :</label>
                                <select name="shippment_statuses_id" class="w-100 select2 form-control"
                                    id="shippment_statuses_id">
                                    <option value="">Pilih</option>
                                    @foreach ($shipmentStatus as $item)
                                        <option value="{{ $item->id }}">{{ strtoupper($item->name) }}</option>
                                    @endforeach
                                </select>
                                <input type="hidden" name="id" class="ids_orders" id="ids_orders">
                            </div>
                            <button type="submit" class="btn btn-primary" id="btn-shipping">Simpan</button>
                        </form>
                    @endif
                    @if (request()->is('crm/trash'))
                        <button class="btn btn-sm btn-danger" id="btn-multi-forcedelete">Hapus Permanen</button>
                        <button class="btn btn-sm btn-primary" id="btn-multi-restore">Pulihkan</button>
                    @endif
                </div>
            </div>
            <table class="table table-sm" id="orders-table">
                <thead class="bg-dark">
                    <tr>
                        <th class="align-middle text-center">ID</th>
                        <th class="align-middle text-center">Nama Pemilik</th>
                        <th class="align-middle text-center">Jenis Dokumen</th>
                        <th class="align-middle text-center">NIK/KK</th>
                        <th class="align-middle text-center">Orangtua/Wali</th>
                        <th class="align-middle text-center">Whatsapp</th>
                        <th class="align-middle text-center">
                            Status Pembayaran
                        </th>
                        <th class="align-middle text-center">
                            Status Pengiriman
                        </th>
                        <th class="align-middle text-center">Alamat</th>
                        <th class="align-middle text-center">Kelurahan</th>
                        <th class="align-middle text-center">Kecamatan</th>
                        <th class="align-middle text-center">Tanggal Daftar</th>
                        <th class="align-middle text-center">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ ucwords($order->customer_name) }}</td>
                            <td>{{ strtoupper($order->category->name) }}</td>
                            <td>{{ strtoupper($order->id_card) }}</td>
                            <td>{{ ucwords($order->customer_guardian) }}</td>
                            <td>{{ $order->phone }}</td>
                            <td>{{ ucwords($order->paymentStatus->name) }}</td>
                            <td>{{ ucwords($order->shippmentStatus->name) }}</td>
                            <td>{{ $order->address }}</td>
                            <td>{{ strtoupper($order->village->name) }}</td>
                            <td>{{ strtoupper($order->district->name) }}</td>
                            <td>{{ date('d/m/Y', strtotime($order->created_at)) }}</td>
                            <td>
                                @if (request()->is('crm/order'))
                                    <a href="{{ url("crm/order/$order->id/edit") }}" class="btn btn-info">Edit</a>
                                @endif
                                @if (request()->is('crm/operation/payment'))
                                    <form action="{{ url("crm/operation/payment/$order->id") }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit"
                                            class="btn btn-sm @if ($order->paymentStatus->id == 1) btn-warning
                                    @else 
                                        btn-danger @endif">
                                            @if ($order->paymentStatus->id == 1)
                                                Bayar
                                            @else
                                                Cancel
                                            @endif
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>
            @if ($orders->hasPages())
                <div class="w-100 overflow-auto">
                    {{ $orders->onEachSide(5)->links() }}
                </div>
            @endif
        </div>
    </div>

@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('datatables/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('datatables/buttons.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('datatables/responsive.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('adminlte/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('adminlte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
@endsection

@section('script')
    <script src="{{ asset('datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('datatables/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('datatables/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('datatables/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('datatables/buttons.print.min.js') }}"></script>
    <script src="{{ asset('datatables/jszip.min.js') }}"></script>
    <script src="{{ asset('datatables/pdfmake.min.js') }}"></script>
    <script src="{{ asset('datatables/vfs_fonts.js') }}"></script>
    <script src="{{ asset('datatables/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/inputmask/jquery.inputmask.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <script src="../../js/filter_crm.js"></script>

    <script>
        // DATATABLE HANDLER
        var table = $('#orders-table').DataTable({
            responsive: true,
            select: {
                style: 'multi'
            },
            searching: false,
            paging: false,
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'copyHtml5',
                    exportOptions: {
                        columns: [0, ':visible']
                    }
                },
                {
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'print',
                    text: 'Print all',
                    exportOptions: {
                        columns: ':visible',
                        modifier: {
                            selected: null
                        }
                    },
                    customize: function(win) {
                        $(win.document.body)
                            .css('font-size', '10pt')

                        $(win.document.body).find('table')
                            .addClass('compact')
                            .css('font-size', 'inherit');
                    }
                },
                {
                    extend: 'print',
                    text: 'Print selected',
                    exportOptions: {
                        columns: ':visible',
                    }
                },
                'colvis'
            ],
            autoWidth: true,
        });

        var idsOrder = [];

        table.on('click', 'tr', function() {
            var tr = $(this).closest('tr');
            var data = table.row(tr).data();
            // console.log(data[0]);
            if (table.row(this, {
                    selected: true
                }).any()) {
                var carIndex = idsOrder.indexOf(data[0]);
                idsOrder.splice(carIndex, 1);
            } else {
                idsOrder.push(data[0])
            }
        });
        // DATATABLE HANDLER END

        // BUTTON HANDLER 

        $("#btn-multi-delete").click(function(e) {
            $(".ids_orders").val(idsOrder);
            e.preventDefault();
            if (idsOrder < 1) {
                Swal.fire({
                    position: 'top-end',
                    toast: true,
                    timer: 3000,
                    timerProgressBar: true,
                    showConfirmButton: false,
                    icon: 'error',
                    title: "Gagal! Pilih minimal 1 data",
                })
            } else {
                Swal.fire({
                    title: 'Apakah anda yakin?',
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonText: `Ya, Hapus`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        $("#form-delete").submit();
                    }
                });
            }
        });

        $("#btn-multi-forcedelete").click(function(e) {
            $(".ids_orders").val(idsOrder);
            console.log($(".ids_orders").val())
            e.preventDefault();
            if (idsOrder < 1) {
                Swal.fire({
                    position: 'top-end',
                    toast: true,
                    timer: 3000,
                    timerProgressBar: true,
                    showConfirmButton: false,
                    icon: 'error',
                    title: "Gagal! Pilih minimal 1 data",
                })
            } else {
                Swal.fire({
                    title: 'Apakah anda yakin?',
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonText: `Ya, Hapus Permanen`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        $("#form-multi-forcedelete").submit();
                    }
                });
            }
        });

        $("#btn-multi-restore").click(function(e) {
            $(".ids_orders").val(idsOrder);
            console.log($(".ids_orders").val())
            e.preventDefault();
            if (idsOrder < 1) {
                Swal.fire({
                    position: 'top-end',
                    toast: true,
                    timer: 3000,
                    timerProgressBar: true,
                    showConfirmButton: false,
                    icon: 'error',
                    title: "Gagal! Pilih minimal 1 data",
                })
            } else {
                Swal.fire({
                    title: 'Apakah anda yakin?',
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonText: `Ya, Pulihkan`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        $("#form-multi-restore").submit();
                    }
                });
            }
        });

        $("#print-multiple").click(function(e) {
            e.preventDefault();
            $(".ids_orders").val(idsOrder);
            console.log($(".ids_orders").val())
            e.preventDefault();
            if (idsOrder < 1) {
                Swal.fire({
                    position: 'top-end',
                    toast: true,
                    timer: 3000,
                    timerProgressBar: true,
                    showConfirmButton: false,
                    icon: 'error',
                    title: "Gagal! Pilih minimal 1 data",
                })
            } else {
                Swal.fire({
                    title: 'Apakah anda yakin?',
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonText: `Ya, Cetak`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        $("#form-invoice").submit();
                    }
                });
            }
        });

        $("#form-shipment").submit(function(e) {
            e.preventDefault();
            var shippment_statuses_id = $("#shippment_statuses_id").val();
            $(".ids_orders").val(idsOrder);
            if (idsOrder < 1) {
                Swal.fire({
                    position: 'top-end',
                    toast: true,
                    timer: 3000,
                    timerProgressBar: true,
                    showConfirmButton: false,
                    icon: 'error',
                    title: "Gagal! Pilih minimal 1 data",
                })
            } else if (!shippment_statuses_id) {
                Swal.fire({
                    position: 'top-end',
                    toast: true,
                    timer: 3000,
                    timerProgressBar: true,
                    showConfirmButton: false,
                    icon: 'error',
                    title: "Gagal! Jenis pengiriman wajib dipilih",
                })
            } else {
                Swal.fire({
                    title: 'Apakah anda yakin?',
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonText: `Ya, Simpan`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit();
                    }
                });
            }
        });

        $("#form-filter").submit(function(e) {
            e.preventDefault();
            if (idsOrder.length > 0) {
                Swal.fire({
                    title: 'Apakah Anda Yakin?',
                    icon: 'warning',
                    text: 'Data yang sudah anda pilih tidak akan diproses.',
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonText: `Ya, Lanjutkan Pencarian`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit();
                    }
                });
            } else {
                this.submit()
            }
        });
        // BUTTON HANDLER  END
    </script>
@endsection
