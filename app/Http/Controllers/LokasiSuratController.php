<?php

namespace App\Http\Controllers;

use App\Http\Requests\LokasiSuratRequest;
use App\Models\LokasiSurat;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Database\QueryException;

class LokasiSuratController extends Controller
{
    public function __construct()
    {
        $this->param['pageTitle'] = 'Lokasi Surat';
        $this->param['pageIcon'] = 'ti-envelope';
        $this->param['parentMenu'] = '/lokasi-surat';
        $this->param['current'] = 'Lokasi Surat';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->param['btnText'] = 'Tambah';
        $this->param['btnLink'] = route('lokasi-surat.create');

        try {
            $keyword = $request->get('keyword');
            $get = LokasiSurat::orderBy('id');

            if ($keyword) {
                $get->where('lokasi', 'LIKE', "%{$keyword}%");
            }

            $this->param['data'] = $get->paginate(10);
        } catch (\Illuminate\Database\QueryException $e) {
            return back()->withError('Terjadi Kesalahan : ' . $e->getMessage());
        }
        catch (Exception $e) {
            return back()->withError('Terjadi Kesalahan : ' . $e->getMessage());
        }

        return \view('lokasi_surat.index', $this->param);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->param['btnText'] = 'List Lokasi Surat';
        $this->param['btnLink'] = route('lokasi-surat.index');

        return \view('lokasi_surat.create', $this->param);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LokasiSuratRequest $request)
    {
        $request = $request->validate(
            [
                'lokasi' => 'required|max:191|unique:lokasi_surat,lokasi',
            ],
            [
                'lokasi.required' => 'Lokasi Surat harus diisi.', 
                'lokasi.max' => 'Maksimal jumlah karakter 191.', 
                'lokasi.unique' => 'Nama telah digunakan.', 
            ]
        );
        $validated = $request;
        try {
            $lokasi = new LokasiSurat;
            $lokasi->lokasi = $validated['lokasi'];
            $lokasi->save();
        } catch (Exception $e) {
            return back()->withError('Terjadi kesalahan.');
        } catch (QueryException $e) {
            return back()->withError('Terjadi kesalahan pada database.');
        }

        return redirect()->route('lokasi-surat.index')->withStatus('Data berhasil disimpan.');
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
        $this->param['data'] = LokasiSurat::find($id);
        $this->param['btnText'] = 'List Lokasi Surat';
        $this->param['btnLink'] = route('lokasi-surat.index');

        return view('lokasi_surat.edit', $this->param);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LokasiSuratRequest $request, $id)
    {
        $data = LokasiSurat::findOrFail($id);

        $lokasiUnique = $request['lokasi'] != null && $request['lokasi'] != $data->lokasi ? '|unique:lokasi_surat,lokasi' : '';

        $request = $request->validate(
            [
                'lokasi' => 'required|max:191'.$lokasiUnique,
            ],
            [
                'lokasi.required' => 'Lokasi Surat harus diisi.', 
                'lokasi.max' => 'Maksimal jumlah karakter 191.', 
                'lokasi.unique' => 'Nama telah digunakan.', 
            ]
        );

        $validated = $request;

        try {
            $data->lokasi = $validated['lokasi'];

            $data->save();
        } catch (\Exception $e) {
            return redirect()->back()->withError('Terjadi kesalahan.');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database.');
        }

        return redirect()->route('lokasi-surat.index')->withStatus('Data berhasil diperbarui.');
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
            $jenis = LokasiSurat::findOrFail($id);
            $jenis->delete();
        } catch (Exception $e) {
            return back()->withError('Terjadi kesalahan.');
        } catch (QueryException $e) {
            return back()->withError('Terjadi kesalahan pada database.');
        }

        return redirect()->route('lokasi-surat.index')->withStatus('Data berhasil dihapus.');
    }
}
