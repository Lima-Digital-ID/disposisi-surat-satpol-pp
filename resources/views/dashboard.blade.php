@extends('layouts.template')

@section('page-header')
    @include('components.page-header', [
        'pageTitle' => 'Dashboard',
        'pageSubtitle' => '',
        'pageIcon' => 'feather icon-home',
        'parentMenu' => '',
        'current' => 'Dashboard'
    ])
@endsection

@section('content')
    @include('components.notification')
        <div class="row">
        <div class="col-md-4">
            <div class="card sale-card">
                <div class="card-header">
                    <h5>Surat Masuk</h5>
                </div>
                <div class="card-block">
                    <figure class="highcharts-figure">
                        <div id="container-hls"></div>
                        <p class="highcharts-description">
                            Jumlah Surat Masuk : {{ \App\Models\SuratMasuk::count() }}
                        </p>
                    </figure>                    
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card sale-card">
                <div class="card-header">
                    <h5>Surat Keluar</h5>
                </div>
                <div class="card-block">
                    <figure class="highcharts-figure">
                        <div id="container-hls"></div>
                        <p class="highcharts-description">
                            Jumlah Surat Keluar : {{ \App\Models\SuratKeluar::count() }}
                        </p>
                    </figure>                    
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card sale-card">
                <div class="card-header">
                    <h5>Disposisi</h5>
                </div>
                <div class="card-block">
                    <figure class="highcharts-figure">
                        <div id="container-hls"></div>
                        <p class="highcharts-description">
                            Jumlah Disposisi : {{ \App\Models\Disposisi::count() }}
                        </p>
                    </figure>                    
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card sale-card">
                <div class="card-header">
                    <h5>Golongan</h5>
                </div>
                <div class="card-block">
                    <figure class="highcharts-figure">
                        <div id="container-hls"></div>
                        <p class="highcharts-description">
                            Jumlah Golongan : {{ \App\Models\Golongan::count() }}
                        </p>
                    </figure>                    
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card sale-card">
                <div class="card-header">
                    <h5>Jabatan</h5>
                </div>
                <div class="card-block">
                    <figure class="highcharts-figure">
                        <div id="container-hls"></div>
                        <p class="highcharts-description">
                            Jumlah Jabatan : {{ \App\Models\Jabatan::count() }}
                        </p>
                    </figure>                    
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card sale-card">
                <div class="card-header">
                    <h5>User</h5>
                </div>
                <div class="card-block">
                    <figure class="highcharts-figure">
                        <div id="container-hls"></div>
                        <p class="highcharts-description">
                            Jumlah User : {{ \App\Models\User::count() }}
                        </p>
                    </figure>                    
                </div>
            </div>
        </div>
    </div>

@endsection