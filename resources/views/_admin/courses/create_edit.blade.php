@extends('_admin.master')

@section('title') @lang('admin_chapters_courses.courses') @parent @stop


@section('breadcrumbs')
    <li><a href="{{URL::to('/'.config('app.admin_route'))}}">Home</a></li>
    <li><a href="{{URL::to('/'.config('app.admin_route').'/courses')}}">@lang('admin_chapters_courses.courses')</a></li>
    <li>@if($course->id) Edit @else Create @endif</li>
@stop

@section('scripts')
    <script src="/assets/_admin/js/tree-view-section.js"></script>
    <script src="/assets/_admin/js/general.js"></script>
    <script src="/assets/_admin/js/libs/ckeditor/ckeditor.js"></script>
    <script>
        $(function () {
            //description editor
            CKEDITOR.replace( 'description_editor' ,
                {
                    toolbar : 'deadsimple',
                    uiColor : '#F5F5F5'
                });
        })

        //add course slug 'tutorial-' prefix
        $("input[name='slug']").focusout(function(e) {
            var oldvalue=$(this).val();
            var field=this;
            setTimeout(function () {
                if(field.value.indexOf('-tutorial') === -1) {
                    $(field).val(oldvalue+'-tutorial');
                }
            }, 1);
        });
    </script>
@stop

@section('stylesheets')
    <link rel="stylesheet" type="text/css" href="/assets/_admin/css/tree-view-section.css">
    <style>
        .item-image-container {
            background-image: -webkit-gradient(linear,left top,right bottom,color-stop(0.25,rgba(0,0,0,.03)),color-stop(0.25,transparent),color-stop(0.5,transparent),color-stop(0.5,rgba(0,0,0,.03)),color-stop(0.75,rgba(0,0,0,.03)),color-stop(0.75,transparent),to(transparent));
            background-image: -webkit-linear-gradient(135deg,rgba(0,0,0,.03)25%,transparent 25%,transparent 50%,rgba(0,0,0,.03)50%,rgba(0,0,0,.03)75%,transparent 75%,transparent);
            background-image: -moz-linear-gradient(135deg,rgba(0,0,0,.03)25%,transparent 25%,transparent 50%,rgba(0,0,0,.03)50%,rgba(0,0,0,.03)75%,transparent 75%,transparent);
            background-image: -ms-linear-gradient(135deg,rgba(0,0,0,.03)25%,transparent 25%,transparent 50%,rgba(0,0,0,.03)50%,rgba(0,0,0,.03)75%,transparent 75%,transparent);
            background-image: -o-linear-gradient(135deg,rgba(0,0,0,.03)25%,transparent 25%,transparent 50%,rgba(0,0,0,.03)50%,rgba(0,0,0,.03)75%,transparent 75%,transparent);
            background-image: linear-gradient(135deg,rgba(0,0,0,.03)25%,transparent 25%,transparent 50%,rgba(0,0,0,.03)50%,rgba(0,0,0,.03)75%,transparent 75%,transparent);
            background-color: #FAFCFD;
            width: 250px;
            height: 200px;
            position: relative;
            background-size: 16px 16px;
            border: 1px solid #ddd;

        }
        .item-image-container .img-controllers {
            z-index: 10;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            display: none;
        }
        .item-image-container:after{
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.0);
            transition: background-color 0.3s;
            z-index: 3;
        }
        .item-image-container:hover:after{
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0,0,0,0.3);
            z-index: 3;
        }
        .item-image-container:hover .img-controllers{
            display: initial;
        }
        .item-image-container .item-image {
            position: absolute;
            transform: translate(-50%, -50%);
            top: 50%;
            left: 50%;
            max-width: 100%;
            max-height: 100%;
            z-index: 1;
        }
    </style>
@stop

@section('content')

<form action="{{url(config('app.admin_route').'/courses/'.$course->id)}}" enctype="application/x-www-form-urlencoded" method="post" class="form-horizontal form-edit  " autocomplete="off" >
    <div class="row">
        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-6">
            <h1 class="page-title txt-color-blueDark">
                <i class="fa fa-fw fa-pencil-square-o"></i>
                @lang('admin_chapters_courses.courses') <span>&gt; @if($course->id) Edit @else Create @endif </span>
            </h1>
        </div>

        <div class="col-xs-12 col-sm-5 col-lg-6 text-right">
            <div class="btn-group">
                <button name="save" class="btn btn-lg bg-color-blueDark txt-color-white" value="da">Save</button>
                <button class="btn btn-lg bg-color-blueDark txt-color-white dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <li>
                        <a href="javascript:void(0);" id="save-and-add">Save and Add New</a>
                        <input type="hidden" autocomplete="off" id="save-and-add-input" name="save_and_add_new" value="" />
                    </li>
                </ul>
            </div>
            <button type="submit" name="save_and_continue" value="1" class=" btn btn-lg btn-primary">Save and Continue</button>
            @if($course->id)
                <input name="_method" type="hidden" value="PUT" >
            @endif
            <input type="hidden" name="_token" value="{{csrf_token()}}">
        </div>
    </div>

    {!! \App\Libraries\UIMessage::get() !!}

    <section id="widget-grid" >
        <div class="row">
            <div class="col-md-8">

                <div class="jarviswidget" data-widget-editbutton="false" data-widget-custombutton="false" data-widget-deletebutton="false">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                        <h2>Details </h2>

                        @if($course->id)
                        <div class="widget-toolbar" role="menu">

                            <div class="btn-group">
                                <a href="{{url(config('app.admin_route').'/chapters?course='.$course->id)}}" class="btn btn-xs btn-success">
                                    Chapters
                                </a>
                            </div>
                        </div>
                        @endif

                    </header>

                    <div role="content" >
                        <div class="widget-body smart-form ">

                            <section>
                                <label class="label">Name <span class="req">*</span></label>
                                <label class="input">
                                    <input type="text" name="name" placeholder="Name" class="form-control input-sm" value="{{old('name', $course->name)}}">
                                </label>
                            </section>

                            <section>
                                    <label class="label">Description</label>
                                    <label class="textarea textarea-resizable">
                                        <textarea rows="3" type="text" id="description_editor" name="description" placeholder="Description" class="custom-scroll" >{{old('description', $course->description)}}</textarea>
                                    </label>
                            </section>

                            @if($course->id)
                            <section>
                                <label class="label">Image</label>
                                @if($image)
                                    <div class="item-image-container">
                                        <div class="img-controllers">
                                            <a href="{{url(config('app.admin_route').'/media-library/add/course/'.$course->id)}}" title="Edit" class="btn btn-primary"><i class="fa fa-fw fa-pencil-square-o"></i></a>
                                            <button title="Delete" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></button>
                                        </div>
                                        <img class="item-image" src="{{URL::to($image->url)}}" >
                                    </div>
                                @else
                                    <a class="btn btn-primary" href="{{url(config('app.admin_route').'/media-library/add/course/'.$course->id)}}">Upload Image</a>
                                @endif
                            </section>
                            @endif

                        </div>
                    </div>

                </div>

            </div>
            <div class="col-md-4">

                <div class="jarviswidget" data-widget-editbutton="false" data-widget-custombutton="false" data-widget-deletebutton="false">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                        <h2> @lang('admin_general.details_title') </h2>

                        <ul id="widget-tab-1" class="nav nav-tabs pull-right">

                            <li class=" @if($course->id) active @endif">

                                <a data-toggle="tab" href="#hr1"> <i class="fa fa-lg fa-arrow-circle-o-down"></i> <span class="hidden-mobile hidden-tablet"> @lang('admin_general.map') </span> </a>

                            </li>

                            <li class="@if(!$course->id) active @endif">
                                <a data-toggle="tab" href="#hr2"> <i class="fa fa-lg fa-arrow-circle-o-up"></i> <span class="hidden-mobile hidden-tablet"> @lang('admin_general.configure') </span></a>
                            </li>

                        </ul>
                    </header>

                    <div role="content" >
                        <div class="widget-body ">


                            <div class="tab-content padding-10">
                                <div class="tab-pane fade @if($course->id) in active @endif curses-chapters-tree" data-curses-hierarchy-map='{!! $curses_hierarchy_map !!}'  id="hr1">
                                </div>
                                <div class="tab-pane fade @if(!$course->id) in active @endif " id="hr2">
                                    <section class="smart-form">
                                        <section>
                                            <label class="label toggle-inline">Status</label>
                                            <select class="select2" name="status">
                                                <option value="0" @if(old('status', $course->status) == 0) selected @endif >Non-public</option>
                                                <option value="1" @if(old('status', $course->status) == 1) selected @endif >Public</option>
                                                <option value="2" @if(old('status', $course->status) == 2) selected @endif >Inaccessible - public</option>
                                            </select>
                                        </section>

                                        <section>
                                            <label class="label toggle-inline">Is draft </label>
                                            <label class="toggle" >
                                                <input type="checkbox" name="is_draft" value="1"
                                                        @if(!count(old()) && $course->is_draft == 1)
                                                            checked
                                                        @elseif(old('is_draft') == 1)
                                                            checked
                                                        @endif>
                                                <i data-swchon-text="YES" data-swchoff-text="NO"></i>
                                            </label>
                                        </section>

                                        <section>
                                            <label class="label">Course order weight </label>
                                            <label class="input">
                                                <input type="text" name="order_weight" placeholder="Order weight" class="form-control input-sm" value="{{old('order_weight', $course->order_weight)}}">
                                            </label>
                                        </section>
                                    </section>

                                    <section style="overflow: auto" >
                                        <div class="col-md-12">
                                            <label style="font-weight: normal">Slug <span class="req">*</span></label>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="input-group" data-input-enable-switcher>
                                                    <input data-switch-enable-target type="text" name="slug" placeholder="Slug"  disabled="disabled" class="form-control" data-value="{{old('slug',$course->slug)}}" value="{{old('slug',$course->slug)}}">
                                                    <span class="input-group-addon">
                                                        <span class="onoffswitch">
                                                            <input data-switch-enable type="checkbox" @if(!$course->id) checked @endif name="enabled_slug_edit" class="onoffswitch-checkbox" id="switch_slug">
                                                            <label class="onoffswitch-label" for="switch_slug">
                                                                <span class="onoffswitch-inner" data-swchon-text="YES" data-swchoff-text="NO"></span>
                                                                <span class="onoffswitch-switch"></span>
                                                            </label>
                                                        </span>
                                                    </span>
                                                </div>
                                                <p class="text-right text-muted">
                                                    <small >If changed then loss of SEO</small>
                                                </p>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

            </div>
        </div>

    </section>
</form>
@stop