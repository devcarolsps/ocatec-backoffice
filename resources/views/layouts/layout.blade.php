<!DOCTYPE html>
<html lang="en">

<head>
		<meta charset="utf-8"/>
		<!-- ===============================================-->
		<!--    Document Title-->
		<!-- ===============================================-->
		<title>{{ env("APP_NAME") }}</title>

		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description"/>
		<meta content="Coderthemes" name="author"/>
		<!-- CSRF Token -->
		<meta name="csrf-token" content="{{ csrf_token() }}">

		<!-- App favicon -->
		<link rel="shortcut icon" href="/view/assets/images/logos/logo-icon.png">
		<meta http-equiv="Cache-control" content="no-cache">
		<meta http-equiv="Expires" content="-1">

		<script src="{{ asset('js/jquery.min.js') }}" type="text/javascript"></script>

		<!-- App css -->
		<link href={{ asset('css/icons.min.css') }} rel="stylesheet" type="text/css"/>
		<link href={{ asset('css/app.css') }} rel="stylesheet" type="text/css" id="app-style">
		<link href={{ asset('css/notify.css') }} rel="stylesheet" type="text/css">

		<!-- Toast css -->
		<link href={{ asset('lib/toastr/toastr.min.css') }} rel="stylesheet">
		<!-- Fonts -->
		<link rel="dns-prefetch" href="//fonts.gstatic.com">
		<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

		<!-- DataTable css -->
		<link href="{{ asset('lib/dataTablesBootstrap4/css/dataTables.bootstrap4.css') }}" rel="stylesheet" type="text/css"/>
		<link href="{{ asset('lib/dataTablesBootstrap4/css/responsive.bootstrap4.css') }}" rel="stylesheet" type="text/css"/>

		<!-- Dropzone -->
		<link href="{{ asset("lib/dropzone@5/css/dropzone.min.css") }}" rel="stylesheet" type="text/css"/>


<body id="bodyteste" class="loading" data-layout="full" data-layout-color="light" data-leftbar-theme="dark"
						data-layout-mode="fluid" data-rightbar-onstart="true">

<x:notify-messages/>
<div class="wrapper">

		<meta http-equiv="Cache-control" content="no-cache">
		<meta http-equiv="Expires" content="-1">


		@extends('layouts.sidebar')

		<div class="content-page">
				<div class="content">
						@include('layouts.navbar')

						@yield('content')


				</div>
		</div>

		<script src={{ asset('js/vendor.min.js') }}></script>
		<script src={{ asset('js/app.js') }}></script>
		<script src={{ asset('js/view/main.js') }}></script>

		<!-- Toaster -->
		<script src={{ asset('lib/toastr/toastr.min.js') }}></script>


      <!-- DataTable Js -->
        <script src="{{ asset('lib/dataTablesBootstrap4/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('lib/dataTablesBootstrap4/js/dataTables.bootstrap4.js') }}"></script>
        <script src="{{ asset('lib/dataTablesBootstrap4/js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('lib/dataTablesBootstrap4/js/responsive.bootstrap4.min.js') }}"></script>


		<!-- PDFJS -->
		<script src="https://jasonday.github.io/printThis/printThis.js"></script>

		<!-- SWEET ALERT 2 -->
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- DROPZONE -->
  <script src="{{ asset("lib/dropzone@5/js/dropzone.min.js") }}" ></script>

		<!-- NOIFYJS -->
		@notifyJs

</body>

</html>
