@extends('_admin.master')

@section('title') @lang('admin_lessons.lessons') - @parent @stop


@section('breadcrumbs')
    <li><a href="{{URL::to('/')}}">@lang('admin_general.home')</a></li>
    <li><a href="{{URL::to('/admin/lessons')}}">@lang('admin_lessons.lessons')</a></li>
    <li>@if($lesson->id) @lang('admin_general.edit') @else @lang('admin_general.creates') @endif</li>
@stop

@section('scripts')
    <script src="/assets/_admin/js/tree-view-section.js"></script>
    <script src="/assets/_admin/js/general.js"></script>
    <script src="/assets/_admin/js/libs/ckeditor.js"></script>
    <script>
        $(function () {
            ClassicEditor.create( document.querySelector( '#text_content' ) );
            ClassicEditor.create( document.querySelector( '#description_editor' ) );
            console.log(ClassicEditor.build.plugins.map( plugin => plugin.pluginName ));

        });
    </script>
    <script>
        $(function () {

            $('.curses-hierarchy').select2({
                searchInputPlaceholder: 'Please select',
                allowClear: true,
                width: 'resolve',
                dropdownAutoWidth: true,
                data: {
                    results: JSON.parse($('[data-curses-hierarchy]').attr('data-curses-hierarchy')),
                    text: "name"
                },
                formatSelection: function(item) {
                    return item.name
                },
                formatResult: function(item) {
                    return item.name
                }
            });

        });
    </script>
@stop

@section('stylesheets')
    <link rel="stylesheet" type="text/css" href="/assets/_admin/css/tree-view-section.css">
@stop

@section('content')

<form action="{{url('admin/lessons/'.$lesson->id)}}" enctype="application/x-www-form-urlencoded" method="post" class="form-horizontal form-edit  " autocomplete="off" >
    <div class="row">
        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-6">
            <h1 class="page-title txt-color-blueDark">
                <i class="fa fa-fw fa-pencil-square-o"></i>
                @lang('admin_lessons.lessons') <span>&gt; @if($lesson->id) @lang('admin_general.edit') @else @lang('admin_general.create') @endif </span>
            </h1>
        </div>

        <div class="col-xs-12 col-sm-5 col-lg-6 text-right">
            <div class="btn-group">
                <button name="save" class="btn btn-lg bg-color-blueDark txt-color-white" value="da">@lang('admin_general.save')</button>
                <button class="btn btn-lg bg-color-blueDark txt-color-white dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <li>
                        <a href="javascript:void(0);" id="save-and-add">@lang('admin_general.save_and_add_new')</a>
                        <input type="hidden" autocomplete="off" id="save-and-add-input" name="save_and_add_new" value="" />
                    </li>
                </ul>
            </div>
            <button type="submit" name="save_and_continue" value="1" class=" btn btn-lg btn-primary">@lang('admin_general.save_and_continue')</button>
            @if($lesson->id)
                <input name="_method" type="hidden" value="PUT" >
            @endif
            <input type="hidden" name="_token" value="{{csrf_token()}}">
        </div>
    </div>

    {!! \App\Libraries\REC\UIMessage::get() !!}

    <section id="widget-grid" >
        <div class="row">
            <div class="col-md-8">

                <div class="row">
                    <div class="col-md-12">

                        <div class="jarviswidget" data-widget-editbutton="false" data-widget-custombutton="false" data-widget-deletebutton="false">
                            <header>
                                <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                                <h2>@lang('admin_general.details_title') </h2>

                            </header>

                            <div role="content" >
                                <div class="widget-body smart-form ">

                                    <section>
                                        <label class="label">Name</label>
                                        <label class="input">
                                            <input type="text" name="name" placeholder="Name" class="form-control input-sm" value="{{old('name', $lesson->name)}}">
                                        </label>
                                    </section>

                                    <section>
                                        <label class="label">Description</label>
                                        <label class="textarea textarea-resizable">
                                            <textarea rows="3" type="text" id="description_editor" name="description" placeholder="Description" class="custom-scroll" >{{old('description', $lesson->description)}}</textarea>
                                        </label>
                                    </section>

                                </div>
                            </div>

                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="jarviswidget" data-widget-editbutton="false" data-widget-custombutton="false" data-widget-deletebutton="false">
                            <header>
                                <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                                <h2>@lang('admin_lessons.content') </h2>


                                <ul id="widget-tab-1" class="nav nav-tabs pull-right">

                                    <li class="active ">

                                        <a data-toggle="tab" href="#content_editor"> <i class="fa fa-lg fa-arrow-circle-o-down"></i> <span class="hidden-mobile hidden-tablet"> @lang('admin_lessons.editor') </span> </a>

                                    </li>

                                    <li class="">
                                        <a data-toggle="tab" href="#preview"> <i class="fa fa-lg fa-arrow-circle-o-up"></i> <span class="hidden-mobile hidden-tablet"> @lang('admin_lessons.preview') </span></a>
                                    </li>

                                </ul>

                            </header>

                            <div role="content" >
                                <div class="widget-body no-padding ">

                                    <div class="tab-content">
                                        {{--Editor--}}
                                        <div class="tab-pane fade in active" id="content_editor">
                                            <textarea id="text_content" rows="3" type="text" name="content" placeholder="Content" class="custom-scroll" >{{old('content', $lesson->content)}}</textarea>
                                        </div>

                                        {{--Preview--}}
                                        <div class="tab-pane fade " id="preview">
                                        </div>
                                    </div>
                                </div>
                            </div>

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

                            <li class=" @if($lesson->id) active @endif ">

                                <a data-toggle="tab" href="#hr1"> <i class="fa fa-lg fa-arrow-circle-o-down"></i> <span class="hidden-mobile hidden-tablet"> @lang('admin_general.map') </span> </a>

                            </li>

                            <li class=" @if(!$lesson->id) active @endif">
                                <a data-toggle="tab" href="#hr2"> <i class="fa fa-lg fa-arrow-circle-o-up"></i> <span class="hidden-mobile hidden-tablet"> @lang('admin_general.configure') </span></a>
                            </li>

                        </ul>
                    </header>

                    <div role="content" >
                        <div class="widget-body  ">

                            <div class="tab-content padding-10">
                                <div class="tab-pane fade  @if($lesson->id) in active @endif curses-chapters-tree" data-curses-hierarchy-map='{!! $curses_hierarchy_map !!}' id="hr1">
                                </div>
                                <div class="tab-pane fade  @if(!$lesson->id) in active @endif " id="hr2">
                                    <section class="smart-form">
                                        <section>
                                            <label class="label toggle-inline">Is public <span class="req">*</span></label>
                                            <label class="toggle" >
                                                <input type="checkbox" name="is_public" @if(old('is_public', $lesson->is_public)) checked="checked" @endif>
                                                <i data-swchon-text="YES" data-swchoff-text="NO"></i>
                                            </label>
                                        </section>

                                        <section>
                                            <label class="label toggle-inline">Is draft <span class="req">*</span></label>
                                            <label class="toggle" >
                                                <input type="checkbox" name="is_draft" @if(old('is_draft', $lesson->is_draft)) checked="checked" @endif>
                                                <i data-swchon-text="YES" data-swchoff-text="NO"></i>
                                            </label>
                                        </section>

                                        <section>
                                            <label class="label">Order weight <span class="req">*</span></label>
                                            <label class="input">
                                                <input type="text" name="order_weight" placeholder="Order weight" class="form-control input-sm" value="{{old('order_weight', $lesson->order_weight)}}">
                                            </label>
                                        </section>

                                        <section>
                                            <label class="label">Course/Chapter <span class="req">*</span></label>
                                            <label class="input">
                                                <input name="parent_id" type="hidden" class="curses-hierarchy" data-placeholder="@lang('admin_general.select_placeholder')" value="{{old('parent_id', $lesson->parent_id)}}">
                                                <span class="hidden" data-curses-hierarchy='{!! $curses_hierarchy !!}' ></span>
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
                                                    <input data-switch-enable-target type="text" name="slug" placeholder="Slug"  disabled="disabled" class="form-control" data-value="{{old('slug',$lesson->slug)}}" value="{{old('slug',$lesson->slug)}}">
                                                    <span class="input-group-addon">
                                                            <span class="onoffswitch">
                                                                <input data-switch-enable type="checkbox" @if(!$lesson->id) checked @endif name="enabled_slug_edit" class="onoffswitch-checkbox" id="switch_slug">
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