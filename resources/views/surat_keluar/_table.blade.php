<div class="table-responsive">
  <table class="table table-styling table-de">
      <thead>
          <tr class="table-primary">
              <th class="text-center">#</th>
              <th>No Surat</th>
              <th>Jenis Surat</th>
              <th>Pengirim Surat</th>
              <th>Penerima Surat</th>
              <th>Tanggal Kirim Surat</th>
              <th>Perihal Surat</th>
              <th>Lampiran Surat</th>
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
                <td>{{ $item->jenis_surat->jenis_surat }}</td>
                <td>{{ $item->pengirim_keluar->nama }}</td>
                <td>{{ $item->penerima }}</td>
                <td>{{ $item->tgl_kirim }}</td>
                <td>{{ $item->perihal }}</td>
                <td><a href="{{ "upload/surat_keluar/".$item->file_surat }}" target="_blank" class="btn btn-info btn-sm mr-2"><i class="fa fa-file"></i></a></td>
                <td>
                    <div class="form-inline">
                        <a href="{{ route('surat_keluar.edit', $item->id) }}" class="mr-2">
                            <button type="button" id="PopoverCustomT-1" class="btn btn-primary btn-sm"
                                data-toggle="tooltip" title="Edit" data-placement="top"><span
                                    class="feather icon-edit"></span></button>
                        </a>
                        <form action="{{ route('surat_keluar.destroy', $item->id) }}" method="post">
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
            {{-- @endif --}}
          @endforeach
      </tbody>
  </table>
  <div class="pull-right">
    {{$data->appends(Request::all())->links('vendor.pagination.custom')}}
  </div>
</div>