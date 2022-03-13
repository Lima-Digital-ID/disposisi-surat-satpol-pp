{{-- @push('custom-styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}css/morris.css">
@endpush --}}
@extends('layouts.template')

@section('page-header')
    @include('components.page-header', [
        'pageTitle' => 'Dashboard',
        'pageSubtitle' => '',
        'pageIcon' => 'feather icon-home',
        'parentMenu' => '',
        'current' => 'Dashboard',
    ])
@endsection

@section('content')
    @include('components.notification')

    <div class="row col-md-12">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>Surat Masuk</h5>
                    <span>Jumlah Surat Masuk</span>
                </div>
                <div class="card-block">
                    <canvas id="suratMasukChart" width="400" height="400"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>Surat Keluar</h5>
                    <span>Jumlah Surat Keluar</span>
                </div>
                <div class="card-block">
                    <canvas id="suratKeluarChart" width="400" height="400"></canvas>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="row">
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
    </div> --}}

    @php
    $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';

    $disposisi = \App\Models\Disposisi::with('penerima', 'pengirim');
    if (auth()->user()->level == 'Anggota') {
        $disposisi->where('id_pengirim', auth()->user()->id)->orwhere('id_penerima', auth()->user()->id);
    }
    $disposisi->orderBy('id', 'ASC');

    if ($keyword) {
        $disposisi->where('disposisi', 'LIKE', "%{$keyword}%");
    }

    $disposisi->limit(5);

    $data = $disposisi->paginate(10);

    // Chart Surat Masuk
    $suratMasuk = \App\Models\SuratMasuk::select('id', 'created_at')
        ->orderBy('created_at', 'ASC')
        ->get()
        ->groupBy(function ($suratMasuk) {
            return \Carbon\Carbon::parse($suratMasuk->created_at)->format('F');
        });

    $monthsMasuk = [];
    $monthMasukCount = [];
    foreach ($suratMasuk as $key => $value) {
        $monthsMasuk[] = $key;
        $monthMasukCount[] = count($value);
    }
    $monthMasuk = json_encode($monthsMasuk);
    $countMasuk = json_encode($monthMasukCount);

    // Chart Surat Keluar
    $suratKeluar = \App\Models\SuratKeluar::select('id', 'created_at')
        ->orderBy('created_at', 'ASC')
        ->get()
        ->groupBy(function ($suratKeluar) {
            return \Carbon\Carbon::parse($suratKeluar->created_at)->format('F');
        });

    // ddd($suratMasuk);
    // echo $suratKeluar;
    // echo $suratMasuk;
    $monthsKeluar = [];
    $monthKeluarCount = [];
    foreach ($suratKeluar as $key => $value) {
        $monthsKeluar[] = $key;
        $monthKeluarCount[] = count($value);
    }
    $monthKeluar = json_encode($monthsKeluar);
    $countKeluar = json_encode($monthKeluarCount);
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
                                        <!-- {{-- @if (auth()->user()->id == $item->id_pengirim || auth()->user()->level == 'Administrator' || auth()->user()->level == 'Admin' || auth()->user()->id == $item->id_penerima) --}} -->
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
                                                <td align="center"><a
                                                        href="{{ 'upload/surat_masuk/' . $item->masuk->file_surat }}"
                                                        target="_blank" class="btn btn-info btn-sm mr-2"><i
                                                            class="fa fa-file"></i></a></td>
                                            @elseif($item->id_surat_keluar != null || $item->id_surat_keluar != '')
                                                <td align="center"><a
                                                        href="{{ 'upload/surat_keluar/' . $item->keluar->file_surat }}"
                                                        target="_blank" class="btn btn-info btn-sm mr-2"><i
                                                            class="fa fa-file"></i></a></td>
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
                                {{ $data->appends(Request::all())->links('vendor.pagination.custom') }}
                            </div>
                        </div>
                    </figure>
                </div>
            </div>
        </div>
    </div>

    </div>
@endsection
@push('custom-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>
    <script>
        const suratMasuk = document.getElementById('suratMasukChart');
        const suratMasukChart = new Chart(suratMasuk, {
            type: 'bar',
            data: {
                labels: {!! $monthMasuk !!},
                datasets: [{
                    label: ['Surat Masuk'],
                    data: {!! $countMasuk !!},
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
    <script>
        const suratKeluar = document.getElementById('suratKeluarChart');
        const suratKeluarChart = new Chart(suratKeluar, {
            type: 'bar',
            data: {
                labels: {!! $monthKeluar !!},
                datasets: [{
                    label: ['Surat Keluar'],
                    data: {!! $countKeluar !!},
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
    {{-- <script src="{{ asset('') }}js/morris-custom-chart.js" type="ab836d322815de22d75b9415-text/javascript"></script> --}}
    {{-- <script src="{{ asset('') }}js/morris.js" type="ab836d322815de22d75b9415-text/javascript"></script> --}}
@endpush
