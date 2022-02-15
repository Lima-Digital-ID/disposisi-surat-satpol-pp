@extends('layouts.template')

@section('page-header')
    @include('components.page-header', [
    'pageTitle' => $pageTitle,
    'pageSubtitle' => '',
    'pageIcon' => $pageIcon,
    'parentMenu' => $parentMenu,
    'current' => $current
    ])
@endsection

@section('content')

    @include('components.notification')
    
    <div class="card">
        <div class="card-header">
            <h5>List {{ $pageTitle }}</h5>
            {{-- <div class="col-md-4 pull-right">
                @include('components.search')
            </div> --}}
            {{-- <div class="col-sm-2 pull-right">
                <input type="date" class="form-control">
            </div>
            <div class="col-sm-2 pull-right" style="padding-top:8px;margin-left:30px;">
                <h4>Dari Tanggal : </h4>
            </div>
            <div class="col-sm-2 pull-right">
                <input type="date" class="form-control">
            </div>
            <div class="col-sm-2 pull-right" style="padding-top:8px;margin-left:30px;">
                <h4>Dari Tanggal : </h4>
            </div> --}}
        </div>
        <div class="card-block table-border-style">
            @include('rekap_laporan_surat._table')
        </div>
    </div>

@endsection
@push('custom-scripts')
    <script>
        function getRekap(){
            var dari = $('#dari').val();
            var sampai = $('#sampai').val();
            var tipe = $('#tipe').val();
            var no = 1
            $.ajax({
                    type: "GET",
                    url:"{{ url('laporan_surat/get_laporan') }}?tipe="+tipe+"&dari="+dari+"&sampai="+sampai,
                    dataType : "json",
                    success : function(response){
                        $('#myHead tr').remove()
                        $('#myBody tr').remove()
                        if(tipe==0){
                        $('#myHead').append(`
                                <tr class="table-primary">
                                    <th class="text-center">#</th>
                                    <th>No Surat</th>
                                    <th>Jenis Surat</th>
                                    <th>Pengirim Surat</th>
                                    <th>Penerima Surat</th>
                                    <th>Tanggal Kirim Surat</th>
                                    <th>Perihal Surat</th>
                                    <th>Lampiran Surat</th>
                                </tr>
                        `)
                        $.each(response,function(k,v){
                            $('#myBody').append(`
                                <tr class="border-bottom-primary">
                                    <td class="text-center text-muted">${no++}</td>
                                    <td>${v.no_surat}</td>
                                    <td>${v.jenis_surat.jenis_surat}</td>
                                    <td>${v.pengirim_keluar.nama}</td>
                                    <td>${v.penerima}</td>
                                    <td>${v.tgl_kirim}</td>
                                    <td>${v.perihal}</td>
                                    <td align="center"><a href="{{ "upload/surat_keluar/" }}${v.file_surat}" target="_blank" class="btn btn-info btn-sm mr-2"><i class="fa fa-file"></i></a></td>
                                </tr>
                            `)
                        })
                        }
                        else if(tipe==1){
                            $('#myHead').append(`
                            <tr class="table-primary">
                                <th class="text-center">#</th>
                                <th>No Surat</th>
                                <th>Jenis Surat</th>
                                <th>Pengirim Surat</th>
                                <th>Penerima Surat</th>
                                <th>Tanggal Terima Surat</th>
                                <th>Tanggal Kirim Surat</th>
                                <th>Perihal Surat</th>
                                <th>Lampiran</th>
                            </tr>
                        `)
                        $.each(response,function(k,v){
                        $('#myBody').append(`
                                <tr class="border-bottom-primary">
                                    <td class="text-center text-muted">${no++}</td>
                                    <td>${v.no_surat}</td>
                                    <td>${v.jenis_surat.jenis_surat}</td>
                                    <td>${v.pengirim}</td>
                                    <td>${v.penerima_masuk.nama}</td>
                                    <td>${v.tgl_penerima}</td>
                                    <td>${v.tgl_pengirim}</td>
                                    <td>${v.perihal}</td>
                                    <td align="center"><a href="{{ "upload/surat_masuk/" }}${v.file_surat}" target="_blank" class="btn btn-info btn-sm mr-2"><i class="fa fa-file"></i></a></td>
                                </tr>
                            `)
                        })

                        }
                    }
                })
        }
    </script>
@endpush
