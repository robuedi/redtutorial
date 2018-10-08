@extends('_partials.master')

@section('meta')
    <meta name="description" content="{{$page->meta_description}}">
@stop

@section('title') {{$page->head_title}} @parent @stop

@section('stylesheets')
    <link rel="stylesheet" type="text/css" href="/assets/css/static_page.css">
@stop

@section('scripts')
@stop

@section('content')

    <article class="static-page-content" >
        <header>{{$page->header}}</header>
        <section>
            {{$page->content}}
        </section>

    </article>

@stop

