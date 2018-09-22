@extends('_admin.master')

@section('title') @lang('admin_media_library.media_library') - @parent @stop


@section('breadcrumbs')
    <li><a href="{{URL::to('/')}}">@lang('admin_general.home')</a></li>
    <li>@lang('admin_media_library.media_library')</li>
@stop

@section('scripts')
@stop

@section('stylesheets')
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
            <h1 class="page-title txt-color-blueDark">
                <i class="fa fa-table fa-fw "></i>
                @lang('admin_media_library.media_library') <span>&gt; @lang('admin_media_library.all_files')</span>
            </h1>
        </div>
        <div class="col-xs-12 col-sm-5 col-md-5 col-lg-8 text-right">
            <a href="{{url('admin/media-library/add')}}" class="btn btn-lg btn-primary"><i class="glyphicon glyphicon-plus-sign"></i> @lang('admin_media_library.upload_new')</a>
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
                            <h2>@lang('admin_lessons.lessons')</h2>
                        </header>

                        <!-- widget div-->
                        <div>
                            <!-- widget content -->
                            <div class="widget-body widget-listing no-padding alert-margin">

                                @if(count($results))
                                    <table class="table table-striped table-bordered table-listing table-hover smart-form ">
                                        <thead>
                                        <tr>
                                            <th style="width:80px">@lang('admin_general.listing_thumbnail')</th>
                                            <th><a class="{{ $listing->sortDir("name") }}" href="{{ $listing->sortLink("name") }}"><span>@lang('admin_general.listing_name')</span></a></th>
                                            <th style="width:200px"><a class="{{ $listing->sortDir("created_at") }}" href="{{ $listing->sortLink("created_at") }}"><span>@lang('admin_general.listing_date_created')</span></a></th>
                                            <th style="width:120px; text-align:center"><span>@lang('admin_general.listing_actions')</span></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $results_arr = $results->items() ?>
                                        @foreach($results_arr as $r)
                                            <tr>
                                                <td>
                                                    @if (in_array($r->type, array('jpg','gif','png')))
                                                        @if (File::exists($r->path))
                                                            <img src="{{URL::to($r->url . '?resize=w[80]h[60]e[true]s[true]')}}" width="80" height="60" alt="{{ $r->name }}">
                                                        @else
                                                            <img src="{{URL::asset('assets/admin/img/missing-picture.png?resize=w[80]h[60]e[true]s[true]')}}" width="80" height="60" widthalt="{{ $r->name }}">
                                                        @endif
                                                    @else
                                                        <div class="file-thumbnail">
                                                            <i class="fa fa-3x {{ MediaFile::getFileIcon($r->type) }}"></i>
                                                        </div>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div>{{ $r->name }}</div>
                                                    <div class="text-muted"><a target="_blank" href="{{URL::to($r->url)}}" title="View file"><small>{{URL::to($r->url)}}</small></a></div>
                                                </td>
                                                <td class="format-momentjs">{{ $r->created_at }}</td>
                                                <td style="text-align:center;">
                                                    <a href="{{URL::to('admin/media-library/download/'.$r->id)}}" class="btn btn-sm btn-primary apply-tooltip" title="Download file"><i class="fa fa-download"></i></a>
                                                    <a href="{{URL::to('admin/media-library/delete/'.$r->id)}}" class="btn btn-sm btn-danger btn-delete apply-tooltip" title="Delete" data-warning="Are you sure?"><i class="fa fa-trash-o"></i></a>
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