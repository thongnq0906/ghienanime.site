@extends('frontend.partials.master')
@section('title', ' Xem phim '.$movie->name.' Tập ' .$episode->ep. ' Vietsub Full HD')
@section('title_seo', ' Xem phim '.$movie->name.' Tập ' .$episode->ep. ' Vietsub Full HD')
@section('meta_key', $movie->meta_key)
@section('meta_des', $movie->meta_des)
@section('content')
    <div class="page-single movie-items view-movie-custom">
        <div class="container">
            <div class="row ipad-width">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="view-movie">
                        <div id="video-player"></div>

                        <div class="row item-player-custom">
                            <div class="col-md-4">
                                <div class="dongcuatatden dentrai">
                                    <a href="#" title="Bật/Tắt đèn" class="change-light">
                                        <div class="next-ep tatden">Tắt đèn</div>
                                        <div class="material-icons">lightbulb</div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-4">
                                <div id="list_sv" class="list-severs">
                                    @if ($episode->vip != null)
                                        <a href="javascript:void(0)" class="button-default" id="sv_VIP" name="VIP">VIP</a>
                                    @endif
                                    <a href="javascript:void(0)" class="button-default" id="sv_FBO" name="FBO">Server 1</a>
                                    <a href="javascript:void(0)" class="button-default" id="sv_EMB" name="EMB">Server 2</a>
                                    <a href="javascript:void(0)" class="button-default" id="sv_Hydrax" name="Hydrax">Server 3</a>
                                    <a href="javascript:void(0)" class="button-default" id="sv_AHS" name="AHS">Server 4</a>
                                </div>
                                <div class="sever-des">Chọn sever VIP để xem nhanh hơn (nếu có)</div>
                            </div>
                            <div class="col-xs-12 col-md-4">
                                <div class="dongcuatatden">
                                    @if ($prev)
                                        <a href="{{ route('view_movie', [$movie->slug, $prev->slug]) }}" title="Xem tập trước đó">
                                            <div class="next-ep kola-haha">Tập trước</div>
                                            <div class="material-icons material-icons-custom">skip_previous</div>
                                        </a>
                                    @endif
                                    @if($next)
                                        <a href="{{ route('view_movie', [$movie->slug, $next->slug]) }}" title="Xem tập tiếp theo">
                                            <div class="material-icons material-icons-custom">skip_next</div>
                                            <div class="next-ep kola-haha">Tập tiếp</div>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="chontap">
                        </div>
                    </div>
                    <div class="detail-movie">
                        <div class="title-hd">
                            <a href="{{ route('detail_product', $movie->slug) }}"><h2>{{ $movie->name }} tập {{ $episode->ep }} VietSub</h2></a>
                            @if (count($phankhac) != 0)
                                <div class="phankhac">
                                    <ul>
                                        @foreach ($phankhac as $p)
                                            <li><a href="{{ route('detail_product', $p->slug) }}">{{ $p->ten_phan }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
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

                        <div class="vietsub"><div class="material-icons custom-vietsub">movie_filter</div><div class="text-vietsub">Vietsub</div></div>
                        <div class="list-episode nendep" id="cuondep2">
                            <ul>
                                @foreach ($listEp as $l)
                                    <li>
                                        <a href="{{ route('view_movie', [$movie->slug, $l->slug]) }}" class="@if($l->id == $episode->id) active @endif">{{ $l->ep }}{{ $l->note }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="vietsub"><div class="material-icons custom-vietsub">movie_filter</div><div class="text-vietsub">Thuyết minh</div></div>
                        <div class="list-episode nendep" id="cuondep2">
                            <ul>
                                @foreach ($listEpTM as $l)
                                    <li>
                                        <a href="{{ route('view_movie_tm', [$movie->slug, $l->slug]) }}" class="">{{ $l->ep }}{{ $l->note }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="comment">
                            <div class="fb-comments" data-href="{{ route('detail_product', $movie->slug) }}" data-width="100%" data-numposts="10" data-order-by="time"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="custom-view-film row">
                <div class="col-md-9">
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
@section('script')
    <script type="text/javascript" src="{{ asset('js/jwplayer.js') }}"></script>
    <script type="text/javascript">jwplayer.key = "ITWMv7t88JGzI0xPwW8I0+LveiXX9SWbfdmt0ArUSyc=";</script>
    <script>
        var $info_play_video = {
            source: JSON.parse("[{}]"),
            source_fbo: [{"file":"{!! $episode->vip !!}"}],
            source_yd: '',
            vast: []
        };
        var $check_vip = "{!! $episode->vip !!}";
        var $list_sv = document.getElementById("list_sv");
        function loadVideo(s, aa, seek, w, load_hls = false) {
            var jp = jwplayer("video-player");
            !load_hls ?
                jp.setup({
                    sources: s,
                    width: w,
                    aspectratio: "16:9",
                    playbackRateControls: [0.75, 1, 1.25, 1.5, 2, 2.5],
                    autostart: true,
                    volume: 100,
                    advertising: {
                        client: 'vast',
                        admessage: 'Quảng cáo còn XX giây.',
                        skipoffset: 5,
                        skiptext: 'Bỏ qua quảng cáo',
                        skipmessage: 'Bỏ qua sau xxs',
                        tag: aa,
                    },

                }) :
                jp.setup({
                    file: s,
                    width: w,
                    aspectratio: "16:9",
                    playbackRateControls: [0.75, 1, 1.25, 1.5, 2, 2.5],
                    autostart: true,
                    volume: 100,
                    advertising: {
                        client: 'vast',
                        admessage: 'Quảng cáo còn XX giây.',
                        skipoffset: 5,
                        skiptext: 'Bỏ qua quảng cáo',
                        skipmessage: 'Bỏ qua sau xxs',
                        tag: aa,
                    },

                });
            return jp;
        }

        function startStreaming(name_server, first_server = null) {
            let _video_player = document.getElementById("video-player");
            let load_video;
             switch (name_server) {
                case 'EMB':
                        _video_player.innerHTML = '<div style="position: relative;padding-bottom: 56%">' +
                            '<iframe style="position: absolute;top: 0;left: 0;width: 100%;height: 100%;overflow:hidden;" frameborder="0"' +
                            'src="{!! $episode->link2 !!}" frameborder="0" scrolling="0" allowfullscreen></iframe></div>';
                        break;

                case 'Hydrax':
                    _video_player.innerHTML = '<div style="position: relative;padding-bottom: 56%">' +
                        '<iframe style="position: absolute;top: 0;left: 0;width: 100%;height: 100%;overflow:hidden;" frameborder="0"' +
                        'src="{!! $episode->link3 !!}" frameborder="0" scrolling="0" allowfullscreen></iframe></div>';
                    break;
                case 'AHS':
                    _video_player.innerHTML = '<div style="position: relative;padding-bottom: 56%">' +
                        '<iframe style="position: absolute;top: 0;left: 0;width: 100%;height: 100%;overflow:hidden;" frameborder="0"' +
                        'src="{!! $episode->link4 !!}" frameborder="0" scrolling="0" allowfullscreen></iframe></div>';
                    break;
                case 'FBO':
                    _video_player.innerHTML = '<div style="position: relative;padding-bottom: 56%">' +
                        '<iframe style="position: absolute;top: 0;left: 0;width: 100%;height: 100%;overflow:hidden;" frameborder="0"' +
                        'src="{!! $episode->link1 !!}" frameborder="0" scrolling="0" allowfullscreen></iframe></div>';
                    break;
                 case 'VIP':
                     load_video = loadVideo($info_play_video.source_fbo, $info_play_video.vast, null, '100%');
                     break;
                default:
                    break;
            }
            first_server == null && $cookie.setItem('server_watching', name_server);
            document.getElementById("sv_" + name_server).classList.add("bg-green");
        }
        if ($check_vip.length === 0) {
            startStreaming('FBO', 1);
        } else {
            startStreaming('VIP', 1);
        }
        list_sv.childNodes.forEach(item => {
            item.addEventListener("click", function(e) {
                list_sv.querySelector(".bg-green").classList.remove("bg-green");
                this.classList.add("bg-green");
                startStreaming(this.getAttribute("name"));
            })
        });

        $( ".change-light" ).on("click", function() {
            if($(".tatden").hasClass( "dark" )) {
                $(".tatden").removeClass( "dark" );
                $( ".tatden" ).text( "Tắt đèn" );
                $(".custom-view-film").show();
                $(".ht-footer").show();
                $(".detail-movie").show();
                $(".ht-header").show();
                $(".next-ep").show();
                $(".list-severs").css("opacity", '1');
                $(".sever-des").css("opacity", '1');
                $("body").css("background", '#263238');
                $(".ipad-width").css("background", '#0f1416');
            } else {
                $(".tatden").addClass( "dark" );
                $(".tatden").text( "Bật đèn" );
                $(".custom-view-film").removeAttr("style").hide();
                $(".ht-footer").removeAttr("style").hide();
                $(".detail-movie").removeAttr("style").hide();
                $(".ht-header").removeAttr("style").hide();
                $(".next-ep").removeAttr("style").hide();
                $(".list-severs").css("opacity", '0');
                $(".sever-des").css("opacity", '0');
                $("body").css("background", 'black');
                $(".ipad-width").css("background", 'black');
            }
        });

    </script>
@stop