@extends('_admin.master')

@section('title') Blog articles @parent @stop


@section('breadcrumbs')
    <li><a href="{{URL::to('/'.config('app.admin_route'))}}">Home</a></li>
    <li>Blog articles</li>
@stop

@section('scripts')
@stop

@section('stylesheets')
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
            <h1 class="page-title txt-color-blueDark"><i class="fa fa-calendar fa-fw "></i>
                Blog articles
            </h1>
        </div>
        <div class="col-xs-12 col-sm-5 col-md-5 col-lg-8 text-right pull-right">
            <a href="{{url(config('app.admin_route').'/blog/create')}}" class="btn btn-lg btn-primary"><i class="glyphicon glyphicon-plus-sign"></i> @lang('admin_general.add_new')</a>
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
                                                    <label>Title</label>
                                                    <input class="form-control" type="text" name="title" placeholder="Title" value="{{ Illuminate\Support\Facades\Input::get('title') }}">
                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>Is Public</label>
                                                    <select name="is_public" class="select2" data-placeholder="Please select" style="width: 100%">
                                                        <option value=""></option>
                                                        <option value="1" @if(Illuminate\Support\Facades\Input::get('is_public') == "1") selected @endif>YES</option>
                                                        <option value="0" @if(Illuminate\Support\Facades\Input::get('is_public') == "0") selected @endif>NO</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>Is Draft</label>
                                                    <select name="is_draft" class="select2" data-placeholder="Please select" style="width: 100%">
                                                        <option value=""></option>
                                                        <option value="1" @if(Illuminate\Support\Facades\Input::get('is_draft') == "1") selected @endif>YES</option>
                                                        <option value="0" @if(Illuminate\Support\Facades\Input::get('is_draft') == "0") selected @endif>NO</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Slug</label>
                                                    <input class="form-control" type="text" name="slug" placeholder="Slug" value="{{ Illuminate\Support\Facades\Input::get('slug') }}">
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
                            <h2>Blog articles</h2>
                        </header>

                        <!-- widget div-->
                        <div>
                            <!-- widget content -->
                            <div class="widget-body widget-listing no-padding alert-margin">

                                @if(count($results))
                                    <table class="table table-striped table-bordered table-listing table-hover smart-form ">
                                        <thead>
                                        <tr>
                                            <th><a class="{{ $listing->sortDir("ba.name") }}" href="{{ $listing->sortLink("ba.name") }}"><span>Name</span></a></th>
                                            <th style="width: 100px"><a class="{{ $listing->sortDir("ba.is_public") }}" href="{{ $listing->sortLink("ba.is_public") }}"><span>Is Active</span></a></th>
                                            <th style="width: 100px"><a class="{{ $listing->sortDir("ba.is_draft") }}" href="{{ $listing->sortLink("ba.is_draft") }}"><span>Is Draft</span></a></th>
                                            <th style="width:200px"><a class="{{ $listing->sortDir("ba.created_at") }}" href="{{ $listing->sortLink("ba.created_at") }}"><span>Date Created</span></a></th>
                                            <th style="width:200px"><a class="{{ $listing->sortDir("ba.updated_at") }}" href="{{ $listing->sortLink("ba.updated_at") }}"><span>Date Updated</span></a></th>
                                            <th style="width:120px; text-align:center"><span>Actions</span></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $results_arr = $results->items() ?>
                                        @foreach($results_arr as $r)
                                            <tr>
                                                <td>{{ $r->name }}</td>
                                                <td><span class="label {{ $r->is_public ? 'label-success': 'label-info' }}">{{ $r->is_public ? 'YES': 'NO' }}</span></td>
                                                <td><span class="label {{ $r->is_draft ? 'label-success': 'label-info' }}">{{ $r->is_draft ? 'YES': 'NO' }}</span></td>
                                                <td class="format-momentjs">{{ $r->created_at }}</td>
                                                <td class="format-momentjs">{{ $r->updated_at }}</td>
                                                <td style="text-align:center; min-width: 150px">
                                                    <a href="{{url(config('app.admin_route').'/blog/'.$r->id)}}/edit" class="btn btn-sm btn-info apply-tooltip" title="Edit"><i class="glyphicon glyphicon-pencil"></i></a>&nbsp;&nbsp;
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