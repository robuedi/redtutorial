<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login - {{config('app.name')}} </title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,user-scalable=yes">
    <link rel="stylesheet" type="text/css" media="screen" href="{{URL::to('/assets')}}/css/lib/bootstrap4.0.min.css">
    {{--<link rel="stylesheet" type="text/css" media="screen" href="{{URL::to('/assets')}}/css/app.css">--}}
    <link rel="stylesheet" type="text/css" media="screen" href="{{URL::to('/assets')}}/css/admin-login.css">
</head>
<body>

    <main class="container f-box-display">

        <section class="row">
            <div class="col">

                <h1>Welcome</h1>

                <div class="img-container">
                    <img class="user-img" src="/assets/img/user_placeholderw150h150.png" alt="User Image">
                </div>

                <div class="input-container input-container_username">
                    <input type="text" name="email" placeholder="Email address">
                </div>
                <div class="input-container">
                    <input type="password" name="password" placeholder="Password">
                </div>

                <button>Login</button>
            </div>
        </section>

    </main>

    <footer>
        <ul>
            <li>Forgot <span class="warning">Password?</span></li>
            <li>Don’t have an account? (Sorry, administrator only) </li>
        </ul>
    </footer>
    <!-- Link to Google CDN's jQuery; fall back to local -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        if (!window.jQuery) {
            document.write('<script src="{{URL::to('/assets/admin/')}}/js/lib/jquery-3.3.1.min.js"><\/script>');
        }
    </script>
    <script src="{{URL::to('/assets')}}/js/lib/bootstrap.bundle.min.js"></script>

</body>
</html>