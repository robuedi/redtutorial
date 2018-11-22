@extends('_admin.master')

@section('title') @lang('admin_lessons.lesson_section') @parent @stop


@section('breadcrumbs')
    <li><a href="{{URL::to('/'.config('app.admin_route'))}}">@lang('admin_general.home')</a></li>
    <li><a href="{{URL::to('/'.config('app.admin_route').'/lessons')}}">@lang('admin_lessons.lessons')</a></li>
    <li><a href="{{URL::to('/'.config('app.admin_route').'/lessons/'.$lesson_section->lesson_id.'/edit')}}">@lang('admin_lessons.parent_lesson')</a></li>
    <li>@lang('admin_general.edit')</li>
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
                    height: '200px',
                    extraPlugins:'tab,codesnippet,imagebrowser',
                    codeSnippet_theme: 'monokai_sublime',
                    imageBrowser_listUrl: '/admin/media-library/ckeditor',

                });

            //show/hide options for quiz
            function showHideOptions(typeSelect){
                if($(typeSelect).val() == 'quiz')
                {
                    $('[data-quiz-options]').removeClass('hidden');
                }
                else
                {
                    $('[data-quiz-options]').addClass('hidden');
                }
            }

            var typeSelect = $('[name="type"]');

            //on startup
            showHideOptions(typeSelect);
            //on change
            typeSelect.on('change', function () {
                showHideOptions(this);
            });

            //add new option
            $('[data-add-new-option]').on('click', function () {

                var newOption = $('[data-template-option]').clone();
                $(newOption).removeAttr('data-template-option');
                $(newOption).find('input').removeAttr('disabled');
                $(newOption).find('select').removeAttr('disabled');
                $('[data-options-container]').append(newOption);
                newOption.find('select').select2();
            })

            //delete options
            $(document).on('click', '[data-delete-option]', function () {
               $(this).closest('tr').remove();
            });

            //make the options sortable
            $('.table-sortable tbody').sortable({
                axis: 'y',
                handle: '.sortable-handler'
            });

        });
    </script>
@stop

@section('stylesheets')
    <link rel="stylesheet" type="text/css" href="/assets/js/libs/prism/prism.css">
    <style>
        .sortable-handler {
            position: relative;
            cursor: pointer;
        }
        .sortable-handler i {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
        .switch-style-2 {
            padding: 0;
        }
        .switch-style-2 i {
            right: auto;
            left: 50%;
            transform: translateX(-50%);
        }
        [data-template-option] {
            display: none;
        }
    </style>
@stop

@section('content')

    <form action="{{url(config('app.admin_route').'/lesson-section/'.$lesson_section->id)}}" enctype="application/x-www-form-urlencoded" method="post" class="form-horizontal form-edit  " autocomplete="off" >
        <div class="row">
            <div class="col-xs-12 col-sm-7 col-md-7 col-lg-6">
                <h1 class="page-title txt-color-blueDark">
                    <i class="fa fa-fw fa-pencil-square-o"></i>
                    @lang('admin_lessons.lesson_section') <span>&gt; @lang('admin_general.edit') </span>
                </h1>
            </div>

            <div class="col-xs-12 col-sm-5 col-lg-6 text-right">
                <div class="btn-group">
                    <button name="save" class="btn btn-lg bg-color-blueDark txt-color-white" value="da">@lang('admin_general.save')</button>
                    <button class="btn btn-lg bg-color-blueDark txt-color-white dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu danger">
                        <li>
                            <a href="javascript:deleteRouteObject('{{url(config('app.admin_route').'/lesson-section/'.$lesson_section->id)}}')" class="btn btn-md  btn-delete apply-tooltip" data-method="DELETE" title="Delete" data-warning="Are you sure you want to delete this lesson section?">Delete <i class="glyphicon glyphicon-trash"></i></a>
                        </li>
                    </ul>
                </div>
                <button type="submit" name="save_and_continue" value="1" class=" btn btn-lg btn-primary">@lang('admin_general.save_and_continue')</button>
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <input type="hidden" name="_method" value="PUT">
            </div>
        </div>

        {!! \App\Libraries\UIMessage::get() !!}

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
                                    <label class="label">Name</label>
                                    <label class="input">
                                        <input type="text" name="name" placeholder="Name" class="form-control input-sm" value="{{old('name', $lesson_section->name)}}">
                                    </label>
                                </section>

                            </div>
                        </div>

                    </div>


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
                                        <textarea id="text_content" rows="3" type="text" name="content" placeholder="Content" class="custom-scroll" >{{old('content', $lesson_section->content)}}</textarea>
                                    </div>

                                    {{--Preview--}}
                                    <div class="tab-pane fade " id="preview">
                                        <div class="text-content-preview">
                                            {!! old('content',  $lesson_section->content) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="jarviswidget hidden" data-quiz-options data-widget-editbutton="false" data-widget-custombutton="false" data-widget-deletebutton="false">
                        <header>
                            <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                            <h2>@lang('admin_lessons.options') </h2>
                            <div class="widget-toolbar" role="menu">
                                <div class="btn-group">
                                    <button type="button" data-add-new-option class="btn btn-xs btn-success">
                                        Add new
                                    </button>
                                </div>
                            </div>
                        </header>

                        <div role="content" >
                            <div class="widget-body no-padding smart-form">
                                <div class="table-responsive ">
                                    <table class="table table-bordered table-striped table-sortable">
                                        <thead>
                                            <tr>
                                                <th style="width: 50px" >Sort</th>
                                                <th>Label</th>
                                                <th>Value</th>
                                                <th style="width: 70px" >Is valid</th>
                                                <th style="width: 70px" >Is public</th>
                                                <th style="width: 70px" >Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody data-options-container>
                                            <tr data-template-option >
                                                <td class="sortable-handler">
                                                    <i class="glyphicon glyphicon-resize-vertical"></i>
                                                </td>
                                                <td>
                                                    <label class="input">
                                                        <input type="text" disabled name="option_data[label][]" placeholder="Label" class="form-control input-sm" >
                                                    </label>
                                                </td>
                                                <td>
                                                    <label class="input">
                                                        <input type="text" disabled name="option_data[value][]" placeholder="Value" class="form-control input-sm" >
                                                    </label>
                                                </td>
                                                <td >
                                                    <label class="input">
                                                        <select disabled name="option_data[is_valid][]" style="width: 100%">
                                                            <option value="0"  >No</option>
                                                            <option value="1" >Yes</option>
                                                        </select>
                                                    </label>
                                                </td>
                                                <td>
                                                    <label class="input">
                                                        <select disabled name="option_data[is_public][]" style="width: 100%">
                                                            <option value="0"  >No</option>
                                                            <option value="1" >Yes</option>
                                                        </select>
                                                    </label>
                                                </td>
                                                <td class="text-center">
                                                    <button data-delete-option type="button" class="btn btn-sm btn-danger btn-delete apply-tooltip" title="Delete" ><i class="glyphicon glyphicon-trash"></i></button>
                                                </td>
                                            </tr>
                                            @if(isset($options))
                                                @foreach(old('option_data.label', $options) as $key => $option)
                                                    <tr >
                                                        <td class="sortable-handler">
                                                            <i class="glyphicon glyphicon-resize-vertical"></i>
                                                        </td>
                                                        <td>
                                                            <label class="input">
                                                                <input type="text" value="{{old('option_data.label.'.$key, isset($option['label']) ? $option['label'] : '')}}" name="option_data[label][]" placeholder="Label" class="form-control input-sm" >
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <label class="input">
                                                                <input type="text" value="{{old('option_data.value.'.$key, isset($option['value']) ? $option['value'] : '')}}" name="option_data[value][]" placeholder="Value" class="form-control input-sm" >
                                                            </label>
                                                        </td>
                                                        <td >
                                                            <label class="input">
                                                                <select class="select2" name="option_data[is_valid][]" style="width: 100%">
                                                                    <option value="0" @if(old('option_data.is_valid.'.$key, isset($option['is_valid']) ? $option['is_valid'] : '') == 0) selected @endif >No</option>
                                                                    <option value="1" @if(old('option_data.is_valid.'.$key, isset($option['is_valid']) ? $option['is_valid'] : '') == 1) selected @endif >Yes</option>
                                                                </select>
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <label class="input">
                                                                <select class="select2" name="option_data[is_public][]" style="width: 100%">
                                                                    <option value="0"  @if(old('option_data.is_public.'.$key, isset($option['is_public']) ? $option['is_public'] : '') == 0) selected @endif >No</option>
                                                                    <option value="1" @if(old('option_data.is_public.'.$key, isset($option['is_public']) ? $option['is_public'] : '' ) == 1) selected @endif >Yes</option>
                                                                </select>
                                                            </label>
                                                        </td>
                                                        <td class="text-center">
                                                            <button data-delete-option type="button" class="btn btn-sm btn-danger btn-delete apply-tooltip" title="Delete" ><i class="glyphicon glyphicon-trash"></i></button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                                @if((!isset($options))||!count($options))
                                    <div class="alert alert-info">
                                        No options found
                                    </div>
                                @endif

                                <footer class="text-right">
                                    <div class="btn-group">
                                        <label class="label toggle-inline">
                                            Options type <span class="req">*</span>
                                        </label>
                                        <label  class="text-left" style="width: 200px;">
                                            <select name="options_type" class="select2" >
                                                <option value="checkbox" @if(old('options_type', $lesson_section->options_type) === 'checkbox') selected @endif >Checkbox</option>
                                                <option value="radio" @if(old('options_type', $lesson_section->options_type) === 'radio') selected @endif >Radio</option>
                                            </select>
                                        </label>
                                    </div>
                                </footer>
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
                            <div class="widget-body  ">

                                <section class="smart-form">

                                    <section>
                                        <label class="label toggle-inline">Type <span class="req">*</span></label>
                                        <label class="input" >
                                            <select name="type" class="select2" style="width: 100%">
                                                <option value=""></option>
                                                <option value="text" @if(old('type', $lesson_section->type) == "text") selected @endif>Text</option>
                                                <option value="quiz" @if(old('type', $lesson_section->type) == "quiz") selected @endif>Quiz</option>
                                            </select>
                                        </label>
                                    </section>

                                    <section>
                                        <label class="label toggle-inline">Is public <span class="req">*</span></label>
                                        <label class="toggle" >
                                            <input type="checkbox" name="is_public" @if(old('is_public', $lesson_section->is_public)) checked="checked" @endif>
                                            <i data-swchon-text="YES" data-swchoff-text="NO"></i>
                                        </label>
                                    </section>

                                    <section>
                                        <label class="label toggle-inline">Is draft <span class="req">*</span></label>
                                        <label class="toggle" >
                                            <input type="checkbox" name="is_draft" @if(old('is_draft', $lesson_section->is_draft)) checked="checked" @endif>
                                            <i data-swchon-text="YES" data-swchoff-text="NO"></i>
                                        </label>
                                    </section>

                                    <section>
                                        <label class="label">Order weight <span class="req">*</span></label>
                                        <label class="input">
                                            <input type="text" name="order_weight" placeholder="Order weight" class="form-control input-sm" value="{{old('order_weight', $lesson_section->order_weight)}}">
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