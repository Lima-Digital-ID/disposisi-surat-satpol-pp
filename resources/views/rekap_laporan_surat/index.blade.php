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
            // console.log(dari);
            // console.log(sampai);
            // console.log(tipe);
            // console.log("{{ url('laporan_surat/get_laporan') }}?tipe="+tipe+"&dari="+dari+"&sampai="+sampai);
            if(tipe == 0){
                $.ajax({
                    type: "GET",
                    url:"{{ url('laporan_surat/get_laporan') }}?tipe="+tipe+"&dari="+dari+"&sampai="+sampai,
                    dataType : "json",
                    success : function(response){
                        console.log(response);
                        $.each(response,function(key,val){
                            $('#myTable').append(`
                            <thead>
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
                            </thead>
                            <tbody>
                                <tr class="border-bottom-primary">
                                    <td class="text-center text-muted">1</td>
                                    <td>${val.no_surat}</td>
                                    <td>${val.jenis_surat.jenis_surat}</td>
                                    <td>${val.pengirim_keluar.nama}</td>
                                    <td>${val.penerima}</td>
                                    <td>${val.tgl_kirim}</td>
                                    <td>${val.perihal}</td>
                                    <td align="center"><a href="{{ "upload/surat_keluar/" }}${val.file_surat}" target="_blank" class="btn btn-info btn-sm mr-2"><i class="fa fa-file"></i></a></td>
                                </tr>
                            </tbody>
                            `)
                        })
                    }
                })
            }else{
                $.ajax({
                    type: "GET",
                    url:"{{ url('laporan_surat/get_laporan') }}?tipe="+tipe+"&dari="+dari+"&sampai="+sampai,
                    dataType : "json",
                    success : function(response){
                        console.log(response);
                        // $('#myTable').remove()
                        $.each(response,function(key,val){
                        $('#myTable').append(`
                            <thead>
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
                            </thead>
                            <tbody>
                                <tr class="border-bottom-primary">
                                    <td class="text-center text-muted">1</td>
                                    <td>${val.no_surat}</td>
                                    <td>${val.jenis_surat.jenis_surat}</td>
                                    <td>${val.pengirim}</td>
                                    <td>${val.penerima_masuk.nama}</td>
                                    <td>${val.tgl_penerima}</td>
                                    <td>${val.tgl_pengirim}</td>
                                    <td>${val.perihal}</td>
                                    <td align="center"><a href="{{ "upload/surat_masuk/" }}${val.file_surat}" target="_blank" class="btn btn-info btn-sm mr-2"><i class="fa fa-file"></i></a></td>
                                </tr>
                            </tbody>
                            `)
                        })
                    }
                })
            }
        }
    </script>
@endpush
