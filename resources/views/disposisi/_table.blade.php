<div class="table-responsive">
  <table class="table table-styling table-de">
      <thead>
          <tr class="table-primary">
              <th class="text-center">#</th>
              <th>Sifat Surat</th>
              <th>Surat Masuk</th>
              <th>Surat Keluar</th>
              <th>Pengirim</th>
              <th>Penerima</th>
              <th>Tanggal Disposisi</th>
              <th>Catatan</th>
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
          <!-- {{-- @if (auth()->user()->id == $item->id_pengirim || auth()->user()->level == 'Administrator' || auth()->user()->level == 'Admin' || auth()->user()->id == $item->id_penerima ) --}} -->
              <tr class="border-bottom-primary">
                <td class="text-center text-muted">{{ $no }}</td>
                <td>{{ $item->sifat_surat }}</td>
                <td>{{ $item->masuk->perihal }}</td>
                <td>{{ $item->keluar->perihal }}</td>
                <td>{{ $item->pengirim->nama }}</td>
                <td>{{ $item->penerima->nama }}</td>
                <td>{{ $item->tgl_disposisi }}</td>
                <td>{{ $item->catatan }}</td>
                @if ($item->id_surat_masuk != null || $item->id_surat_masuk != '')
                <td align="center"><a href="{{ "upload/surat_masuk/".$item->masuk->file_surat }}" target="_blank" class="btn btn-info btn-sm mr-2"><i class="fa fa-file"></i></a></td>
                @elseif($item->id_surat_keluar != null || $item->id_surat_keluar != '')
                <td align="center"><a href="{{ "upload/surat_keluar/".$item->keluar->file_surat }}" target="_blank" class="btn btn-info btn-sm mr-2"><i class="fa fa-file"></i></a></td>
                @endif
                <td>
                    <div class="form-inline">
                        {{-- <a href="{{ route('disposisi.edit', $item->id) }}" class="mr-2">
                            <button type="button" id="PopoverCustomT-1" class="btn btn-primary btn-sm"
                                data-toggle="tooltip" title="Edit" data-placement="top"><span
                                    class="feather icon-edit"></span></button>
                        </a> --}}
                        <form action="{{ route('disposisi.destroy', $item->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="button" class="btn btn-danger btn-sm" data-toggle="tooltip"
                                title="Hapus" data-placement="top"
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
            <!-- {{-- @endif --}} -->
          @endforeach
      </tbody>
  </table>
  <div class="pull-right">
    {{$data->appends(Request::all())->links('vendor.pagination.custom')}}
  </div>
</div>