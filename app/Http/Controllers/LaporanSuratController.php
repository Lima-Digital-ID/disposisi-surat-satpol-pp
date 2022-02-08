<?php

namespace App\Http\Controllers;

use App\Models\SuratKeluar;
use App\Models\SuratMasuk;
use App\Models\User;
use App\Models\JenisSurat;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Database\QueryException;

class LaporanSuratController extends Controller
{
    public function __construct()
    {
        $this->param['pageTitle'] = 'Rekap Laporan Surat';
        $this->param['pageIcon'] = 'ti-agenda';
        $this->param['parentMenu'] = '/rekap_laporan_surat';
        $this->param['current'] = 'Rekap Laporan Surat';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        try {
            $dari = $request->get('dari');
            $sampai = $request->get('sampai');
            if($request->get('jenis_surat') == '0'){
                $getSuratMasuk = SuratMasuk::with('jenis_surat','penerima_keluar','pengirim_keluar')->whereBetween('created_at', [$dari, $sampai])->orderBy('id','ASC');
                $this->param['data'] = $getSuratMasuk->paginate(10);
            }else{
                $getSuratKeluar = SuratKeluar::with('jenis_surat','penerima_keluar','pengirim_keluar')->whereBetween('created_at', [$dari, $sampai])->orderBy('id','ASC');
                $this->param['data'] = $getSuratKeluar->paginate(10);
            }
        } catch (\Illuminate\Database\QueryException $e) {
            return back()->withError('Terjadi Kesalahan : ' . $e->getMessage());
        }
        catch (Exception $e) {
            return back()->withError('Terjadi Kesalahan : ' . $e->getMessage());
        }

        return \view('rekap_laporan_surat.index', $this->param);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    // public function laporan($waktu_mulai,$waktu_selesai)
    // {
    //     $suratMasuk = SuratMasuk::with('jenis_surat','penerima_keluar','pengirim_keluar')->whereBetween('created_at', [$waktu_mulai, $waktu_selesai])->orderBy('id','ASC');
    //     return $suratMasuk;
    // }


    public function getLaporan(Request $request)
    {
        if($request->get('tipe') == '0'){
            $dari = $request->get('dari');
            $sampai = $request->get('sampai');
            $tipe = $request->get('tipe');
            $getSuratKeluar = SuratKeluar::with('jenis_surat','pengirim_keluar')->whereBetween('tgl_kirim', [$dari,$sampai])->orderBy('id','ASC')->get();
            return $getSuratKeluar;
            // echo json_encode($getSuratKeluar);
        }else{
            $dari = $request->get('dari');
            $sampai = $request->get('sampai');
            $tipe = $request->get('tipe');
            $getSuratMasuk = $getSuratMasuk = SuratMasuk::with('jenis_surat','penerima_masuk','pengirim_masuk')->where('tgl_penerima',[$dari,$sampai])->orderBy('id','ASC')->get();
            return $getSuratMasuk;
            // echo json_encode($getSuratMasuk);
        }
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }
}
