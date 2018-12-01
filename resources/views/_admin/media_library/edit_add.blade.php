@extends('_admin.master')

@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop


@section('title') @lang('admin_media_library.add_new_files') @parent @stop

@section('scripts')
    <script src="/assets/_admin/js/libs/plupload/moxie.js"></script>
    <script src="/assets/_admin/js/libs/plupload/plupload.dev.js"></script>
    <script src="/assets/_admin/js/cropjs/cropper.min.js"></script>
    <script src="/assets/_admin/js/media_library/medialibrary_edit_add.js"></script>
    <script src="/assets/_admin/js/media_library/medialibrary_edit_crop.js"></script>
@stop

@section('stylesheets')
    <link rel="stylesheet" type="text/css" href="/assets/_admin/js/cropjs/cropper.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/_admin/js/cropjs/cropper_extra.css">
    <style>
        .smart-form header {
            padding-top: 0px;
            border-bottom: none;
        }
        .smart-form .edit-footer .btn{
            float: none;
        }
        .smart-form .edit-footer .btn-group .btn{
            float: left;
        }
    </style>
@stop

@section('breadcrumbs')
    <li><a href="{{URL::to('/'.config('app.admin_route'))}}">@lang('admin_general.home')</a></li>
    <li><a href="{{URL::to('/'.config('app.admin_route').'/media-library')}}">@lang('admin_media_library.media_library')</a></li>
    <li>@lang('admin_media_library.add_new_file')</li>
@stop

@section('content')

    <div class="row">
        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-6">
            <h1 class="page-title txt-color-blueDark">
                <i class="fa fa-fw fa-pencil-square-o"></i>
                @lang('admin_media_library.media_library') <span>&gt; Upload new files</span>
            </h1>
        </div>
    </div>

    {!! \App\Libraries\UIMessage::get() !!}

    <section id="widget-grid" class="" data-upload-item = "@if(isset($item_type) && isset($item_id))/{{$item_type}}/{{$item_id}}@endif">
        @if(isset($item_type) && isset($item_id) && in_array($item_type, ['course']))
        <div class="row">
            <div class="col-xs-12">
                <p>
                    <a href="{{ url(config('app.admin_route').'/courses/'.$item_id.'/edit') }}" class="btn btn-primary btn-xl">Back</a>
                </p>
            </div>
        </div>
        @endif

        <div class="row">
            <div class="col-xs-12">

                <!-- Dropzone -->
                <div data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" id="wid-id-dropzone" class="widget-options jarviswidget jarviswidget-color-darken">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-file"></i> </span>
                        <h2>Select files for upload</h2>
                    </header>

                    <!-- widget div-->
                    <div>
                        <button type="button" class="btn btn-primary btn-sm hidden" id="pickfiles">Select files</button>
                        <!-- widget content -->
                        <div class="widget-body no-padding">
                            <div class="smart-form">
                                <header class="docs-data">
                                    Width: <span id="dataWidth">0</span>px | Height: <span id="dataHeight">0</span>px | X: <span id="dataX">0</span>px | Y: <span id="dataY">0</span>px
                                </header>
                                <div id="upload-container" class="dropzone">
                                    <div class="img-container">
                                        <img id="image" @if($img) src="{{URL::to($img->url)}}" @endif>
                                    </div>
                                </div>
                                <footer class="edit-footer docs-buttons">
                                    <label type="button" class="btn btn-primary btn-upload">
                                        <input type="file" class="sr-only" id="inputImage" name="file" accept=".jpg,.jpeg,.png,.gif,.bmp,.tiff">
                                        Import image
                                    </label>
                                    <button type="button" class="btn btn-success" data-method="getCroppedCanvas" data-option='{"maxWidth": 4096, "maxHeight": 4096 }'>
                                        Upload
                                    </button>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default"  data-method="zoom" data-option="0.1" title="Zoom In" >
                                            <span class="fa fa-search-plus"></span>
                                        </button>
                                        <button type="button" class="btn btn-default"  data-method="zoom" data-option="-0.1" title="Zoom Out" >
                                            <span class="fa fa-search-minus"></span>
                                        </button>
                                    </div>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default" data-method="move" data-option="-10" data-second-option="0" title="Move Left">
                                            <span class="fa fa-arrow-left"></span>
                                        </button>
                                        <button type="button" class="btn btn-default" data-method="move" data-option="10" data-second-option="0" title="Move Right">
                                            <span class="fa fa-arrow-right"></span>
                                        </button>
                                        <button type="button" class="btn btn-default" data-method="move" data-option="0" data-second-option="-10" title="Move Up">
                                            <span class="fa fa-arrow-up"></span>
                                        </button>
                                        <button type="button" class="btn btn-default" data-method="move" data-option="0" data-second-option="10" title="Move Down">
                                            <span class="fa fa-arrow-down"></span>
                                        </button>
                                    </div>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default" data-method="rotate" data-option="-5" title="Rotate 5 Degrees Left">
                                          <span class="fa fa-rotate-left"></span>
                                        </button>
                                        <button type="button" class="btn btn-default" data-method="rotate" data-option="5" title="Rotate 5 Degrees Right">
                                          <span class="fa fa-rotate-right"></span>
                                        </button>
                                    </div>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default" data-method="scaleX" data-option="-1"  title="Flip Horizontal">
                                          <span class="fa fa-arrows-h"></span>
                                        </button>
                                        <button type="button" class="btn btn-default" data-method="scaleY" data-option="-1"  title="Flip Vertical">
                                          <span class="fa fa-arrows-v"></span>
                                        </button>
                                    </div>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default" data-method="scale" data-option="1"  data-second-option="1" title="Scale Up">
                                          <span class="fa fa-arrows-h"></span>
                                        </button>
                                        <button type="button" class="btn btn-default" data-method="testBtn"  title="Scale Down">
                                          <span class="fa fa-arrows-v"></span>
                                        </button>
                                    </div>
                                    <button type="button" class="btn btn-warning" data-method="reset" title="Reset" >
                                        <span class="fa fa-refresh"></span>
                                    </button>
                                </footer>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end Dropzone -->

            </div>
        </div>
    </section>

    <div class="uploaded-files hidden">
        <h1>Uploaded files</h1>
        <hr class="simple">

        <div class="fileslist">
            <div class="alert alert-danger" role="alert">Your browser doesn't have Flash, Silverlight or HTML5 support.</div>
        </div>
    </div>

    <div class="alert alert-danger error-console hidden"></div>

    <!-- Show the cropped image in modal -->
    <div class="modal fade docs-cropped" id="getCroppedCanvasModal" aria-hidden="true" aria-labelledby="getCroppedCanvasTitle" role="dialog" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="getCroppedCanvasTitle">Cropped</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" data-upload-img class="btn btn-success">Upload</button>
                    <a class="btn btn-default" id="download" href="javascript:void(0);" download="cropped.jpg">Download</a>
                </div>
            </div>
        </div>
    </div><!-- /.modal -->
@stop