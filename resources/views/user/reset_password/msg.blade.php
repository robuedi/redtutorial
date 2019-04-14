@extends('_partials.master')

@section('meta')
    <meta name="description" content="Reset password">
@stop

@section('title') Reset Password @parent @stop

@section('stylesheets')
@stop

@section('scripts')
@stop

@section('content')

    <main class="sign-in-page"  >
        <div class="top-section" style='background-image: url("/images/assets/img/contact_us.jpg?w=1200&fit=contain")'>
            <h1>Reset Password</h1>
        </div>
        <div class="content">

           <p class="info-paragraph txt-lg">
               We just sent an email to your account, if we found it.
               <br>
               Please take notice that in special situations it may take couple of minutes for the email to arrive.
           </p>

        </div>
    </main>

@stop