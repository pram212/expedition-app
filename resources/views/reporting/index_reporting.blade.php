@extends('layouts.app')
@section('title', 'Laporan Pengiriman')
@section('header', 'Laporan Operasional')

@section('css')
    <link rel="stylesheet" href="{{ asset('datatables/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('datatables/buttons.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('datatables/responsive.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">

@endsection

@section('content')
    <div class="card">
        <div class="card-header bg-secondary">Filter Panel</div>
        <div class="card-body">
            <form action="">
                @csrf
                <div class="row space-y-2">
                    <div class="col-md-4 col-sm-12 mb-2">
                        <label>Periode :</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="far fa-calendar-alt"></i>
                                </span>
                            </div>
                            <input type="text" name="created_at" value="{{@$filters['created_at']}}" class="form-control float-right" id="reservation">
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12 mb-2">
                        <label for="register_number">Jenis Dokumen :</label>
                        <select class="select2 w-100 form-control" name="category_id" id="category_id">
                            <option value="">Semua</option>
                            @foreach ($categories as $item)
                                <option value="{{ $item->id }}" @if ($item->id == @$filters['category_id'])
                                    selected
                                @endif>{{ strtoupper($item->name) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 col-sm-12 mb-2">
                        <label for="register_number">Status Bayar :</label>
                        <select class="select2 w-100 form-control" name="payment_statuses_id" id="payment_id">
                            <option value="">Semua</option>
                            @foreach ($paymentStatus as $item)
                                <option value="{{ $item->id }}" @if ($item->id == @$filters['payment_statuses_id'])
                                    selected
                                @endif>{{ strtoupper($item->name) }}</option>
                            @endforeach
                        </select>

                    </div>
                    <div class="col-md-4 col-sm-12 mb-2">
                        <label for="register_number">Status Kirim :</label>
                        <select class="select2 w-100 form-control" name="shippment_statuses_id" id="shipment_id">
                            <option value="">Semua</option>
                            @foreach ($shipmentStatus as $item)
                                <option value="{{ $item->id }}" @if ($item->id == @$filters['shippment_statuses_id'])
                                    selected
                                @endif>{{ strtoupper($item->name) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 col-sm-12 mb-2">
                        <label for="register_number">Kelurahan :</label>
                        <select class="select2 w-100 form-control" name="village_id" id="village_id">
                            <option value="">Semua</option>
                            @foreach ($villages as $item)
                                <option value="{{ $item->id }}" @if ($item->id == @$filters['village_id'])
                                    selected
                                @endif>{{ strtoupper($item->name) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 col-sm-12 mb-2">
                        <label for="register_number">Kecamatan :</label>
                        <select class="select2 w-100 form-control" name="district_id" id="district_id">
                            <option value="">Semua</option>
                            @foreach ($districts as $item)
                                <option value="{{ $item->id }}" @if ($item->id == @$filters['district_id'])
                                    selected
                                @endif>{{ strtoupper($item->name) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 text-center">
                        <button class="btn btn-primary w-25" type="submit" name="filter" value="1">Tampilkan</button>
                        <a href="{{url('reporting')}}" class="btn btn-warning w-25">Reset</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card">
        <div class="card-header bg-secondary">DAFTAR KONSUMEN</div>
        <div class="card-body">
            <table class="table table-sm" id="orders-table">
                <thead class="bg-dark">
                    <tr>
                        <th class="align-middle text-center">No</th>
                        <th class="align-middle text-center">Jenis Dokumen</th>
                        <th class="align-middle text-center">NIK/KK</th>
                        <th class="align-middle text-center">Nama Pemilik</th>
                        <th class="align-middle text-center">Orangtua/Wali</th>
                        <th class="align-middle text-center">Whatsapp</th>
                        <th class="align-middle text-center">Status Pembayaran</th>
                        <th class="align-middle text-center">Status Pengiriman</th>
                        <th class="align-middle text-center">Alamat</th>
                        <th class="align-middle text-center">Kelurahan</th>
                        <th class="align-middle text-center">Kecamatan</th>
                        <th class="align-middle text-center">Tanggal Daftar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ strtoupper(@$item->category->name) }}</td>
                            <td>{{ $item->id_card }}</td>
                            <td>{{ $item->customer_name }}</td>
                            <td>{{ $item->customer_guardian }}</td>
                            <td>{{ $item->phone }}</td>
                            <td>{{ $item->paymentStatus->name }}</td>
                            <td>{{ $item->shippmentStatus->name }}</td>
                            <td>{{ $item->address }}</td>
                            <td>{{ strtoupper(@$item->village->name) }}</td>
                            <td>{{ strtoupper(@$item->district->name) }}</td>
                            <td>{{ $item->created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection

@section('script')
    <script src="{{ asset('datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('datatables/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('datatables/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('datatables/dataTables.responsive.min.js') }}"></script>
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
    <script src="{{ asset('adminlte/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $(".select2").select2({
                theme: 'bootstrap4'
            });
            $(document).on('select2:open', () => {
                document.querySelector('.select2-search__field').focus();
            });

            var created_at = "{!! @$filters->category_id !!}";
            console.log(created_at);

            $('#reservation').daterangepicker()
            // generate datatable untuk tabel master aruskas
            var table = $('#orders-table').DataTable({
                responsive: true,
                paging: false,
                dom: 'Bfrtip',
                buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
            });

        });
    </script>
@endsection
