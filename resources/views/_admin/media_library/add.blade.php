@extends('_admin.master')

@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop


@section('title') @lang('admin_media_library.add_new_files') @parent @stop

@section('scripts')
    <script src="/assets/_admin/js/libs/plupload/plupload.full.min.js"></script>
    <script src="/assets/_admin/js/media_library/medialibrary_add.js"></script>
@stop

@section('stylesheets')
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
                        <!-- widget content -->
                        <div class="widget-body">

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

@stop