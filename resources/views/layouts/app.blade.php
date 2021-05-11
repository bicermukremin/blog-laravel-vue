<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

   <!-- Vendor CSS -->
		<link rel="stylesheet" href="frontend/vendor/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="frontend/vendor/fontawesome-free/css/all.min.css">
		<link rel="stylesheet" href="frontend/vendor/animate/animate.compat.css">
		<link rel="stylesheet" href="frontend/vendor/simple-line-icons/css/simple-line-icons.min.css">
		<link rel="stylesheet" href="frontend/vendor/owl.carousel/assets/owl.carousel.min.css">
		<link rel="stylesheet" href="frontend/vendor/owl.carousel/assets/owl.theme.default.min.css">
		<link rel="stylesheet" href="frontend/vendor/magnific-popup/magnific-popup.min.css">

		<!-- Theme CSS -->
		<link rel="stylesheet" href="frontend/css/theme.css">
		<link rel="stylesheet" href="frontend/css/theme-elements.css">
		<link rel="stylesheet" href="frontend/css/theme-blog.css">
		<link rel="stylesheet" href="frontend/css/theme-shop.css">



		<!-- Demo CSS -->
		<link rel="stylesheet" href="frontend/css/demos/demo-construction.css">
		<!-- Skin CSS -->
		<link id="skinCSS" rel="stylesheet" href="frontend/css/skins/skin-construction.css">

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="frontend/css/custom.css">

		<!-- Head Libs -->
		<script src="frontend/vendor/modernizr/modernizr.min.js"></script>



	
      
</head>
<body data-spy="scroll" data-target="#sidebar" data-offset="120">
    
            @yield('content')
      
</body>
</html>
