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

@endsection