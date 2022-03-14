<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuratMasuk;
use App\Models\SuratKeluar;
use App\Models\Disposisi;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }

    public function grafikSurat()
    {
        $year = date('Y');
        $month = [
            '01',
            '02',
            '03',
            '04',
            '05',
            '06',
            '07',
            '08',
            '09',
            '10',
            '11',
            '12',
        ];

        $data = array();
        
        for ($i=0; $i < count($month); $i++) { 
            $suratMasuk = SuratMasuk::
            // select(
            //     DB::raw('count(id) as data'),
                // DB::raw("DATE_FORMAT(tgl_pengirim, '%Y-%m') as date"),
                // DB::raw('YEAR(tgl_pengirim) as year, MONTH(tgl_pengirim) as month')
            // )
            // ->whereYear('tgl_pengirim', $year)
            whereMonth('tgl_pengirim', $month[$i])
            // ->groupBy('date','year','month')
            ->count();
    
            $suratKeluar = SuratKeluar::
            // select(
            //     DB::raw('count(id) as data'),
                // DB::raw("DATE_FORMAT(tgl_kirim, '%Y-%m') as date"),
                // DB::raw('YEAR(tgl_kirim) as year, MONTH(tgl_kirim) as month')
            // )
            // ->whereYear('tgl_kirim', $year)
            whereMonth('tgl_kirim', $month[$i])
            // ->groupBy('date','year','month')
            ->count();
            
            $diposisi = Disposisi::
            // select(
            //     DB::raw('count(id) as data'),
                // DB::raw("DATE_FORMAT(tgl_disposisi, '%Y-%m') as date"),
                // DB::raw('YEAR(tgl_disposisi) as year, MONTH(tgl_disposisi) as month')
            // )
            // ->whereYear('tgl_disposisi', $year)
            whereMonth('tgl_disposisi', $month[$i])
            // ->groupBy('date','year','month')
            ->count();

            $arr = array(
                'y' => $year.'-'.$month[$i],
                'in' => $suratMasuk,
                'out' => $suratKeluar,
                'disposisi' => $diposisi
            );

            array_push($data, $arr);
        }

        return json_encode($data);
    }
}
