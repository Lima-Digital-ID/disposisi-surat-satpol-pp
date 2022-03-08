<?php

namespace App\Http\Controllers;

use App\Http\Requests\PengirimRequest;
use App\Models\Pengirim;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Database\QueryException;

class PengirimController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->param['pageTitle'] = 'Pengirim Surat';
        $this->param['pageIcon'] = 'ti-user';
        $this->param['parentMenu'] = '/pengirim';
        $this->param['current'] = 'Pengirim Surat';
    }
    public function index(Request $request)
    {
        $this->param['btnText'] = 'Tambah';
        $this->param['btnLink'] = route('pengirim.create');

        try {
            $keyword = $request->get('keyword');
            $get = pengirim::orderBy('id');

            if ($keyword) {
                $get->where('pengirim', 'LIKE', "%{$keyword}%");
            }

            $this->param['data'] = $get->paginate(10);
        } catch (\Illuminate\Database\QueryException $e) {
            return back()->withError('Terjadi Kesalahan : ' . $e->getMessage());
        } catch (Exception $e) {
            return back()->withError('Terjadi Kesalahan : ' . $e->getMessage());
        }

        return \view('pengirim.index', $this->param);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->param['btnText'] = 'List Pengirim Surat';
        $this->param['btnLink'] = route('pengirim.index');

        return \view('pengirim.create', $this->param);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PengirimRequest $request)
    {
        $request = $request->validate(
            [
                'pengirim' => 'required|max:191|unique:pengirim',
            ],
            [
                'pengirim.required' => 'Pengirim Surat harus diisi.',
                'pengirim.max' => 'Maksimal jumlah karakter 191.',
                'pengirim.unique' => 'Nama telah digunakan.',
            ]
        );
        $validated = $request;
        try {
            $pengirim = new Pengirim;
            $pengirim->pengirim = $validated['pengirim'];
            $pengirim->save();
        } catch (Exception $e) {
            return back()->withError('Terjadi kesalahan.');
        } catch (QueryException $e) {
            return back()->withError('Terjadi kesalahan pada database.');
        }

        return redirect()->route('pengirim.index')->withStatus('Data berhasil disimpan.');
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
        $this->param['data'] = Pengirim::find($id);
        $this->param['btnText'] = 'List Pengirim';
        $this->param['btnLink'] = route('pengirim.index');

        return view('pengirim.edit', $this->param);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PengirimRequest $request, $id)
    {
        $data = Pengirim::findOrFail($id);

        $PengirimUnique = $request['pengirim'] != null && $request['pengirim'] != $data->pengirim ? '|unique:pengirim' : '';

        $request = $request->validate(
            [
                'pengirim' => 'required|max:191' . $PengirimUnique,
            ],
            [
                'pengirim.required' => 'Pengirim Surat harus diisi.',
                'pengirim.max' => 'Maksimal jumlah karakter 191.',
                'pengirim.unique' => 'Nama telah digunakan.',
            ]
        );

        $validated = $request;

        try {
            $data->pengirim = $validated['pengirim'];

            $data->save();
        } catch (\Exception $e) {
            return redirect()->back()->withError('Terjadi kesalahan.' . $e);
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database.');
        }

        return redirect()->route('pengirim.index')->withStatus('Data berhasil diperbarui.');
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
            $pengirim = Pengirim::findOrFail($id);
            $pengirim->delete();
        } catch (Exception $e) {
            return back()->withError('Terjadi kesalahan.');
        } catch (QueryException $e) {
            return back()->withError('Terjadi kesalahan pada database.');
        }

        return redirect()->route('pengirim.index')->withStatus('Data berhasil dihapus.');
    }
}
