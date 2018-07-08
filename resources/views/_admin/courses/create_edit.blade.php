@extends('_admin.master')

@section('title') @lang('admin_chapters_courses.courses') - @parent @stop


@section('breadcrumbs')
    <li><a href="{{URL::to('/')}}">Home</a></li>
    <li><a href="{{URL::to('/admin/courses')}}">@lang('admin_chapters_courses.courses')</a></li>
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
    </script>
@stop

@section('stylesheets')
    <link rel="stylesheet" type="text/css" href="/assets/_admin/css/tree-view-section.css">
@stop

@section('content')

<form action="{{url('admin/courses').'/'.$course->id}}" enctype="application/x-www-form-urlencoded" method="post" class="form-horizontal form-edit  " autocomplete="off" >
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

    {!! \App\Libraries\REC\UIMessage::get() !!}

    <section id="widget-grid" >
        <div class="row">
            <div class="col-md-8">

                <div class="jarviswidget" data-widget-editbutton="false" data-widget-custombutton="false" data-widget-deletebutton="false">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                        <h2>Details </h2>

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
                                            <label class="label toggle-inline">Is public fix old input checkbox</label>
                                            <label class="toggle" >
                                                <input type="checkbox" name="is_public" value="1" @if((string)old('is_public', $course->is_public) === '1') checked @endif>
                                                <i data-swchon-text="YES" data-swchoff-text="NO"></i>
                                            </label>
                                        </section>

                                        <section>
                                            <label class="label toggle-inline">Is draft {{old('is_draft')}} </label>
                                            <label class="toggle" >
                                                <input type="checkbox" name="is_draft" value="1" @if((string)old('is_draft', $course->is_draft) === '1') checked @endif>
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