<form action="{{ route('surat_masuk.store') }}" method="POST" enctype="multipart/form-data">
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
        <label class="col-sm-2 col-form-label">Sifat Surat</label>
        <div class="col-sm-10">
            <select name="sifat_surat" id="sifat_surat" class="form-control @error('sifat_surat') is-invalid @enderror">
                <option value="">Pilih Sifat Surat</option>
                <option value="Penting" {{ old('sifat_surat') == 'Penting' ? ' selected' : '' }}>Penting</option>
                <option value="Rahasia" {{ old('sifat_surat') == 'Rahasia' ? ' selected' : '' }}>Rahasia
                </option>
                <option value="Biasa" {{ old('sifat_surat') == 'Biasa' ? ' selected' : '' }}>Biasa
                </option>
                <option value="Pribadi" {{ old('sifat_surat') == 'Pribadi' ? ' selected' : '' }}>Pribadi
                </option>
            </select>
            @error('sifat_surat')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>

    {{--  <div class="form-group row">
        <label class="col-sm-2 col-form-label">Penerima</label>
        <div class="col-sm-10">
            <select name="id_penerima" id="id_penerima" class="js-example-basic-single" style="width: 100%;" required>
                <option value="">Pilih Penerima</option>
                @foreach ($allUsr as $usr)
                    <option value="{{ $usr->id }}">{{ $usr->nama." || ".$usr->jabatan->jabatan }}</option>
                @endforeach
            </select>
            @error('id_penerima')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>  --}}

    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Pengirim</label>
        <div class="col-sm-10">
            <select name="pengirim" id="pengirim" class="js-example-tags" style="width: 100%;" required>
                <option value="">Pilih Pengirim</option>
                @foreach ($allPengirim as $sender)
                    <option value="{{ $sender->id }}">{{ $sender->pengirim }}</option>
                @endforeach
            </select>
            @error('pengirim')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>

        <div class="form-group row">
        <label class="col-sm-2 col-form-label">Tanggal Surat</label>
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
        <label class="col-sm-2 col-form-label">Status Tembusan</label>
        <div class="col-sm-10">
            <select name="tembusan" id="tembusan" class="form-control @error('tembusan') is-invalid @enderror">
                <option value="">Pilih Status Tembusan</option>
                <option value="Langsung" {{ old('tembusan') == 'Langsung' ? ' selected' : '' }}>Langsung</option>
                <option value="Tembusan" {{ old('tembusan') == 'Tembusan' ? ' selected' : '' }}>Tembusan
                </option>
            </select>
            @error('tembusan')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label">File Surat</label>
        <div class="col-sm-10">
            <input type="file" name="file_surat" class="form-control" id="file_surat"/>
            @error('file_surat')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    
    <button type="submit" class="btn btn-sm btn-primary"><i class="feather icon-save"></i>Simpan</button>
</form>
