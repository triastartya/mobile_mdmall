@extends('mobile.template.layout')
@section('content')
    <div id="page_content_inner">
        <div class="md-card">
            <button class="md-btn md-btn-small md-btn-flat md-btn-flat-primary" ng-click="pay()">PAY</button>
        </div>
    </div>
@endsection
@section('ctrl')
    @include('mobile.page.pay.script')
@endsection