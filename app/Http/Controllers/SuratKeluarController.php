<?php

namespace App\Http\Controllers;

use App\Http\Requests\SuratKeluarRequest;
use App\Models\SuratKeluar;
use App\Models\User;
use App\Models\JenisSurat;
use App\Models\Terusan;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;

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
            $where = '';
            $where1 = '';
            $where2 = '';
            if (auth()->user()->level == "TU" || auth()->user()->level == 'Administrator') {
                $where = 'Kasat';
            } elseif (auth()->user()->level == "Kasat") {
                $where1 = 'TU';
                $where2 = 'Administrator';
            } elseif (auth()->user()->level == "Kabid") {
                $where = 'Kasat';
            } elseif (auth()->user()->level == "Sekretaris") {
                $where = 'Kasat';
            } elseif (auth()->user()->level == "Kasubag") {
                $where = 'Sekretaris';
            } elseif (auth()->user()->level == "Kasi") {
                $where = 'Kabid';
            } elseif (auth()->user()->level == "Staff") {
                $where1 = 'Kasubag';
                $where2 = 'Kasi';
            }
            $getAnggota = User::from('users as u')
                ->select(
                    'u.*',
                )->where('u.id', "!=", auth()->user()->id);
            if (auth()->user()->level != "Kasat" && auth()->user()->level != "Staff") {
                $getAnggota = $getAnggota->where('u.level', $where);
            }
            else {
                $getAnggota = $getAnggota->where('u.level', $where1);
                $getAnggota = $getAnggota->orWhere('u.level', $where2);
            }
            // $getAnggota = $getAnggota->whereNotIn('u.id', function ($query) use ($id) {
            //     $where = $_GET['tipe'] == 0 ? 'id_surat_keluar' : 'id_surat_masuk';
            //     $query->select('id_penerima')
            //         ->from('disposisi')

            //         ->where($where, $id)
            //         ->get();
            // })->get();
            $getSuratKeluar = SuratKeluar::with('jenis_surat', 'penerima_keluar', 'pengirim_keluar')
                                        ->where('id_pengirim', auth()->user()->id)
                                        ->orWhere('id_penerima', auth()->user()->id)
                                        ->where('diarsipkan', '0')->orderBy('id', 'ASC');
            // if (auth()->user()->level == 'staff') {
            //     $getSuratKeluar->where('id_pengirim', auth()->user()->id);
            // }
            // $getSuratKeluar->where('diarsipkan', '0')->orderBy('id', 'ASC');

            if ($keyword) {
                $getSuratKeluar->where('perihal', 'LIKE', "%{$keyword}%");
            }

            $this->param['data'] = $getSuratKeluar->paginate(10);
            $this->param['user'] = $getAnggota->get();
            $this->param['terusan'] = Terusan::with('surat_keluar','pengirim_keluar', 'penerima_keluar')
                                ->where('id_pengirim', auth()->user()->id)
                                ->orWhere('id_penerima', auth()->user()->id)->get();
                                // ddd($this->param['terusan']);
        } catch (\Illuminate\Database\QueryException $e) {
            return $e->getMessage();
            return back()->withError('Terjadi Kesalahan : ' . $e->getMessage());
        } catch (Exception $e) {
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
        $this->param['allUsr'] = User::with('golongan', 'jabatan','unit_kerja')->where('level','Kasi')->orWhere('level', 'Kasubag')->get();
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

            // upload surat
            $uploadPath = 'upload/surat_keluar/';
            $scanSurat = $request->file('file_surat');
            $newScanSurat = time() . '_' . $scanSurat->getClientOriginalName();

            $surat->no_surat = $validated['no_surat'];
            // $surat->id_jenis_surat = $validated['id_jenis_surat'];
            $surat->id_pengirim = $request->get('id_pengirim');
            // $surat->penerima = $request->get('penerima');

            if (is_numeric($request->penerima)) // Penerima dari master
                $surat->id_penerima = $request->get('penerima');
            else // Penerima baru
                $surat->penerima = $request->get('penerima');

            $surat->tgl_kirim = $request->get('tgl_kirim');
            $surat->perihal = $validated['perihal'];
            $surat->file_surat = $newScanSurat;
            if ($surat->save()) {
                $scanSurat->move($uploadPath, $newScanSurat);
                // $paraf($paraf, $image_base64);
                $terusan = new Terusan;
                $terusan->id_pengirim = Auth::user()->id;
                $terusan->id_penerima = $request->get('penerima');
                $terusan->id_surat_keluar = $surat->id;
                $terusan->catatan = $request->get('catatan');
                $terusan->save();
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
        // $this->param['allUsr'] = User::get();
        if (auth()->user()->level == 'Kasubag')
        {
            $getUser = User::with('golongan', 'jabatan','unit_kerja')->where('level','Kabag')->get();
        } elseif (auth()->user()->level == 'Kabag') {
            $getUser = User::with('golongan', 'jabatan','unit_kerja')->where('level','Kasat')->get();
        } elseif (auth()->user()->level == 'Anggota'){
            $getUser = User::with('golongan', 'jabatan','unit_kerja')->where('level','Kasi')->orWhere('level', 'Kasubag')->get();
        }
        $this->param['allJen'] = JenisSurat::get();
        // ddd(auth()->user()->level == 'Kabag');
        $this->param['allUsr'] = $getUser;
        // ddd($this->param['allUsr']);

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
        // $surat = SuratKeluar::findOrFail($id);
        $validated = $request->validated();

        try {
            $surat = new SuratKeluar;
            // upload paraf
            // $folderPath = public_path('upload/paraf/');
            $folderPath = 'upload/paraf/';
            // $paraf = $request->file('paraf');
            $image_parts = explode(";base64,", $request->paraf);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $newParaf = $folderPath . uniqid() . '.' . $image_type;
            // file_put_contents($paraf, $image_base64);
            $surat->no_surat = $validated['no_surat'];
            $surat->id_pengirim = $request->get('id_pengirim');
            $surat->penerima = $request->get('penerima');

            if (is_numeric($request->penerima)) // Penerima dari master
                $surat->id_penerima = $request->get('penerima');
            else // Penerima baru
                $surat->penerima = $request->get('penerima');

            $surat->tgl_kirim = $request->get('tgl_kirim');
            $surat->paraf = $newParaf;
            $surat->perihal = $validated['perihal'];
            $surat->file_surat = $validated['file_surat'];
            if ($surat->save()) {
                file_put_contents($newParaf, $image_base64);
                return redirect()->route('surat_keluar.index')->withStatus('Data berhasil disimpan.');
            }
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
    public function destroy($id)
    {
        try {
            $data = SuratKeluar::findOrFail($id);
            $file = 'upload/surat_keluar/' . $data->file_surat;
            if ($data->file_surat != '' && $data->file_surat != null) {
                unlink($file);
                $data->delete();
            }
        } catch (Exception $e) {
            return back()->withError('Terjadi kesalahan.' . $e);
        } catch (QueryException $e) {
            return back()->withError('Terjadi kesalahan pada database.');
        }
        return redirect()->route('surat_keluar.index')->withStatus('Data berhasil dihapus.');
    }

    public function getSuratKeluarJson()
    {
        $get = SuratKeluar::orderBy('id')->get();

        $data = array(
            'data' => $get,
        );

        return $data;
    }

    public function save_surat_keluar(Request $request)
    {
        try {
            $surat = new SuratKeluar;

            // upload surat
            // $uploadPath = 'upload/surat_keluar/';
            // $scanSurat = $request->file('file_surat');
            // $newScanSurat = time() . '_' . $scanSurat->getClientOriginalName();

            $surat->no_surat = $request->get('no_surat');
            $surat->id_pengirim = $request->get('id_pengirim');

            if (is_numeric($request->penerima)) // Penerima dari master
                $surat->id_penerima = $request->get('penerima');
            else // Penerima baru
                $surat->penerima = $request->get('penerima');

            $surat->tgl_kirim = $request->get('tgl_kirim');
            $surat->perihal = $request->get('perihal');
            $surat->file_surat = '1'.$request->get('file_surat');
            if ($surat->save()) {
                // $scanSurat->move($uploadPath, $newScanSurat);
                // $paraf($paraf, $image_base64);
                return redirect()->route('surat_keluar.index')->withStatus('Data berhasil disimpan.');
            }
        } catch (Exception $e) {
            return back()->withError('Terjadi kesalahan.' . $e->getMessage());
        } catch (QueryException $e) {
            return back()->withError('Terjadi kesalahan.' . $e->getMessage());
        }

        return redirect()->route('surat_keluar.index')->withStatus('Data berhasil disimpan.');
    }

    public function getSuratKeluar($id)
    {
        $getSuratKeluar = SuratKeluar::find($id);
        echo json_encode($getSuratKeluar);
    }

    public function storeSuratKeluar(Request $request)
    {
        try{
            $surat = new Terusan;
            $surat->id_pengirim = Auth::user()->id;
            if (is_numeric($request->penerima)) // Penerima dari master
                $surat->id_penerima = $request->get('penerima');
            else // Penerima baru
                $surat->penerima = $request->get('penerima');
            $surat->id_surat_keluar = $request->get('id_surat_keluar');
            $surat->catatan = $request->get('catatan');
            $surat->save();
        } catch (\Exception $e) {
            return redirect()->back()->withError('Terjadi kesalahan.');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database.');
        }

        return back()->withStatus('Data berhasil diperbarui.');
    }
}
