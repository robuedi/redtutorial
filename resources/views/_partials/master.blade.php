<!DOCTYPE html>
<html lang="en-us">

    <head>
        <meta charset="utf-8">
        <title>
            @section('title')
                | {{config('app.name')}}
            @show
        </title>

        @yield('meta')

        <meta name="author" content="{{config('app.name')}}">

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="theme-color" content="#e62c33">

        <link rel="icon" href="/assets/img/logo.ico">
        <link rel="stylesheet" type="text/css" href="/assets/css/app.min.css?v=2">

        @yield('stylesheets')

        <!-- Main Font -->
        <link href="https://fonts.googleapis.com/css?family=PT+Sans:400,700" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Ubuntu+Mono" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

        {{-- FOR LOGO REMOVE IT--}}
        <link href="https://fonts.googleapis.com/css?family=Fjalla+One" rel="stylesheet">


        {{--<!--[if lt IE 9]>--}}
        {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>--}}
        {{--<![endif]-->--}}

        <script>
            var site_url = "{{ url('') }}";
        </script>
    </head>

    <body>

        <aside class="cookie-message">
            This website uses cookies to improve user experience. By using this website you consent to all cookies in accordance with our Cookie Policy.
        </aside>

        @include('_partials.navigation', array('static_pages' => \App\Libraries\MenuClientStatic::getStaticMenu()))

        <main>
            @yield('content')
        </main>

        <!-- Link to Google CDN's jQuery + jQueryUI; fall back to local -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script>
            if (!window.jQuery) {
                document.write('<script src="/assets/js/libs/jquery-3.3.1.min.js"><\/script>');
            }
        </script>

        <!-- JS -->
        <script src="/assets/js/scripts.min.js?v=1"></script>

        @yield('scripts')

    </body>
</html>
