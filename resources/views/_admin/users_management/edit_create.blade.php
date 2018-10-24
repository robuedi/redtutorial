@extends('_admin.master')

@section('title') @lang('admin_users_management.users_management') @parent @stop


@section('breadcrumbs')
    <li><a href="{{URL::to('/'.config('app.admin_route'))}}">@lang('admin_general.home')</a></li>
    <li><a href="{{URL::to('/'.config('app.admin_route').'/users-management/'.$user->role)}}">@lang('admin_users_management.users_management') - @lang('admin_users_management.'.$user->role)</a></li>
    <li>@if($user->id) @lang('admin_general.edit') @else @lang('admin_general.create') @endif</li>
@stop
@section('scripts')
    <script src="/assets/_admin/js/general.js"></script>
@stop

@section('stylesheets')
@stop

@section('content')

    <form action="{{url(config('app.admin_route').'/users-management/'.$user->id)}}" enctype="application/x-www-form-urlencoded" method="post" class="form-horizontal form-edit  " autocomplete="off" >
        <div class="row">
            <div class="col-xs-12 col-sm-7 col-md-7 col-lg-6">
                <h1 class="page-title txt-color-blueDark">
                    <i class="fa fa-fw fa-pencil-square-o"></i>
                    @lang('admin_users_management.users_management') - @lang('admin_users_management.'.$user->role) <span>&gt; @if($user->id) @lang('admin_general.edit') @else @lang('admin_general.create') @endif </span>
                </h1>
            </div>

            <div class="col-xs-12 col-sm-5 col-lg-6 text-right">
                <div class="btn-group">
                    <button name="save" class="btn btn-lg bg-color-blueDark txt-color-white" value="da">@lang('admin_general.save')</button>
                    <button class="btn btn-lg bg-color-blueDark txt-color-white dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                    </button>
                    @if(!$user->id)
                        <ul class="dropdown-menu">
                            <li>
                                <a href="javascript:void(0);" id="save-and-add">@lang('admin_general.save_and_add_new')</a>
                                <input type="hidden" autocomplete="off" id="save-and-add-input" name="save_and_add_new" value="" />
                            </li>
                        </ul>

                    @else
                        <ul class="dropdown-menu danger">
                            <li>
                                <a href="javascript:deleteRouteObject('{{url(config('app.admin_route').'/users-management/'.$user->id)}}')" class="btn btn-md  btn-delete apply-tooltip" data-method="DELETE" title="Delete" data-warning="Are you sure you want to delete the user?">Delete <i class="glyphicon glyphicon-trash"></i></a>
                            </li>
                        </ul>
                    @endif
                </div>
                <button type="submit" name="save_and_continue" value="1" class=" btn btn-lg btn-primary">@lang('admin_general.save_and_continue')</button>
                @if($user->id)
                    <input name="_method" type="hidden" value="PUT" >
                @endif

                <input type="hidden" name="role" value="{{$user->role}}">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
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
                                    <label class="label">First name <span class="req">*</span></label>
                                    <label class="input">
                                        <input type="text" name="first_name" placeholder="First name" class="form-control input-sm" value="{{old('first_name', $user->first_name)}}">
                                    </label>
                                </section>

                                <section>
                                    <label class="label">Last name <span class="req">*</span></label>
                                    <label class="input">
                                        <input type="text" name="last_name" placeholder="Last name" class="form-control input-sm" value="{{old('last_name', $user->last_name)}}">
                                    </label>
                                </section>

                                <section>
                                    <label class="label">Email <span class="req">*</span></label>
                                    <label class="input">
                                        <input @if($user->id&&$user->role==='admin') disabled @endif type="text" name="email" placeholder="Email" class="form-control input-sm" value="{{old('email', $user->email)}}">
                                    </label>
                                </section>

                                <section>
                                    <label class="label">Second email </label>
                                    <label class="input">
                                        <input @if($user->id&&$user->role==='admin') disabled @endif type="text" name="second_email" placeholder="Second email" class="form-control input-sm" value="{{old('second_email', $user->second_email)}}">
                                    </label>
                                </section>

                                <section>
                                    <label class="label">Phone </label>
                                    <label class="input">
                                        <input @if($user->id&&$user->role==='admin') disabled @endif type="text" name="phone" placeholder="Phone" class="form-control input-sm phone-number-mask" value="{{old('phone', $user->phone)}}">
                                    </label>
                                </section>

                                @if(!($user->id&&$user->role==='admin'))
                                <section>
                                    <label class="label">Password @if(!$user->id) <span class="req">*</span> @endif</label>
                                    <label class="input">
                                        <input type="password" name="password" placeholder="Password" class="form-control input-sm" >
                                    </label>
                                </section>

                                <section>
                                    <label class="label">Confirm password @if(!$user->id) <span class="req">*</span> @endif</label>
                                    <label class="input">
                                        <input type="password" name="password_confirmation" placeholder="Confirm password" class="form-control input-sm" >
                                    </label>
                                </section>
                                @endif

                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </section>
    </form>
@stop