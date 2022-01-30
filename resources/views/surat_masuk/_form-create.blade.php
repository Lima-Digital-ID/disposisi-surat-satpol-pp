<form action="{{ route('surat_masuk.store') }}" method="POST">
    @csrf
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">No Surat</label>
        <div class="col-sm-10">
            <input type="text" name="no_surat" class="form-control @error('no_surat') is-invalid @enderror" placeholder="No Surat" value="{{old('no_surat')}}">
            @error('no_surat')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Jenis Surat</label>
        <div class="col-sm-10">
            <select name="id_jenis_surat" id="id_jenis_surat" class="form-control" style="width: 100%;" required>
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
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Penerima</label>
        <div class="col-sm-10">
            <select name="id_penerima" id="id_penerima" class="form-control" style="width: 100%;" required>
                <option value="">Pilih Penerima</option>
                @foreach ($allUsr as $usr)
                    <option value="{{ $usr->id }}">{{ $usr->nama }}</option>
                @endforeach
            </select>
            @error('id_penerima')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Pengirim</label>
        <div class="col-sm-10">
            <select name="id_pengirim" id="id_pengirim" class="form-control" style="width: 100%;" required>
                <option value="">Pilih Pengirim</option>
                @foreach ($allUsr as $usr)
                    <option value="{{ $usr->id }}">{{ $usr->nama }}</option>
                @endforeach
            </select>
            @error('id_pengirim')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>

        <div class="form-group row">
        <label class="col-sm-2 col-form-label">Tanggal Kirim</label>
        <div class="col-sm-10">
            <input type="date" name="tgl_pengirim" class="form-control @error('tgl_pengirim') is-invalid @enderror" placeholder="Tanggal Kirim" value="{{old('tgl_pengirim')}}">
            @error('tgl_pengirim')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>

        <div class="form-group row">
        <label class="col-sm-2 col-form-label">Tanggal Terima</label>
        <div class="col-sm-10">
            <input type="date" name="tgl_penerima" class="form-control @error('tgl_penerima') is-invalid @enderror" placeholder="Tanggal Kirim" value="{{old('tgl_penerima')}}">
            @error('tgl_penerima')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>

        <div class="form-group row">
        <label class="col-sm-2 col-form-label">Perihal</label>
        <div class="col-sm-10">
            <input type="text" name="perihal" class="form-control @error('perihal') is-invalid @enderror" placeholder="Perihal" value="{{old('perihal')}}">
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
            <input type="text" name="file_surat" class="form-control @error('file_surat') is-invalid @enderror" placeholder="File Surat" value="{{old('file_surat')}}">
            @error('file_surat')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    
    <button type="submit" class="btn btn-sm btn-primary"><i class="feather icon-save"></i>Simpan</button>
</form>
