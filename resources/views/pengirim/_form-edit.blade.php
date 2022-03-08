<form action="{{ route('pengirim.update', $data->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Pengirim Surat</label>
        <div class="col-sm-10">
            <input type="text" name="pengirim" class="form-control @error('pengirim') is-invalid @enderror"
                placeholder="Nama Pengirim Surat" value="{{ old('pengirim', $data->pengirim) }}">
            @error('pengirim')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>

    <button type="submit" class="btn btn-sm btn-primary"><i class="feather icon-save"></i>Simpan</button>
</form>
