<!DOCTYPE HTML>
<html>
	<head>
		<title>
			@section('title')
			
			@show
			- PhpBBMarket
		</title>
		<meta name="" content="" charset="utf-8"/>
		<link rel="stylesheet" href="/market/public/css/style.css" />
		<!--<link rel="stylesheet" type="text/css" href="/css/btn.css">-->
		<script src="/market/public/script/myJS.js"></script>
	</head>

	<body class="layout">
		<div id="site" class="table">
			<div id="header">
					@include('layout.header')
			</div>
				
			<div class="row-divider"></div>
			
			<div id="menu">
				<div class="borderbox">
					@include('layout.menu')
				</div>
			</div>
			
			<!--
			<div class="row-divider"></div>	
			<div id="banner1" class="layout">
				@include ('layout.banner1')
			</div>
				
			<div id="banner2" class="layout">
				@include('layout.banner2')	
			</div>
				
			<div id="banner3" class="layout">
				@include('layout.banner3')	
			</div>
			-->
			<div class="row-divider"></div>
			
			<div id="content" class="margin0">
				<div class="borderbox">
					@yield('content')
				</div>
			</div>
					
			<!--
			<div class="row-divider"></div>
			<div id="banner4" class="layout">
				@include('layout.banner4')	
			</div>
			-->
			<div class="row-divider"></div>	
		
			<div id="footer" class="layout row">
					@include('layout.footer')
			</div>
		</div>	
	</body>
</html>