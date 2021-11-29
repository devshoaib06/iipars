@php

$defLng = 'en';

@endphp

<!doctype html>
<html lang="{{$defLng}}">
    <head>
        <meta http-equiv=Content-Type content="text/html;charset=utf-8"> 
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <!--- META -->
        @stack('page_meta')
        <!--- END META -->
        <link rel="shortcut icon" href="{{ asset('public/frontend/images/favicon.png') }}">
    
        <!-- Bootstrap Css -->
        <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/css/bootstrap.css') }}" />
        <!-- <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/css/bootstrap-theme.css') }}" /> -->
        <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/css/font-awesome.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/fonts/fonts.css') }}" />
        
        <!-- Main Css -->
        
        <link rel="stylesheet" href="{{ asset('public/frontend/css/owl.carousel.min.css') }}">
        <link rel="stylesheet" href="{{ asset('public/frontend/css/ios.slider.css') }}">
        <link rel="stylesheet" href="{{ asset('public/frontend/css/owl.theme.default.min.css') }}">
        <link rel="stylesheet" href="{{ asset('public/frontend/css/pushy.css') }}">
        <link rel="stylesheet" href="{{ asset('public/frontend/css/custom-scrollbar.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/css/vmenuModule.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/css/style.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/css/responsive.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/css/messagebox.css') }}" />
        <link href="{{ asset('public/frontend/css/jquery.toast.css') }}" rel="stylesheet" type="text/css">


        
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        
                
        @stack('page_css')
        <!-- Global site tag (gtag.js) - Google Ads: 622923898 -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=AW-622923898"></script>
        <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'AW-622923898');
        </script>
        
        @if (strpos($_SERVER['REQUEST_URI'], "thank-you") !== false)
            <!-- Event snippet for Website lead conversion page -->
            <script>
            gtag('event', 'conversion', {'send_to': 'AW-622923898/PxBcCNqQldQBEPqghKkC'});
            </script>
        @endif
        
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-159588925-1"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());

          gtag('config', 'UA-159588925-1');
        </script>
        <!-- Facebook Pixel Code -->
        <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};
        if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
        n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t,s)}(window, document,'script',
        'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '1150067828687642');
        fbq('track', 'PageView');
        </script>
        <noscript><img height="1" width="1" style="display:none"
        src="https://www.facebook.com/tr?id=1150067828687642&ev=PageView&noscript=1"
        /></noscript>
    <!-- End Facebook Pixel Code -->

    </head>
<body>
    <div class="loaderdiv" style="display: none">
        <img src="{{ asset('public/frontend/images/loader.png') }}"   alt=""/>
    </div>
    <div class="main-container">