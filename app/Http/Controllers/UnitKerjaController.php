<?php

namespace App\Http\Controllers;

use App\Http\Requests\UnitKerjaRequest;
use App\Models\UnitKerja;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Database\QueryException;

class UnitKerjaController extends Controller
{
    public function __construct()
    {
        $this->param['pageTitle'] = 'Unit Kerja';
        $this->param['pageIcon'] = 'fa fa-database';
        $this->param['parentMenu'] = '/unit_kerja';
        $this->param['current'] = 'Unit Kerja';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->param['btnText'] = 'Tambah';
        $this->param['btnLink'] = route('unit_kerja.create');

        try {
            $keyword = $request->get('keyword');
            $getUnitKerja = UnitKerja::orderBy('id');

            if ($keyword) {
                $getUnitKerja->where('unit_kerja', 'LIKE', "%{$keyword}%");
            }

            $this->param['data'] = $getUnitKerja->paginate(10);
        } catch (\Illuminate\Database\QueryException $e) {
            return back()->withError('Terjadi Kesalahan : ' . $e->getMessage());
        }
        catch (Exception $e) {
            return back()->withError('Terjadi Kesalahan : ' . $e->getMessage());
        }

        return \view('unit_kerja.index', $this->param);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->param['btnText'] = 'List Unit Kerja';
        $this->param['btnLink'] = route('unit_kerja.index');

        return \view('unit_kerja.create', $this->param);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UnitKerjaRequest $request)
    {
        $validated = $request->validated();
        try {
            $unit_kerja = new UnitKerja;
            $unit_kerja->kode = $validated['kode'];
            $unit_kerja->unit_kerja = $validated['unit_kerja'];
            $unit_kerja->save();
        } catch (Exception $e) {
            return back()->withError('Terjadi kesalahan.');
        } catch (QueryException $e) {
            return back()->withError('Terjadi kesalahan pada database.');
        }

        return redirect()->route('unit_kerja.index')->withStatus('Data berhasil disimpan.');
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
        $this->param['data'] = UnitKerja::find($id);
        $this->param['btnText'] = 'List Unit Kerja';
        $this->param['btnLink'] = route('unit_kerja.index');

        return view('unit_kerja.edit', $this->param);
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
        $request = $request->validate(
            [
                'kode' => 'required|max:30',
                'unit_kerja' => 'required|max:191',
            ],
            [
                'kode.required' => 'Kode harus diisi.', 
                'kode.max' => 'Maksimal jumlah karakter 30.',
                'unit_kerja.required' => 'Unit Kerja harus diisi.', 
                'unit_kerja.max' => 'Maksimal jumlah karakter 191.',
            ]
        );

        $validated = $request;
        $unit_kerja = UnitKerja::findOrFail($id);
        try {
            $unit_kerja->kode = $validated['kode'];
            $unit_kerja->unit_kerja = $validated['unit_kerja'];

            $unit_kerja->save();
        } catch (\Exception $e) {
            return redirect()->back()->withError('Terjadi kesalahan.'.$e);
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database.');
        }

        return redirect()->route('unit_kerja.index')->withStatus('Data berhasil diperbarui.');
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
            $unit_kerja = UnitKerja::findOrFail($id);
            $unit_kerja->delete();
        } catch (Exception $e) {
            return back()->withError('Terjadi kesalahan.');
        } catch (QueryException $e) {
            return back()->withError('Terjadi kesalahan pada database.');
        }

        return redirect()->route('unit_kerja.index')->withStatus('Data berhasil dihapus.');
    }
}
