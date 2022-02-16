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
                    @include('disposisi._form-create')
                </div>
            </div>
        </div>
    </div>
@endsection
@push('custom-scripts')
    <script>
        $(document).ready(function() {
            // var tipe = $('#jenis').val('');
            
            $('#masuk').hide();
            $('#keluar').hide();

            $('#jenis').change(function() {
                if ($(this).val() == '0') {
                    $('#masuk').show();
                    $('#keluar').hide();
                }
                else{
                    $('#keluar').show();
                    $('#masuk').hide();
                }
            })

            $('#id_surat_masuk').change(function(){
                getAnggotaDis(1); 
            })
            
            $('#id_surat_keluar').change(function(){
                getAnggotaDis(0); 
            })
        })

        function getAnggotaDis(tipe){
            $('#selectUser').empty();
            var masuk = $('#id_surat_masuk').val();
            var keluar = $('#id_surat_keluar').val();
            if(tipe == 0){
                var getTipe = keluar;
            }else{
                var getTipe = masuk;
            }
            $.ajax({
                type: "GET",
                url:"{{ url('disposisi/get_disposisi') }}/"+getTipe+"?tipe="+tipe,
                dataType : "json",
                success : function(response){
                    $.each(response,function(k,v){
                        console.log(v.nama);
                        console.log(v.id);
                        $('#id_penerima').append(
                            "<option value='"+v.id+"'>"+v.nama+"</option>"
                        )
                    })
                }
            })
        }
    </script>
@endpush