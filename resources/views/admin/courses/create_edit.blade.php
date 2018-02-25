@extends('admin.master')

@section('title') Dashboard - @parent @stop


@section('breadcrumbs')
    <li><a href="{{URL::to('/')}}">Home</a></li>
    <li><a href="{{URL::to('/admin/courses')}}">Courses</a></li>
    <li>Create</li>
@stop

@section('scripts')
@stop

@section('stylesheets')
@stop

@section('content')

<form action="{{url('admin/courses')}}" enctype="application/x-www-form-urlencoded" method="post" class="form-horizontal form-edit  " >
    <div class="row">
        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-6">
            <h1 class="page-title txt-color-blueDark">
                <i class="fa fa-fw fa-pencil-square-o"></i>
                Courses <span>&gt; Create </span>
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
            <input type="hidden" name="_token" value="{{csrf_token()}}">
        </div>
    </div>

    <section id="widget-grid" >
        <div class="row">
            <div class="col-md-8">

                <div class="jarviswidget" data-widget-editbutton="false" data-widget-custombutton="false" data-widget-deletebutton="false">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                        <h2>Basic Form Elements </h2>

                    </header>

                    <div role="content" >
                        <div class="widget-body smart-form ">

                            <section>
                                <label class="label">Title</label>
                                <label class="input">
                                    <input type="text" name="title" placeholder="Title" class="form-control input-sm" value="">
                                </label>
                            </section>

                            <section>
                                    <label class="label">Description</label>
                                    <label class="textarea textarea-resizable">
                                        <textarea rows="3" type="text" name="description" placeholder="Description" class="custom-scroll" ></textarea>
                                    </label>
                            </section>

                            <section>
                                <label class="label toggle-inline">Is public <span class="req">*</span></label>
                                <label class="toggle" >
                                    <input type="checkbox" name="is_public" >
                                    <i data-swchon-text="YES" data-swchoff-text="NO"></i>
                                </label>
                            </section>

                            <section>
                                <label class="label">Order weight <span class="req">*</span></label>
                                <label class="input">
                                    <input type="text" name="order_weight" placeholder="Order weight" class="form-control input-sm" value="{{$new_course->order_weight}}">
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