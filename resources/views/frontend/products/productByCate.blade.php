@extends('frontend.partials.master')
@section('title', $cate_product->name)
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
    <div class="page-single movie-items">
        <div class="container">
            <div class="row ipad-width">
                <div class="col-md-8">
                    <div class="title-hd">
                        <h2>{{ $cate_product->name }}</h2>
                    </div>
                    <div class="mv-grid-fw">
                        <div class="row">
                            @forelse ($product as $mvh)
                                <div class="col-md-3 col-sm-3 col-xs-6 grid-item">
                                    <div class="movie-item item-custom">
                                        @include('frontend.products.item')
                                    </div>
                                </div>
                            @empty
                                <p style="text-align: center">Coming soon...</p>
                            @endforelse
                        </div>
                        <div class="row">
                            <div class="col-md-12"><div class="paginates">{{ $product->links() }}</div></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    @include('frontend.partials.sidebar')
                </div>
            </div>
        </div>
    </div>
@endsection