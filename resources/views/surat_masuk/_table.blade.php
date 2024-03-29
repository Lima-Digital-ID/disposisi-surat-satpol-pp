<div class="table-responsive">
    <table class="table table-styling table-de">
        <thead>
            <tr class="table-primary">
                <th class="text-center">#</th>
                <th>No Surat</th>
                <th>Sifat Surat</th>
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
            @forelse ($data as $item)
                {{-- @if (auth()->user()->id == $item->id_pengirim || auth()->user()->level == 'Administrator' || auth()->user()->level == 'Admin' || auth()->user()->level == 'Kasat') --}}
                <tr class="border-bottom-primary">
                    <td class="text-center text-muted">{{ $no }}</td>
                    <td>{{ $item->no_surat }}</td>
                    <td>{{ $item->sifat_surat }}</td>
                    <td>{{ $item->jenis_surat->jenis_surat }}</td>
                    <td>{{ isset($item->pengirim) ? $item->pengirim : $item->pengirim_masuk->pengirim }}</td>
                    {{-- <td>{{ $item->penerima_masuk->nama }}</td> --}}
                    <td>Petugas TU</td>
                    <td>{{ $item->tgl_pengirim }}</td>
                    <td>{{ $item->tgl_penerima }}</td>
                    <td>{{ $item->perihal }}</td>
                    <td align="center"><a href="{{ 'upload/surat_masuk/' . $item->file_surat }}" data-toggle="tooltip" title="Lihat lampiran" target="_blank"
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
                                <button onClick='javasciprt: getSuratMasuk({{ $item->id }})'' type="button"
                                    id="PopoverCustomT-1" class="btn btn-warning btn-sm" data-toggle="modal"
                                    data-target="#disposisiModal" title="Disposisi" data-placement="top"><span
                                        class="feather icon-mail" ja></span></button>
                            </a>
                            <form action="{{ route('surat_masuk.destroy', $item->id) }}" method="post">
                                @csrf
                                @method(' delete') <button type="button" class="btn btn-danger btn-sm"
                                    data-toggle="tooltip" title="Hapus" data-placement="top"
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
            @empty
            <tr class="border-bottom-primary">
                <th colspan="11" class="text-center">Data kosong.</th>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div class="pull-right">
        {{ $data->appends(Request::all())->links('vendor.pagination.custom') }}
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="disposisiModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">

            </div>
            <div class="modal-body">
                <form class="form" action="{{ route('simpan-disposisi') }}" method="POST"
                    enctype="multipart/form-data">



                </form>
            </div>

        </div>
    </div>
</div>
<!-- Modal -->
