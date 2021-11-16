<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="robots" content="index,follow" />
    <meta name="revisit-after" content="1 days" />
    <meta name="ROBOTS" content="index,follow,noodp" />
    <meta name="googlebot" content="index,follow" />
    <meta name="BingBOT" content="index,follow" />
    <meta name="yahooBOT" content="index,follow" />
    <meta name="slurp" content="index,follow" />
    <meta name="msnbot" content="index,follow" />

    <title>@yield('title')</title>
    <meta name='robots' content='max-image-preview:large' />
    <meta name="description" content="@yield('meta_des')">
    <link rel="canonical" href="@yield('canonical')"/>
    <meta property="og:locale" content="vi_VN" />
    <meta name="keywords" content="@yield('meta_key')">

    <meta property="og:title" content="@yield('title')" />
    <meta property="og:description" content="@yield('meta_des')" />
    <meta property="og:url" content="https://phimhoathinh3d.com/" />
    <meta property="og:site_name" content="{{ $setting->name }}" />
    <meta property="og:image" content="@yield('image')" />
    <meta property="og:image:width" content="1200" />
    <meta property="og:image:height" content="630" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="@yield('title_seo')" />
    <meta name="twitter:description" content="@yield('meta_des')" />
    <meta name="twitter:title" content="@yield('title_seo')" />
    <meta name="twitter:card" content="summary" />
    <meta property="og:url" content="{{ Request::url() }}" />

    <link REL="SHORTCUT ICON" href="{{ asset($setting->icon) }}">
    <link rel="stylesheet" href='https://fonts.googleapis.com/css?family=Dosis:400,700,500|Nunito:300,400,600' />
    <link href="https://fonts.googleapis.com/css2?family=Lato&family=Open+Sans&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">
    <!-- Mobile specific meta -->
    <meta name="format-detection" content="telephone-no">
    <!-- CSS files -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css"/>
    <link rel="stylesheet" href="{{ asset('css/plugins.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css?2.4') }}">
    {!! $setting->thead !!}
</head>
<body>
    @yield('loading')
    @include('frontend.partials.header')
    @yield('content')
    @include('frontend.partials.footer')
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
    <script src="{{ asset('js/plugins.js') }}"></script>
    <script src="{{ asset('js/plugins2.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    @yield('script')

</body>
</html>
