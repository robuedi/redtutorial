@extends('_admin.master')

@section('title') @lang('admin_contact_messages.contact_messages') @parent @stop


@section('breadcrumbs')
    <li><a href="{{URL::to('/'.config('app.admin_route'))}}">@lang('admin_general.home')</a></li>
    <li><a href="{{URL::to('/'.config('app.admin_route').'/contact-messages')}}">@lang('admin_contact_messages.contact_messages')</a></li>
    <li> @lang('admin_general.view') </li>
@stop

@section('scripts')
@stop

@section('stylesheets')
@stop

@section('content')

    <form action="{{url(config('app.admin_route').'/contact-messages/'.$message->id)}}" enctype="application/x-www-form-urlencoded" method="post" class="form-horizontal form-edit  " autocomplete="off" >
        <div class="row">
            <div class="col-xs-12 col-sm-7 col-md-7 col-lg-6">
                <h1 class="page-title txt-color-blueDark">
                    <i class="fa fa-fw fa-pencil-square-o"></i>
                    @lang('admin_contact_messages.contact_messages') <span>&gt; @lang('admin_general.view') </span>
                </h1>
            </div>

            <div class="col-xs-12 col-sm-5 col-lg-6 text-right">
                <div class="btn-group">
                    <button name="save" class="btn btn-lg bg-color-blueDark txt-color-white" value="da">@lang('admin_general.save')</button>
                </div>
                <button type="submit" name="save_and_continue" value="1" class=" btn btn-lg btn-primary">@lang('admin_general.save_and_continue')</button>
                <input name="_method" type="hidden" value="PUT" >
                <input type="hidden" name="_token" value="{{csrf_token()}}">
            </div>
        </div>

        {!! \App\Libraries\UIMessage::get() !!}

        <section id="widget-grid" >
            <div class="row">
                <div class="col-md-8">

                    <div class="row">
                        <div class="col-xs-12">

                            <div class="well well-light">
                                @if(!empty($message->subject))
                                    <h1>{{$message->subject}}</h1>
                                    <hr class="simple"/>
                                @endif
                                <h3>{{$message->name}}</h3>
                                <a href="mailto:{{$message->email}}">{{$message->email}}</a>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12">
                            <div class="well well-light font-md">
                                {{$message->content}}
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
                                        <label class="label toggle-inline">Is read </label>
                                        <label class="toggle" >
                                            <input type="checkbox" name="is_read" @if(old('is_read', $message_to_user->is_read)) checked="checked" @endif>
                                            <i data-swchon-text="YES" data-swchoff-text="NO"></i>
                                        </label>
                                    </section>

                                    <section>
                                        <label class="label toggle-inline">Is flagged </label>
                                        <label class="toggle" >
                                            <input type="checkbox" name="is_flagged" @if(old('is_flagged', $message_to_user->is_flagged)) checked="checked" @endif>
                                            <i data-swchon-text="YES" data-swchoff-text="NO"></i>
                                        </label>
                                    </section>

                                    <section>
                                        <label class="label toggle-inline">Mark to delete </label>
                                        <label class="toggle" >
                                            <input type="checkbox" name="is_deleted" @if(old('is_deleted', $message_to_user->is_deleted)) checked="checked" @endif>
                                            <i data-swchon-text="YES" data-swchoff-text="NO"></i>
                                        </label>
                                    </section>

                                </section>

                            </div>
                        </div>

                    </div>

                </div>
            </div>

        </section>
    </form>
@stop