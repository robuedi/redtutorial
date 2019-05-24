@extends('_admin.master')

@section('title') Blog article @parent @stop


@section('breadcrumbs')
    <li><a href="{{URL::to('/')}}">Home</a></li>
    <li><a href="{{URL::to('/'.config('app.admin_route').'/blog')}}">Blog article</a>
    <li>@if($article->id) Edit @else Create @endif</li>
@stop

@section('scripts')
    <script src="/assets/_admin/js/general.js"></script>
    <script src="/assets/_admin/js/libs/ckeditor_4.10.0_full/ckeditor.js"></script>
    <script>
        $(function () {

            CKEDITOR.replace( 'text_content' ,
                {
                    // toolbar : 'deadsimple',
                    uiColor : '#F5F5F5',
                    allowedContent: true,
                    height: '200px',
                    extraPlugins:'tab,codesnippet,imagebrowser',
                    codeSnippet_theme: 'monokai_sublime',
                    imageBrowser_listUrl: '/admin/media-library/ckeditor',

                });

        });
    </script>
@stop

@section('stylesheets')
    <link rel="stylesheet" type="text/css" href="/assets/_admin/css/tree-view-section.css">
@stop

@section('content')

<form action="{{url(config('app.admin_route').'/blog/'.$article->id)}}" enctype="application/x-www-form-urlencoded" method="post" class="form-horizontal form-edit  " autocomplete="off" >
    <div class="row">
        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-6">
            <h1 class="page-title txt-color-blueDark">
                <i class="fa fa-fw fa-pencil-square-o"></i>
                Blog article <span>&gt; @if($article->id) Edit @else Create @endif </span>
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
            @if($article->id)
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
                        <h2> @lang('admin_general.content') </h2>
                    </header>

                    <div role="content" >
                        <div class="widget-body smart-form ">

                            <section>
                                <label class="label">Title <span class="req">*</span></label>
                                <label class="input">
                                    <input type="text" name="title" placeholder="Title" class="form-control input-sm" value="{{old('title', $article->title)}}">
                                </label>
                            </section>

                            <section>
                                <label class="label">Meta description <span class="req">*</span></label>
                                <label class="input">
                                    <input type="text" name="meta_description" placeholder="Meta description" class="form-control input-sm" value="{{old('meta_description', $article->meta_description)}}">
                                </label>
                            </section>

                            <section>
                                    <label class="label">Content</label>
                                    <label class="textarea textarea-resizable">
                                        <textarea rows="3" type="text" id="text_content" name="content" placeholder="Content" class="custom-scroll" >{{old('content', $article->content)}}</textarea>
                                    </label>
                            </section>
                        </div>
                    </div>

                </div>

            </div>

            <div class="col-md-4">
                <div class="row">
                    <div class="col-sm-12">

                        <div class="jarviswidget" data-widget-editbutton="false" data-widget-custombutton="false" data-widget-deletebutton="false">
                            <header>
                                <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                                <h2> @lang('admin_general.details_title') </h2>
                            </header>

                            <div role="content" >
                                <div class="widget-body  ">

                                    <section class="smart-form">

                                        <section>
                                            <label class="label toggle-inline">Is public <span class="req">*</span></label>
                                            <label class="toggle" >
                                                <input type="checkbox" name="is_public" value="1"
                                                       @if(!count(old()) && $article->is_public == 1)
                                                       checked
                                                       @elseif(old('is_public') == 1)
                                                       checked
                                                        @endif
                                                >
                                                <i data-swchon-text="YES" data-swchoff-text="NO"></i>
                                            </label>
                                        </section>

                                        <section>
                                            <label class="label toggle-inline">Is draft <span class="req">*</span></label>
                                            <label class="toggle" >
                                                <input type="checkbox" name="is_draft" value="1"
                                                       @if(!count(old()) && $article->is_draft == 1)
                                                       checked
                                                       @elseif(old('is_draft') == 1)
                                                       checked
                                                        @endif>
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
                                                    <input data-switch-enable-target type="text" name="slug" placeholder="Slug"  disabled="disabled" class="form-control" data-value="{{old('slug',$article->slug)}}" value="{{old('slug',$article->slug)}}">
                                                    <span class="input-group-addon">
                                                    <span class="onoffswitch">
                                                        <input data-switch-enable type="checkbox" @if(!$article->id) checked @endif name="enabled_slug_edit" class="onoffswitch-checkbox" id="switch_slug">
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