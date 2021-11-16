@extends('frontend.partials.master')
@section('loading')
    <!--preloading-->
    <div id="preloader">
        <img class="logo" src="{{ asset($setting->logo) }}" alt="" width="119" height="58">
        <div id="status">
            <span></span>
            <span></span>
        </div>
    </div>
    <!--end of preloading-->
@endsection
@section('content')
    <div class="page-single movie-single movie_single movie-items">
        <div class="container">
            <div class="error404" style="text-align: center; min-height: 700px; color: white">
                <h1>Lỗi 404 - Trang không được tìm thấy</h1>
                <a href="{{ route('index') }}">Về trang chủ</a>
            </div>
        </div>
    </div>
    <div class="row">
    </div>
@endsection
