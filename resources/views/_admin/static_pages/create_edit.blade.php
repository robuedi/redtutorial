@extends('_admin.master')

@section('title') @lang('admin_static_pages.static_pages') @parent @stop


@section('breadcrumbs')
    <li><a href="{{URL::to('/'.config('app.admin_route'))}}">@lang('admin_general.home')</a></li>
    <li><a href="{{URL::to('/'.config('app.admin_route').'/static-pages')}}">@lang('admin_static_pages.static_pages')</a></li>
    <li>@if($page->id) @lang('admin_general.edit') @else @lang('admin_general.create') @endif</li>
@stop
@section('scripts')
    <script src="/assets/_admin/js/general.js"></script>
    <script src="/assets/_admin/js/libs/ckeditor_4.10.0_full/ckeditor.js"></script>
    <script src="/assets/js/libs/prism/prism.js"></script>
    <script>
        $(function (){
            CKEDITOR.editorConfig = function( config )
            {
                config.extraPlugins = 'popup';
            };

            CKEDITOR.replace( 'text_content' ,
                {
                    // toolbar : 'deadsimple',
                    uiColor : '#F5F5F5',
                    allowedContent: true,
                    height: '700px',
                    extraPlugins:'tab,codesnippet,imagebrowser',
                    codeSnippet_theme: 'monokai_sublime',
                    imageBrowser_listUrl: '/admin/media-library/ckeditor',

                });

        });
    </script>
@stop

@section('stylesheets')
    <link rel="stylesheet" type="text/css" href="/assets/js/libs/prism/prism.css">
@stop

@section('content')

    <form action="{{url(config('app.admin_route').'/static-pages/'.$page->id)}}" enctype="application/x-www-form-urlencoded" method="post" class="form-horizontal form-edit  " autocomplete="off" >
        <div class="row">
            <div class="col-xs-12 col-sm-7 col-md-7 col-lg-6">
                <h1 class="page-title txt-color-blueDark">
                    <i class="fa fa-fw fa-pencil-square-o"></i>
                    @lang('admin_static_pages.static_pages') <span>&gt; @if($page->id) @lang('admin_general.edit') @else @lang('admin_general.create') @endif </span>
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
                @if($page->id)
                    <input name="_method" type="hidden" value="PUT" >
                @endif
                <input type="hidden" name="_token" value="{{csrf_token()}}">
            </div>
        </div>

        {!! \App\Libraries\UIMessage::get() !!}

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
                                            <label class="label">Name <span class="req">*</span></label>
                                            <label class="input">
                                                <input type="text" name="name" placeholder="Name" class="form-control input-sm" value="{{old('name', $page->name)}}">
                                            </label>
                                        </section>

                                        <section>
                                            <label class="label">Heading</label>
                                            <label class="input">
                                                <input type="text" name="heading" placeholder="Heading" class="form-control input-sm" value="{{old('heading', $page->heading)}}">
                                            </label>
                                        </section>

                                        <section>
                                            <label class="label">Head title <span class="req">*</span></label>
                                            <label class="input">
                                                <input type="text" name="head_title" placeholder="Head title" class="form-control input-sm" value="{{old('head_title', $page->head_title)}}">
                                            </label>
                                        </section>

                                        <section>
                                            <label class="label">Meta description <span class="req">*</span></label>
                                            <label class="input">
                                                <input type="text" name="meta_description" placeholder="Meta description" class="form-control input-sm" value="{{old('meta_description', $page->meta_description)}}">
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
                                    <h2>@lang('admin_general.content') </h2>


                                    <ul id="widget-tab-1" class="nav nav-tabs pull-right">

                                        <li class="active ">

                                            <a data-toggle="tab" href="#content_editor"> <i class="fa fa-lg fa-arrow-circle-o-down"></i> <span class="hidden-mobile hidden-tablet"> @lang('admin_general.editor_edit') </span> </a>

                                        </li>

                                        <li class="">
                                            <a data-toggle="tab" href="#preview"> <i class="fa fa-lg fa-arrow-circle-o-up"></i> <span class="hidden-mobile hidden-tablet"> @lang('admin_general.editor_preview') </span></a>
                                        </li>

                                    </ul>

                                </header>

                                <div role="content" >
                                    <div class="widget-body no-padding ">

                                        <div class="tab-content">
                                            {{--Editor--}}
                                            <div class="tab-pane fade in active" id="content_editor">
                                                <textarea id="text_content" rows="3" type="text" name="content" placeholder="Content" class="custom-scroll" >{{old('content', $page->content)}}</textarea>
                                            </div>

                                            {{--Preview--}}
                                            <div class="tab-pane fade " id="preview">
                                                <div class="text-content-preview">
                                                    {!! old('content', $page->content) !!}
                                                </div>
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
                        </header>

                        <div role="content" >
                            <div class="widget-body ">

                                <section class="smart-form">
                                    <section>
                                        <label class="label toggle-inline">Is public <span class="req">*</span></label>
                                        <label class="toggle" >
                                            <input type="checkbox" name="is_public" @if(old('is_public', $page->is_public)) checked="checked" @endif>
                                            <i data-swchon-text="YES" data-swchoff-text="NO"></i>
                                        </label>
                                    </section>

                                    <section>
                                        <label class="label toggle-inline">Is draft <span class="req">*</span></label>
                                        <label class="toggle" >
                                            <input type="checkbox" name="is_draft" @if(old('is_draft', $page->is_draft)) checked="checked" @endif>
                                            <i data-swchon-text="YES" data-swchoff-text="NO"></i>
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
                                                <input data-switch-enable-target type="text" name="slug" placeholder="Slug"  disabled="disabled" class="form-control" data-value="{{old('slug',$page->slug)}}" value="{{old('slug',$page->slug)}}">
                                                <span class="input-group-addon">
                                                    <span class="onoffswitch">
                                                        <input data-switch-enable type="checkbox" @if(!$page->id) checked @endif name="enabled_slug_edit" class="onoffswitch-checkbox" id="switch_slug">
                                                        <label class="onoffswitch-label" for="switch_slug">
                                                            <span class="onoffswitch-inner" data-swchon-text="YES" data-swchoff-text="NO"></span>
                                                            <span class="onoffswitch-switch"></span>
                                                        </label>
                                                    </span>
                                                </span>
                                            </div>
                                            <p class="text-right text-muted">
                                                <small >If changed then loss of SEO.</small>
                                            </p>
                                        </div>
                                    </div>
                                </section>

                            </div>
                        </div>

                    </div>

                </div>
            </div>

        </section>
    </form>
@stop