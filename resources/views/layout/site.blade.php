<!DOCTYPE HTML>
<html>
	<head>
		<title>
			@section('title')
			
			@show
			- PhpBBMarket
		</title>
		<meta name="" content="" charset="utf-8"/>

        {{--<link rel="stylesheet" href="/market/public/css/pgwslideshow.css" />--}}

        <!-- Include jQuery Mobile stylesheets -->
        {{--<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">--}}

        {{--<link rel="stylesheet" href="/market/public/css/sceditor/default.min.css" type="text/css" media="all" />--}}

        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="/market/public/css/okg.css" />
        <link rel="stylesheet" href="/market/public/css/style.css" />
        <link rel="stylesheet" href="/market/public/css/menuTest.css" />
        <link rel="stylesheet" href="/market/public/css/jquery.datetimepicker.css" />

        <!--<link rel="stylesheet" type="text/css" href="/css/btn.css">-->

        {{--<script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>--}}
        {{--<script src="/market/public/js/vendor/jquery.js"></script>--}}
        {{--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>--}}

        <!-- Include the jQuery library -->
        <script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>

        {{--<script type="text/javascript" src="/market/public/script/jquery.sceditor.bbcode.min.js"></script>--}}
        {{--<script type="text/javascript" src="/market/public/script/bbcode.js"></script>--}}

        <!-- Include the Hammer.js library -->
        <script src="http://hammerjs.github.io/dist/hammer.min.js"></script>
        <script src="/market/public/script/jquery.datetimepicker.js"></script>



        <!-- Include the jQuery Mobile library -->
        {{--<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>--}}

        {{--<script src="/market/public/script/pgwslideshow.js"></script>--}}
        <script src="/market/public/script/okg.js"></script>
        <script src="/market/public/script/okgBB.js"></script>
        <script src="/market/public/script/okAuction.js"></script>
        <script src="/market/public/script/myJS.js"></script>
	</head>

	<body class="layout">
		<div id="site" class="table">
			<div id="header">
					@include('layout.header')
			</div>
				
			<div class="row-divider"></div>

            @if(Session::has('message'))
                <p class="alert">{{ Session::get('message') }}</p>
                <div class="row-divider"></div>
            @endif
            @if(Session::has('notification'))
                <p class="notification">{{ Session::get('notification') }}</p>
                <div class="row-divider"></div>
            @endif
            {{--@if(isset($notification))--}}
                {{--<p class="notification">{{ $notification }}</p>--}}
                {{--<div class="row-divider"></div>--}}
            {{--@endif--}}
			
			<div id="menu">
				<div class="borderbox">
					@include('layout.menuTest')
				</div>
			</div>

			<div class="row-divider"></div>

			{{--
			<div class="row-divider"></div>	
			<div id="banner1" class="layout">
				@include ('layout.banner1')
			--}}

			{{--
			<div id="banner2" class="layout">
				@include('layout.banner2')
			</div>
			--}}

			{{--
        	<div id="banner3" class="layout">
            	@include('layout.banner3')
			</div>
			--}}

            {{--@if($errors->any())--}}
                {{--<ul>--}}
                    {{--@foreach($errors as $error)--}}
                        {{--<li>$error</li>--}}
                    {{--@endforeach--}}
                {{--</ul>--}}
            {{--@endif--}}

			@if (array_key_exists('menu2', View::getSections()))
				<div id="menu2" class="margin0">
					<div class="borderbox">
						@yield('menu2')
					</div>
				</div>

				<div class="row-divider"></div>
			@endif

			<div id="content" class="margin0">
				<div class="borderbox">
					@yield('content')
				</div>
			</div>
					
			{{--
			<div class="row-divider"></div>
			<div id="banner4" class="layout">
				@include('layout.banner4')
			</div>
			--}}

			<div class="row-divider"></div>	
		
			<div id="footer" class="layout row">
				@include('layout.footer')
			</div>
		</div>	
	</body>
</html>