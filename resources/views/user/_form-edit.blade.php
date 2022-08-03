<form action="{{ route('user.update', $data->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Nama</label>
        <div class="col-sm-10">
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                placeholder="Nama User" value="{{ old('name', $data->nama) }}">
            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-10">
            <input type="text" name="email" class="form-control @error('email') is-invalid @enderror"
                placeholder="Email User" value="{{ old('email', $data->email) }}">
            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Username</label>
        <div class="col-sm-10">
            <input type="text" name="username" class="form-control @error('username') is-invalid @enderror"
                placeholder="Username User" value="{{ old('username', $data->username) }}">
            @error('username')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Golongan</label>
        <div class="col-sm-10">
            <select name="id_golongan" id="id_golongan" class="form-control" style="width: 100%;" required>
                <option value="">Pilih Golongan</option>
                @foreach ($allGol as $gol)
                    <option value="{{ $gol->id }}"
                        {{ old('id_golongan', $data->id_golongan) == $data->id_golongan ? ' selected' : '' }}>
                        {{ $gol->pangkat }}</option>
                @endforeach
            </select>
            @error('id_golongan')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Jabatan</label>
        <div class="col-sm-10">
            <select name="id_jabatan" id="id_jabatan" class="form-control" style="width: 100%;" required>
                <option value="">Pilih Jabatan</option>
                @foreach ($allJab as $jab)
                    <option value="{{ $jab->id }}"
                        {{ old('id_jabatan', $jab->id) == $data->id_jabatan ? ' selected' : '' }}>
                        {{ $jab->jabatan }}</option>
                @endforeach
            </select>
            @error('id_jabatan')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Jenis Pegawai</label>
        <div class="col-sm-10">
            <select name="jenis_pegawai" id="jenis_pegawai"
                class="form-control @error('jenis_pegawai') is-invalid @enderror">
                <option value="">Pilih Jenis Pegawai</option>
                <option value="ASN" {{ old('jenis_pegawai', $data->jenis_pegawai) == 'ASN' ? ' selected' : '' }}>ASN
                </option>
                <option value="PTT-PK" {{ old('jenis_pegawai', $data->jenis_pegawai) == 'PTT-PK' ? ' selected' : '' }}>
                    PTT-PK
                </option>
            </select>
            @error('jenis_pegawai')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Jenis Kelamin</label>
        <div class="col-sm-10">
            <select name="jenis_kelamin" id="jenis_kelamin"
                class="form-control @error('jenis_kelamin') is-invalid @enderror">
                <option value="">Pilih Jenis kelamin</option>
                <option value="L" {{ old('jenis_kelamin', $data->jenis_kelamin) == 'L' ? ' selected' : '' }}>L
                </option>
                <option value="P" {{ old('jenis_kelamin', $data->jenis_kelamin) == 'P' ? ' selected' : '' }}>P
                </option>
            </select>
            @error('jenis_kelamin')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label">NIP</label>
        <div class="col-sm-10">
            <input type="text" name="nip" class="form-control @error('nip') is-invalid @enderror"
                placeholder="NIP User" value="{{ old('nip', $data->nip) }}">
            @error('nip')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Level</label>
        <div class="col-sm-10">
            <select name="level" id="level" class="form-control @error('level') is-invalid @enderror">
                <option value="">Pilih Level</option>
                <option value="Administrator" {{ old('level', $data->level) == 'Administrator' ? ' selected' : '' }}>
                    Administrator</option>
                <option value="Admin" {{ old('level', $data->level) == 'Admin' ? ' selected' : '' }}>Admin
                </option>
                <option value="Kasat" {{ old('level', $data->level) == 'Kasat' ? ' selected' : '' }}>Kasat
                </option>
                <option value="Kabid" {{ old('level', $data->level) == 'Kabid' ? ' selected' : '' }}>Kabid</option>
                <option value="Kabag" {{ old('level', $data->level) == 'Kabag' ? ' selected' : '' }}>Kabag
                </option>
                <option value="Kasubag" {{ old('level', $data->level) == 'Kasubag' ? ' selected' : '' }}>Kasubag
                </option>
                <option value="Kasi" {{ old('level', $data->level) == 'Kasi' ? ' selected' : '' }}>Kasi
                </option>
                <option value="Sekretaris" {{ old('level', $data->level) == 'Sekretaris' ? ' selected' : '' }}>
                    Sekretaris
                </option>
                <option value="Staff" {{ old('level', $data->level) == 'Staff' ? ' selected' : '' }}>Staff
                </option>
                <option value="TU" {{ old('level', $data->level) == 'TU' ? ' selected' : '' }}>TU
                </option>
            </select>
            @error('level')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>



    <button type="submit" class="btn btn-sm btn-primary"><i class="feather icon-save"></i>Simpan</button>
</form>
