@extends('layouts.app')
@section('title', 'Home')
@section('header', 'Welcome, ' . strtoupper(Auth::user()->name))

@section('content')
    <div class="card card-dark">
        <div class="card-header">{{ __('Dashboard') }}</div>
        <div class="card-body text-secondary bg-light">
            <div class="row">
                <div class="col-md-4 col-sm-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-yellow"><i class="fa fa-users"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total Konsumen</span>
                            <span class="info-box-number">{{ $totalOrders }} Orang</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-red"><i class="fa fa-file"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total Tagihan</span>
                            <span class="info-box-number">Rp {{ $totaltagihan }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-red"><i class="fa fa-file"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total Pemasukan</span>
                            <span class="info-box-number">Rp {{ $totalPemasukan }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
