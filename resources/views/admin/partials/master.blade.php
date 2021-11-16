<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta http-equiv="Content-Language" content="en">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>@yield('title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="{{ asset('themes-admin/main.css') }}" rel="stylesheet"></head>
        <script src="{{ asset('themes-admin/assets/scripts/jquery-3.4.1.js') }}"></script>
        <link rel="stylesheet" type="text/css" href="{{ asset('themes-admin/assets/datatable/datatables.min.css') }}"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('themes-admin/switchery.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('themes-admin/custom.css') }}">
    </head>
    <body>
        <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
            @include('admin.partials.top')
            <div class="app-main">
                @include('admin.partials.left')
                <div class="app-main__outer">
                    @yield('content')
                    @include('admin.partials.bot')
                </div>
            </div>
        </div>
        <script type="text/javascript" src="{{ asset('themes-admin/assets/datatable/datatables.min.js') }}"></script>
        <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
        <script type="text/javascript" src="{{ asset('themes-admin/assets/scripts/main.js') }}"></script>
        <script src="{{ asset('js/adminjs.js') }}" type="text/javascript"></script>
        @yield('script')
    </body>
</html>
