<form action="{{ route('surat_keluar.update', $data->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">No Surat</label>
        <div class="col-sm-10">
            <input type="text" name="no_surat" class="form-control @error('no_surat') is-invalid @enderror"
                placeholder="No Surat" value="{{ old('no_surat', $data->no_surat) }}">
            @error('no_surat')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>

    @if (auth()->user()->level == 'TU')
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Tanggal Kirim</label>
            <div class="col-sm-10">
                <input type="datetime-local" name="tgl_kirim"
                    class="form-control @error('tgl_kirim') is-invalid @enderror" placeholder="Tanggal Kirim"
                    value="{{ old('tgl_kirim', $data->tgl_kirim) }}">
                @error('tgl_kirim')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Penerima</label>
            <div class="col-sm-10">
                <input type="text" name="penerima" class="form-control @error('penerima') is-invalid @enderror"
                    placeholder="Nama Penerima" value="{{ old('penerima', $data->penerima) }}">
                @error('pengirim')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
    @endif

    @if (auth()->user()->level != 'TU')
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Penerima</label>
            <div class="col-sm-10">
                <select name="id_penerima" onChange="getAnggotaDis()" id="id_penerima" class="js-example-basic-single"
                    style="width: 100%;" required>
                    <option value="">Pilih Penerima</option>
                    {{-- @foreach ($allUsr as $usr)
                        <option value="{{ $usr->id }}">{{ $usr->nama . ' || ' . $usr->jabatan->jabatan }}
                        </option>
                    @endforeach --}}
                </select>
                @error('id_penerima')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
    @endif

    @if (auth()->user()->level == 'Kasubag')
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Catatan</label>
            <div class="col-sm-10">
                <input type="text" name="catatan" class="form-control @error('catatan') is-invalid @enderror"
                    placeholder="Catatan" value="{{ old('catatan', $data->catatan) }}">
                @error('pengirim')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
    @endif

    @if (auth()->user()->level == 'Kabag')
        <div class="form-group row">
            <label class="" for="">Paraf:</label>
            <br />
            <div id="sig"></div>
            <br><br>
            <button id="clear" class="btn btn-sm btn-danger"><i class="feather icon-trash"></i>Hapus Paraf</button>
            <textarea id="signature" name="signed" style="display: none"></textarea>
        </div>
    @elseif (auth()->user()->level == 'Kasat')
        <div class="form-group row">
            <label class="" for="">Tanda Tangan : </label>
            <br />
            <div id="sig"></div>
            <br><br>
            <button id="clear" class="btn btn-sm btn-danger"><i class="feather icon-trash"></i>Hapus Tanda Tangan
            </button>
            <textarea id="signature" name="signed" style="display: none"></textarea>
        </div>
    @endif
    <br />
    <button type="submit" class="btn btn-sm btn-primary"><i class="feather icon-save"></i>Simpan</button>
</form>
