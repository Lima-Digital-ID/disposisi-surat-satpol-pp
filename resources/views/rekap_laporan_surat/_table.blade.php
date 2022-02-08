<div class="row">
    <div class="" style="margin-left:15px;margin-top:5px;">
        <span>Pilih Surat : </span>
    </div>
    <div class="col-sm-2">
        <select name="jenis_surat" id="tipe" class="form-control">
            <option value="">Pilih Jenis Surat</option>
            <option value="0">Surat Keluar</option>
            <option value="1">Surat Masuk</option>
        </select>
    </div>
    <div class="" style="margin-left:15px;margin-top:5px;">
        <span>Dari : </span>
    </div>
    <div class="col-sm-2">
        <input type="date" class="form-control" name="dari" id="dari">
    </div>
    <div class="" style="margin-left:15px;margin-top:5px;">
        <span>Sampai : </span>
    </div>
    <div class="col-sm-2">
        <input type="date" class="form-control" name="sampai" id="sampai">
    </div>
    <button class="btn btn-sm btn-primary" onclick="getRekap()"><i class="feather icon-search"></i></button>
    
</div>
<br>
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
          </tr>
      </thead>
      <tbody>
          @php
              $page = Request::get('page');
              $no = !$page || $page == 1 ? 1 : ($page - 1) * 10 + 1;
          @endphp
              <tr class="border-bottom-primary">
                <td class="text-center text-muted">{{ $no }}</td>
                <td>tes</td>
                <td>tes</td>
                <td>tes</td>
                <td>tes</td>
                <td>tes</td>
                <td>tes</td>
                <td>tes</td>
              </tr>
              @php
                  $no++;
              @endphp
      </tbody>
  </table>
  <div class="pull-right">
    {{-- {{$data->appends(Request::all())->links('vendor.pagination.custom')}} --}}
  </div>
</div>