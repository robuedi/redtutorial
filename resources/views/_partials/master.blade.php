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

        <link rel="icon" href="/assets/img/red-tutorial.ico">
        <link rel="stylesheet" type="text/css" href="/assets/css/app.min.css">

        @yield('stylesheets')

        <!-- Main Font -->
        <link href="https://fonts.googleapis.com/css?family=PT+Sans:400,700" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

        {{--<!--[if lt IE 9]>--}}
        {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>--}}
        {{--<![endif]-->--}}

        <script>
            var site_url = "{{ url('') }}";
        </script>
    </head>

    <body>

        @include('_partials.sidebar', array('menu' => App\Libraries\MenuClient::getMenu(isset($course_id) ? $course_id : null), 'static_pages' => \App\Libraries\MenuClientStatic::getStaticMenu()))

        <aside class="mobile-nav">
            <a href="/" class="logo-txt">
                <span class="red">RED</span>
                <span class="tutorial">Tutorial</span>
            </a>
            <button aria-label="Open sidebar" class="trigger-sidebar"></button>
        </aside>

        <main>
            @yield('content')
        </main>


        <aside class="cookie-message">
            This website uses cookies to improve user experience. By using this website you consent to all cookies in accordance with our Cookie Policy.
        </aside>

        <!-- Link to Google CDN's jQuery + jQueryUI; fall back to local -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script>
            if (!window.jQuery) {
                document.write('<script src="/assets/js/libs/jquery-3.3.1.min.js"><\/script>');
            }
        </script>

        <!-- JS -->
        <script src="/assets/js/scripts.min.js"></script>

        @yield('scripts')

    </body>
</html>
