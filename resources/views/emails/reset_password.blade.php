<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Password Reset</title>

</head>
<body>
    Hi {{$user->first_name}},<br/>

    <br/>

    Follow this link to reset your password: <a href="{{$reset_url}}">{{$reset_url}}</a>.<br/>

    <br/>

    Kind regards,<br/>
    {{config('app.name')}} Team
</body>
</html>