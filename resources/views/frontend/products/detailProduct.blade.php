@extends('frontend.partials.master')
@if($detail_product)
    @section('title', 'Xem phim '.$detail_product->name. ' vietsub thuyết minh')
    @section('title_seo', 'Xem phim '.$detail_product->name. ' vietsub thuyết minh')
    @section('meta_key', $detail_product->meta_key)
    @section('meta_des', $detail_product->meta_des)
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
                <div class="row">
                    <div class="col-md-9">
                        <div class="row duongdan">
                            <a href="{{ route('index') }}"><div class="material-icons icon-home">home</div></a>
                            <a href="{{ route('index') }}"><div class="danduong"> Trang chủ / </div></a>
                            <a href="{{ route('productByCate', $cate_product->slug) }}"><div class="danduong"> {{ $cate_product->name }} / </div></a>
                            <div class="danduong active"> {{ $detail_product->name }} </div>
                        </div>
                        <div class="row ipad-width2">
                            <div class="col-md-4 col-sm-12 col-xs-12">
                                <div class="movie-img">
                                    <img src="{{ asset($detail_product->image) }}" alt="">
                                    <div class="movie-btn">
                                        <div class="btn-transform transform-vertical red">
                                            <div><a href="@if(isset($epFirst)) {{ route('view_movie', [$detail_product->slug, $epFirst->slug]) }} @endif" class="item item-1 redbtn"> <i class="ion-play"></i> Xem phim</a></div>
                                            <div><a href="@if(isset($epFirst)) {{ route('view_movie', [$detail_product->slug, $epFirst->slug]) }} @endif" class="item item-2 redbtn hvr-grow"><i class="ion-play"></i></a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8 col-sm-12 col-xs-12">
                                <div class="movie-single-ct main-content">
                                    <h1 class="bd-hd">{{ $detail_product->name }}</h1>
                                    @if ($day != null)
                                        <div class="lichphim">
                                            Phim được cập nhật vào
                                            @foreach ($day as $key => $d)
                                                @if ($key != 0)
                                                    và
                                                @endif
                                                @if ($d == 'Mon')
                                                    Thứ 2
                                                @endif
                                                @if ($d == 'Tue')
                                                    Thứ 3
                                                @endif
                                                @if ($d == 'Wed')
                                                    Thứ 4
                                                @endif
                                                @if ($d == 'Thu')
                                                    Thứ 5
                                                @endif
                                                @if ($d == 'Fri')
                                                    Thứ 6
                                                @endif
                                                @if ($d == 'Sat')
                                                    Thứ 7
                                                @endif
                                                @if ($d == 'Sun')
                                                    Chủ Nhật
                                                @endif
                                            @endforeach
                                            hàng tuần
                                        </div>
                                    @endif
                                    @if (count($phankhac) != 0)
                                        <div class="phankhac">
                                            <ul>
                                                @foreach ($phankhac as $p)
                                                    <li><a href="{{ route('detail_product', $p->slug) }}">{{ $p->ten_phan }}</a></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <div class="movie-tabs">
                                        <div class="tabs">
                                            <ul class="tab-links tabs-mv">
                                                <li class="active"><a href="#overview">Danh sách tập phim</a></li>
                                                <li><a href="#reviews"> Nội dung</a></li>
                                            </ul>
                                            <div class="tab-content">
                                                <div id="overview" class="tab active">
                                                    <div class="vietsub"><div class="material-icons custom-vietsub">movie_filter</div><div class="text-vietsub">VietSub</div></div>
                                                    <div class="list-episode nendep" id="cuondep">
                                                        <ul>
                                                            @forelse($listEp as $l)
                                                                <li><a href="{{ route('view_movie', [$detail_product->slug, $l->slug]) }}">{{ $l->ep }}{{ $l->note }}</a></li>
                                                            @empty
                                                                <p>Không có tập mô</p>
                                                            @endforelse
                                                        </ul>
                                                    </div>
                                                    @if (count($thuyetminh) != 0)
                                                        <div class="vietsub"><div class="material-icons custom-vietsub">movie_filter</div><div class="text-vietsub">Thuyết Minh</div></div>
                                                        <div class="list-episode nendep" id="cuondep">
                                                            <ul>
                                                                @forelse($thuyetminh as $l)
                                                                    <li><a href="{{ route('view_movie_tm', [$detail_product->slug, $l->slug]) }}">{{ $l->ep }}{{ $l->note }}</a></li>
                                                                @empty
                                                                    <p>Không có tập mô</p>
                                                                @endforelse
                                                            </ul>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div id="reviews" class="tab review">
                                                    {!! $detail_product->description !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="title-hd">
                            <h2>Có thể bạn thích</h2>
                        </div>
                        <div class="row ipad-width2 cothebanthich">
                            @foreach ($plq as $mvh)
                                <div class="col-md-3 col-sm-3 col-xs-6 grid-item">
                                    <div class="movie-item item-custom">
                                        @include('frontend.products.item')
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-3">
                        @include('frontend.partials.sidebar')
                    </div>
                </div>
            </div>
        </div>
    @endsection
@endif