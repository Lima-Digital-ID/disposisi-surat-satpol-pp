@extends('layouts.template')

@section('page-header')
    @include('components.page-header', [
        'pageTitle' => $pageTitle,
        'pageSubtitle' => '',
        'pageIcon' => $pageIcon,
        'parentMenu' => $parentMenu,
        'current' => $current,
    ])
@endsection

@section('content')
    @include('components.notification')

    <div class="row">
        <div class="col-sm-12">
            @include('components.button-list', ['btnText' => $btnText, 'btnLink' => $btnLink])
            <div class="card">
                <div class="card-header">
                    <h5>Edit {{ $pageTitle }}</h5>
                </div>
                <div class="card-block">
                    @include('surat_keluar._form-edit')
                </div>
            </div>
        </div>
    </div>
@endsection
{{-- @push('custom-scripts')
    <script>
        function getAnggotaDis() {
            $('#id_penerima').empty();
            $.ajax({
                type: "GET",
                url: "{{ url('disposisi/get_disposisi') }}/" + 1 + "?tipe=" + 1,
                dataType: "json",
                success: function(response) {
                    $.each(response, function(k, v) {
                        console.log(v.nama);
                        console.log(v.id);
                        $('#id_penerima').append(
                            "<option value=''>Pilih Penerima</option>"+
                            "<option value='" + v.id + "'>" + v.nama + "</option>"
                        )
                    })
                }
            })
        }
    </script>
@endpush --}}
