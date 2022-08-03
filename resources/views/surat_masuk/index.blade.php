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
            <form action="" method="get">
                <div class="form-group row justify-content-end">
                    <div class="col-md-3">
                        <div class="input-group">
                            <input type="text" class="form-control" name="perihal"
                                value="{{ Request::get('perihal') }}" placeholder="Perihal" style="margin-top:5%;">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group">
                            {{-- <select name="id_pengirim" id="" class="js-example-basic-single" style="width: 100%">
                                <option value="">Pilih Pengirim</option>
                                @foreach ($allPengirim as $pgr)
                                    <option value="{{ $pgr->id }}">{{ $pgr->pengirim }}</option>
                                @endforeach
                            </select> --}}
                            <select name="pengirim" id="pengirim" class="form-control js-example-tags" multiple style="width: 100%;">
                                <option value="">Pilih Pengirim</option>
                                @foreach ($allPengirim as $sender)
                                    <option value="{{ $sender->id }}">{{ $sender->pengirim }}</option>
                                @endforeach
                            </select>
                            {{-- <input type="text" class="form-control" name="pengirim"
                                value="{{ Request::get('pengirim') }}" placeholder="Pengirim"> --}}
                        </div>
                    </div>
                    <button class="btn btn-sm btn-primary" style="margin-top:10px;margin-bottom:5px;"><i class="fa fa-filter"></i>Filter</button>
                </div>
            </form>


        </div>
        <div class="card-block table-border-style">
            @include('surat_masuk._table')
        </div>
    </div>
@endsection
@push('custom-scripts')
    <script>
        function getSuratMasuk(id) {
            $('.modal-header').empty();
            $('.modal-body .form').empty();
            $.ajax({
                type: "GET",
                url: "{{ url('get_surat_masuk') }}/" + id,
                dataType: "json",
                success: function(response) {
                    data = response;
                    $('.modal-header').append(`
                        <h5 class="modal-title" id="exampleModalLabel">Disposisi No Surat : ${data.no_surat}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    `);
                    $('.modal-body .form').append(`
                    @csrf
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Sifat Surat</label>
                            <div class="col-sm-10">
                                <select name="sifat_surat" id="sifat_surat"
                                    class="form-control @error('sifat_surat') is-invalid @enderror" onChange="getAnggotaDis(1)">
                                    <option value="">Pilih Sifat Surat</option>
                                    <option value="Penting">
                                        Penting</option>
                                    <option value="Sangat Segera">
                                        Sangat Segera
                                    </option>
                                    <option value="Segera">
                                        Segera
                                    </option>
                                    <option value="Biasa">Biasa
                                    </option>
                                </select>
                                @error('sifat_surat')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <input type="hidden" name="id_pengirim" value="{{ auth()->user()->id }}">
                        <input type="hidden" name="id_surat_masuk" value=" ${data.id}">

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Penerima</label>
                            <div class="col-sm-10">
                                <select name="id_penerima" id="id_penerima" class="js-example-basic-single" style="width: 100%;" required>
                                    <option value="">Pilih Penerima</option>
                                </select>
                                @error('id_penerima')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Tanggal Disposisi</label>
                            <div class="col-sm-10">
                                <input type="date" name="tgl_disposisi"
                                    class="form-control @error('tgl_disposisi') is-invalid @enderror"
                                    value="{{ old('tgl_disposisi') }}">
                                @error('tgl_pengirim')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Catatan</label>
                            <div class="col-sm-10">
                                <input type="text" name="catatan"
                                    class="form-control @error('catatan') is-invalid @enderror" placeholder="Catatan"
                                    value="{{ old('catatan') }}">
                                @error('catatan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i
                                class="feather icon-x"></i>Tutup</button>
                        <button type="submit" class="btn btn-primary"><i class="feather icon-save"></i>Simpan</button>
                        {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                    </div>
                    `);
                    $('.js-example-basic-single').select2();
                }
            })
        }

        function getAnggotaDis(tipe) {
            console.log('asd');
            $('#selectUser').empty();
            $.ajax({
                type: "GET",
                url: "{{ url('disposisi/get_disposisi') }}/" + 1 + "?tipe=" + 1,
                dataType: "json",
                success: function(response) {
                    $.each(response, function(k, v) {
                        $('#id_penerima').append(
                            "<option value='" + v.id + "'>"+v.level+" || " + v.nama + "</option>"
                        )
                    })
                }
            })
        }
    </script>
@endpush
