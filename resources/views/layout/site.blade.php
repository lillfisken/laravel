<!DOCTYPE HTML>
<html>
	<head>
		<title>
			@section('title')
			
			@show
			- PhpBBMarket
		</title>
		<meta name="" content="" charset="utf-8"/>

		{{--<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">--}}
        <link rel="stylesheet" href="/market/public/font-awesome-4.5.0/css/font-awesome.min.css" />
        <link rel="stylesheet" href="/market/public/css/okg.css" />
        <link rel="stylesheet" href="/market/public/css/style.css" />
        <link rel="stylesheet" href="/market/public/css/menuTest.css" />
        <link rel="stylesheet" href="/market/public/css/jquery.datetimepicker.css" />

        <!-- Include the jQuery library -->
        <script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>

        <!-- Include the Hammer.js library -->
        <script src="http://hammerjs.github.io/dist/hammer.min.js"></script>
        <script src="/market/public/script/jquery.datetimepicker.js"></script>

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
                <div class="inner-content message">{{ Session::pull('message') }}</div>
                <div class="row-divider"></div>
            @endif
            @if(Session::has('alert'))
                <div class="inner-content alert">{{ Session::pull('alert') }}</div>
                <div class="row-divider"></div>
            @endif
            @if(Session::has('notification'))
                <p class="notification">{{ Session::pull('notification') }}</p>
                <div class="row-divider"></div>
            @endif
			
			<div id="menu">
				<div class="borderbox">
					@include('layout.menu')
				</div>
			</div>
			<div class="row-divider"></div>

			@if (array_key_exists('menu2', View::getSections()))
				<div id="menu2" class="margin0">
					<div class="borderbox">
						@yield('menu2')
					</div>
				</div>
				<div class="row-divider"></div>
			@endif

            <div class="css-table">
                <div class="css-table-row">
                    <div class="css-table-cell">
                        <div id="content" class="margin0 borderbox">
                            @yield('content')
                        </div>
                    </div>
                    <div class="css-table-cell-banner">
                        <div id="banner-right-side">
                            @include('layout.bannerRightSide')
                        </div>
                    </div>
                </div>
            </div>
            <div class="row-divider"></div>

            <div id="footer" class="layout row">
				@include('layout.footer')
			</div>
		</div>	
	</body>
</html>