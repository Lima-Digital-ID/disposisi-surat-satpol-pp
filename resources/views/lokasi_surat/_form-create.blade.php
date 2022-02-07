<form action="{{ route('lokasi-surat.store') }}" method="POST">
    @csrf
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Lokasi Surat</label>
        <div class="col-sm-10">
            <input type="text" name="lokasi" class="form-control @error('lokasi') is-invalid @enderror" placeholder="Nama Lokasi Surat" value="{{old('lokasi')}}">
            @error('lokasi')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>

    
    <button type="submit" class="btn btn-sm btn-primary"><i class="feather icon-save"></i>Simpan</button>
</form>
