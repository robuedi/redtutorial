<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Media Library</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{ HTML::style('assets/backend/css/bootstrap.min.css') }}
    {{ HTML::style('assets/backend/css/font-awesome.min.css') }}
    {{ HTML::style('assets/backend/css/medialibrary.css?v1.4') }}

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

    <!-- BOOTSTRAP JS -->
    {{ HTML::script('assets/backend/js/bootstrap/bootstrap.min.js') }}
    {{ HTML::script('assets/backend/js/medialibrary_popup_browse.js') }}

    <script>
        var site_url = "{{ url('') }}";
        var mediaLibraryImages = {};
    </script>
</head>
<body>

    @if(count($results))
        <div class="media-library clearfix">
        @foreach($results as $r)
            <script type="text/javascript">
                // create an object with current displayed images so we can easily update selectedImages object
                mediaLibraryImages['file-{{$r->id}}'] = {'fileId': '{{$r->id}}', 'name' : '{{$r->name}}', 'url' : '{{$r->url}}' };
            </script>

            <div class="media-item pull-left" data-file="{{$r->id}}">
                <div class="thumbnail">
                    @if (in_array($r->type, array('jpg','gif','png')))
                        @if (File::exists($r->path))
                        <img src="{{URL::to($r->url . '?resize=w[120]h[120]e[true]s[true]')}}" alt="{{ $r->name }}">
                        @else
                        <img src="{{URL::asset('assets/admin/img/missing-picture.png?resize=w[120]h[120]e[true]s[true]')}}" alt="{{ $r->name }}">
                        @endif
                    @else
                        <div class="icon">
                            <i class="fa fa-5x {{ MediaFile::getFileIcon($r->type) }}"></i>
                        </div>
                        <div class="file-name">{{$r->name}}</div>
                    @endif
                </div>
                <span class="check">
                    <i class="fa fa-check fa-fw fa-lg"></i>
                </span>
            </div>
        @endforeach
        </div>

        <div class="text-center">
            {{ $results->appends(Input::except('page'))->links() }}
        </div>
    @else
        <div class="alert alert-info">
            No files in media library
        </div>
    @endif

</body>
</html>