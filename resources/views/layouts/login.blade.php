<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- ===============================================-->
    <!--    Document Title-->
    <!-- ===============================================-->
    <title>{{ env("APP_NAME") }}</title>


    <!-- ===============================================-->
    <!--    Favicons-->
    <!-- ===============================================-->
    <link rel="apple-touch-icon" sizes="180x180" href={{ asset('img/favicons/apple-touch-icon.png') }}>
    <link rel="icon" type="image/png" sizes="32x32" href={{ asset('img/favicons/apple-touch-icon.png') }}>
    <link rel="icon" type="image/png" sizes="16x16" href={{ asset('img/favicons/apple-touch-icon.png') }}>
    <link rel="shortcut icon" type="image/x-icon" href={{ asset('img/favicons/apple-touch-icon.png') }}>
    <link rel="manifest" href={{ asset('img/favicons/manifest.json') }}>
    <meta name="msapplication-TileImage" content={{ asset('img/favicons/mstile-150x150.png') }}>
    <meta name="theme-color" content="#ffffff">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js?v=<?php echo time();?>" type="text/javascript"></script>

    <!-- ===============================================-->
    <!--    Stylesheets-->
    <!-- ===============================================-->

    <link href={{ asset('css/icons.min.css') }} rel="stylesheet" type="text/css"  />
    <link href={{ asset('css/app.css') }} rel="stylesheet" type="text/css" id="app-style" >

    <!-- ===============================================-->
    <!--    Fonts-->
    <!-- ===============================================-->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">


</head>
<body>

@yield('content')


<!-- ===============================================-->
<!--    JavaScripts-->
<!-- ===============================================-->



<script src={{ asset('js/vendor.min.js') }}></script>
<script src={{ asset('js/app.js') }}></script>
<script src="{{ asset('js/view/main.js?v=' . date("YmdHis")) }}"></script>

</body>

</html>
