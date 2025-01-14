<head>
    <meta charset="utf-8">
    <!--<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">-->

    <title> @section('title') | Admin {{config('app.name')}} @show </title>
    <meta name="robots" content="noindex,follow">
    <meta name="description" content="">
    <meta name="author" content="">

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    @yield('meta')

    <!-- Caution! DO NOT change the order -->
    <link rel="stylesheet" type="text/css" media="screen" href="{{URL::to('/assets/_admin/')}}/css/smartadmin-production-plugins.min.css">
    <link rel="stylesheet" type="text/css" media="screen" href="{{URL::to('/assets/_admin/')}}/css/smartadmin-production.min.css">
    <link rel="stylesheet" type="text/css" media="screen" href="{{URL::to('/assets/_admin/')}}/css/smartadmin-skins.min.css">

    <link rel="stylesheet" type="text/css" media="screen" href="{{URL::to('/assets/_admin/')}}/css/smartadmin-rtl.min.css">
    <link rel="stylesheet" type="text/css" media="screen" href="{{URL::to('/assets/_admin/')}}/css/smart-admin-style.css">

    <!-- Basic Styles -->
    <link rel="stylesheet" type="text/css" media="screen" href="{{URL::to('/assets/_admin/')}}/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" media="screen" href="{{URL::to('/assets/_admin/')}}/css/font-awesome.min.css">

    <!-- Own CSS-->
    <link rel="stylesheet" type="text/css" media="screen" href="{{URL::to('/assets/_admin/')}}/css/your_style.css">

    @yield('stylesheets')


    <link rel="stylesheet" type="text/css" media="screen" href="{{URL::to('/assets/_admin/')}}/css/extra.min.css">

    <!-- FAVICONS -->
    <link rel="shortcut icon" href="{{URL::to('/assets/_admin/')}}/img/favicon/red-tutorial.ico" type="image/x-icon">
    <link rel="icon" href="{{URL::to('/assets/_admin/')}}/img/favicon/red-tutorial.ico" type="image/x-icon">

    <!-- GOOGLE FONT -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700">

    <!-- Specifying a Webpage Icon for Web Clip
         Ref: https://developer.apple.com/library/ios/documentation/AppleApplications/Reference/SafariWebContent/ConfiguringWebApplications/ConfiguringWebApplications.html -->
    <link rel="apple-touch-icon" href="{{URL::to('/assets/_admin/')}}/img/splash/sptouch-icon-iphone.png">
    <link rel="apple-touch-icon" sizes="76x76" href="{{URL::to('/assets/_admin/')}}/img/splash/touch-icon-ipad.png">
    <link rel="apple-touch-icon" sizes="120x120" href="{{URL::to('/assets/_admin/')}}/img/splash/touch-icon-iphone-retina.png">
    <link rel="apple-touch-icon" sizes="152x152" href="{{URL::to('/assets/_admin/')}}/img/splash/touch-icon-ipad-retina.png">

    <!-- iOS web-app metas : hides Safari UI Components and Changes Status Bar Appearance -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">

    <!-- Startup image for web apps -->
    <link rel="apple-touch-startup-image" href="{{URL::to('/assets/_admin/')}}/img/splash/ipad-landscape.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:landscape)">
    <link rel="apple-touch-startup-image" href="{{URL::to('/assets/_admin/')}}/img/splash/ipad-portrait.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:portrait)">
    <link rel="apple-touch-startup-image" href="{{URL::to('/assets/_admin/')}}/img/splash/iphone.png" media="screen and (max-device-width: 320px)">

    <!-- Link to Google CDN's jQuery + jQueryUI; fall back to local -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script>
        if (!window.jQuery) {
            document.write('<script src="{{URL::to('/assets/_admin/')}}/js/libs/jquery-2.1.1.min.js"><\/script>');
        }
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
    <script>
        if (!window.jQuery.ui) {
            document.write('<script src="{{URL::to('/assets/_admin/')}}/js/libs/jquery-ui-1.10.3.min.js"><\/script>');
        }
    </script>
    <script >
        var site_url = "{{ url('') }}";
        var admin_url = "{{ config('app.admin_route') }}";

        $(function () {
            //set unique ids to jarvis in order to remember the colors
            var path_name_jarvis = window.location.pathname;
            var page_id = "unique_site_id_"+page_id+"_"+path_name_jarvis.replace(/\W/g, '');
           $('.jarviswidget').each(function (index) {
              $(this).attr('id', page_id+"_"+String(index));
           });
        });
    </script>

</head>