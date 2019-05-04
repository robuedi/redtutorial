<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Contact Us message</title>

    </head>
    <body>
        <p>
            Hi Admin,<br/>

            <br/>

            There has been a new Contact Us form message, with the following details:<br/>
            <br/>
            <strong>Date sent:</strong> {{$created_at}}<br/>
            <br/>
            <strong>Subject:</strong> {{$subject}}<br/>
            <strong>Sender name:</strong> {{$name}}<br/>
            <strong>Sender email:</strong> {{$email}}

            <br/>
            <br/>

            <strong>Message content:</strong>

            <br/>
            <br/>

            {{$content}}

            <br/>
            <br/>

            Kind regards,<br/>
            {{config('app.name')}} Team
        </p>
    </body>
</html>