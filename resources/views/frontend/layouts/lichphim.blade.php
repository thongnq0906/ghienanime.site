@extends('frontend.partials.master')
@section('title', 'Lịch phát sóng phim hoạt hình')
@section('title_seo', 'Lịch phát sóng phim hoạt hình')
@section('meta_des', 'Lịch phát sóng phim hoạt hình')
@section('loading')
{{--    <!--preloading-->
    <div id="preloader">
        <img class="logo" src="{{ asset($setting->logo) }}" alt="" width="119" height="58">
        <div id="status">
            <span></span>
            <span></span>
        </div>
    </div>
    <!--end of preloading-->--}}
@endsection
@section('content')
    <div class="page-single movie-single movie_single movie-items">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <div class="row duongdan">
                        <a href="{{ route('index') }}"><div class="material-icons icon-home">home</div></a>
                        <a href="{{ route('index') }}"><div class="danduong"> Trang chủ / </div></a>
                        <div class="danduong active"> Lịch phim </div>
                    </div>
                    <div class="lich-chieu-phim">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th width="60px"></th>
                                <th>Phim 3D</th>
                                <th>Phim 2D</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr @if($homnay == "Mon") class="success" @endif>
                                <td>Thứ 2</td>
                                <td>
                                    @foreach ($thu23D as $t)
                                        <p><a href="{{ route('detail_product', $t->slug) }}">{{ $t->name }}</a></p>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($thu22D as $t)
                                        <p><a href="{{ route('detail_product', $t->slug) }}">{{ $t->name }}</a></p>
                                    @endforeach
                                </td>
                            </tr>
                            <tr @if($homnay == "Tue") class="success" @endif>
                                <td>Thứ 3</td>
                                <td>
                                    @foreach ($thu23D2 as $t)
                                        <p><a href="{{ route('detail_product', $t->slug) }}">{{ $t->name }}</a></p>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($thu22D2 as $t)
                                        <p><a href="{{ route('detail_product', $t->slug) }}">{{ $t->name }}</a></p>
                                    @endforeach
                                </td>
                            </tr>
                            <tr @if($homnay == "Wed") class="success" @endif>
                                <td>Thứ 4</td>
                                <td>
                                    @foreach ($thu23D3 as $t)
                                        <p><a href="{{ route('detail_product', $t->slug) }}">{{ $t->name }}</a></p>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($thu22D3 as $t)
                                        <p><a href="{{ route('detail_product', $t->slug) }}">{{ $t->name }}</a></p>
                                    @endforeach
                                </td>
                            </tr>
                            <tr @if($homnay == "Thu") class="success" @endif>
                                <td>Thứ 5</td>
                                <td>
                                    @foreach ($thu23D4 as $t)
                                        <p><a href="{{ route('detail_product', $t->slug) }}">{{ $t->name }}</a></p>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($thu22D4 as $t)
                                        <p><a href="{{ route('detail_product', $t->slug) }}">{{ $t->name }}</a></p>
                                    @endforeach
                                </td>
                            </tr>
                            <tr @if($homnay == "Fri") class="success" @endif>
                                <td>Thứ 6</td>
                                <td>
                                    @foreach ($thu23D5 as $t)
                                        <p><a href="{{ route('detail_product', $t->slug) }}">{{ $t->name }}</a></p>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($thu22D5 as $t)
                                        <p><a href="{{ route('detail_product', $t->slug) }}">{{ $t->name }}</a></p>
                                    @endforeach
                                </td>
                            </tr>
                            <tr @if($homnay == "Sat") class="success" @endif>
                                <td>Thứ 7</td>
                                <td>
                                    @foreach ($thu23D6 as $t)
                                        <p><a href="{{ route('detail_product', $t->slug) }}">{{ $t->name }}</a></p>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($thu22D6 as $t)
                                        <p><a href="{{ route('detail_product', $t->slug) }}">{{ $t->name }}</a></p>
                                    @endforeach
                                </td>
                            </tr>
                            <tr @if($homnay == "Sun") class="success" @endif>
                                <td>Chủ Nhật</td>
                                <td>
                                    @foreach ($thu23D7 as $t)
                                        <p><a href="{{ route('detail_product', $t->slug) }}">{{ $t->name }}</a></p>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($thu22D7 as $t)
                                        <p><a href="{{ route('detail_product', $t->slug) }}">{{ $t->name }}</a></p>
                                    @endforeach
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-3">
                    @include('frontend.partials.sidebar')
                </div>
            </div>
        </div>
    </div>
@endsection
