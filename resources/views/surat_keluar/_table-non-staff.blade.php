<div class="table-responsive">
    <table class="table table-styling table-de">
        <thead>
            <tr class="table-primary">
                <th class="text-center">#</th>
                <th>No Surat</th>
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
            @forelse ($terusan as $item)
                <tr class="border-bottom-primary">
                    <td class="text-center text-muted">{{ $no }}</td>
                    <td>{{ $item->surat_keluar->no_surat }}</td>
                    <td>{{ $item->pengirim_keluar->nama }}</td>
                    <td>{{ $item->penerima_keluar->nama }}</td>
                    {{-- <td>{{ isset($item->penerima) ? $item->penerima : $item->penerima_keluar->nama }}</td> --}}
                    {{-- <td>{{  }}</td> --}}
                    <td>{{ $item->surat_keluar->tgl_kirim }}</td>
                    <td>{{ $item->surat_keluar->perihal }}</td>
                    <td><a href="{{ 'upload/surat_keluar/' . $item->surat_keluar->file_surat }}" target="_blank"
                            class="btn btn-info btn-sm mr-2"><i class="fa fa-file"></i></a></td>
                    <td>
                        <div class="form-inline">
                            <a href="#" class="mr-2" id="PopoverCustomT-1" data-toggle="tooltip"
                                title="Teruskan" data-placement="top">
                                <button type="button" id="PopoverCustomT-1" class="btn btn-warning btn-sm"
                                    onClick='javascript: getSuratKeluar({{ $item->surat_keluar->id }})''
                                    data-toggle="modal" data-target="#suratKeluarModal" title="Teruskan"
                                    data-placement="top"><span class="feather icon-navigation" ja></span></button>
                            </a>
                        </div>
                    </td>
                </tr>
                @php
                    $no++;
                @endphp
            @empty
                <tr class="border-bottom-primary">
                    <th colspan="8" class="text-center">Data Kosong.</th>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="pull-right">
        {{ $data->appends(Request::all())->links('vendor.pagination.custom') }}
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="suratKeluarModal" role="dialog" aria-labelledby="suratKeluarLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">

            </div>
            <div class="modal-body">
                <form class="form" action="{{ url('store-surat-keluar') }}" method="POST"
                    enctype="multipart/form-data">

                </form>
            </div>

        </div>
    </div>
</div>
<!-- Modal -->
