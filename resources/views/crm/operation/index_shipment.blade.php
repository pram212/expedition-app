@extends('layouts.app')
@section('title', 'Pengiriman')
@section('header', 'Pengiriman Dokumen')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="{{asset('datatables/buttons.dataTables.min.css')}}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2/css/select2.min.css') }}">
@endsection

@section('content')
<div class="card">
    <div class="card-header bg-secondary">Panel</div>
    <div class="card-body">
        <div class="row">
            <div class="col-4">
                <div class="form-group">
                    <label for="address">Jenis Pengiriman :</label>
                    <select class="w-100 select2 form-control" id="shippment_statuses_id">
                        <option value="">Pilih</option>
                        @foreach ($shipments as $item)
                        <option value="{{$item->id}}">{{ strtoupper($item->name) }}</option>
                        @endforeach
                    </select>
                </div>
                <button class="btn btn-primary" id="btn-shipping">Simpan</button>
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
                    <th class="align-middle text-center">Status Pengiriman</th>
                    <th class="align-middle text-center">Alamat</th>
                    <th class="align-middle text-center">Kelurahan</th>
                    <th class="align-middle text-center">Kecamatan</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

@endsection

@section('script')
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="{{asset('datatables/dataTables.select.min.js')}}"></script>
    <script src="{{asset('datatables/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('datatables/buttons.html5.min.js')}}"></script>
    <script src="{{asset('datatables/buttons.print.min.js')}}"></script>
    <script src="{{asset('datatables/jszip.min.js')}}"></script>
    <script src="{{asset('datatables/pdfmake.min.js')}}"></script>
    <script src="{{asset('datatables/vfs_fonts.js')}}"></script> 
    <script src="{{asset('datatables/buttons.colVis.min.js')}}"></script>
    <script src="{{ asset('adminlte/plugins/select2/js/select2.full.min.js') }}"></script> 
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    <script>
        $('.select2').select2({
            theme: 'bootstrap4'
        });
        $(document).on('select2:open', () => {
                document.querySelector('.select2-search__field').focus();
            });
        // generate datatable untuk tabel master aruskas
        var table = $('#orders-table').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            select: { style: 'multi' },
            lengthMenu: [
                [ 10, 25, 50, -1 ],
                [ '10 rows', '25 rows', '50 rows', 'Show all' ]
            ],
            dom: 'Bfrtip',
            buttons: [
                'colvis', 
                'pageLength' 
            ],
            ajax: '/datatable/getordershipment',
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'category_id', name: 'category_id' },
                { data: 'id_card', name: 'id_card' },
                { data: 'customer_name', name: 'customer_name' },
                { data: 'customer_guardian', name: 'customer_guardian' },
                { data: 'phone', name: 'phone' },
                { data: 'shippment_statuses_id', name: 'shippment_statuses_id' },
                { data: 'address', name: 'address' },
                { data: 'village_id', name: 'village_id' },
                { data: 'district_id', name: 'district_id' },
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

        $("#btn-shipping").click(function (e) { 
            e.preventDefault();
            var shippment_statuses_id = $("#shippment_statuses_id").val();
            if (idsOrder==0) {
                Swal.fire({
                    position: 'top-end',
                    toast: true,
                    timer: 3000,
                    timerProgressBar: true,
                    showConfirmButton: false,
                    icon: 'error',
                    title: "Gagal! Pilih salah satu data",
                })
            } else if(!shippment_statuses_id) {
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
                    confirmButtonText: `Ya, Lanjutkan`,  
                    }).then((result) => {  
                        if (result.isConfirmed) {    
                            axios.post('/crm/operation/shipment/multiupdate', {id : idsOrder, shippment_statuses_id: shippment_statuses_id})
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
