@extends('layouts.app')
@section('title', 'Konsumen')
@section('header', 'Manajemen Konsumen')

@section('css')
    <link rel="stylesheet" href="{{asset('datatables/jquery.dataTables.min.css')}}">
    <link rel="stylesheet" href="{{asset('datatables/buttons.dataTables.min.css')}}">
    <link rel="stylesheet" href="{{asset('datatables/responsive.dataTables.min.css')}}">
@endsection

@section('content')
<div class="card">
    <div class="card-header bg-secondary">CRUD Panel</div>
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <a href="{{url('/crm/order/create')}}" class="btn btn-success m-2">Tambah Konsumen</a>
                <button class="btn btn-danger m-2" type="button" id="btn-multi-delete">Hapus</button>
            </div>
        </div>
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
                    <th class="align-middle text-center">Opsi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

@endsection

@section('script')
    <script src="{{asset('datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('datatables/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('datatables/dataTables.select.min.js')}}"></script>
    <script src="{{asset('datatables/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('datatables/buttons.html5.min.js')}}"></script>
    <script src="{{asset('datatables/buttons.print.min.js')}}"></script>
    <script src="{{asset('datatables/jszip.min.js')}}"></script>
    <script src="{{asset('datatables/pdfmake.min.js')}}"></script>
    <script src="{{asset('datatables/vfs_fonts.js')}}"></script> 
    <script src="{{asset('datatables/buttons.colVis.min.js')}}"></script>

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
            buttons: ['copy', 'csv', 'excel', 'pdf', 'print', 'colvis', 'pageLength' ],
            ajax: '/datatable/getorder',
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'category_id', name: 'category_id' },
                { data: 'id_card', name: 'id_card' },
                { data: 'customer_name', name: 'customer_name' },
                { data: 'customer_guardian', name: 'customer_guardian' },
                { data: 'phone', name: 'phone' },
                { data: 'payment_statuses_id', name: 'payment_statuses_id' },
                { data: 'shippment_statuses_id', name: 'shippment_statuses_id' },
                { data: 'address', name: 'address' },
                { data: 'village_id', name: 'village_id' },
                { data: 'district_id', name: 'district_id' },
                { data: 'created_at', name: 'created_at' },
                { data: 'action', name: 'action', searcable: false, orderable: false },
            ],
        });

        var idsOrder = [];

        table.on('click', 'tr', function () {
            var tr = $(this).closest('tr');
            var data = table.row(tr).data();
            if ( table.row( this, { selected: true } ).any() ) {
                var carIndex = idsOrder.indexOf(data.id);
                idsOrder.splice(carIndex, 1);
            }
            else {
                idsOrder.push(data.id)
            }
            
        });

        $("#btn-multi-delete").click(function (e) { 
            e.preventDefault();
            if (idsOrder == 0) {
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
                            axios.post('/crm/order/delete/multiple', {id : idsOrder})
                                .then((res) => {
                                    Swal.fire({
                                        position: 'top-end',
                                        toast: true,
                                        timer: 4000,
                                        timerProgressBar: true,
                                        showConfirmButton: false,
                                        icon: 'success',
                                        title: res.data,
                                    })
                                    table.ajax.reload();
                                })
                        }
                    });
            }
            
        });

    </script>
@endsection
