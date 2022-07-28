<?php

namespace App\Http\Controllers;

use App\Http\Requests\DisposisiRequest;
use App\Models\Disposisi;
use App\Models\User;
use App\Models\SuratMasuk;
use App\Models\SuratKeluar;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Database\QueryException;

class DisposisiController extends Controller
{
    private $param;

    public function __construct()
    {
        $this->param['pageTitle'] = 'Disposisi';
        $this->param['pageIcon'] = 'fa fa-envelope';
        $this->param['parentMenu'] = '/disposisi';
        $this->param['current'] = 'Disposisi';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->param['btnText'] = 'Tambah';
        $this->param['btnLink'] = route('disposisi.create');
        try {
            $keyword = $request->get('keyword');
            $getDisposisi = Disposisi::with('penerima', 'pengirim')
                // if(auth()->user()->level=='Anggota'){
                //     $getDisposisi->where('id_penerima',auth()->user()->id)->orwhere('id_penerima',auth()->user()->id);
                // }
                ->where('id_pengirim', auth()->user()->id)->orwhere('id_penerima', auth()->user()->id)
                // $getDisposisi->orderBy('id','ASC');
                ->orderBy('id', 'ASC');

            if ($keyword) {
                $getDisposisi->where('disposisi', 'LIKE', "%{$keyword}%");
            }

            $this->param['data'] = $getDisposisi->paginate(10);
        } catch (\Illuminate\Database\QueryException $e) {
            return back()->withError('Terjadi Kesalahan : ' . $e->getMessage());
        } catch (Exception $e) {
            return back()->withError('Terjadi Kesalahan : ' . $e->getMessage());
        }

        return \view('disposisi.index', $this->param);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->param['btnText'] = 'List Disposisi';
        $this->param['btnLink'] = route('disposisi.index');
        // $this->param['allUsr'] = User::where('id', '!=' , auth()->user()->id)->get();
        $getAnggota = User::from('users as u')
            ->select(
                'u.*',
            )
            ->where('id', '!=', auth()->user()->id);
        $getAnggota = $getAnggota->whereNotIn('u.id', function ($query) {
            $query->select('dis.id_penerima')
                ->from('disposisi as dis');
        })->get();
        $this->param['allUsr'] = $getAnggota;
        $this->param['allMsk'] = SuratMasuk::get();
        $this->param['allKlr'] = SuratKeluar::get();

        return \view('disposisi.create', $this->param);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DisposisiRequest $request)
    {
        $validated = $request->validated();
        try {
            $disposisi = new Disposisi;
            $disposisi->id_surat_masuk = $request->get('id_surat_masuk');
            $disposisi->sifat_surat = $validated['sifat_surat'];
            $disposisi->id_surat_keluar = $request->get('id_surat_keluar');
            $disposisi->id_pengirim = $request->get('id_pengirim');
            $disposisi->id_penerima = $validated['id_penerima'];
            $disposisi->tgl_disposisi = $validated['tgl_disposisi'];
            $disposisi->catatan = $validated['catatan'];
            $disposisi->save();
        } catch (Exception $e) {
            return back()->withError('Terjadi kesalahan.' . $e);
        } catch (QueryException $e) {
            return back()->withError('Terjadi kesalahan pada database.');
        }

        return redirect()->route('disposisi.index')->withStatus('Data berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $data = Disposisi::findOrFail($id);
            $data->delete();
        } catch (Exception $e) {
            return back()->withError('Terjadi kesalahan.');
        } catch (QueryException $e) {
            return back()->withError('Terjadi kesalahan pada database.');
        }

        return redirect()->route('disposisi.index')->withStatus('Data berhasil dihapus.');
    }

    public function getDisposisi($id)
    {
        // echo auth()->user()->level;
        $where = '';
        $where1 = '';
        $where2 = '';
        if (auth()->user()->level == "TU" || auth()->user()->level == 'Administrator') {
            $where = 'Kasat';
        } elseif (auth()->user()->level == "Kasat") {
            $where1 = 'Kabid';
            $where2 = 'Sekretaris';
        } elseif (auth()->user()->level == "Kabid") {
            $where = 'Kasi';
        } elseif (auth()->user()->level == "Sekretaris") {
            $where = 'Kasubag';
        } elseif (auth()->user()->level == "Kasubag" || auth()->user()->level == "Kasi") {
            $where = 'Staff';
        } elseif (auth()->user()->level == "Staff") {
            $where1 = 'Kasubag';
            $where2 = 'Kasi';
        }
        $getAnggota = User::from('users as u')
            ->select(
                'u.*',
            )->where('u.id', "!=", auth()->user()->id);
        // ->where('u.level', $where)
        if (auth()->user()->level != "Kasat" && auth()->user()->level != "Staff") {
            $getAnggota = $getAnggota->where('u.level', $where);
        }
        //  elseif (auth()->user()->level == "Staff") {
        //     $getAnggota = $getAnggota->where('u.level', $where1);
        //     $getAnggota = $getAnggota->orWhere('u.level', $where2);
        // }
        else {
            $getAnggota = $getAnggota->where('u.level', $where1);
            $getAnggota = $getAnggota->orWhere('u.level', $where2);
        }
        $getAnggota = $getAnggota->whereNotIn('u.id', function ($query) use ($id) {
            $where = $_GET['tipe'] == 0 ? 'id_surat_keluar' : 'id_surat_masuk';
            $query->select('id_penerima')
                ->from('disposisi')

                ->where($where, $id)
                ->get();
        })->get();
        echo json_encode($getAnggota);
    }

    public function cetakDisposisi($id)
    {
        $this->param['data'] = Disposisi::with('pengirim', 'masuk', 'masuk.jenis_surat')->find($id);
        // ddd($this->param['data']->masuk->id_pengirim);
        return \view('disposisi.cetak_lembar_disposisi', $this->param);
        // return redirect()->route('disposisi.index');
    }
}
