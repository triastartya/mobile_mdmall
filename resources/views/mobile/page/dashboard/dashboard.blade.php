@extends('mobile.template.layout')
@section('content')
    <div id="page_content_inner">
        <div class="md-card">
            <div class="md-card-toolbar">
                <div class="md-card-toolbar-actions">
                    <a href="#" ng-click="get_data()" class="md-btn md-btn-small md-btn-flat md-btn-flat-primary">Refresh</a>
                </div>
                <h3 class="md-card-toolbar-heading-text">
                    Laporan Kirim Data
                </h3>
            </div>
            <div class="md-card-content">
                <div class="uk-grid">
                    <div class="uk-width-large-2-3 uk-width-1-1">
                        <div class="uk-input-group">
                            <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-calendar"></i></span>
                            <label for="tanggal">Tanggal</label>
                            <input  class="md-input" type="text" id="tanggal" data-uk-datepicker="{format:'YYYY-MM-DD'}">
                        </div>
                    </div>
                </div>
                <hr/>
                <div class="uk-width-medium-1-3 uk-row-first">
                    <ul class="md-list md-list-addon">
                        <li ng-repeat="x in data" ng-click="handleClickItem()">
                            <div class="md-list-addon-element">
                                <i class="md-list-addon-icon material-icons uk-text-success">
                                    check_circle_outline
                                </i>
                            </div>
                            <div class="md-list-content">
                                <span class="md-list-heading"><% x.lokasi.Lokasi %></span>
                                <span class="uk-text-small uk-text-muted"><% x.UserKasir %></span>
                                <span class="uk-text-small uk-text-muted"><% x.UserValidasiSpvToko %></span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('ctrl')
    @include('mobile.page.dashboard.script')
@endsection