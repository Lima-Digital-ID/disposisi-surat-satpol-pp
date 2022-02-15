<form action="{{ route('arsip.store') }}" method="POST">
    @csrf
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Pilih Jenis Surat</label>
        <div class="col-sm-10">
            <select name="jenis" id="jenis" class="js-example-basic-single" style="width: 100%;" required>
                <option value="0">Pilih Jenis Surat</option>
                <option value="masuk">Surat Masuk</option>
                <option value="keluar">Surat Keluar</option>
            </select>
        </div>
    </div>
    <div class="form-group row" id="suratRow" style="display: none;">
        <label class="col-sm-2 col-form-label">Pilih Surat</label>
        <div class="col-sm-10">
            <select name="surat" id="surat" class="js-example-basic-single @error('surat') is-invalid @enderror" style="width: 100%;" required>
                <option value="0">Pilih Surat</option>
            </select>
            @error('surat')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    @error('surat')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Lokasi Surat</label>
        <div class="col-sm-10">
            <select name="lokasi" id="lokasi" class="js-example-basic-single @error('lokasi') is-invalid @enderror" style="width: 100%;" required>
                <option value="0">Pilih Lokasi</option>
                @foreach ($lokasi as $item)
                    <option value="{{ $item->id }}">{{ $item->lokasi }}</option>
                @endforeach
            </select>
            @error('lokasi')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    <button type="submit" class="btn btn-sm btn-primary"><i class="feather icon-save"></i>Simpan</button>
</form>