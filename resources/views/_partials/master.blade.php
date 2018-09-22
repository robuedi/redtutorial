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
        {{--<link rel="stylesheet" type="text/css" href="/assets/css/lib/bootstrap-grid.min.css">--}}
        {{--<link rel="stylesheet" type="text/css" href="/assets/css/lib/bootstrap.min.css">--}}
        <link rel="stylesheet" type="text/css" href="/assets/css/lib/normalize8.css">
        <link rel="stylesheet" type="text/css" href="/assets/css/app.css">

        @yield('stylesheets')

        <!-- Main Font -->
        <link href="https://fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">



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

        @include('_partials.sidebar')

        <main>

            <section id="content_top_section">

            </section>

            @yield('content')
        </main>



        <script src="/assets/js/main.js"></script>
        @yield('scripts')

    </body>
</html>
