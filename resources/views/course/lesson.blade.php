@extends('_master')

@section('title') Learn HTML @parent @stop

@section('stylesheets')
    <link rel="stylesheet" type="text/css" href="/assets/css/course_main.css">
@stop

@section('scripts')
@stop

@section('content')
    <main>


        <div class="container-fluid main-course-container">
            <div class="row">
                <div class="col title-container">
                    <div class="tutorial-symbol-container">
                        <div class=" main-tutorial-btn-container ">
                            <div class="big-rounded-btn html-tutorial-btn">
                                <div class="inner-container {{'html'}}-tut">
                                    <a href="#"><span class="desc-title" >{!! 'HTML <br/> Tutorial' !!}</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-1">

                </div>
                <div class="col-9">
                    <div class="col">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus tristique, leo ultrices varius vulputate, orci tellus sagittis ante, eget sollicitudin felis libero rhoncus turpis. Pellentesque sed ante id felis faucibus varius. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Phasellus facilisis, enim eget interdum hendrerit, enim enim lacinia quam, in semper lacus lacus sit amet dolor. Morbi pulvinar elit sapien, non aliquam leo euismod eget. Donec sed lacinia turpis. Proin a aliquam elit, nec dignissim dui. Nam tortor ante, rutrum eu nisl sed, tempus vulputate dui. Nulla ullamcorper dignissim arcu. Maecenas lorem dui, vestibulum id arcu vel, lacinia porttitor dolor. Fusce at elit urna. Vivamus at libero non elit ultricies dapibus lacinia et metus. Quisque facilisis justo et tortor molestie, non dignissim libero efficitur. Mauris venenatis velit sit amet ligula gravida tristique imperdiet ut libero. Donec lobortis est egestas dui bibendum, a consequat neque eleifend.
                    </div>
                    <div class="stages">
                        <div class="stages-list">
                            <h2>Beginner</h2>
                            <ul>
                                <li><a href="/pages-titles">consectetur adipiscing</a></li>
                                <li>consectetur adipiscing</li>
                                <li>ultrices varius</li>
                                <li>tellus sagittis</li>
                                <li>sagittis ante</li>
                                <li>ipsum dolor</li>
                                <li>adipiscing elit</li>
                                <li>orci tellus</li>
                                <li>tellus sagittis ante</li>
                            </ul>
                        </div>
                        <div class="stages-list">
                            <h2>Intermediary</h2>
                            <ul>
                                <li>ipsum dolor sit amet</li>
                                <li>eget sollicitudin</li>
                                <li>arius vulputate</li>
                                <li>consectetur adipiscing</li>
                                <li>eo ultrices varius</li>
                                <li>orem ipsum dolor sit</li>
                                <li>eget sollicitudin</li>
                            </ul>
                        </div>
                        <div class="stages-list">
                            <h2>Advanced</h2>
                            <ul>
                                <li>eget sollicitudin</li>
                                <li>sectetur adipis</li>
                                <li>orem ipsum dolor sit</li>
                                <li>ellus tristique</li>
                                <li>ipsum dolor sit amet</li>
                                <li>consectetur adipiscing</li>
                                <li>eget sollicitudin</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@stop