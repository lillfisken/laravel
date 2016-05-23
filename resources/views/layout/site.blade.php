<!DOCTYPE HTML>
<html class="no-js">
    <head>
        <title>
            @section('title')

            @show
            - PhpBBMarket
        </title>
        <meta name="" content="" charset="utf-8"/>

        {{--Favicon--}}
        <link rel="shortcut icon" href="{{ env('PUBLIC_PATH') }}favicon.ico">

        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        {{--<link rel="stylesheet" href="/market/public/font-awesome-4.5.0/css/font-awesome.min.css" />--}}
        <link rel="stylesheet" href="/market/public/css/okg.css" />
        {{--<link rel="stylesheet" href="/market/public/css/style.css" />--}}
        <link rel="stylesheet" href="/market/public/css/dev/sticky-footer.css"/>
        <link rel="stylesheet" href="/market/public/css/dev/layout.css"/>
        {{--<link rel="stylesheet" href="/market/public/css/dev/topmenu.css"/>--}}
        <link rel="stylesheet" href="/market/public/css/dev/theme.css"/>
        <link rel="stylesheet" href="/market/public/css/mainMenu.css" />
        <link rel="stylesheet" href="/market/public/css/jquery.datetimepicker.css" />

                <!-- Include the modernizr development library -->
        {{--<script src="/market/public/script/modernizr-custom.js"></script>--}}

                <!-- Include the jQuery library -->
        <script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>

                <!-- Include the Hammer.js library -->
        <script src="http://hammerjs.github.io/dist/hammer.min.js"></script>


        <script src="/market/public/script/jquery.datetimepicker.js"></script>

        <script src="/market/public/script/pgwslideshow.js"></script>
        <script src="/market/public/script/okg.js"></script>
        <script src="/market/public/script/okgBB.js"></script>
        <script src="/market/public/script/okAuction.js"></script>
        <script src="/market/public/script/myJS.js"></script>
    </head>

    <body class="Site">
        <header class="margin-bottom-5 Site-header">
            @include('layout.header')
        </header>

        @if(Session::has('message'))
            <div class="inner-content message width100">{{ Session::pull('message') }}</div>
            <div class="row-divider"></div>
        @endif
        @if(Session::has('alert'))
            <div class="inner-content alert">{{ Session::pull('alert') }}</div>
            <div class="row-divider"></div>
        @endif
        @if(Session::has('notification'))
            <div class="inner-content notification">{{ Session::pull('notification') }}</div>
            <div class="row-divider"></div>
        @endif

        <menu id="menu" class="width100 margin-bottom-5 dark-border light-background">
                @include('layout.menu')
        </menu>

        <main class="margin-bottom-5 Site-content">
            <div class="flex-container flex-small-row flex-space-between">
                <div id="content" class="margin0 borderbox light-background dark-border inner-content">
                    @yield('content')
                </div>
                <div id="banner-right-side" class=" /*light-background dark-border*/">
                    @include('layout.bannerRightSide')
                </div>
            </div>
        </main>

        <footer class="Site-footer dark-background dark-border">
            @include('layout.footer')
        </footer>
    </body>
</html>