<?php

namespace App\Http\Controllers;

use App\Http\Requests\SuratMasukRequest;
use App\Models\SuratMasuk;
use App\Models\User;
use App\Models\JenisSurat;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Database\QueryException;

class SuratMasukController extends Controller
{
        public function __construct()
    {
        $this->param['pageTitle'] = 'Surat Masuk';
        $this->param['pageIcon'] = 'fa fa-download';
        $this->param['parentMenu'] = '/surat_masuk';
        $this->param['current'] = 'Surat Masuk';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->param['btnText'] = 'Tambah';
        $this->param['btnLink'] = route('surat_masuk.create');

        try {
            $keyword = $request->get('keyword');
            $getSuratMasuk = SuratMasuk::with('jenis_surat','penerima_masuk','pengirim_masuk')->where('id_penerima',auth()->user()->id)->orderBy('id','ASC');
            // $getSuratMasuk = SuratMasuk::orderBy('id');

            if ($keyword) {
                $getSuratMasuk->where('surat_masuk', 'LIKE', "%{$keyword}%");
            }

            $this->param['data'] = $getSuratMasuk->paginate(10);
        } catch (\Illuminate\Database\QueryException $e) {
            return back()->withError('Terjadi Kesalahan : ' . $e->getMessage());
        }
        catch (Exception $e) {
            return back()->withError('Terjadi Kesalahan : ' . $e->getMessage());
        }
        // return $this->param['data'];

        return \view('surat_masuk.index', $this->param);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->param['btnText'] = 'List Surat Masuk';
        $this->param['btnLink'] = route('surat_masuk.index');
        $this->param['allUsr'] = User::get();
        $this->param['allJen'] = JenisSurat::get();

        return \view('surat_masuk.create', $this->param);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SuratMasukRequest $request)
    {
        $validated = $request->validated();
        try {
            $surat = new SuratMasuk;

            $uploadPath = 'upload/surat_masuk/';
            $scanSurat = $validated['file_surat'];
            $newScanSurat = time().'_'.$scanSurat->getClientOriginalName();

            $surat->no_surat = $validated['no_surat'];
            $surat->id_jenis_surat = $validated['id_jenis_surat'];
            $surat->id_penerima = $validated['id_penerima'];
            $surat->pengirim = $validated['pengirim'];
            $surat->tgl_pengirim = $validated['tgl_pengirim'];
            $surat->tgl_penerima = $validated['tgl_penerima'];
            $surat->perihal = $validated['perihal'];
            $surat->file_surat = $newScanSurat;
            if($surat->save()){
                $scanSurat->move($uploadPath,$newScanSurat);
                return redirect()->route('surat_masuk.index')->withStatus('Data berhasil disimpan.');
            }
        } catch (Exception $e) {
            return back()->withError('Terjadi kesalahan.' . $e->getMessage());
        } catch (QueryException $e) {
            return back()->withError('Terjadi kesalahan.' . $e->getMessage());
        }
        return redirect()->route('surat_masuk.index')->withStatus('Data berhasil disimpan.');
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
            $data = SuratMasuk::findOrFail($id);
            $file = 'upload/surat_masuk/'.$data->file_surat;
            if($data->file_surat != '' && $data->file_surat != null){
                unlink($file);
                $data->delete();
            }
        } catch (Exception $e) {
            return back()->withError('Terjadi kesalahan.'.$e);
        } catch (QueryException $e) {
            return back()->withError('Terjadi kesalahan pada database.');
        }

        return redirect()->route('surat_masuk.index')->withStatus('Data berhasil dihapus.');
    }
}
