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
                    }
                })
            }else{
                $.ajax({
                    type: "GET",
                    url:"{{ url('laporan_surat/get_laporan') }}?tipe="+tipe+"&dari="+dari+"&sampai="+sampai,
                    dataType : "json",
                    success : function(response){
                        // console.log('asd');
                        console.log(response);
                    }
                })
            }
        }
    </script>
@endpush
