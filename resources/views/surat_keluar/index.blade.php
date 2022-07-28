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
            <div class="col-md-4 pull-right">
                @include('components.search')
            </div>

        </div>
        <div class="card-block table-border-style">
            @include('surat_keluar._table')
        </div>
    </div>
@endsection
@push('custom-scripts')
    <script>
        function getSuratKeluar(id) {
            $('.modal-header').empty();
            $('.modal-body .form').empty();
            $.ajax({
                type: "GET",
                url: "{{ url('get_surat_keluar') }}/" + id,
                dataType: "json",
                success: function(response) {
                    data = response;
                    $('.modal-header').append(`
                        <h5 class="modal-title" id="suratKeluarLabel">No Surat : ${data.no_surat}</h5>
                    `);
                    $('.modal-body .form').append(`
                    @csrf
                        <input type="hidden" name="no_surat" value=" ${data.no_surat}">
                        <input type="hidden" name="tgl_kirim" value=" ${data.tgl_kirim}">
                        <input type="hidden" name="perihal" value=" ${data.perihal}">
                        <input type="hidden" name="id_pengirim" value="${data.id_penerima}">
                        <input type="hidden" name="file_surat" value="${data.file_surat}">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Teruskan Kepada :</label>
                            <div class="col-sm-8">
                                <select name="penerima" id="penerima" class="js-example-basic-single" style="width: 100%;" required>
                                    <option value="">Pilih Penerima</option>
                                    @foreach($user as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @if(auth()->user()->level == 'Kasat')
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Catatan : </label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" placeholder="Catatan" name="catatan">
                                </div>
                            </div>
                        @endif
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i
                                    class="feather icon-x"></i>Tutup</button>
                            <button type="submit" class="btn btn-primary"><i class="feather icon-save"></i>Simpan</button>
                        </div>
                    `);
                    $('.js-example-basic-single').select2();
                }
            })
        }

        function getAnggotaDis(tipe) {
            $('#selectUser').empty();
            $.ajax({
                type: "GET",
                url: "{{ url('disposisi/get_disposisi') }}/" + 1 + "?tipe=" + 1,
                dataType: "json",
                success: function(response) {
                    $.each(response, function(k, v) {
                        $('#id_penerima').append(
                            "<option value='" + v.id + "'>" + v.level + " || " + v.nama +
                            "</option>"
                        )
                    })
                }
            })
        }
    </script>
@endpush
