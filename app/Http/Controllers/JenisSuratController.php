<?php

namespace App\Http\Controllers;

use App\Http\Requests\JenisSuratRequest;
use App\Models\JenisSurat;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Database\QueryException;

class JenisSuratController extends Controller
{
        public function __construct()
    {
        $this->param['pageTitle'] = 'Jenis Surat';
        $this->param['pageIcon'] = 'fa fa-envelope';
        $this->param['parentMenu'] = '/jenis_surat';
        $this->param['current'] = 'Jenis Surat';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->param['btnText'] = 'Tambah';
        $this->param['btnLink'] = route('jenis_surat.create');

        try {
            $keyword = $request->get('keyword');
            $getjenis_surat = JenisSurat::orderBy('id');

            if ($keyword) {
                $getjenis_surat->where('jenis_surat', 'LIKE', "%{$keyword}%");
            }

            $this->param['data'] = $getjenis_surat->paginate(10);
        } catch (\Illuminate\Database\QueryException $e) {
            return back()->withError('Terjadi Kesalahan : ' . $e->getMessage());
        }
        catch (Exception $e) {
            return back()->withError('Terjadi Kesalahan : ' . $e->getMessage());
        }

        return \view('jenis_surat.index', $this->param);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->param['btnText'] = 'List Jenis Surat';
        $this->param['btnLink'] = route('jenis_surat.index');

        return \view('jenis_surat.create', $this->param);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(JenisSuratRequest $request)
    {
        $request = $request->validate(
            [
                'jenis_surat' => 'required|max:191|unique:jenis_surat,jenis_surat',
            ],
            [
                'jenis_surat.required' => 'Jenis Surat harus diisi.', 
                'jenis_surat.max' => 'Maksimal jumlah karakter 191.', 
                'jenis_surat.unique' => 'Nama telah digunakan.', 
            ]
        );
        $validated = $request;
        try {
            $jenis_surat = new JenisSurat;
            $jenis_surat->jenis_surat = $validated['jenis_surat'];
            $jenis_surat->save();
        } catch (Exception $e) {
            return back()->withError('Terjadi kesalahan.');
        } catch (QueryException $e) {
            return back()->withError('Terjadi kesalahan pada database.');
        }

        return redirect()->route('jenis_surat.index')->withStatus('Data berhasil disimpan.');
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
        $this->param['data'] = JenisSurat::find($id);
        $this->param['btnText'] = 'List Jenis Surat';
        $this->param['btnLink'] = route('jenis_surat.index');

        return view('jenis_surat.edit', $this->param);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(JenisSuratRequest $request, $id)
    {
        $data = JenisSurat::findOrFail($id);

        $jenisUnique = $request['jenis_surat'] != null && $request['jenis_surat'] != $data->jenis_surat ? '|unique:jenis_surat,jenis_surat' : '';

        $request = $request->validate(
            [
                'jenis_surat' => 'required|max:191'.$jenisUnique,
            ],
            [
                'jenis_surat.required' => 'Jenis Surat harus diisi.', 
                'jenis_surat.max' => 'Maksimal jumlah karakter 191.', 
                'jenis_surat.unique' => 'Nama telah digunakan.', 
            ]
        );

        $validated = $request;

        try {
            $data->jenis_surat = $validated['jenis_surat'];

            $data->save();
        } catch (\Exception $e) {
            return redirect()->back()->withError('Terjadi kesalahan.');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database.');
        }

        return redirect()->route('jenis_surat.index')->withStatus('Data berhasil diperbarui.');
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
            $jenis = JenisSurat::findOrFail($id);
            $jenis->delete();
        } catch (Exception $e) {
            return back()->withError('Terjadi kesalahan.');
        } catch (QueryException $e) {
            return back()->withError('Terjadi kesalahan pada database.');
        }

        return redirect()->route('jenis_surat.index')->withStatus('Data berhasil dihapus.');
    }
}
