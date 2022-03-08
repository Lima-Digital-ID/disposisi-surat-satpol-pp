<form action="{{ route('penerima.update', $data->id) }}" method="POST">
  @csrf
  @method('PUT')
  <div class="form-group row">
      <label class="col-sm-2 col-form-label">Penerima Surat</label>
      <div class="col-sm-10">
          <input type="text" name="penerima" class="form-control @error('penerima') is-invalid @enderror" placeholder="Nama Penerima Surat" value="{{old('penerima', $data->penerima)}}">
          @error('penerima')
              <div class="invalid-feedback">
                  {{ $message }}
              </div>
          @enderror
      </div>
  </div>
  
  <button type="submit" class="btn btn-sm btn-primary"><i class="feather icon-save"></i>Simpan</button>
</form>
