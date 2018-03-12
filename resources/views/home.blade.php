@extends('_master')

@section('title') Learn HTML @parent @stop

@section('stylesheets')
    <link rel="stylesheet" type="text/css" href="/assets/css/home.css">
@stop

@section('scripts')
@stop

@section('content')
<main>

   <div class="container-fluid tutorial-content">
       <div class="row tutorial-main-title">
           <div class="col">
               <h2 >HTML Tutorial</h2>
               <p>
                   Phasellus nisi dolor, sollicitudin at eros id, sollicitudin efficitur lorem.
                   Aenean euismod, mi eu dapibus dignissim, erat tellus cursus nisl, vel fermentum nunc nulla vel tortor.
               </p>
           </div>
       </div>
       <div class="row">
            <div class="col main-tutorial-btn-container ">
                <div class="big-rounded-btn html-tutorial-btn">
                    <div class="inner-shadow1"></div>
                    <div class="inner-container">
                        <a href="#">HTML</a>
                    </div>
                </div>
            </div>
       </div>
       <div class="row skills-container">
           <div class="col">
               <div class="skill-level-container">
                   <h3 class="title">Beginner</h3>
                   <p class="description">
                       Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer ut sapien eros. Nam pretium, orci commodo consequat dictum, dui purus convallis magna, non aliquam est lectus sed enim.
                       Praesent at lacus semper, tincidunt urna facilisis, pulvinar magna. Phasellus nisi dolor, sollicitudin at eros id, sollicitudin efficitur lorem.
                   </p>
               </div>
           </div>
           <div class="col">
               <div class="skill-level-container" >
                   <h3 class="title">Intermediary</h3>
                   <p class="description">
                       Nam pretium, orci commodo consequat dictum, dui purus convallis magna, non aliquam est lectus sed enim. Praesent at lacus semper, tincidunt urna facilisis, pulvinar magna. Phasellus nisi dolor, sollicitudin at eros id, sollicitudin efficitur lorem. Aenean euismod, mi eu dapibus dignissim, erat tellus cursus nisl, vel fermentum nunc nulla vel tortor.
                   </p>
               </div>
           </div>
           <div class="col">
               <div class="skill-level-container" >
                   <h3 class="title">Advanced</h3>
                   <p class="description">
                       Praesent at lacus semper, tincidunt urna facilisis, pulvinar magna. Phasellus nisi dolor, sollicitudin at eros id, sollicitudin efficitur lorem. Aenean euismod, mi eu dapibus dignissim, erat tellus cursus nisl, vel fermentum nunc nulla vel tortor. Ut tincidunt placerat ante, vel lacinia neque imperdiet eu. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nulla elementum congue erat in cursus.
                   </p>
               </div>
           </div>
       </div>
   </div>
</main>
@stop