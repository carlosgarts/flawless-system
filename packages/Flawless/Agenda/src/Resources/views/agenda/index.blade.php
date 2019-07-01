@extends('admin::layouts.master')

@section('page_title')
Flawless Agenda
@stop

@section('content-wrapper')
    <div class="inner-section">

        @include ('admin::layouts.nav-aside')

        <div class="content-wrapper">

            @include ('admin::layouts.tabs')

            @yield('content')

        </div>

    </div>
@stop
