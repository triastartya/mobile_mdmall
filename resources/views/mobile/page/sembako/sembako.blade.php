@extends('mobile.template.layout')
@section('content')
    <div id="page_content_inner">
        <div class="md-card">
            <div class="md-card-toolbar">
                <div class="md-card-toolbar-actions">
                    <a href="#" ng-click="filter()" class="md-btn md-btn-small md-btn-flat md-btn-flat-primary">Ganti Tanggal</a>
                </div>
                <div class="uk-modal uk-modal-card-fullscreen" id="modal_tanggal">
                    <div class="uk-modal-dialog uk-modal-dialog-blank">
                        <div class="md-card uk-height-viewport">
                            <div class="md-card-toolbar" style="background: #1976d2!important;">
                                <span class="md-icon material-icons uk-modal-close" style="color:#fff!important">&#xE5C4;</span>
                                <h3 class="md-card-toolbar-heading-text" style="color:#fff!important">
                                    Pillih Tanggal
                                </h3>
                            </div>
                            <div class="md-card-content">
                                <div class="uk-grid" data-uk-grid-margin>
                                    <div class="uk-width-large-1-3 uk-width-1-1" style="margin-top:20px">
                                        <div class="uk-input-group">
                                            <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-calendar"></i></span>
                                            <label for="uk_dp_start">Dari Tanggal</label>
                                            <input class="md-input" type="text" id="uk_dp_start">
                                        </div>
                                    </div>
                                    <div class="uk-width-large-1-3 uk-width-medium-1-1" style="margin-top:20px">
                                        <div class="uk-input-group">
                                            <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-calendar"></i></span>
                                            <label for="uk_dp_end">Sampai Tanggal</label>
                                            <input class="md-input" type="text" id="uk_dp_end">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <h3 class="md-card-toolbar-heading-text">
                    Sembako
                </h3>
            </div>
            <div class="md-card-content">
                <span class="uk-badge uk-badge-primary">Dari <% startdate %></span>
                <span class="uk-badge uk-badge-primary">Sampai <% enddate %></span>
                
            </div>
            <div class="uk-modal uk-modal-card-fullscreen" id="modal_barang">
                <div class="uk-modal-dialog uk-modal-dialog-blank">
                    <div class="md-card uk-height-viewport">
                        <div class="md-card-toolbar" style="background: #1976d2!important;">
                            <span class="md-icon material-icons uk-modal-close" style="color:#fff!important">&#xE5C4;</span>
                            <h3 class="md-card-toolbar-heading-text" style="color:#fff!important">
                                <% lokasi %>
                            </h3> 
                        </div>
                        
                        <div class="md-card-content">
                        <span class="uk-badge uk-badge-primary">Dari <% startdate %></span>
                        <span class="uk-badge uk-badge-primary">Sampai <% enddate %></span>
                            <table class="uk-table">
                                <tbody>
                                    <tr ng-repeat="x in barang">
                                        <td><% x.NamaBarang %> @<% x.QtyJual %> <% x.Satuan %> </td>
                                        <td style="text-align:right"><% x.Nominal | currency:"" %></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div style="margin-top: 10px;" class="uk-grid-margin" ng-repeat="x in data"  ng-click="handleClickLokasi(x)">
            <div class="md-card md-card-success">
                <div class="md-card-content">
                    <table class="uk-table" style="margin-bottom: 2px;">
                        <tbody>
                            <tr style="font-weight:bold">
                                <td><% x.Lokasi %> </td>
                                <td style="text-align:right"><% x.total | currency:"" %></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div style="margin-top: 10px;" class="uk-grid-margin" ng-click="handleClickSemuaLokasi()">
            <div class="md-card md-card-success">
                <div class="md-card-content">
                    <table class="uk-table" style="margin-bottom: 2px;">
                        <tbody>
                            <tr style="font-weight:bold">
                                <td>Semua Cabang </td>
                                <td style="text-align:right"><% total_lokasi | currency:"" %></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('ctrl')
    @include('mobile.page.sembako.script')
@endsection