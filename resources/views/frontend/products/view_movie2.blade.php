@extends('frontend.partials.master')
@section('title', 'Phim mới')
@section('content')

    <div class="page-single movie-items">
        <div class="container">
            <div class="row ipad-width">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="view-movie">
                        <div class="play-movie">
                            <iframe allowfullscreen='' frameborder='0' height='360' id='myframe' scrolling='no' src='{{ $episode->link1 }}' width='640'></iframe>
                        </div>
                    </div>
                    <div class="detail-movie">
                        <div class="title-hd">
                            <a href="{{ route('detail_product', $movie->slug) }}"><h2>{{ $movie->name }}</h2></a>
                        </div>
                        <div class="list-server">
                            <button class="button_link" onclick="link_1()">Link 1</button>
                            <button class="button_link" onclick="link_2()">Link 2</button>
                            <button class="button_link" onclick="link_3()">Link 3</button>
                            <button class="button_link" onclick="link_4()">Link 4</button>
                            <script>
                                var link1 = "{{$episode->link1}}";
                                var link2 = "{{$episode->link2}}";
                                var link3 = "{{$episode->link3}}";
                                var link4 = "{{$episode->link4}}";

                                function link_1() {
                                    var x = document.getElementsByClassName("button_link");
                                    for (var i=0; i < x.length; i++)
                                    {
                                        x[i].classList.remove("button_link_clicked")
                                    }
                                    x[0].classList.add("button_link_clicked");
                                    document.getElementById("myframe").src = link1;
                                }

                                function link_2() {
                                    var x = document.getElementsByClassName("button_link");
                                    for (var i=0; i < x.length; i++)
                                    {x[i].classList.remove("button_link_clicked")}
                                    x[1].classList.add("button_link_clicked");
                                    document.getElementById("myframe").src = link2;}

                                function link_3() {
                                    var x = document.getElementsByClassName("button_link");
                                    for (var i=0; i < x.length; i++)
                                    {x[i].classList.remove("button_link_clicked")}
                                    x[2].classList.add("button_link_clicked");
                                    document.getElementById("myframe").src = link3;}

                                function link_4() {
                                    var x = document.getElementsByClassName("button_link");
                                    for (var i=0; i < x.length; i++)
                                    {x[i].classList.remove("button_link_clicked")}
                                    x[3].classList.add("button_link_clicked");
                                    document.getElementById("myframe").src = link4;}
                            </script>
                        </div>
                        <div class="list-episode nendep">
                            <ul>
                                @foreach ($listEp as $l)
                                    <li>
                                        <a href="{{ route('view_movie', [$id, $l->id]) }}" class="@if($l->id == $ep_id) active @endif">{{ $l->ep }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="comment">
                            <div id="fb-root"></div>
                            <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v12.0" nonce="rm38pFpQ"></script>
                            <div class="fb-comments" data-href="{{ route('detail_product', $movie->slug) }}" data-width="100%" data-numposts="10" data-order-by="time"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="title-hd">
                <h2>Có thể bạn thích</h2>
            </div>
            <div class="row">
                @foreach ($plq as $mvh)
                    <div class="col-md-3 col-sm-3 col-xs-6 grid-item">
                        <div class="movie-item item-custom2">
                            <a href="{{ route('detail_product', $mvh->slug) }}">
                                <div class="mv-img">
                                    <img src="{{ asset($mvh->image) }}" alt="{{ $mvh->name }}" width="285" height="437">
                                    <div class="icon_overlay"></div>
                                </div>
                            </a>
                            <div class="title-in">
                                <div class="cate">
                                    @php
                                        $lastEp = \App\Models\Images::where('product_id', $mvh->id)->orderBy('ep', 'DESC')->first();
                                    @endphp
                                    <span class="orange"><a href="#" tabindex="-1">@if($lastEp) Tập {{ $lastEp->ep }} @else Coming soon @endif</a></span>
                                </div>
                                <h6><a href="{{ route('detail_product', $mvh->slug) }}">{{ $mvh->name }}</a></h6>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
