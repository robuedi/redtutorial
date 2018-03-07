<!DOCTYPE html>
<html lang="en-us">

    <head>
        <meta charset="utf-8">
        <title>
            @section('title')
                | WebCode Tutorial
            @show
        </title>

        <meta name="description" content="{{$meta['description']}}">
        <meta name="author" content="{{config('app.name')}}">

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="/assets/css/lib/grid4.css">
        <link rel="stylesheet" type="text/css" href="/assets/css/lib/normalize8.css">
        <link rel="stylesheet" type="text/css" href="/assets/css/app.css">

        @yield('stylesheets')

        <!-- Main Font -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700,800" rel="stylesheet">

        <!--[if lt IE 9]>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
        <![endif]-->

        <!-- Link to Google CDN's jQuery + jQueryUI; fall back to local -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script>
            if (!window.jQuery) {
                document.write('<script src="/assets/js/libs/jquery-3.3.1.min.js"><\/script>');
            }
        </script>

        <script>
            var site_url = "{{ url('') }}";
        </script>
    </head>

    <body>
        <div id="page_wrapper">
            <nav id="main_navigation" class="container-fluid">
                <div class="row">
                    <div class="col-md-2">
                        <img class="main-logo" src="/assets/img/logo.png" alt="Main website logo">
                        <p class="title">WebCode Tutorial</p>
                    </div>

                    <div class="main-menu-list col-md-8">
                        <ul class="menu-list">
                            <li><a>LEARN HTML5</a></li>
                            <li><a>SEARCH</a></li>
                            <li><a>PLAYGROUND</a></li>
                        </ul>
                    </div>

                    <div class="col-md-2 navigation-sidebar">
                        <span>
                            Menu
                        </span>
                        <div class="menu-sidebar">
                            <ul class="menu-items">
                                <li>HTML</li>
                                <li>SEARCH</li>
                                <li>Contact us</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>

            @yield('content')

            <footer>
            </footer>
        </div>

        <script src="/assets/js/main.js"></script>
        @yield('scripts')

    </body>
</html>
