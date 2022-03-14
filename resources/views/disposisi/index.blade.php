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

    {{-- @include('components.button-add', ['btnText' => $btnText, 'btnLink' => $btnLink]) --}}

    <div class="card">
        <div class="card-header">
            <h5>List {{ $pageTitle }}</h5>
            <div class="col-md-4 pull-right">
                @include('components.search')
            </div>

        </div>
        <div class="card-block table-border-style">
            @include('disposisi._table')
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
                                    <option value="Rahasia">
                                        Rahasia
                                    </option>
                                    <option value="Biasa">Biasa
                                    </option>
                                    <option value="Pribadi">
                                        Pribadi
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
                        <input type="hidden" name="id_penerima" value=" ${data.id}">

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Penerima</label>
                            <div class="col-sm-10">
                                <select name="id_penerima[]" id="id_penerima" class="form-control" style="width: 100%;" required>
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
                    </div>
                    `);
                }
            })
        }

        function getAnggotaDis(tipe) {
            console.log('getAnggotaDis()')
            $.ajax({
                type: "GET",
                url: "{{ url('disposisi/get_disposisi') }}/" + 1 + "?tipe=" + 1,
                dataType: "json",
                success: function(response) {
                    console.log('asd');
                    $.each(response, function(k, v) {
                        console.log(v.nama);
                        console.log(v.id);
                        $('#id_penerima').append(
                            "<option value='" + v.id + "'>" + v.nama + "</option>"
                        )
                    })
                }
            })
        }
    </script>
@endpush
