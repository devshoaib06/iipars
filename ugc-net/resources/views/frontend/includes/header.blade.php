@php

$defLng = 'en';

@endphp

<!doctype html>
<html lang="{{ $defLng }}">

<head>
    <meta http-equiv=Content-Type content="text/html;charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <!--- META -->
    @stack('page_meta')
    <!--- END META -->
    <link rel="shortcut icon" href="{{ config('path.iipars_base_url') }}/assets/images/favicon.png">
   

    <title>IIPARS</title>

    <!-- Favicon and Touch Icons -->
    <link href="assets/images/favicon.png" rel="shortcut icon" type="image/png">

    <!-- Stylesheet -->
    <link href="{{asset('public/frontend/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('public/frontend/css/jquery-ui.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('public/frontend/css/animate.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('public/frontend/css/css-plugin-collections.css')}}" rel="stylesheet" />
    <!-- CSS | menuzord megamenu skins -->
    <link id="menuzord-menu-skins" href="{{asset('public/frontend/css/menuzord-skins/menuzord-boxed.css')}}" rel="stylesheet" />

    <!-- CSS | Preloader Styles -->
    <link href="{{asset('public/frontend/css/preloader.css')}}" rel="stylesheet" type="text/css">
    <!-- CSS | Custom Margin Padding Collection -->
    <link href="{{asset('public/frontend/css/custom-bootstrap-margin-padding.css')}}" rel="stylesheet" type="text/css">
    <!-- CSS | Responsive media queries -->
    <link href="{{asset('public/frontend/css/responsive.css')}}" rel="stylesheet" type="text/css">


    <!-- Revolution Slider 5.x CSS settings -->
    <link href="{{asset('public/frontend/js/revolution-slider/css/settings.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('public/frontend/js/revolution-slider/css/layers.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('public/frontend/js/revolution-slider/css/navigation.css"')}} rel="stylesheet" type="text/css" />

    <!-- CSS | Theme Color -->
    <link href="{{asset('public/frontend/css/colors/theme-skin-color-set1.css')}}" rel="stylesheet" type="text/css">
    <!-- CSS | Main style file -->
    <link href="{{ config('path.iipars_base_url') }}/assets/css/style-main.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{asset('public/frontend/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/frontend/css/owl.theme.default.min.css')}}">




    <meta name="csrf-token" content="{{ csrf_token() }}" />


    @stack('page_css')


</head>

<body>
    <div class="loaderdiv" style="display: none">
        <img src="{{ asset('public/frontend/images/loader.png') }}" alt="" />
    </div>
    <div id="wrapper" class="clearfix">
