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
            $('#masuk').hide();
            $('#keluar').hide();

            $('#jenis').change(function() {
                if ($(this).val() == '0') {
                    $('#masuk').show();
                    $('#keluar').hide();
                    console.log('0');
                }
                else{
                    $('#keluar').show();
                    $('#masuk').hide();
                    console.log('1');
                }
            })
        })
    </script>
@endpush
