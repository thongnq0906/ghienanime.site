<header class="ht-header">
    <div class="container">
        <nav class="navbar navbar-default navbar-custom">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header logo">
                <a href="{{ route('index') }}"><img class="logo" src="{{ asset($setting->logo) }}" alt="" width="119" height="58"></a>

            </div>
            <div class="menu-mobile">
                <div class="row">
                    <div class="col-xs-3" style="padding: 0">
                        <div class="logo-mobile">
                            <a href="{{ route('index') }}"><img src="{{ asset($setting->logo) }}" alt="" width="119" height="58"></a>
                        </div>
                    </div>
                    <div class="col-xs-7">
                        <div class="search-mb">
                            <form action="{{ route('postSearch') }}" method="get">
                                @csrf
                                <input type="text" placeholder="Tìm kiếm phim" class="search-custom" name="search">
                                <button  class="btn btn-outline-secondary button-search">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"></path>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="col-xs-2" style="padding: 0">
                        <div class="solcal-mb">
                            <a href="{{ $setting->fb }}" title="Fanpage Phim hoạt hình 3D" target="_blank"><img src="{{ asset('images/fb.png') }}" alt="Facebook"></a>
                            <a href="{{ $setting->yt }}" title="Kênh Phim hoạt hình 3D" target="_blank"><img src="{{ asset('images/yt.png') }}" alt="Youtube"></a>
                        </div>
                    </div>
                </div>
                @php
                    $level_1 = DB::table('cate_products')->where('status', 1)->where('parent_id', 0)->orderBy('position', 'ASC')->get();
                @endphp
                <div class="list-movie-mb">
                    @foreach($level_1 as $l)
                        <a href="{{ route('productByCate', $l->slug) }}">{{ $l->name }}</a>
                    @endforeach
                        <a href="{{ route('lich_phim') }}">Lịch phim</a>
                </div>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse flex-parent" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav flex-child-menu menu-left">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li><a href="{{ route('index') }}">Trang chủ</a></li>

                    @foreach($level_1 as $l)
                        <li><a href="{{ route('productByCate', $l->slug) }}">{{ $l->name }}</a></li>
                    @endforeach
                    <li class="dacbiet"><a href="{{ route('lich_phim') }}">Lịch phim</a></li>
                    {{--<li class="dropdown first">
                        <a class="btn btn-default dropdown-toggle lv1" data-toggle="dropdown" data-hover="dropdown">
                            community <i class="fa fa-angle-down" aria-hidden="true"></i>
                        </a>
                        <ul class="dropdown-menu level1">
                            <li><a href="userfavoritegrid.html">user favorite grid</a></li>
                            <li><a href="userfavoritelist.html">user favorite list</a></li>
                            <li><a href="userprofile.html">user profile</a></li>
                            <li class="it-last"><a href="userrate.html">user rate</a></li>
                        </ul>
                    </li>--}}
                </ul>
                <ul class="nav navbar-nav flex-child-menu menu-right search">
                    <li class="search-pc">
                        <form action="{{ route('postSearch') }}" method="get">
                            @csrf
                            <input type="text" placeholder="Tìm kiếm phim" class="search-custom" name="search">
                            <button  class="btn btn-outline-secondary button-search">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"></path>
                                </svg>
                            </button>
                        </form>
                    </li>
                    <li class="social"><a href="{{ $setting->fb }}" title="Fanpage Phim hoạt hình 3D" target="_blank"><img src="{{ asset('images/fb.png') }}" alt="Facebook"></a></li>
                    <li class="social"><a href="{{ $setting->yt }}" title="Kênh Phim hoạt hình 3D" target="_blank"><img src="{{ asset('images/yt.png') }}" alt="Youtube"></a></li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>
    </div>
</header>
<!-- END | Header -->
