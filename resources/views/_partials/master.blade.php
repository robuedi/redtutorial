<!DOCTYPE html>
<html lang="en-us">

    <head>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-137856014-1"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'UA-137856014-1');
        </script>
        <meta charset="utf-8">
        <title>
            @section('title')
                - {{config('app.name')}}
            @show
        </title>

        @yield('meta')

        <meta name="author" content="{{config('app.name')}}">

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="theme-color" content="#e62c33">

        <link rel="icon" href="/assets/img/logo.ico">
        <link rel="stylesheet" type="text/css" href="/assets/css/app.min.css?v=9">

        @yield('stylesheets')

        <!-- Main Font -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700,900" rel="stylesheet">

        <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">

        {{-- FOR LOGO REMOVE IT--}}
        <link href="https://fonts.googleapis.com/css?family=Fjalla+One" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Yesteryear" rel="stylesheet">

        {{--<!--[if lt IE 9]>--}}
        {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>--}}
        {{--<![endif]-->--}}

        <script>
            var site_url = "{{ url('') }}";
        </script>

        @yield('head_end')
    </head>

    <body>

        <aside class="cookie-message">
            This website uses cookies to improve user experience. By using this website you consent to all cookies in accordance with our <a class="link" href="/info/privacy-and-cookies-policy">Privacy and Cookie Policy</a>.
        </aside>

        @include('_partials.navigation', array('static_pages' => \App\Libraries\MenuClientStatic::getStaticMenu()))

        @yield('content')

        <footer id="footer-container">
            <ul class="footer-links">
                @foreach(App\Libraries\MenuClientStatic::getStaticMenu() as $page)
                    <li>
                        <a href="/info/{{$page->slug}}" class="@if(url()->current() === url('/info/'.$page->slug)) active @endif" >{{$page->name}}</a>
                    </li>
                @endforeach
            </ul>
            <p class="copyright-container">
               Copyright &copy; 2019 REDTutorial.com
            </p>
        </footer>

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
