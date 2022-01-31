<form action="{{ route('disposisi.store') }}" method="POST">
    @csrf
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Sifat Surat</label>
        <div class="col-sm-10">
            <select name="sifat_surat" id="sifat_surat" class="form-control @error('sifat_surat') is-invalid @enderror">
                <option value="">Pilih sifat_surat</option>
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

    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Pengirim</label>
        <div class="col-sm-10">
            <select name="id_pengirim" id="id_pengirim" class="js-example-basic-single" style="width: 100%;" required>
                <option value="">Pilih Pengirim</option>
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
    </div>

    <div class="form-group row">
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
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Tanggal Disposisi</label>
        <div class="col-sm-10">
            <input type="datetime-local" name="tgl_disposisi" class="form-control @error('tgl_disposisi') is-invalid @enderror" value="{{old('tgl_disposisi')}}">
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
            <input type="text" name="catatan" class="form-control @error('catatan') is-invalid @enderror" placeholder="Catatan" value="{{old('catatan')}}">
            @error('catatan')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    
    <button type="submit" class="btn btn-sm btn-primary"><i class="feather icon-save"></i>Simpan</button>
</form>
