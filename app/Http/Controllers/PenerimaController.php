<?php

namespace App\Http\Controllers;

use App\Http\Requests\PenerimaRequest;
use App\Models\Penerima;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Database\QueryException;

class PenerimaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->param['pageTitle'] = 'Penerima Surat';
        $this->param['pageIcon'] = 'ti-user';
        $this->param['parentMenu'] = '/penerima';
        $this->param['current'] = 'Penerima Surat';
    }
    public function index(Request $request)
    {
        $this->param['btnText'] = 'Tambah';
        $this->param['btnLink'] = route('penerima.create');

        try {
            $keyword = $request->get('keyword');
            $get = Penerima::orderBy('id');

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

        return \view('penerima.index', $this->param);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->param['btnText'] = 'List Penerima Surat';
        $this->param['btnLink'] = route('penerima.index');

        return \view('penerima.create', $this->param);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PenerimaRequest $request)
    {
        $request = $request->validate(
            [
                'penerima' => 'required|max:191|unique:penerima,penerima',
            ],
            [
                'penerima.required' => 'Penerima Surat harus diisi.', 
                'penerima.max' => 'Maksimal jumlah karakter 191.', 
                'penerima.unique' => 'Nama telah digunakan.', 
            ]
        );
        $validated = $request;
        try {
            $penerima = new Penerima;
            $penerima->penerima = $validated['penerima'];
            $penerima->save();
        } catch (Exception $e) {
            return back()->withError('Terjadi kesalahan.');
        } catch (QueryException $e) {
            return back()->withError('Terjadi kesalahan pada database.');
        }

        return redirect()->route('penerima.index')->withStatus('Data berhasil disimpan.');
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
        $this->param['data'] = Penerima::find($id);
        $this->param['btnText'] = 'List Penerima';
        $this->param['btnLink'] = route('penerima.index');

        return view('penerima.edit', $this->param);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PenerimaRequest $request, $id)
    {
        $data = Penerima::findOrFail($id);

        $penerimaUnique = $request['penerima'] != null && $request['penerima'] != $data->penerima ? '|unique:penerima,penerima' : '';

        $request = $request->validate(
            [
                'penerima' => 'required|max:191'.$penerimaUnique,
            ],
            [
                'penerima.required' => 'Penerima Surat harus diisi.', 
                'penerima.max' => 'Maksimal jumlah karakter 191.', 
                'penerima.unique' => 'Nama telah digunakan.', 
            ]
        );

        $validated = $request;

        try {
            $data->penerima = $validated['penerima'];

            $data->save();
        } catch (\Exception $e) {
            return redirect()->back()->withError('Terjadi kesalahan.');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database.');
        }

        return redirect()->route('penerima.index')->withStatus('Data berhasil diperbarui.');
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
            $penerima = Penerima::findOrFail($id);
            $penerima->delete();
        } catch (Exception $e) {
            return back()->withError('Terjadi kesalahan.');
        } catch (QueryException $e) {
            return back()->withError('Terjadi kesalahan pada database.');
        }

        return redirect()->route('penerima.index')->withStatus('Data berhasil dihapus.');
    }
}
