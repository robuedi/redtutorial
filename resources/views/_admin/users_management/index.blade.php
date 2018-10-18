@extends('_admin.master')

@section('title') @lang('admin_users_management.users_management') @parent @stop


@section('breadcrumbs')
    <li><a href="{{URL::to('/'.config('app.admin_route'))}}">@lang('admin_general.home')</a></li>
    <li>@lang('admin_users_management.users_management')</li>
@stop

@section('scripts')
@stop

@section('stylesheets')
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
            <h1 class="page-title txt-color-blueDark"><i class="fa fa-calendar fa-fw "></i>
                @lang('admin_users_management.users_management') - @lang('admin_users_management.'.$type)
            </h1>
        </div>
        <div class="col-xs-12 col-sm-5 col-md-5 col-lg-8 text-right pull-right">
            <a href="{{url(config('app.admin_route').'/users-management/'.$type.'/create')}}" class="btn btn-lg btn-primary"><i class="glyphicon glyphicon-plus-sign"></i> @lang('admin_general.add_new')</a>
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
                            <h2>@lang('admin_general.filters')</h2>
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
                                                    <label>@lang('admin_general.filters_name')</label>
                                                    <input class="form-control" type="text" name="name" value="{{ Illuminate\Support\Facades\Input::get('name') }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 filter-buttons text-right">
                                        <button class="btn btn-primary" type="submit">@lang('admin_general.filters_submit')</button>
                                        <a class="btn btn-default" type="reset" href="{{ URL::current() }}">@lang('admin_general.filters_reset')</a>
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
                            <h2>@lang('admin_users_management.'.$type)</h2>
                        </header>

                        <!-- widget div-->
                        <div>
                            <!-- widget content -->
                            <div class="widget-body widget-listing no-padding alert-margin">

                                @if(count($results))
                                    <table class="table table-striped table-bordered table-listing table-hover smart-form ">
                                        <thead>
                                        <tr>
                                            <th><a class="{{ $listing->sortDir("first_name") }}" href="{{ $listing->sortLink("first_name") }}"><span>@lang('admin_general.listing_name')</span></a></th>
                                            <th style="width:200px"><a class="{{ $listing->sortDir("last_login_date") }}" href="{{ $listing->sortLink("last_login_date") }}"><span>@lang('admin_general.listing_date_last_login')</span></a></th>
                                            <th style="width:200px"><a class="{{ $listing->sortDir("created_at") }}" href="{{ $listing->sortLink("created_at") }}"><span>@lang('admin_general.listing_date_created')</span></a></th>
                                            <th style="width:200px"><a class="{{ $listing->sortDir("created_at") }}" href="{{ $listing->sortLink("created_at") }}"><span>@lang('admin_general.listing_date_updated')</span></a></th>
                                            <th style="width:120px; text-align:center"><span>Actions</span></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $results_arr = $results->items() ?>
                                        @foreach($results_arr as $r)
                                            <tr>

                                                <td>
                                                    {{ $r->first_name.' '.$r->last_name }}
                                                    <br/>
                                                    <a href="mailto:{{$r->email}}"><small>{{$r->email}}</small></a>
                                                </td>
                                                @if($r->last_login_date)
                                                    <td class="format-momentjs">{{ $r->last_login_date }}</td>
                                                @else
                                                    <td >No date recorded until now</td>
                                                @endif
                                                <td class="format-momentjs">{{ $r->created_at }}</td>
                                                <td class="format-momentjs">{{ $r->updated_at }}</td>
                                                <td style="text-align:center;">
                                                    <a href="{{url(config('app.admin_route').'/users-management/'.$r->id)}}/edit" class="btn btn-sm btn-info apply-tooltip" title="Edit"><i class="glyphicon glyphicon-pencil"></i></a>&nbsp;&nbsp;
                                                    @if(empty ($r->code_page ))
                                                        <a href="javascript:deleteRouteObject('{{url(config('app.admin_route').'/users-management/'.$r->id)}}')" class="btn btn-sm btn-danger btn-delete apply-tooltip" data-method="DELETE" title="Disable" data-warning="Are you sure?"><i class="glyphicon glyphicon-ban-circle"></i></a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <div class="alert alert-info">
                                        @lang('admin_general.listing_no_results')
                                    </div>
                            @endif

                            <!-- widget footer -->
                                <div class="widget-footer">
                                    <div class="row">
                                        <div class="col-sm-6 hidden-xs text-left">
                                            <span class="info">@lang('admin_general.listing_per_page')</span>
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