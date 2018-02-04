<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>@section('title') {{config('app.APP_NAME')}} @show </title>
        <meta name="description" content="Admin Section" >
        <meta name="author" content="Robu Eduard Cristian" >
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

        <!-- BOOTSTRAP, FONT-AWESOME CSS-->
        <link rel="stylesheet" href="{!! asset('assets/admin/css/lib/bootstrap/bootstrap.min.css') !!}">
        <link rel="stylesheet" href="{!! asset('assets/admin/css/lib/font_awesome/font-awesome.min.css') !!}">

        <!-- SMART ADMIN CSS-->
        <link rel="stylesheet" href="{!! asset('assets/admin/css/lib/smartadmin/smartadmin-production.min.css') !!}">
        <link rel="stylesheet" href="{!! asset('assets/admin/css/lib/smartadmin/smartadmin-skins.min.css') !!}">

        @yield('stylesheets')

        <!-- GOOGLE FONT -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700">

        <!-- Link to Google CDN's jQuery for using existing caches, fall back to local is failed to find -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script>
            if (!window.jQuery) {
                document.write('<script src="{{ asset('assets/js/libs/jquery-3.3.1.min.js') }}"><\/script>');
            }
        </script>
        <script src="{!! asset('assets/admin/js/lib/jquery-ui-1.11.1.min.js') !!}"></script>

        <script>
            var site_url = "{{ url('') }}";
        </script>
    </head>

    <body>
        <!-- PAGE HEADER -->
        <header id="header">
            <div id="logo-group">
                <span id="logo" class="clearfix"> <img src="{{ URL::to('assets/backend/img/logo.png') }}" alt="Adminpanel" class="pull-left"></span>
            </div>

            <!-- pulled right: nav area -->
            <div class="pull-right">

                <!-- collapse menu button -->
                <div id="hide-menu" class="btn-header pull-right">
                    <span> <a href="javascript:void(0);" data-action="toggleMenu" title="Collapse Menu"><i class="fa fa-reorder"></i></a> </span>
                </div>
                <!-- end collapse menu -->

                <!-- #MOBILE -->
                <!-- Top menu profile link : this shows only when top menu is active -->
                <ul id="mobile-profile-img" class="header-dropdown-list hidden-xs padding-5">
                    <li class="">
                        <a href="#" class="dropdown-toggle no-margin userdropdown" data-toggle="dropdown">
                            {{--<img src="{{MediaFile::getProfilePicture()}}?resize=w[50]h[50]e[true]s[true]" alt="Profile picture" class="online" />--}}
                        </a>
                        <ul class="dropdown-menu pull-right">
                            <li>
                                <a href="javascript:void(0);" class="padding-10 padding-top-0 padding-bottom-0"><i class="fa fa-cog"></i> Setting</a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="profile.html" class="padding-10 padding-top-0 padding-bottom-0"> <i class="fa fa-user"></i> <u>P</u>rofile</a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="javascript:void(0);" class="padding-10 padding-top-0 padding-bottom-0" data-action="toggleShortcut"><i class="fa fa-arrow-down"></i> <u>S</u>hortcut</a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="javascript:void(0);" class="padding-10 padding-top-0 padding-bottom-0" data-action="launchFullscreen"><i class="fa fa-arrows-alt"></i> Full <u>S</u>creen</a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="{{URL::to('backend/logout') }}" class="padding-10 padding-top-5 padding-bottom-5" data-action="userLogout"><i class="fa fa-sign-out fa-lg"></i> <strong><u>L</u>ogout</strong></a>
                            </li>
                        </ul>
                    </li>
                </ul>

                <!-- logout button -->
                <div id="logout" class="btn-header transparent pull-right">
                    <span> <a href="{{URL::to('backend/logout') }}" title="Sign Out" data-action="userLogout" data-logout-msg="You can improve your security further after logging out by closing this opened browser"><i class="fa fa-sign-out"></i></a> </span>
                </div>
                <!-- end logout button -->

                <!-- search mobile button (this is hidden till mobile view port) -->
                <div id="search-mobile" class="btn-header transparent pull-right">
                    <span> <a href="javascript:void(0)" title="Search"><i class="fa fa-search"></i></a> </span>
                </div>
                <!-- end search mobile button -->
                <!-- fullscreen button -->
                <div id="fullscreen" class="btn-header transparent pull-right">
                    <span> <a href="javascript:void(0);" data-action="launchFullscreen" title="Full Screen"><i class="fa fa-arrows-alt"></i></a> </span>
                </div>
                <!-- end fullscreen button -->
            </div>
            <!-- end pulled right: nav area -->

        </header>
        <!-- END PAGE HEADER -->


        <!-- Left panel : Navigation area -->
        <!-- Note: This width of the aside area can be adjusted through LESS variables -->
        <aside id="left-panel">

            <!-- User info -->
            <div class="login-info">
                <span> <!-- User image size is adjusted inside CSS, it should stay as it -->

                    <a href="javascript:void(0);" id="show-shortcut" data-action="toggleShortcut">
                        <span>
                        </span>
                        <i class="fa fa-angle-down"></i>
                    </a>

                </span>
            </div>
            <!-- end user info -->


            <!-- NAVIGATION : This navigation is also responsive -->
            @include('admin.menu', array('config_menu' => App\Libraries\AdminLib\Menu::getMenu()))
            <!-- END NAVIGATION -->

        </aside>

        <!-- MAIN PAGE CONTENT -->
        <main>
            @yield('content')
        </main>
        <!-- END MAIN PAGE CONTENT-->

        <!-- PAGE FOOTER-->
        <footer>
        </footer>
        <!-- END PAGE FOOTER-->

        <script src="{!! asset('assets/admin/js/lib/smartadmin/notification/SmartNotification.min.js') !!}"></script>
        <script src="{!! asset('assets/admin/js/lib/smartadmin/smartwidgets/jarvis.widget.min.js') !!}"></script>

        @yield('scripts')

    </body>

</html>