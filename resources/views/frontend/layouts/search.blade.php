@extends('frontend.partials.master')
@section('title', 'Tìm kiếm: '.$input)
@section('content')
    <div class="page-single movie-items">
        <div class="container">
            <div class="row ipad-width">
                <div class="col-md-8">
                    <div class="title-hd">
                        <h2>Kết quả tìm kiếm: {{ $input }}</h2>
                    </div>
                    <div class="mv-grid-fw">
                        <div class="row">
                            @foreach ($product as $mvh)
                                <div class="col-md-3 col-sm-3 col-xs-6 grid-item">
                                    <div class="movie-item item-custom">
                                        @include('frontend.products.item')
                                    </div>
                                </div>
                            @endforeach
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