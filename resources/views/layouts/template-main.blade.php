<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> --TonyRomas--</title>

    <!-- styles -->
    @include('layouts.styles')

    <!-- Load Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicon.ico') }}" />
</head>
<body class="ks-navbar-fixed ks-sidebar-default ks-sidebar-position-fixed ks-page-header-fixed ks-theme-primary ks-page-loading">

    <!-- Load Pre-Loader -->
    <div id="pre-loader">@include('layouts.styles')</div>

    <!-- Load Nav Header -->
    @include('layouts.navs.top')

    <div class="ks-page-container">
        
        @include('layouts.navs.left')

        <div class="ks-column ks-page">

            @include('partials.messages')

            @yield('content')
            
        </div>

    </div>

    <!-- scripts -->
    @include('layouts.scripts')
</body>
</html>