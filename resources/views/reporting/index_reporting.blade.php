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
    <link rel="stylesheet"
        href="{{ asset('adminlte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">

@endsection

@section('content')
    <div class="card">
        <div class="card-header bg-secondary">FILTER PANEL</div>
        <div class="card-body">
            <form action="">
                <div class="row">
                    <div class="col-md-10 col-sm-12">
                        <div class="row border rounded p-1">
                            <div class="col-md-4 col-sm-12 mb-2">
                                <label>Periode :</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="far fa-calendar-alt"></i>
                                        </span>
                                    </div>
                                    <input type="text" name="created_at" value="{{ request()->get('created_at') }}"
                                        class="form-control float-right" id="reservation">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12 mb-2">
                                <label for="register_number">Jenis Dokumen :</label>
                                <select class="select2 w-100 form-control" name="category_id" id="category_id">
                                    <option value="">Semua</option>
                                    @foreach ($categories as $item)
                                        <option value="{{ $item->id }}" @if ($item->id == request()->get('category_id')) selected @endif>
                                            {{ strtoupper($item->name) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 col-sm-12 mb-2">
                                <label for="register_number">Status Bayar :</label>
                                <select class="select2 w-100 form-control" name="payment_statuses_id" id="payment_id">
                                    <option value="">Semua</option>
                                    @foreach ($paymentStatus as $item)
                                        <option value="{{ $item->id }}" @if ($item->id == request()->get('payment_statuses_id')) selected @endif>
                                            {{ strtoupper($item->name) }}</option>
                                    @endforeach
                                </select>
        
                            </div>
                            <div class="col-md-4 col-sm-12 mb-2">
                                <label for="register_number">Status Kirim :</label>
                                <select class="select2 w-100 form-control" name="shippment_statuses_id" id="shipment_id">
                                    <option value="">Semua</option>
                                    @foreach ($shipmentStatus as $item)
                                        <option value="{{ $item->id }}" @if ($item->id == request()->get('shippment_statuses_id')) selected @endif>
                                            {{ strtoupper($item->name) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 col-sm-12 mb-2">
                                <label for="register_number">Kelurahan :</label>
                                <select class="select2 w-100 form-control" name="village_id" id="village_id">
                                    <option value="">Semua</option>
                                    @foreach ($villages as $item)
                                        <option value="{{ $item->id }}" @if ($item->id == request()->get('village_id')) selected @endif>
                                            {{ strtoupper($item->name) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 col-sm-12 mb-2">
                                <label for="register_number">Kecamatan :</label>
                                <select class="select2 w-100 form-control" name="district_id" id="district_id">
                                    <option value="">Semua</option>
                                    @foreach ($districts as $item)
                                        <option value="{{ $item->id }}" @if ($item->id == request()->get('district_id')) selected @endif>
                                            {{ strtoupper($item->name) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 col-sm-12 mb-2">
                                <div class="form-group">
                                    <label for="">No. WA</label>
                                    <input type="text" autocomplete="off" value="{{ request()->get('phone') }}" name="phone" id="id_card"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12 mb-2">
                                <label for="limit">Limit :</label>
                                <select class="select2 w-100 form-control" name="limit" id="limit">
                                    <option value="10" @if (request()->get('limit') == 10) selected @endif>10</option>
                                    <option value="25" @if (request()->get('limit') == 25) selected @endif>25</option>
                                    <option value="50" @if (request()->get('limit') == 50) selected @endif>50</option>
                                    <option value="100" @if (request()->get('limit') == 100) selected @endif>100</option>
                                    <option value="200" @if (request()->get('limit') == 200) selected @endif>200</option>
                                    <option value="300" @if (request()->get('limit') == 300) selected @endif>300</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-12">
                        
                        <button class="btn btn-primary w-100 mb-2" type="submit" name="filter" value="1">Tampilkan</button>
                        <a href="{{ url('reporting') }}" class="btn btn-warning w-100 mb-2">Reset</a>
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
                        <th class="align-middle text-center">ID</th>
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
                            <td>{{ $item->id }}</td>
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
            
            // DATE PICKER HANDLER
            $('#reservation').daterangepicker({
                autoUpdateInput: false,
                locale: {
                    cancelLabel: 'Clear'
                }
            })

            $('#reservation').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format(
                    'DD/MM/YYYY'));
            });

            $('#reservation').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
            });
            // DATE PICKER HANDLER END

            var created_at = "{!! @$filters->category_id !!}";
            console.log(created_at);

            // generate datatable untuk tabel master aruskas
            var table = $('#orders-table').DataTable({
                responsive: true,
                paging: false,
                dom: 'Bfrtip',
                searching: false,
                select: {
                    style: 'multi'
                },
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
                        text: 'Print All',
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
                        text: 'Print Selected',
                        exportOptions: {
                            columns: ':visible',
                        }
                    },
                    'colvis'
                ],
            });

        });
    </script>
@endsection
