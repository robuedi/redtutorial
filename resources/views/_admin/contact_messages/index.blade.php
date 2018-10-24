@extends('_admin.master')

@section('title') @lang('admin_contact_messages.contact_messages') @parent @stop


@section('breadcrumbs')
    <li><a href="{{URL::to('/'.config('app.admin_route'))}}">Home</a></li>
    <li>@lang('admin_contact_messages.contact_messages')</li>
@stop

@section('scripts')
@stop

@section('stylesheets')
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
            <h1 class="page-title txt-color-blueDark"><i class="fa fa-calendar fa-fw "></i>
                @lang('admin_contact_messages.contact_messages')
            </h1>
        </div>
    </div>

    {!! \App\Libraries\UIMessage::get() !!}

    <form action="{{ URL::current() }}" enctype="application/x-www-form-urlencoded" method="get">

        <!-- widget grid -->
        <section id="widget-grid" class="">
            <div class="row">
                <div class="col-xs-12">
                    <div data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false"  class="widget-filters jarviswidget jarviswidget-color-darken">
                        <header>
                            <span class="widget-icon"> <i class="fa fa-filter"></i> </span>
                            <h2>Filters</h2>
                        </header>

                        <!-- widget div-->
                        <div>
                            <!-- widget content -->
                            <div class="widget-body">

                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="row">

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Name</label>
                                                    <input class="form-control" type="text" name="name" placeholder="Name" value="{{ Illuminate\Support\Facades\Input::get('name') }}">
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input class="form-control" type="text" name="email" placeholder="Email" value="{{ Illuminate\Support\Facades\Input::get('email') }}">
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Subject</label>
                                                    <input class="form-control" type="text" name="subject" placeholder="Subject" value="{{ Illuminate\Support\Facades\Input::get('subject') }}">
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Content</label>
                                                    <input class="form-control" type="text" name="content" placeholder="Content" value="{{ Illuminate\Support\Facades\Input::get('content') }}">
                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>Is Read</label>
                                                    <select name="is_public" class="select2" data-placeholder="Please select" style="width: 100%">
                                                        <option value=""></option>
                                                        <option value="1" @if(Illuminate\Support\Facades\Input::get('is_read') == "1") selected @endif>YES</option>
                                                        <option value="0" @if(Illuminate\Support\Facades\Input::get('is_read') == "0") selected @endif>NO</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>Is Deleted</label>
                                                    <select name="is_deleted" class="select2" data-placeholder="Please select" style="width: 100%">
                                                        <option value=""></option>
                                                        <option value="1" @if(Illuminate\Support\Facades\Input::get('is_deleted') == "1") selected @endif>YES</option>
                                                        <option value="0" @if(Illuminate\Support\Facades\Input::get('is_deleted') == "0") selected @endif>NO</option>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-3 filter-buttons text-right">
                                        <button class="btn btn-primary" type="submit">Submit</button>
                                        <a class="btn btn-default" type="reset" href="{{ URL::current() }}">Reset</a>
                                    </div>
                                </div>

                            </div>
                            <!-- end widget content -->

                        </div>
                        <!-- end widget div -->

                    </div>
                    <!-- end filters -->

                    <div data-widget-editbutton="false" data-widget-deletebutton="false" class="jarviswidget jarviswidget-color-darken">

                        <header>
                            <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                            <h2>@lang('admin_contact_messages.contact_messages')</h2>
                        </header>

                        <!-- widget div-->
                        <div>
                            <!-- widget content -->
                            <div class="widget-body widget-listing no-padding alert-margin">

                                @if(count($results))
                                    <table class="table table-striped table-bordered table-listing table-hover smart-form table-relative-columns ">
                                        <thead>
                                        <tr>
                                            <th style="width: 200px"><a class="{{ $listing->sortDir("name") }}" href="{{ $listing->sortLink("name") }}"><span>Name</span></a></th>
                                            <th ><span>Subject/Content</span></th>
                                            <th style="width:200px"><a class="{{ $listing->sortDir("created_at") }}" href="{{ $listing->sortLink("created_at") }}"><span>Date Created</span></a></th>
                                            <th style="width:120px; text-align:center"><span>Actions</span></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $results_arr = $results->items() ?>
                                        @foreach($results_arr as $r)
                                            <tr class="@if($r->is_flagged) success @endif">
                                                <td  >
                                                    <a class="absolute-full-container" href="{{url(config('app.admin_route').'/contact-messages/'.$r->id)}}/edit"></a>
                                                    <p @if(!$r->is_read||$r->is_flagged) style="font-weight: bold" @endif >{{ $r->name }}</p>
                                                    <small class="info">{{$r->email}}</small>
                                                </td>
                                                <td @if(!$r->is_read||$r->is_flagged) style="font-weight: bold" @endif >
                                                    <a class="absolute-full-container" href="{{url(config('app.admin_route').'/contact-messages/'.$r->id)}}/edit"></a>
                                                    <p>{{ $r->subject }}</p>
                                                    <small class="info">@if(strlen($r->content) > 100){{ substr($r->content, 0, 100).'...' }}@else {{ $r->content }} @endif</small>
                                                </td>
                                                <td class="format-momentjs">{{ $r->created_at }}</td>
                                                <td style="text-align:center;">
                                                    <a href="javascript:deleteRouteObject('{{url(config('app.admin_route').'/contact-messages/'.$r->msg_user_id)}}')" class="btn btn-sm btn-danger btn-delete apply-tooltip" data-method="DELETE" title="Delete" data-warning="Are you sure?"><i class="glyphicon glyphicon-trash"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <div class="alert alert-info">
                                        This search returned no results.
                                    </div>
                            @endif

                            <!-- widget footer -->
                                <div class="widget-footer">
                                    <div class="row">
                                        <div class="col-sm-6 hidden-xs text-left">
                                            <span class="info">Per page</span>
                                            <div class="btn-group">
                                                @foreach(array(5, 10, 20, 50, 100) as $rpp)
                                                    <button class="btn btn-sm @if($rpp == $results->perPage()) btn-primary @else btn-default @endif" type="submit" name="rpp" value="{{$rpp}}">{{ $rpp }}</button>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-6">
                                    <span class="info">
                                        Showing <span class="txt-color-darken">{{ $results->firstItem() }}</span> to <span class="txt-color-darken">{{ $results->lastItem() }}</span> of <span class="text-primary">{{ $results->count() }}</span> entries
                                    </span>
                                            <div class="pull-right">
                                                {{ $results->appends(Illuminate\Support\Facades\Input::except('page'))->links() }}
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- end widget content -->

                        </div>
                        <!-- end widget div -->

                    </div>
                    <!-- end listing widget div -->

                </div>
            </div>
        </section>

    </form>

@stop