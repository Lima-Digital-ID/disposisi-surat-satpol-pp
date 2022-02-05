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
            // $getDisposisi = Disposisi::orderBy('id');
            $getDisposisi = Disposisi::with('penerima','pengirim')->where('id_pengirim',auth()->user()->id)->orwhere('id_pengirim',auth()->user()->id)->orderBy('id','ASC');
            // $getDisposisi = Disposisi::with('penerima','pengirim')->orderBy('id','ASC');

            if ($keyword) {
                $getDisposisi->where('disposisi', 'LIKE', "%{$keyword}%");
            }

            $this->param['data'] = $getDisposisi->paginate(10);
        } catch (\Illuminate\Database\QueryException $e) {
            return back()->withError('Terjadi Kesalahan : ' . $e->getMessage());
        }
        catch (Exception $e) {
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
        $this->param['allUsr'] = User::where('id', '!=' , auth()->user()->id)->get();
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
            // $disposisi->id_surat_masuk = auth()->user()->id;
            $disposisi->sifat_surat = $validated['sifat_surat'];
            $disposisi->id_surat_keluar = $request->get('id_surat_keluar');
            $disposisi->id_pengirim = $validated['id_pengirim'];
            $disposisi->id_penerima = $validated['id_penerima'];
            $disposisi->tgl_disposisi = $validated['tgl_disposisi'];
            $disposisi->catatan = $validated['catatan'];
            // ddd($disposisi);
            $disposisi->save();
        } catch (Exception $e) {
            return back()->withError('Terjadi kesalahan.'.$e);
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
}
