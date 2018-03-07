@extends('_master')

@section('title') Learn HTML @parent @stop

@section('stylesheets')
    <link rel="stylesheet" type="text/css" href="/assets/css/home.css">
@stop

@section('scripts')
@stop

@section('content')
<main>
   <div class="container-fluid main-content">
       <div class="row">
            <div class="col text-center">

                <h1 class="tutorial-main-title">HTML Tutorial</h1>
                <div class="big-rounded-btn">
                    <div class="inner-shadow1"></div>
                    <div class="inner-shadow">
                        <a href="#">HTML</a>
                    </div>
                </div>
            </div>
       </div>
       <div class="row skill-lv-lbl">
           <div class="col-1"></div>
           <div class="col">
               Skill level
           </div>
           <div class="col-1"></div>
       </div>
       <div class="row ">
           <div class="col-1"></div>
           <div class="col skill-level-container">
               <h3 class="title">Beginner</h3>
               <p class="description">
                   Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer ut sapien eros. Nam pretium, orci commodo consequat dictum, dui purus convallis magna, non aliquam est lectus sed enim.
                   Praesent at lacus semper, tincidunt urna facilisis, pulvinar magna. Phasellus nisi dolor, sollicitudin at eros id, sollicitudin efficitur lorem.
               </p>
           </div>
           <div class="col skill-level-container">
               <h3 class="title">Intermediary</h3>
               <p class="description">
                   Nam pretium, orci commodo consequat dictum, dui purus convallis magna, non aliquam est lectus sed enim. Praesent at lacus semper, tincidunt urna facilisis, pulvinar magna. Phasellus nisi dolor, sollicitudin at eros id, sollicitudin efficitur lorem. Aenean euismod, mi eu dapibus dignissim, erat tellus cursus nisl, vel fermentum nunc nulla vel tortor.
               </p>
           </div>
           <div class="col skill-level-container">
               <h3 class="title">Advanced</h3>
               <p class="description">
                   Praesent at lacus semper, tincidunt urna facilisis, pulvinar magna. Phasellus nisi dolor, sollicitudin at eros id, sollicitudin efficitur lorem. Aenean euismod, mi eu dapibus dignissim, erat tellus cursus nisl, vel fermentum nunc nulla vel tortor. Ut tincidunt placerat ante, vel lacinia neque imperdiet eu. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nulla elementum congue erat in cursus.
               </p>
           </div>
           <div class="col-1"></div>
       </div>
   </div>
    <div class="container search-section">
        <div class="row">
            <div class="col-md-6">
                <h2 class="main-title" >Search</h2>
                <p>
                    Praesent at lacus semper, tincidunt urna facilisis, pulvinar magna. Phasellus nisi dolor, sollicitudin at eros id, sollicitudin efficitur lorem.
                </p>
            </div>
            <div class="col-md-6">
                <input type="text">
            </div>
        </div>
    </div>
</main>
@stop