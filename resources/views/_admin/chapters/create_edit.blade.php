@extends('_admin.master')

@section('title') @lang('admin_chapters_courses.chapters') - @parent @stop


@section('breadcrumbs')
    <li><a href="{{URL::to('/')}}">Home</a></li>
    <li><a href="{{URL::to('/admin/chapters')}}">@lang('admin_chapters_courses.chapters')</a>
    <li>@if(!isset($create_action)) Edit @else Create @endif</li>
@stop

@section('scripts')
    <script>
        var data = [
            {id: "2", name: "2 - Gastos", children: [
                    {id: "2.1", name: "2.1 - DESPESA OPERACIONAL FIXA", children: [
                            {id: "2.1.1", name: "2.1.1 - PESSOAL", children: [
                                    {id: "2.1.0", name: "2.1.1 - PESSOAL"},
                                    {id: "2.1.1.1", name: "2.1.1.1 - GERENCIA/ADMINSTRATIVO", children: [
                                            {id: "2.1.1.1.1", name: "2.1.1.1.1 - SALÁRIOS"},
                                            {id: "2.1.1.1.2", name: "2.1.1.1.2 - DIVIDENDOS / COMISSÕES /BONUS"},
                                            {id: "2.1.1.1.3", name: "2.1.1.1.3 - INSS"},
                                            {id: "2.1.1.1.4", name: "2.1.1.1.4 - FGTS"}
                                        ]}
                                ]}
                        ]}
                ]}
        ];
        $('#txtConta').select2({
            allowClear: true,
            width: 'resolve',
            dropdownAutoWidth: true,
            width: '400px',
            data: {results: data, text: "name"},
            formatSelection: function(item) {
                return item.name
            },
            formatResult: function(item) {
                return item.name
            }
        });
        // $("#txtConta").select2('val','2.1.0');

    </script>
@stop

@section('stylesheets')
@stop

@section('content')

<form action="{{url('admin/chapters/'.$section_obj->id)}}" enctype="application/x-www-form-urlencoded" method="post" class="form-horizontal form-edit  " autocomplete="off" >
    <div class="row">
        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-6">
            <h1 class="page-title txt-color-blueDark">
                <i class="fa fa-fw fa-pencil-square-o"></i>
                @lang('admin_chapters_courses.chapters') <span>&gt; @if(!isset($create_action)) Edit @else Create @endif </span>
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
            @if(!isset($create_action))
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

                            <input name="txtConta" id="txtConta" data-placeholder="Selecione a conta" />


                            <section>
                                <label class="label">Title</label>
                                <label class="input">
                                    <input type="text" name="title" placeholder="Title" class="form-control input-sm" value="{{$section_obj->title}}">
                                </label>
                            </section>

                            <section>
                                    <label class="label">Description</label>
                                    <label class="textarea textarea-resizable">
                                        <textarea rows="3" type="text" name="description" placeholder="Description" class="custom-scroll" >{{$section_obj->description}}</textarea>
                                    </label>
                            </section>

                            <section>
                                <label class="label toggle-inline">Is public <span class="req">*</span></label>
                                <label class="toggle" >
                                    <input type="checkbox" name="is_public" @if($section_obj->is_public) checked="checked" @endif>
                                    <i data-swchon-text="YES" data-swchoff-text="NO"></i>
                                </label>
                            </section>

                            <section>
                                <label class="label">Order weight <span class="req">*</span></label>
                                <label class="input">
                                    <input type="text" name="order_weight" placeholder="Order weight" class="form-control input-sm" value="{{$section_obj->order_weight}}">
                                </label>
                            </section>

                            <section>
                                <label class="label">Slug <span class="req">*</span></label>
                                <label class="input">
                                    <input type="text" name="slug" placeholder="Slug" class="form-control input-sm" value="{{$section_obj->title}}">
                                </label>
                            </section>

                            <section>
                                <label class="label">Course <span class="req">*</span></label>
                                <label class="input">
                                    <select name="course" class="select2">
                                        @foreach($courses as $course)
                                            <option value="{{$course->id}}" >{{$course->title}}</option>
                                        @endforeach
                                    </select >
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