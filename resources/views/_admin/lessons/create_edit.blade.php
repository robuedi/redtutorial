@extends('_admin.master')

@section('title') @lang('admin_lessons.lessons') - @parent @stop


@section('breadcrumbs')
    <li><a href="{{URL::to('/')}}">@lang('admin_general.home')</a></li>
    <li><a href="{{URL::to('/admin/lessons')}}">@lang('admin_lessons.lessons')</a></li>
    <li>@if($main_object->id) @lang('admin_general.edit') @else @lang('admin_general.creates') @endif</li>
@stop

@section('scripts')
@stop

@section('stylesheets')
@stop

@section('content')

<form action="{{url('admin/lessons/'.$main_object->id)}}" enctype="application/x-www-form-urlencoded" method="post" class="form-horizontal form-edit  " autocomplete="off" >
    <div class="row">
        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-6">
            <h1 class="page-title txt-color-blueDark">
                <i class="fa fa-fw fa-pencil-square-o"></i>
                @lang('admin_lessons.lessons') <span>&gt; @if($main_object->id) @lang('admin_general.edit') @else @lang('admin_general.create') @endif </span>
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
            @if($main_object->id)
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
                        <h2>@lang('admin_general.details_title') </h2>

                    </header>

                    <div role="content" >
                        <div class="widget-body smart-form ">

                            <section>
                                <label class="label">Title</label>
                                <label class="input">
                                    <input type="text" name="title" placeholder="Title" class="form-control input-sm" value="{{$main_object->title}}">
                                </label>
                            </section>

                            <section>
                                    <label class="label">Description</label>
                                    <label class="textarea textarea-resizable">
                                        <textarea rows="3" type="text" name="description" placeholder="Description" class="custom-scroll" >{{$main_object->description}}</textarea>
                                    </label>
                            </section>

                            <section>
                                <label class="label">Course order weight <span class="req">*</span></label>
                                <label class="input">
                                    <input type="text" name="order_weight" placeholder="Order weight" class="form-control input-sm" value="{{$main_object->order_weight}}">
                                </label>
                            </section>

                            <section>
                                <label class="label">Category<span class="req">*</span></label>
                                <label class="input">
                                    <input type="text" name="order_weight" placeholder="Order weight" class="form-control input-sm" value="{{$main_object->order_weight}}">
                                </label>
                            </section>

                            <section>
                                <label class="label toggle-inline">Is public <span class="req">*</span></label>
                                <label class="toggle" >
                                    <input type="checkbox" name="is_public" @if($main_object->is_public) checked="checked" @endif>
                                    <i data-swchon-text="YES" data-swchoff-text="NO"></i>
                                </label>
                            </section>

                            <section>
                                <label class="label">Slug <span class="req">*</span></label>
                                <label class="input">
                                    <input type="text" name="slug" placeholder="slug" class="form-control input-sm" value="{{$main_object->slug}}">
                                </label>
                            </section>

                        </div>
                    </div>

                </div>

            </div>
        </div>


        <div class="row">
            <div class="col-sm-12">

                <div class="jarviswidget" data-widget-editbutton="false" data-widget-custombutton="false" data-widget-deletebutton="false">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                        <h2>@lang('admin_lessons.content') </h2>

                    </header>

                    <div role="content" >
                        <div class="widget-body smart-form ">

                            <section>
                                <label class="textarea textarea-resizable">
                                    <textarea rows="3" type="text" name="description" placeholder="Description" class="custom-scroll" >{{$main_object->content}}</textarea>
                                </label>
                            </section>

                        </div>
                    </div>

                </div>

            </div>
        </div>

    </section>
</form>
@stop