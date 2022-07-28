<form action="{{ route('surat_keluar.update', $data->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">No Surat</label>
        <div class="col-sm-10">
            <input type="text" name="no_surat" class="form-control @error('no_surat') is-invalid @enderror"
                placeholder="No Surat" value="{{ old('no_surat', $data->no_surat) }}" onClick="getAnggotaDis()">
            @error('no_surat')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>

    <input type="hidden" value="{{ auth()->user()->id }}" name="id_pengirim">

    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Penerima</label>
        <div class="col-sm-10">
            <select name="penerima" id="penerima" class="js-example-tags" style="width: 100%;" required>
                <option value="">Pilih Penerima</option>
                @foreach ($allUsr as $user)
                    <option value="{{ $user->id }}"
                        {{ old('id_penerima', $data->id_penerima) == $user->id ? 'selected' : '' }}>
                        {{ $user->nama . '||' . $user->level . '||' . $user->unit_kerja->unit_kerja }}</option>
                @endforeach
            </select>
            @error('penerima')
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
                placeholder="Tanggal Kirim" value="{{ old('tgl_kirim', $data->tgl_kirim) }}">
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
                placeholder="Perihal" value="{{ old('perihal', $data->perihal) }}">
            @error('perihal')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
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
