<div class="table-responsive">
    <table class="table table-styling table-de">
        <thead>
            <tr class="table-primary">
                <th class="text-center">#</th>
                <th>No Surat</th>
                <th>Jenis Surat</th>
                <th>Pengirim Surat</th>
                <th>Penerima Surat</th>
                <th>Tanggal Surat</th>
                <th>Tanggal Terima Surat</th>
                <th>Perihal Surat</th>
                <th>Lampiran</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php
                $page = Request::get('page');
                $no = !$page || $page == 1 ? 1 : ($page - 1) * 10 + 1;
            @endphp
            @foreach ($data as $item)
                {{-- @if (auth()->user()->id == $item->id_pengirim || auth()->user()->level == 'Administrator' || auth()->user()->level == 'Admin' || auth()->user()->level == 'Kasat') --}}
                <tr class="border-bottom-primary">
                    <td class="text-center text-muted">{{ $no }}</td>
                    <td>{{ $item->no_surat }}</td>
                    <td>{{ $item->sifat_surat }}</td>
                    <td>{{ isset($item->pengirim) ? $item->pengirim : $item->pengirim_masuk->pengirim }}</td>
                    {{-- <td>{{ $item->penerima_masuk->nama }}</td> --}}
                    <td>Petugas TU</td>
                    <td>{{ $item->tgl_pengirim }}</td>
                    <td>{{ $item->tgl_penerima }}</td>
                    <td>{{ $item->perihal }}</td>
                    <td align="center"><a href="{{ 'upload/surat_masuk/' . $item->file_surat }}" target="_blank"
                            class="btn btn-info btn-sm mr-2"><i class="fa fa-file"></i></a></td>
                    <td>
                        <div class="form-inline">
                            <a href="{{ route('surat_masuk.edit', $item->id) }}" class="mr-2">
                                <button type="button" id="PopoverCustomT-1" class="btn btn-primary btn-sm"
                                    data-toggle="tooltip" title="Edit" data-placement="top"><span
                                        class="feather icon-edit"></span></button>
                            </a>
                            <a href="#" class="mr-2" id="PopoverCustomT-1" data-toggle="tooltip"
                                title="Disposisi" data-placement="top">
                                <button type="button" id="PopoverCustomT-1" class="btn btn-warning btn-sm"
                                    data-toggle="modal" data-target="#disposisiModal" title="Disposisi"
                                    data-placement="top"><span class="feather icon-mail"></span></button>
                            </a>
                            <form action="{{ route('surat_masuk.destroy', $item->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="tooltip" title="Hapus"
                                    data-placement="top"
                                    onclick="confirm('{{ __('Apakah anda yakin ingin menghapus?') }}') ? this.parentElement.submit() : ''">
                                    <span class="feather icon-trash"></span>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @php
                    $no++;
                @endphp
                {{-- @endif --}}
            @endforeach
        </tbody>
    </table>
    <div class="pull-right">
        {{ $data->appends(Request::all())->links('vendor.pagination.custom') }}
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="disposisiModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Disposisi No Surat : 123</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    @csrf
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Sifat Surat</label>
                        <div class="col-sm-10">
                            <select name="sifat_surat" id="sifat_surat"
                                class="form-control @error('sifat_surat') is-invalid @enderror">
                                <option value="">Pilih Sifat Surat</option>
                                <option value="Penting" {{ old('sifat_surat') == 'Penting' ? ' selected' : '' }}>
                                    Penting</option>
                                <option value="Rahasia" {{ old('sifat_surat') == 'Rahasia' ? ' selected' : '' }}>
                                    Rahasia
                                </option>
                                <option value="Biasa" {{ old('sifat_surat') == 'Biasa' ? ' selected' : '' }}>Biasa
                                </option>
                                <option value="Pribadi" {{ old('sifat_surat') == 'Pribadi' ? ' selected' : '' }}>
                                    Pribadi
                                </option>
                            </select>
                            @error('sifat_surat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <input type="hidden" name="id_pengirim" value="{{ auth()->user()->id }}">

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Penerima</label>
                        <div class="col-sm-10">
                            <select name="id_penerima[]" id="id_penerima" multiple class="js-example-basic-single"
                                style="width: 100%;" required>
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
                            <input type="date" name="tgl_disposisi"
                                class="form-control @error('tgl_disposisi') is-invalid @enderror"
                                value="{{ old('tgl_disposisi') }}">
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
                            <input type="text" name="catatan"
                                class="form-control @error('catatan') is-invalid @enderror" placeholder="Catatan"
                                value="{{ old('catatan') }}">
                            @error('catatan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    {{-- <button type="submit" class="btn btn-sm btn-primary"><i
                            class="feather icon-save"></i>Simpan</button> --}}
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i
                        class="feather icon-x"></i>Tutup</button>
                <button type="submit" class="btn btn-primary"><i class="feather icon-save"></i>Simpan</button>
                {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
