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

    <div class="row">
        <div class="col-sm-12">
            @include('components.button-list', ['btnText' => $btnText, 'btnLink' => $btnLink])
            <div class="card">
                <div class="card-header">
                    <h5>Tambah {{ $pageTitle }}</h5>
                </div>
                <div class="card-block">
                    {{-- <h4 class="sub-title">Basic Inputs</h4> --}}
                    @include('arsip._form-create')
                </div>
            </div>
        </div>
    </div>
@endsection
@push('custom-scripts')
<script>
    $('#jenis').on('change', function() {
        if(this.value != '0') {
            $('#suratRow').show();
            $('#surat').empty();
            $('#surat').append('<option value="0">Pilih Surat</option>');
        }
        else {
            $('#suratRow').hide();
            $('#surat').empty();
        }
        if(this.value == 'masuk') {
            $.ajax({
                type: "GET",
                url: "{{ route('get_surat_masuk') }}", //json get site
                dataType : 'json',
                success: function(response){
                    arrData=response['data'];
                    for(i = 0; i < arrData.length; i++){
                        $('#surat').append('<option value="'+arrData[i]['id']+'">'+arrData[i]['no_surat'] + ' || ' + arrData[i]['perihal'] +'</option>');
                    }
                }
            });
        }
        if(this.value == 'keluar') {
            $.ajax({
                type: "GET",
                url: "{{ route('get_surat_keluar') }}", //json get site
                dataType : 'json',
                success: function(response){
                    arrData=response['data'];
                    for(i = 0; i < arrData.length; i++){
                        $('#surat').append('<option value="'+arrData[i]['id']+'">'+arrData[i]['no_surat'] + ' || ' + arrData[i]['perihal'] +'</option>');
                    }
                }
            });
        }
    });
</script>
@endpush