<form action="{{ route('golongan.update', $data->id) }}" method="POST">
  @csrf
  @method('PUT')
  <div class="form-group row">
      <label class="col-sm-2 col-form-label">Jenis Surat</label>
      <div class="col-sm-10">
          <input type="text" name="jenis_surat" class="form-control @error('jenis_surat') is-invalid @enderror" placeholder="Nama Jenis Surat" value="{{old('jenis_surat', $data->jenis_surat)}}">
          @error('jenis_surat')
              <div class="invalid-feedback">
                  {{ $message }}
              </div>
          @enderror
      </div>
  </div>
  
  <button type="submit" class="btn btn-sm btn-primary"><i class="feather icon-save"></i>Simpan</button>
</form>
