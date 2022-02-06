<form action="{{ route('unit_kerja.update', $data->id) }}" method="POST">
  @csrf
  @method('PUT')
  <div class="form-group row">
      <label class="col-sm-2 col-form-label">Kode</label>
      <div class="col-sm-10">
          <input type="text" name="kode" class="form-control @error('kode') is-invalid @enderror" placeholder="Nama Kode" value="{{old('kode', $data->kode)}}">
          @error('kode')
              <div class="invalid-feedback">
                  {{ $message }}
              </div>
          @enderror
      </div>
  </div>

  <div class="form-group row">
    <label class="col-sm-2 col-form-label">Unit Kerja</label>
    <div class="col-sm-10">
        <input type="text" name="unit_kerja" class="form-control @error('unit_kerja') is-invalid @enderror" placeholder="Nama Unit Kerja" value="{{old('unit_kerja', $data->unit_kerja)}}">
        @error('unit_kerja')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>
  
  <button type="submit" class="btn btn-sm btn-primary"><i class="feather icon-save"></i>Simpan</button>
</form>
