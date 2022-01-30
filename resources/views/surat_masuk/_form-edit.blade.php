<form action="{{ route('surat_keluar.update', $data->id) }}" method="POST">
@csrf
@method('PUT')
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">No Surat</label>
        <div class="col-sm-10">
            <input type="text" name="no_surat" class="form-control @error('no_surat') is-invalid @enderror" placeholder="No Surat" value="{{old('no_surat', $data->no_surat)}}">
            @error('no_surat')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
<button type="submit" class="btn btn-sm btn-primary"><i class="feather icon-save"></i>Simpan</button>
</form>
