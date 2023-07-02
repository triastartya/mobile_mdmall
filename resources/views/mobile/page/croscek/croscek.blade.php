@extends('mobile.template.layout')
@section('content')
    <div id="page_content_inner">
        <div class="md-card">
            <div class="md-card-toolbar">
                {{-- <div class="md-card-toolbar-actions">
                    <a href="#" class="md-btn md-btn-small md-btn-flat md-btn-flat-primary">Filter</a>
                </div> --}}
                <h3 class="md-card-toolbar-heading-text">
                    Laporan Tutup Kasir
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
                
                {{-- <div class="uk-accordion">
                    <span ng-repeat="x in data">
                    <h3 class="uk-accordion-title"><b><% x.lokasi.Lokasi %></b></h3>
                    <div class="uk-accordion-content">
                        <table class="uk-table">
                            <tbody>
                            <tr>
                                <td>Faktur</td>
                                <td style="text-align:right"><% x.FakturSaldoKasir %></td>
                            </tr>
                            <tr>
                                <td>Waktu Buka Kasir</td>
                                <td style="text-align:right"><% x.WaktuBukaKasir %></td>
                            </tr>
                            <tr>
                                <td>Waktu Tutup Kasir</td>
                                <td style="text-align:right"><% x.WaktuTutupKasir %></td>
                            </tr>
                             <tr>
                                <td>Waktu CrosCek</td>
                                <td style="text-align:right"><% x.WaktuValidasiSpvToko %></td>
                            </tr>
                             <tr>
                                <td>Nama Kasir</td>
                                <td style="text-align:right"><% x.UserKasir %></td>
                            </tr>
                             <tr>
                                <td>Nama Spv Kasir</td>
                                <td style="text-align:right"><% x.UserValidasiSpvToko %></td>
                            </tr>
                            <tr>
                                <td>Ket. Tutup Kasir</td>
                                <td style="text-align:right"><% x.KeteranganTutupKasir %></td>
                            </tr>
                            <tr>
                                <td>Ket. CrosCek</td>
                                <td style="text-align:right"><% x.KeteranganValidasiSpvToko %></td>
                            </tr>
                            <tr>
                                <td>Jumlah Modal</td>
                                <td style="text-align:right"><% x.JumlahModalAwal | currency:"" %></td>
                            </tr>
                            <tr>
                                <td>Saldo Di Kasir</td>
                                <td style="text-align:right"><% x.JumlahPenerimaanVerUser - x.JumlahStoranBank | currency:""%></td>
                            </tr>
                            <tr>
                                <td>Stor Ke Bank </td>
                                <td style="text-align:right"><% x.JumlahStoranBank  | currency:"" %></td>
                            </tr>
                            <tr>
                                <td>Pendapatan Versi User Kasir</td>
                                <td style="text-align:right"><% x.JumlahPenerimaanVerUser | currency:"" %></td>
                            </tr>
                            <tr>
                                <td>Pendapatan Versi Sistem</td>
                                <td style="text-align:right"><% x.JumlahPenerimaanVerSistem | currency:"" %></td>
                            </tr>
                            <tr>
                                <td>Selisih</td>
                                <td style="text-align:right"><% x.JumlahPenerimaanVerSistem - x.JumlahPenerimaanVerUser | currency:"" %></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    </span>
                </div> --}}
                <div style="margin-top: 10px;" class="uk-grid-margin" ng-repeat="x in data"  ng-click="handleClickLokasi(x)">
                    <div class="md-card md-card-success">
                        <div class="md-card-content">
                            <table class="uk-table" style="margin-bottom: 2px;">
                                <tbody>
                                    <tr style="font-weight:bold">
                                        <td><% x.lokasi.Lokasi %>,Kasir <% x.UserKasir %> </td>
                                        <td style="text-align:right"><% x.JumlahPenerimaanVerSistem | currency:"" %></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="uk-modal uk-modal-card-fullscreen" id="modal_barang">
        <div class="uk-modal-dialog uk-modal-dialog-blank">
            <div class="md-card uk-height-viewport">
                <div class="md-card-toolbar" style="background: #1976d2!important;">
                    <span class="md-icon material-icons uk-modal-close" style="color:#fff!important">&#xE5C4;</span>
                    <h3 class="md-card-toolbar-heading-text" style="color:#fff!important">
                        <% detail.lokasi.Lokasi %>
                    </h3> 
                </div>
                
                <div class="md-card-content">
                    <table class="uk-table">
                        <tbody>
                        <tr>
                            <td>Faktur</td>
                            <td style="text-align:right"><% detail.FakturSaldoKasir %></td>
                        </tr>
                        <tr>
                            <td>Waktu Buka Kasir</td>
                            <td style="text-align:right"><% detail.WaktuBukaKasir %></td>
                        </tr>
                        <tr>
                            <td>Waktu Tutup Kasir</td>
                            <td style="text-align:right"><% detail.WaktuTutupKasir %></td>
                        </tr>
                         <tr>
                            <td>Waktu CrosCek</td>
                            <td style="text-align:right"><% detail.WaktuValidasiSpvToko %></td>
                        </tr>
                         <tr>
                            <td>Nama Kasir</td>
                            <td style="text-align:right"><% detail.UserKasir %></td>
                        </tr>
                         <tr>
                            <td>Nama Spv Kasir</td>
                            <td style="text-align:right"><% detail.UserValidasiSpvToko %></td>
                        </tr>
                        <tr>
                            <td>Ket. Tutup Kasir</td>
                            <td style="text-align:right"><% detail.KeteranganTutupKasir %></td>
                        </tr>
                        <tr>
                            <td>Ket. CrosCek</td>
                            <td style="text-align:right"><% detail.KeteranganValidasiSpvToko %></td>
                        </tr>
                        <tr>
                            <td>Jumlah Modal</td>
                            <td style="text-align:right"><% detail.JumlahModalAwal | currency:"" %></td>
                        </tr>
                        <tr>
                            <td>Saldo Di Kasir</td>
                            <td style="text-align:right"><% detail.JumlahPenerimaanVerUser - x.JumlahStoranBank | currency:""%></td>
                        </tr>
                        <tr>
                            <td>Stor Ke Bank </td>
                            <td style="text-align:right"><% detail.JumlahStoranBank  | currency:"" %></td>
                        </tr>
                        <tr>
                            <td>Pendapatan Versi User Kasir</td>
                            <td style="text-align:right"><% detail.JumlahPenerimaanVerUser | currency:"" %></td>
                        </tr>
                        <tr>
                            <td>Pendapatan Versi Sistem</td>
                            <td style="text-align:right"><% detail.JumlahPenerimaanVerSistem | currency:"" %></td>
                        </tr>
                        <tr>
                            <td>Selisih</td>
                            <td style="text-align:right"><% detail.JumlahPenerimaanVerSistem - detail.JumlahPenerimaanVerUser | currency:"" %></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('ctrl')
    @include('mobile.page.croscek.script')
@endsection