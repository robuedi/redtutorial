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

        <meta name="theme-color" content="#FFFFFF"/>

        <meta name="author" content="{{config('app.name')}}">

        <meta name="viewport" content="width=device-width, initial-scale=1">

        @if(isset($custom_meta_link)||(!(isset($exception) && in_array($exception->getStatusCode() ?? [], [404, 410])) ))
            <link rel="canonical" href="https://redtutorial.com{{request()->path() !== '/' ? '/'.request()->path() : ''}}" />
        @endif

        <link rel="icon" href="/assets/img/logo.ico">
        <link rel="stylesheet" type="text/css" href="/assets/css/bundle.min.css?v=15">

        @yield('stylesheets')

        {{--<!--[if lt IE 9]>--}}
        {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>--}}
        {{--<![endif]-->--}}

        <script>
            var site_url = "{{ url('') }}";
        </script>

        @yield('head_end')
    </head>

    <body class="@yield('body_class')">

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
               Copyright &copy; 2019 RedTutorial.com
            </p>
        </footer>

        @yield('scripts')

        <!-- JS -->
        <script src="/assets/js/bundle.min.js?v=12"></script>

    </body>
</html>
