<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

    <title>{{ config('app.name', 'EMEK') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
   
   		 <!-- Styles -->
    	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
    	<link href="{{ asset('css/loading.css') }}" rel="stylesheet">
        <!-- Theme CSS -->
 		<link rel="stylesheet" href="{{asset('admin/css/theme.css')}}" />
    		<!-- Web Fonts  -->
		<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="{{asset('admin/vendor/bootstrap/css/bootstrap.css')}}" />
		<link rel="stylesheet" href="{{asset('admin/vendor/animate/animate.compat.css')}}">

		<link rel="stylesheet" href="{{asset('admin/vendor/font-awesome/css/all.min.css')}}" />
		<link rel="stylesheet" href="{{asset('admin/vendor/boxicons/css/boxicons.min.css')}}" />
		<link rel="stylesheet" href="{{asset('admin/vendor/magnific-popup/magnific-popup.css')}}" />
		<link rel="stylesheet" href="{{asset('admin/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css')}}" /> 


		<!-- Theme Custom CSS -->
	    <link rel="stylesheet" href="{{asset('admin/css/custom.css')}}">

	
		{{-- <script src="{{asset('admin/vendor/modernizr/modernizr.js')}}"></script>
		<script src="{{asset('admin/master/style-switcher/style.switcher.localstorage.js')}}"></script> --}}

      
</head>
<body>
    
            @yield('content')
   
      
</body>
</html>
