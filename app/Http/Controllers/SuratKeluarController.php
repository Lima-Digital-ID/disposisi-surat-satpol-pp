<?php

namespace App\Http\Controllers;

use App\Http\Requests\SuratKeluarRequest;
use App\Models\SuratKeluar;
use App\Models\User;
use App\Models\JenisSurat;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Database\QueryException;

class SuratKeluarController extends Controller
{
    public function __construct()
    {
        $this->param['pageTitle'] = 'Surat Keluar';
        $this->param['pageIcon'] = 'fa fa-upload';
        $this->param['parentMenu'] = '/surat_keluar';
        $this->param['current'] = 'Surat Keluar';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->param['btnText'] = 'Tambah';
        $this->param['btnLink'] = route('surat_keluar.create');

        try {
            $keyword = $request->get('keyword');
            $getSuratKeluar = SuratKeluar::with('jenis_surat','penerima_keluar','pengirim_keluar')->where('id_pengirim',auth()->user()->id)->orderBy('id','ASC');

            if ($keyword) {
                $getSuratKeluar->where('surat_keluar', 'LIKE', "%{$keyword}%");
            }

            $this->param['data'] = $getSuratKeluar->paginate(10);
        } catch (\Illuminate\Database\QueryException $e) {
            return back()->withError('Terjadi Kesalahan : ' . $e->getMessage());
        }
        catch (Exception $e) {
            return back()->withError('Terjadi Kesalahan : ' . $e->getMessage());
        }

        return \view('surat_keluar.index', $this->param);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->param['btnText'] = 'List Surat Keluar';
        $this->param['btnLink'] = route('surat_keluar.index');
        $this->param['allUsr'] = User::get();
        $this->param['allJen'] = JenisSurat::get();

        return \view('surat_keluar.create', $this->param);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SuratKeluarRequest $request)
    {
        $validated = $request->validated();
        try {
            $surat = new SuratKeluar;

            $uploadPath = 'upload/surat_keluar/';
            $scanSurat = $request->file('file_surat');
            $newScanSurat = time().'_'.$scanSurat->getClientOriginalName();  

            $surat->no_surat = $validated['no_surat'];
            $surat->id_jenis_surat = $validated['id_jenis_surat'];
            $surat->penerima = $validated['penerima'];
            $surat->id_pengirim = $validated['id_pengirim'];
            $surat->tgl_kirim = $validated['tgl_kirim'];
            $surat->perihal = $validated['perihal'];
            $surat->file_surat = $newScanSurat;
            if($surat->save()){
                $scanSurat->move($uploadPath,$newScanSurat);
                return redirect()->route('surat_keluar.index')->withStatus('Data berhasil disimpan.');
            }
        } catch (Exception $e) {
            return back()->withError('Terjadi kesalahan.' . $e->getMessage());
        } catch (QueryException $e) {
            return back()->withError('Terjadi kesalahan.' . $e->getMessage());
        }

        return redirect()->route('surat_keluar.index')->withStatus('Data berhasil disimpan.');
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
        $this->param['data'] = SuratKeluar::find($id);
        $this->param['btnText'] = 'List Surat Keluar';
        $this->param['btnLink'] = route('surat_keluar.index');

        return view('surat_keluar.edit', $this->param);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SuratKeluarRequest $request, $id)
    {
        $surat = SuratKeluar::findOrFail($id);
        $validated = $request->validated();

        try {
            $surat->no_surat = $validated['no_surat'];
            $surat->id_jenis_surat = $validated['id_jenis_surat'];
            $surat->id_penerima = $validated['id_penerima'];
            $surat->id_pengirim = $validated['id_pengirim'];
            $surat->tgl_kirim = $validated['tgl_kirim'];
            $surat->perihal = $validated['perihal'];
            $surat->file_surat = $validated['file_surat'];
            $surat->save();
        } catch (\Exception $e) {
            return redirect()->back()->withError('Terjadi kesalahan.');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database.');
        }

        return redirect()->route('jabatan.index')->withStatus('Data berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try {
            $surat = SuratKeluar::find($request->id);
            unlink("upload/surat/".$surat->file_surat);
            // $surat->delete();
            SuratKeluar::where("id", $surat->id)->delete();
        } catch (Exception $e) {
            return back()->withError('Terjadi kesalahan.');
        } catch (QueryException $e) {
            return back()->withError('Terjadi kesalahan pada database.');
        }

        return redirect()->route('surat_keluar.index')->withStatus('Data berhasil dihapus.');
    }
}
