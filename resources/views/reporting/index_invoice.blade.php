@extends('layouts.app')
@section('title', 'Invoice')
@section('header', 'Cetak Invoice')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="{{asset('datatables/buttons.dataTables.min.css')}}">
    <link rel="stylesheet" href="{{asset('datatables/responsive.dataTables.min.css')}}">
@endsection

@section('content')
<div class="card">
    <div class="card-header bg-secondary">PANEL</div>
    <div class="card-body">
        <form action="{{url('/invoice/multiple/print')}}" target="_blank" id="form-invoice">
            <div class="row">
                <div class="col-12">
                    <input type="hidden" name="ids_order" id="idsOrder">
                    <button type="submit" class="btn btn-primary m-2">Cetak Banyak</button>
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
                    <th class="align-middle text-center">Alamat</th>
                    <th class="align-middle text-center">Kelurahan</th>
                    <th class="align-middle text-center">Kecamatan</th>
                    <th class="align-middle text-center">Opsi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

@endsection

@section('script')
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="{{asset('datatables/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('datatables/dataTables.select.min.js')}}"></script>
    <script src="{{asset('datatables/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('datatables/buttons.html5.min.js')}}"></script>
    <script src="{{asset('datatables/buttons.print.min.js')}}"></script>
    <script src="{{asset('datatables/jszip.min.js')}}"></script>
    <script src="{{asset('datatables/pdfmake.min.js')}}"></script>
    <script src="{{asset('datatables/vfs_fonts.js')}}"></script> 
    <script src="{{asset('datatables/buttons.colVis.min.js')}}"></script> 
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    <script>
        // generate datatable untuk tabel master aruskas
        var table = $('#orders-table').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            lengthMenu: [
                [ 10, 25, 50, -1 ],
                [ '10 rows', '25 rows', '50 rows', 'Show all' ]
            ],
            select: { style: 'multi' },
            dom: 'Bfrtip',
            buttons: [
                'colvis', 
                'pageLength' 
            ],
            ajax: '/datatable/getinvoiceorder',
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'category_id', name: 'category_id' },
                { data: 'id_card', name: 'id_card' },
                { data: 'customer_name', name: 'customer_name' },
                { data: 'customer_guardian', name: 'customer_guardian' },
                { data: 'phone', name: 'phone' },
                { data: 'payment_statuses_id', name: 'payment_statuses_id' },
                { data: 'address', name: 'address' },
                { data: 'village_id', name: 'village_id' },
                { data: 'district_id', name: 'district_id' },
                { data: 'action', name: 'action' },
            ],
        });

        var idsOrder = [];
        table.on('click', 'tr', function () {
            var tr = $(this).closest('tr');
            var data = table.row(tr).data();
            if ( table.row( this, { selected: true } ).any() ) {
                var carIndex = idsOrder.indexOf(data.id);
                idsOrder.splice(carIndex, 1);
                $("#idsOrder").val(idsOrder);
            }
            else {
                idsOrder.push(data.id)
                $("#idsOrder").val(idsOrder);
            }
        });

        $("#form-invoice").submit(function (e) { 
            e.preventDefault();
            if (idsOrder.length < 1) {
                Swal.fire({
                    title : "Error! pilih minimal satu data",
                    icon : "error"
                })
            } else {
                this.submit()
            }
        });

    </script>
@endsection
