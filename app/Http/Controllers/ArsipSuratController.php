<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArsipSuratRequest;
use App\Models\ArsipSurat;
use App\Models\LokasiSurat;
use App\Models\SuratKeluar;
use App\Models\SuratMasuk;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Database\QueryException;

class ArsipSuratController extends Controller
{
    public function __construct()
    {
        $this->param['pageTitle'] = 'Arsip Surat';
        $this->param['pageIcon'] = 'ti-envelope';
        $this->param['parentMenu'] = '/arsip';
        $this->param['current'] = 'Arsip Surat';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->param['btnText'] = 'Tambah';
        $this->param['btnLink'] = route('arsip.create');

        try {
            $keyword = $request->get('keyword');
            $get = ArsipSurat::select(
                'arsip_surat.*',
                'sm.no_surat as no_surat_masuk',
                'sm.perihal as no_perihal_masuk',
                'sk.no_surat as no_surat_keluar',
                'sk.perihal as no_perihal_keluar',
                'lk.lokasi',
                'jm.jenis_surat as js_masuk',
                'jk.jenis_surat as js_keluar'
            )
            ->leftJoin('surat_masuk as sm', 'sm.id', 'arsip_surat.id_surat_masuk')
            ->leftJoin('surat_keluar as sk', 'sk.id', 'arsip_surat.id_surat_keluar')
            ->join('lokasi_surat as lk', 'lk.id', 'arsip_surat.id_lokasi_surat')
            ->leftJoin('jenis_surat as jm', 'jm.id', 'sm.id_jenis_surat')
            ->leftJoin('jenis_surat as jk', 'jk.id', 'sk.id_jenis_surat')
            ->orderBy('arsip_surat.id');

            if ($keyword) {
                $get->where('arsip_surat.lokasi', 'LIKE', "%{$keyword}%")
                ->orWhere('sm.perihal', 'LIKE', "%{$keyword}%")
                ->orWhere('sk.perihal', 'LIKE', "%{$keyword}%");
            }

            $this->param['data'] = $get->paginate(10);
            // return $this->param['data'];
        } catch (\Illuminate\Database\QueryException $e) {
            return back()->withError('Terjadi Kesalahan : ' . $e->getMessage());
        }
        catch (Exception $e) {
            return back()->withError('Terjadi Kesalahan : ' . $e->getMessage());
        }

        return \view('arsip.index', $this->param);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->param['btnText'] = 'List Arsip Surat';
        $this->param['btnLink'] = route('arsip.index');
        $this->param['lokasi'] = LokasiSurat::orderBy('lokasi')->get();

        return \view('arsip.create', $this->param);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArsipSuratRequest $request)
    {
        $validated = $request->validate(
            [
                'jenis' => 'not_in:0',
                'surat' => 'not_in:0',
                'lokasi' => 'not_in:0'
            ],
            [
                'jenis.not_in' => 'Jenis harus dipilih.',
                'surat.not_in' => 'Surat harus dipilih.',
                'lokasi.not_in' => 'Lokasi surat harus dipilih.',
            ]
        );

        try {
            $newArsip = new ArsipSurat;
            if($validated['jenis'] == 'masuk')
                $newArsip->id_surat_masuk = $validated['surat'];
            if($validated['jenis'] == 'keluar')
                $newArsip->id_surat_keluar = $validated['surat'];
            $newArsip->id_lokasi_surat = $validated['lokasi'];
            $newArsip->save();

            if($validated['jenis'] == 'masuk') {
                // Update status surat
                $surat = SuratMasuk::find($validated['surat']);
                $surat->diarsipkan = true;
                $surat->save();
            }
            if($validated['jenis'] == 'keluar') {
                // Update status surat
                $surat = SuratKeluar::find($validated['surat']);
                $surat->diarsipkan = true;
                $surat->save();
            }

        } catch (Exception $e) {
            return back()->withError('Terjadi kesalahan.');
        } catch (QueryException $e) {
            return back()->withError('Terjadi kesalahan pada database.');
        }

        return redirect()->route('arsip.index')->withStatus('Data berhasil disimpan.');
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
        $this->param['data'] = ArsipSurat::find($id);
        $this->param['btnText'] = 'List Arsip Surat';
        $this->param['btnLink'] = route('arsip.index');

        return view('arsip.edit', $this->param);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ArsipSuratRequest $request, $id)
    {
        $data = ArsipSurat::findOrFail($id);

        $validated = $request->validate();

        try {
            if($validated['jenis'] == 'surat_masuk')
                $data->id_surat_masuk = $validated['surat'];
            if($validated['jenis'] == 'surat_keluar')
                $data->id_surat_keluar = $validated['surat'];
            $data->id_lokasi_surat = $validated['lokasi'];

            $data->save();
        } catch (\Exception $e) {
            return redirect()->back()->withError('Terjadi kesalahan.');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database.');
        }

        return redirect()->route('arsip.index')->withStatus('Data berhasil diperbarui.');
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
            $arsip = ArsipSurat::findOrFail($id);
            if($arsip->id_surat_keluar != '' || $arsip->id_surat_keluar != null){
                $keluar = SuratKeluar::findOrFail($arsip->id_surat_keluar);
                $keluar->diarsipkan = false;
                $keluar->save();
            }else if($arsip->id_surat_masuk != '' || $arsip->id_surat_masuk != null){
                $masuk = SuratMasuk::findOrFail($arsip->id_surat_masuk);
                $masuk->diarsipkan = false;
                $masuk->save();
            }
            ArsipSurat::findOrFail($id)->delete();
        } catch (Exception $e) {
            return back()->withError('Terjadi kesalahan.');
        } catch (QueryException $e) {
            return back()->withError('Terjadi kesalahan pada database.');
        }

        return redirect()->route('arsip.index')->withStatus('Data berhasil dibatalkan.');
    }

    public function restoreArchive(Request $request)
    {
        $masuk = SuratMasuk::get();
        $keluar = SuratKeluar::get();
        ddd($masuk);
        if($masuk != ''){
            echo '$masuk';
        }elseif($keluar != ''){
            echo '$keluar';
        }            
    }
}
