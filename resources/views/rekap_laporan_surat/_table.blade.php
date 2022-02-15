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
    <div class="col-sm-3">
        <input type="date" class="form-control" name="dari" id="dari">
    </div>
    <div class="" style="margin-left:15px;margin-top:5px;">
        <span>Sampai : </span>
    </div>
    <div class="col-sm-3">
        <input type="date" class="form-control" name="sampai" id="sampai">
    </div>
    <button class="btn btn-sm btn-primary" onclick="getRekap()"><i class="feather icon-search"></i></button>
    
</div>
<br>
<div class="table-responsive">
  <table class="table table-styling table-de" id="myTable">
    <thead id="myHead">

    </thead>      
      <tbody id="myBody">
          @php
              $page = Request::get('page');
              $no = !$page || $page == 1 ? 1 : ($page - 1) * 10 + 1;
          @endphp
              <tr class="border-bottom-primary">
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