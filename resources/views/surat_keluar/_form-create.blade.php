<form action="{{ route('surat_keluar.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">No Surat</label>
        <div class="col-sm-10">
            <input type="text" name="no_surat" class="form-control @error('no_surat') is-invalid @enderror"
                placeholder="No Surat" value="{{ old('no_surat') }}" onClick="getAnggotaDis()">
            @error('no_surat')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>

    {{-- <div class="form-group row">
        <label class="col-sm-2 col-form-label">Jenis Surat</label>
        <div class="col-sm-10">
            <select name="id_jenis_surat" id="id_jenis_surat" class="js-example-basic-single" style="width: 100%;"
                required>
                <option value="">Pilih Jenis Surat</option>
                @foreach ($allJen as $jen)
                    <option value="{{ $jen->id }}">{{ $jen->jenis_surat }}</option>
                @endforeach
            </select>
            @error('id_jenis_surat')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div> --}}

    {{-- <div class="form-group row">
        <label class="col-sm-2 col-form-label">Pengirim</label>
        <div class="col-sm-10">
            <select name="id_penerima" id="id_penerima" class="js-example-basic-single" style="width: 100%;" required>
                <option value="">Pilih Penerima</option>
                @foreach ($allUsr as $usr)
                    <option value="{{ $usr->id }}">{{ $usr->nama . ' || ' . $usr->jabatan->jabatan }}</option>
                @endforeach
            </select>
            @error('id_pengirim')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div> --}}

    <input type="hidden" value="{{ auth()->user()->id }}" name="id_pengirim">

    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Penerima</label>
        <div class="col-sm-10">
            <input type="text" name="penerima" class="form-control @error('penerima') is-invalid @enderror"
                placeholder="Nama Penerima" value="{{ old('penerima') }}">
            @error('pengirim')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Tanggal Kirim</label>
        <div class="col-sm-10">
            <input type="date" name="tgl_kirim" class="form-control @error('tgl_kirim') is-invalid @enderror"
                placeholder="Tanggal Kirim" value="{{ old('tgl_kirim') }}">
            @error('tgl_kirim')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Perihal</label>
        <div class="col-sm-10">
            <input type="text" name="perihal" class="form-control @error('perihal') is-invalid @enderror"
                placeholder="Perihal" value="{{ old('perihal') }}">
            @error('perihal')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <div class="col-sm-2 col-form-label">Paraf</div>
        <div class="col-sm-6">
            {{-- <button type="button" class="btn btn-info btn-sm waves-effect" data-toggle="modal"
                data-target="#default-Modal">Tambah TTD</button>

            <div class="modal fade" id="default-Modal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Tempat Untuk Paraf </h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default waves-effect "
                                data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary waves-effect waves-light ">Save
                                changes</button>
                        </div>
                    </div>
                </div>
            </div> --}}
            <br />
            <div id="sig"></div>
            <br />
            <button id="clear" class="btn btn-danger btn-sm">Clear Signature</button>
            <textarea id="signature64" name="signed" style="display: none"></textarea>
            {{-- <br />
            <div id="signaturePad"></div>
            <br />
            <button id="clear" class="btn btn-danger btn-sm"><i class="feather icon-trash"></i>Hapus Paraf</button>
            <textarea id="signature64" name="signed" style="display: none"></textarea>
            <br /> --}}

        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label">File Surat</label>
        <div class="col-sm-10">
            <input type="file" name="file_surat" class="form-control" id="file_surat" />
            @error('file_surat')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>


    <button type="submit" class="btn btn-sm btn-primary"><i class="feather icon-save"></i>Simpan</button>
</form>
