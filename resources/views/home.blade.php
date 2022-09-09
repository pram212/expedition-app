@extends('layouts.app')
@section('title', 'Home')
@section('header', 'Home')

@section('content')
<div class="card">
    <div class="card-header">{{ __('Dashboard') }}</div>

    <div class="card-body text-secondary">
        <h3>SELAMAT DATANG, {{Auth::user()->name}}</h3>
    </div>
</div>

@endsection
