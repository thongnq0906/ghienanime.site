@extends('frontend.partials.master')
@section('title', $cate_post->name)
@section('title_seo', $cate_post->title_seo)
@section('meta_key', $cate_post->meta_key)
@section('meta_des', $cate_post->meta_des)
@section('canonical')
{{ URL::current() }}
@stop
@section('content')
<div class="duongdan">
    <div class="container">
        <ol class="breadcrumb breadcrumb-arrow">
            <li><a href="{{ route('index') }}">Trang chủ</a></li>
            <li class="active"><span>{{ $cate_post->name }}</span></li>
        </ol>
    </div>
</div>
<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                @foreach($post as $p)
                    <div class="hic">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                                <div class="img-post" style="overflow: hidden;">
                                    <a class="" href="{{ route('detail', $p->slug) }}">
                                       <img src="{{ asset($p->image) }}" class="img-hover">
                                    </a>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7">
                                <div class="detail-post">
                                    <a href="{{ route('detail', $p->slug) }}"><h4 class="">{{ $p->name }} {{ $p->name }}</h4></a>
                                    <br>
                                    {!! str_limit($p->title, 20) !!}
                                    <br>
                                    <a href="{{ route('detail', $p->slug) }}" class="chi-tiet-tin">Chi tiết</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                {{ $post->links() }}
            </div>
            @include('frontend.partials.sidebar')
        </div>
    </div>
</div>
@endsection