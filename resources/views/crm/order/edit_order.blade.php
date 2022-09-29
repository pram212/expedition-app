@extends('layouts.app')
@section('title', 'Edit Konsumen')
@section('header', 'Edit Konsumen')

@section('css')
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('content')
<div class="card">
    <div class="card-header bg-secondary">
        Edit Konsumen Baru Via Admin
    </div>
    @if(count($errors) > 0)
<div class="p-1">
    @foreach($errors->all() as $error)
    <div class="alert alert-warning alert-danger fade show" role="alert">{{$error}} <button type="button" class="close"
            data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button></div>
    @endforeach
</div>
@endif
    <div class="card-body">
        <form action="{{ url('/crm/order/'. $order->id)}}" method="POST">
            @csrf
            @method('put')
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                        <label for="register_number">Nomor Pendafatran :</label>
                        <input type="text" name="register_number" id="register_number" class="form-control"
                            placeholder="Isi Nomor Pendaftaran" aria-describedby="helpId"
                            value="{{ old('register_number', $order->register_number) }}">
                        <small id="helpId" class="text-muted">isi dengan nomor pendaftaran dari
                            Disdukcapil!</small>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                        <label for="category_id">Jenis Dokumen : <span class="text-danger">*</span></label>
                        <select name="category_id"
                            class="form-control select2 @error('category_id') is-invalid @enderror" id="category_id">
                            <option value="">-- Pilih --</option>
                            @foreach ($categories as $item)
                            <option value="{{$item->id}}" @if ($item->id == $order->category_id)
                                selected
                            @endif>{{strtoupper($item->name)}}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <small id="helpId" class="text-danger">wajib diisi!</small>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                        <label for="payment_statuses_id">Status Pembayaran : <span class="text-danger">*</span></label>
                        <select name="payment_statuses_id"
                            class="form-control select2 @error('payment_statuses_id') is-invalid @enderror" id="payment_statuses_id">
                            <option value="">-- Pilih --</option>
                            @foreach ($paymentStatus as $item)
                            <option value="{{$item->id}}" @if ($item->id == $order->payment_statuses_id)
                                selected
                            @endif>{{strtoupper($item->name)}}</option>
                            @endforeach
                        </select>
                        @error('payment_statuses_id')
                            <small id="helpId" class="text-danger">wajib diisi!</small>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                        <label for="shippment_statuses_id">Status Pengiriman : <span class="text-danger">*</span></label>
                        <select name="shippment_statuses_id"
                            class="form-control select2 @error('shippment_statuses_id') is-invalid @enderror" id="shippment_statuses_id">
                            <option value="">-- Pilih --</option>
                            @foreach ($shipmentStatus as $item)
                            <option value="{{$item->id}}" @if ($item->id == $order->shippment_statuses_id)
                                selected
                            @endif>{{strtoupper($item->name)}}</option>
                            @endforeach
                        </select>
                        @error('shippment_statuses_id')
                            <small id="helpId" class="text-danger">wajib diisi!</small>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                        <label for="id_card">Nomor KTP/KK : <span class="text-danger">*</span></label>
                        <input type="number" name="id_card" id="id_card"
                            class="form-control @error('id_card') is-invalid @enderror" placeholder="Isi Nomor KTP"
                            aria-describedby="helpId" value="{{ old('id_card', $order->id_card) }}">
                        @error('id_card')
                            <small id="helpId" class="text-danger">wajib diisi!</small>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                        <label for="customer_name">Nama : <span class="text-danger">*</span></label>
                        <input type="text" name="customer_name" id="customer_name"
                            class="form-control @error('customer_name') is-invalid @enderror"
                            placeholder="Isi Nama sesuai KTP" aria-describedby="helpId"
                            value="{{ old('customer_name', $order->customer_name) }}">
                        @error('customer_name')
                            <small id="helpId" class="text-danger">wajib diisi!</small>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                        <label for="customer_guardian">Orang Tua / Wali :</label>
                        <input type="text" name="customer_guardian" id="customer_guardian"
                            class="form-control @error('customer_guardian') is-invalid @enderror"
                            placeholder="Isi jika KIA" aria-describedby="helpId"
                            value="{{ old('customer_guardian', $order->customer_guardian) }}">
                        @error('customer_guardian')
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
                            value="{{ old('phone', $order->phone) }}">
                        @error('phone')
                            <small id="helpId" class="text-danger">wajib diisi!</small>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                        <label for="district_id">Kecamatan : <span class="text-danger">*</span></label>
                        <select name="district_id"
                            class="form-control select2 @error('district_id') is-invalid @enderror"
                            id="district_id">
                            <option value="">-- Pilih --</option>
                            @foreach ($districts as $item)
                                <option value="{{ $item->id }}"
                                    @if (old('district_id') == $item->id || $item->id == $order->district_id)
                                        selected
                                    @endif
                                    >
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
                        <select name="village_id" readonly
                            class="form-control select2 @error('village_id') is-invalid @enderror" id="village_id">
                            <option value="">-- Pilih --</option>
                            @foreach ($villages as $item)
                            <option value="{{ $item->id }}" class="option-village"
                                @if (old('village_id') == $item->id || $item->id == $order->village_id)
                                    selected
                                @endif
                                >
                                {{ $item->name }}
                            </option>
                            @endforeach
                        </select>
                        @error('village_id')
                            <small id="helpId" class="text-danger">wajib diisi!</small>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-12 col-md-12">
                    <div class="form-group">
                        <label for="address">Detil Alamat : <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('address') is-invalid @enderror" name="address" id="address" rows="3">{{ old('address', $order->address) }}</textarea>
                        @error('address')
                            <small id="helpId" class="text-danger">wajib diisi!</small>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 text-center">
                    <button type="submit" class="btn btn-primary w-50">Simpan</button>
                </div>
                <div class="col-sm-12 col-md-6 text-center">
                    <a href="{{ url()->previous() }}" class="btn btn-secondary w-50">Kembali</a>
                </div>
            </div>
            {{-- /.card --}}
        </form>
    </div>
</div>
@endsection

@section('script')
    <script src="{{ asset('adminlte/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                theme: 'bootstrap4'
            });
            $(document).on('select2:open', () => {
                document.querySelector('.select2-search__field').focus();
            });
            $("#district_id").change(function(e) {
                e.preventDefault();
                const district = e.target.value
                getVillage(district)
            });

            function getVillage(district) {
                $(".option-village").remove();
                $.ajax({
                    type: "get",
                    url: "/pendaftaran/getvillage/" + district,
                    success: function(response) {
                        $("#village_id").removeAttr("readonly");
                        $.each(response, function(indexInArray, valueOfElement) {
                            $("#village_id").append(`
                            <option class="option-village" value="${valueOfElement.id}">${valueOfElement.name}</option>
                        `);
                        });
                    }
                });
            }

        });
    </script>
@endsection
