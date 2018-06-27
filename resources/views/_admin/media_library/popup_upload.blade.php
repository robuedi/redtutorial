<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Upload new files</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{ HTML::style('assets/backend/css/bootstrap.min.css') }}

    <!-- SmartAdmin Styles : Please note (smartadmin-production.css) was created using LESS variables -->
    {{ HTML::style('assets/backend/css/smartadmin-production.min.css') }}
    {{ HTML::style('assets/backend/css/smartadmin-skins.min.css') }}

    {{ HTML::style('assets/backend/css/your_style.css') }}
    {{ HTML::style('assets/backend/css/medialibrary.css?v1.3') }}

    <!-- Link to Google CDN's jQuery + jQueryUI; fall back to local -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
    <script>
        if (!window.jQuery) {
            document.write('<script src="{{ URL::to('assets/backend/js/libs/jquery-2.0.2.min.js') }}"><\/script>');
        }
    </script>

    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
    <script>
        if (!window.jQuery.ui) {
            document.write('<script src="{{ URL::to('assets/backend/js/libs/jquery-ui-1.10.3.min.js') }}"><\/script>');
        }
    </script>

    <script>
        var site_url = "{{ url('') }}";
    </script>

    {{ HTML::script('assets/backend/js/bootstrap/bootstrap.min.js') }}
    {{ HTML::script('assets/backend/js/plugin/plupload/plupload.full.min.js') }}
    {{ HTML::script('assets/backend/js/medialibrary_popup_upload.js') }}
</head>
<body>
    
    <div id="upload-container" class="dropzone">
        <div id="drag-drop-area">
            <div class="drag-drop-container">
                <p>Drop files here</p>
                <p>or</p>
                <p>
                    <button type="button" class="btn btn-primary btn-sm" id="pickfiles">Select files</button>
                </p>
            </div>
        </div>
    </div>

    <div class="uploaded-files hidden">
        <h1>Uploaded files</h1>
        <hr class="simple">

        <div class="fileslist">
            <div class="alert alert-danger" role="alert">Your browser doesn't have Flash, Silverlight or HTML5 support.</div>
        </div>
    </div>

    <div class="alert alert-danger error-console hidden"></div>
</body>
</html>