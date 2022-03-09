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

    @include('components.button-add', ['btnText' => $btnText, 'btnLink' => $btnLink])

    <div class="card">
        <div class="card-header">
            <h5>List {{ $pageTitle }}</h5>
            <div class="row">
                <div class="col-md-2">Asal Surat : </div>
                <div class="col-md-4"><select class="js-example-tags" name="" id="" style="width: 100%;">
                        <option value="">asd</option>
                        <option value="">dsa</option>
                    </select></div>
                <div class="col-md-2">Perihal : </div>
                <div class="col-md-2"><input type="text" class="form-control"></div>

                <div class="col-md-2">
                    @include('components.search')
                </div>
            </div>

        </div>
        <div class="card-block table-border-style">
            @include('surat_masuk._table')
        </div>
    </div>
@endsection
