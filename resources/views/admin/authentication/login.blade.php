<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login - {{config('app.name')}} </title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,user-scalable=yes">
    <link rel="icon" href="{{URL::to('/assets/admin/')}}/img/favicon/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" type="text/css" media="screen" href="{{URL::to('/assets')}}/css/lib/bootstrap4.0.min.css">
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
                @if ($errors->any())
                    <div >
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            @foreach ($errors->all(':message') as $message)
                                {{ $message }}
                            @endforeach
                        </div>
                    </div>
                @endif
                <form action="/admin/login" id="login_form" method="POST">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="input-container input-container_username">
                        <input type="text" name="email" placeholder="Email address" autocomplete="off" >
                    </div>
                    <div class="input-container">
                        <input type="password" name="password" placeholder="Password" autocomplete="off">
                    </div>

                    <button class="submit">Login</button>
                </form>
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

    <script type="text/javascript">

        $(function() {
            // Validation
            $("#login_form").validate({
                // Rules for form validation
                rules : {
                    email : {
                        required : true,
                        email : true
                    },
                    password : {
                        required : true,
                        minlength : 3,
                        maxlength : 50
                    }
                },

                // Messages for form validation
                messages : {
                    email : {
                        required : 'Please enter your email address',
                        email : 'Please enter a VALID email address'
                    },
                    password : {
                        required : 'Please enter your password'
                    }
                },

                // Do not change code below
                errorPlacement : function(error, element) {
                    error.insertAfter(element.parent());
                }
            });
        });
    </script>
</body>
</html>