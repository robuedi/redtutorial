@extends('_admin.master')

@section('title') @lang('admin_chapters_courses.chapters') - @parent @stop


@section('breadcrumbs')
    <li><a href="{{URL::to('/')}}">Home</a></li>
    <li><a href="{{URL::to('/admin/chapters')}}">@lang('admin_chapters_courses.chapters')</a>
    <li>@if($chapter->id) Edit @else Create @endif</li>
@stop

@section('scripts')
    <script>


        $(function () {

            $('.curses-hierarchy').select2({
                searchInputPlaceholder: 'Please select',
                allowClear: true,
                width: 'resolve',
                dropdownAutoWidth: true,
                // width: '400px',
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

        })
        $(document).ready(function() {

            var curses_hierarchy = JSON.parse($('[data-curses-hierarchy]').attr('data-curses-hierarchy'));

            var html = {content: ''};

            for(var i = 0; i < curses_hierarchy.length; i++)
            {
                html.content += '<li><span><i class="fa fa-lg fa-folder-open"></i> <a href="'+curses_hierarchy[i].link+'">'+curses_hierarchy[i].clear_name+'</a>' +
                    ' </span> <i class=" text-success hidden-'+curses_hierarchy[i].is_public+'" >public</i> <i  class=" text-info hidden-'+curses_hierarchy[i].is_draft+'" >draft</i>';

                if(curses_hierarchy[i].children.length > 0)
                {
                    getChildren(html, curses_hierarchy[i].children);
                }

                html.content += '</li>';
            }

            if(html.content.length > 0)
            {

                html.content = $('<div class="tree "><ul>'+html.content+'</ul></div>');
            }

            $('.curses-chapters-tree').append(html.content);

            function getChildren(html, children) {
                html.content += '<ul>';
                for(var j = 0; j < children.length; j++)
                {
                    var children_ = false;
                    var icon = '';
                    if(children[j].children.length > 0)
                    {
                        children_ = true;
                        icon = 'fa-minus-circle';
                    }

                    html.content += '<li><span><i class="fa fa-lg '+icon+'"></i> <a href="'+children[j].link+'">'+children[j].clear_name+'</a>' +
                        ' </span> <i class=" text-success hidden-'+children[j].is_public+'" >public</i> <i class=" text-info hidden-'+children[j].is_draft+'" >draft</i>';

                    if(children_)
                    {
                        getChildren(html, children[j].children);
                    }

                    html.content += '</li>';
                }
                html.content += '</ul>';
            }

            $('.tree > ul').attr('role', 'tree').find('ul').attr('role', 'group');
            $('.tree').find('li:has(ul)').addClass('parent_li').attr('role', 'treeitem').find(' > span > i:first-child').attr('title', 'Collapse this branch').on('click', function(e) {
                var children = $(this).closest('li.parent_li').find(' > ul > li');
                console.log(children);
                if (children.is(':visible')) {
                    children.hide('fast');
                    $(this).attr('title', 'Expand this branch').removeClass().addClass('fa fa-lg fa-plus-circle');
                } else {
                    children.show('fast');
                    $(this).attr('title', 'Collapse this branch').removeClass().addClass('fa fa-lg fa-minus-circle');
                }
                e.stopPropagation();
            });

        })
    </script>
@stop

@section('stylesheets')
    <style>
        .hidden-0{
            display: none !important;
        }
    </style>
@stop

@section('content')

<form action="{{url('admin/chapters/'.$chapter->id)}}" enctype="application/x-www-form-urlencoded" method="post" class="form-horizontal form-edit  " autocomplete="off" >
    <div class="row">
        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-6">
            <h1 class="page-title txt-color-blueDark">
                <i class="fa fa-fw fa-pencil-square-o"></i>
                @lang('admin_chapters_courses.chapters') <span>&gt; @if($chapter->id) Edit @else Create @endif </span>
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
            @if($chapter->id)
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
                                <label class="label">Name</label>
                                <label class="input">
                                    <input type="text" name="name" placeholder="Name" class="form-control input-sm" value="{{old('name', $chapter->name)}}">
                                </label>
                            </section>

                            <section>
                                    <label class="label">Description</label>
                                    <label class="textarea textarea-resizable">
                                        <textarea rows="3" type="text" name="description" placeholder="Description" class="custom-scroll" >{{old('description', $chapter->description)}}</textarea>
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
                                <h2> @lang('admin_general.configure') </h2>

                            </header>

                            <div role="content" >
                                <div class="widget-body smart-form ">

                                    <section>
                                        <label class="label toggle-inline">Is public <span class="req">*</span></label>
                                        <label class="toggle" >
                                            <input type="checkbox" name="is_public" @if(old('is_public', $chapter->is_public)) checked="checked" @endif>
                                            <i data-swchon-text="YES" data-swchoff-text="NO"></i>
                                        </label>
                                    </section>

                                    <section>
                                        <label class="label toggle-inline">Is draft <span class="req">*</span></label>
                                        <label class="toggle" >
                                            <input type="checkbox" name="is_draft" @if(old('is_draft', $chapter->is_draft)) checked="checked" @endif>
                                            <i data-swchon-text="YES" data-swchoff-text="NO"></i>
                                        </label>
                                    </section>

                                    <section>
                                        <label class="label">Order weight <span class="req">*</span></label>
                                        <label class="input">
                                            <input type="text" name="order_weight" placeholder="Order weight" class="form-control input-sm" value="{{old('order_weight', $chapter->order_weight)}}">
                                        </label>
                                    </section>

                                    <section>
                                        <label class="label">Slug <span class="req">*</span></label>
                                        <label class="input">
                                            <input type="text" name="slug" placeholder="Slug" class="form-control input-sm" value="{{old('slug',$chapter->slug)}}">
                                        </label>
                                    </section>

                                    <section>
                                        <label class="label">Course/Chapter <span class="req">*</span></label>
                                        <label class="input">
                                            <input name="parent_id" type="hidden" class="curses-hierarchy" data-placeholder="@lang('admin_general.select_placeholder')" value="{{old('parent_id', $chapter->parent_id)}}">
                                            <span class="hidden" data-curses-hierarchy='{!! $curses_hierarchy !!}' ></span>
                                        </label>
                                    </section>

                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="col-sm-12">

                        <div class="jarviswidget" data-widget-editbutton="false" data-widget-custombutton="false" data-widget-deletebutton="false">
                            <header>
                                <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                                <h2> @lang('admin_general.map') </h2>

                            </header>

                            <div role="content" >
                                <div class="widget-body curses-chapters-tree">



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