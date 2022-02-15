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

    @php
    $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';

    $disposisi = \App\Models\Disposisi::with('penerima','pengirim')->where('id_pengirim',auth()->user()->id)->orwhere('id_penerima',auth()->user()->id)->orderBy('id','ASC');

    if ($keyword) {
        $disposisi->where('disposisi', 'LIKE', "%{$keyword}%");
    }

    $disposisi->limit(5);

    $data = $disposisi->paginate(10);
    @endphp

    <div class="row">
        <div class="col-md-12">
            <div class="card sale-card">
                <div class="card-header">
                    <h5>List Disposisi</h5>
                </div>
                <div class="card-block">
                    <figure class="highcharts-figure">
                        <div id="container-hls"></div>
                        <div class="table-responsive">
                            <table class="table table-styling table-de">
                                <thead>
                                    <tr class="table-primary">
                                        <th class="text-center">#</th>
                                        <th>Sifat Surat</th>
                                        <th>Surat Masuk</th>
                                        <th>Surat Keluar</th>
                                        <th>Pengirim</th>
                                        <th>Penerima</th>
                                        <th>Tanggal Disposisi</th>
                                        <th>Catatan</th>
                                        <th>Lampiran</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $page = Request::get('page');
                                        $no = !$page || $page == 1 ? 1 : ($page - 1) * 10 + 1;
                                    @endphp
                                    @foreach ($data as $item)
                                    <!-- {{-- @if (auth()->user()->id == $item->id_pengirim || auth()->user()->level == 'Administrator' || auth()->user()->level == 'Admin' || auth()->user()->id == $item->id_penerima ) --}} -->
                                        <tr class="border-bottom-primary">
                                          <td class="text-center text-muted">{{ $no }}</td>
                                          <td>{{ $item->sifat_surat }}</td>
                                          <td>{{ $item->masuk->perihal }}</td>
                                          <td>{{ $item->keluar->perihal }}</td>
                                          <td>{{ $item->pengirim->nama }}</td>
                                          <td>{{ $item->penerima->nama }}</td>
                                          <td>{{ $item->tgl_disposisi }}</td>
                                          <td>{{ $item->catatan }}</td>
                                          @if ($item->id_surat_masuk != null || $item->id_surat_masuk != '')
                                          <td align="center"><a href="{{ "upload/surat_masuk/".$item->masuk->file_surat }}" target="_blank" class="btn btn-info btn-sm mr-2"><i class="fa fa-file"></i></a></td>
                                          @elseif($item->id_surat_keluar != null || $item->id_surat_keluar != '')
                                          <td align="center"><a href="{{ "upload/surat_keluar/".$item->keluar->file_surat }}" target="_blank" class="btn btn-info btn-sm mr-2"><i class="fa fa-file"></i></a></td>
                                          @endif
                                        </tr>
                                        @php
                                            $no++;
                                        @endphp
                                      <!-- {{-- @endif --}} -->
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="pull-right">
                            {{$data->appends(Request::all())->links('vendor.pagination.custom')}}
                            </div>
                        </div>
                    </figure>                    
                </div>
            </div>
        </div>
    </div>

    </div>

@endsection