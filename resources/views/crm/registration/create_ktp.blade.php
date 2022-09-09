<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">

    <link rel="stylesheet" href="{{ asset('adminlte/plugins/daterangepicker/daterangepicker.css') }}">

    <link rel="stylesheet" href="{{ asset('adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">

    <link rel="stylesheet"
        href="{{ asset('adminlte/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}">

    <link rel="stylesheet"
        href="{{ asset('adminlte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">

    <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

    <link rel="stylesheet" href="{{ asset('adminlte/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">

    <link rel="stylesheet" href="{{ asset('adminlte/plugins/bs-stepper/css/bs-stepper.min.css') }}">

    <link rel="stylesheet" href="{{ asset('adminlte/plugins/dropzone/min/dropzone.min.css') }}">

    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css?v=3.2.0') }}">

    <link rel="stylesheet" href="{{ asset('adminlte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <title>Pendaftaran KTP</title>
</head>

<body>
    <div class="container-fluid p-2">
        <form action="{{ url('/pendaftaran/ktp') }}" method="POST">
            @csrf
            <div class="card card-primary">
                <div class="card-header text-center">
                    <h1>Pendaftaran KTP</h1>
                    <p>Formulir permohonan untuk pengiriman dokumen KTP</p>
                    <p><strong>Yang bertanda * wajib diisi!</strong></p>
                </div>
                <div class="card-body">
                    <div class="card card-danger">
                        <div class="card-header text-center">IDENTITAS</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label for="register_number">Nomor Pendafatran :</label>
                                        <input type="text" name="register_number" id="register_number"
                                            class="form-control" placeholder="Isi Nomor Pendaftaran"
                                            aria-describedby="helpId" value="{{ old('register_number') }}">
                                        <small id="helpId" class="text-muted">isi dengan nomor pendaftaran dari
                                            Disdukcapil!</small>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label for="id_card">Nomor KTP : <span class="text-danger">*</span></label>
                                        <input type="number" name="id_card" id="id_card"
                                            class="form-control @error('id_card') is-invalid @enderror"
                                            placeholder="Isi Nomor KTP" aria-describedby="helpId"
                                            value="{{ old('id_card') }}">
                                            @error('id_card')
                                                <small id="helpId" class="text-danger">wajib diisi!</small>
                                            @enderror
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label for="customer_name">Nama Pemohon : <span class="text-danger">*</span></label>
                                        <input type="text" name="customer_name" id="customer_name"
                                            class="form-control @error('customer_name') is-invalid @enderror"
                                            placeholder="Isi Nama sesuai KTP" aria-describedby="helpId"
                                            value="{{ old('customer_name') }}">
                                            @error('customer_name')
                                                <small id="helpId" class="text-danger">wajib diisi!</small>
                                            @enderror
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label for="phone">Nomor WA Aktif : <span class="text-danger">*</span></label>
                                        <input type="tel" name="phone" id="phone"
                                            class="form-control @error('phone') is-invalid @enderror"
                                            placeholder="isi nomor whatsapp aktif" aria-describedby="helpId"
                                            value="{{ old('phone') }}">
                                            @error('phone')
                                                <small id="helpId" class="text-danger">wajib diisi!</small>
                                            @enderror
                                    </div>
                                </div>

                                <input type="hidden" name="category_id" value="1">

                            </div>
                        </div>
                    </div>
                    {{-- /.card --}}
                    <div class="card card-danger">
                        <div class="card-header text-center">DETIL ALAMAT PENGIRIMAN</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label for="district_id">Kecamatan : <span class="text-danger">*</span></label>
                                        <select name="district_id"
                                            class="form-control select2 @error('district_id') is-invalid @enderror"
                                            id="district_id">
                                            <option value="">-- Pilih --</option>
                                            @foreach ($districts as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ old('district_id') == $item->id ? 'selected' : '' }}>
                                                    {{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('district_id')
                                            <small id="helpId" class="text-danger">wajib diisi!</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label for="village_id">Kelurahan/Desa : <span class="text-danger">*</span></label>
                                        <select name="village_id"
                                            class="form-control select2 @error('village_id') is-invalid @enderror"
                                            id="village_id" disabled>
                                            <option value="">-- Pilih --</option>
                                        </select>
                                        @error('village_id')
                                            <small id="helpId" class="text-danger">wajib diisi!</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="address">Detil Alamat : <span class="text-danger">*</span></label>
                                        <textarea class="form-control @error('address') is-invalid @enderror" name="address" id="address" rows="3">{{ old('address') }}</textarea>
                                        @error('address')
                                            <small id="helpId" class="text-danger">wajib diisi!</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- /.card --}}
                    <div class="d-flex justify-content-between p-2">
                        <button type="submit" class="btn btn-primary w-100  mr-1">Daftar</button>
                        <a href="" class="btn btn-warning w-100 ">Ulangi</a>
                    </div>
                </div>
                <div class="card-footer">
                    <small>&copy; 2021. Depok Cooperative Mart&trade;. All Right Reserved.</small>
                </div>
            </div>
        </form>
    </div>

    <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>

    <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('adminlte/plugins/select2/js/select2.full.min.js') }}"></script>

    <script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}?v=3.2.0"></script>

    <script src="{{ asset('adminlte/plugins/sweetalert2/sweetalert2.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('.select2').select2();
            $("#district_id").change(function(e) {
                e.preventDefault();
                $(".option-village").remove();
                const district = e.target.value
                $.ajax({
                    type: "get",
                    url: "/pendaftaran/getvillage/" + district,
                    success: function(response) {
                        $("#village_id").removeAttr("disabled");
                        $.each(response, function(indexInArray, valueOfElement) {
                            $("#village_id").append(`
                                <option class="option-village" value="${valueOfElement.id}">${valueOfElement.name}</option>
                            `);
                        });
                    }
                });
            });

        });
    </script>
</body>

</html>
