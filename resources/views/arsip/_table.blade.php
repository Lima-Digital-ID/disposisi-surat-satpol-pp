<div class="table-responsive">
  <table class="table table-styling table-de">
      <thead>
          <tr class="table-primary">
              <th class="text-center">#</th>
              <th>Surat Masuk</th>
              <th>Surat Keluar</th>
              <th>Lokasi Surat</th>
              <th>Aksi</th>
          </tr>
      </thead>
      <tbody>
          @php
              $page = Request::get('page');
              $no = !$page || $page == 1 ? 1 : ($page - 1) * 10 + 1;
          @endphp
          @foreach ($data as $item)
              <tr class="border-bottom-primary">
                <td class="text-center text-muted">{{ $no }}</td>
                <td>{{ $item->masuk->no_surat }}</td>
                <td>{{ $item->keluar->no_surat }}</td>
                <td>{{ $item->lokasi }}</td>
                <td>
                    <div class="form-inline">
                        <form action="{{ route('arsip.destroy', $item->id) }}" method="post" class="mr-2">
                            @csrf
                            @method('delete')
                            <button type="button" class="btn btn-success btn-sm" data-toggle="tooltip"
                                title="Batalkan Arsip" data-placement="top"
                                onclick="confirm('{{ __('Apakah anda yakin ingin membatalkan arsip?') }}') ? this.parentElement.submit() : ''">
                                <span class="feather icon-upload"></span>
                            </button>
                        </form>
                        {{-- <a href="{{ route('arsip.edit', $item->id) }}" class="mr-2">
                            <button type="button" id="PopoverCustomT-1" class="btn btn-primary btn-sm"
                                data-toggle="tooltip" title="Edit" data-placement="top"><span
                                    class="feather icon-edit"></span></button>
                        </a> --}}
                        {{-- <form action="{{ route('arsip.destroy', $item->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="button" class="btn btn-danger btn-sm" data-toggle="tooltip"
                                title="Hapus" data-placement="top"
                                onclick="confirm('{{ __('Apakah anda yakin ingin menghapus?') }}') ? this.parentElement.submit() : ''">
                                <span class="feather icon-trash"></span>
                            </button>
                        </form> --}}
                    </div>
                </td>
              </tr>
              @php
                  $no++;
              @endphp
          @endforeach
      </tbody>
  </table>
  <div class="pull-right">
    {{$data->appends(Request::all())->links('vendor.pagination.custom')}}
  </div>
</div>