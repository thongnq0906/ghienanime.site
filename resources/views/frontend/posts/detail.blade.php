@extends('frontend.partials.master')
@section('title', $detail->name)
@section('title_seo', $detail->title_seo)
@section('meta_key', $detail->meta_key)
@section('meta_des', $detail->meta_des)
@section('content')
<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                <div class="bai-viet">
                    <div class="title-bai">
                        <h1>{{ $detail->name }}</h1>
                    </div>
                    {!! $detail->description !!}
                    <br>
                    <div id="fb-root"></div>
                    <div id="fb-root"></div>
                    <div class="fb-like" data-href="" data-layout="standard" data-action="like" data-show-faces="false" data-share="true"></div>
                    <div class="fb-comments" data-href="" data-numposts="5"></div>
                </div>
            </div>
            @include('frontend.partials.sidebar')
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.5";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
<script>
    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.3&appId=1579370508992302";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
@endsection
