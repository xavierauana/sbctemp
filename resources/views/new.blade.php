@extends('partials.adminLayout')

@section('content')
    <div class="row" v-show="entryView">
        <entry-view></entry-view>
    </div>
    <div class="row" v-show="!entryView">
        <div class="col-sm-3">
            <side-bar-menu :current-view.sync="currentView"></side-bar-menu>
        </div>
        <div class="col-sm-9">
            <components :is="currentView"></components>
        </div>
    </div>

@stop

@section('scripts')
    <script src="/js/app.js"></script>
@stop