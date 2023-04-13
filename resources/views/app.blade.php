<!DOCTYPE html>
<html>
  <head>
  	<title>{{ config('app.name') }}</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.2/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="preconnect" href="//fonts.googleapis.com">
    <link rel="preconnect" href="//fonts.gstatic.com" crossorigin>
    <link href="//fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('lib/themify-icons/themify-icons.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" crossorigin="anonymous" />

    <link rel="preload" as="style" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.2/css/bootstrap.min.css">
    <link rel="preload" as="font" href="//fonts.googleapis.com/css2?family=Varela+Round&display=swap">
    <link rel="preload" as="style" href="{{ asset('lib/themify-icons/themify-icons.css') }}">
    <link rel="preload" as="style" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="preload" as="script" href="//cdn.jsdelivr.net/npm/sweetalert2@11">

    <link rel="prefetch" as="style" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.2/css/bootstrap.min.css">
    <link rel="prefetch" as="font" href="//fonts.googleapis.com/css2?family=Varela+Round&display=swap">
    <link rel="prefetch" as="style" href="{{ asset('lib/themify-icons/themify-icons.css') }}">
    <link rel="prefetch" as="style" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="prefetch" as="script" href="//cdn.jsdelivr.net/npm/sweetalert2@11">

    <script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment-with-locales.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="//cdn.jsdelivr.net/npm/pouchdb@7.3.1/dist/pouchdb.min.js"></script>
	@vite(['resources/css/sass/app.scss', 'resources/js/app.js'])
	@yield('header_part')
</head>
<body>
	<div class="main-container">
		<x-header.menu />
		@yield('content')
	</div>
	@yield('footer_part')
</body>
</html>