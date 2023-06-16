<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lop;
use App\Models\AlokasiMitra;

class AlokasiMitraController extends Controller
{
    public function index($id)
    {
        $pageCategory = 'Dashboard';
        $pageName = 'Alokasi Mitra';

        $lop = Lop::join('list_permintaan', 'list_permintaan.id', '=', 'lop.permintaan_id')
            ->join('survey_rab', 'survey_rab.lop_id', '=', 'lop.id')
            ->select('lop.id','lop.nama_lop','lop.tematik_lop','lop.sto','lop.tikor_lop','lop.keterangan','lop.lokasi_lop', 'list_permintaan.tanggal_permintaan','list_permintaan.nama_permintaan', 'survey_rab.rab_ondesk','survey_rab.keterangan')
            ->where('lop.id', $id)
            ->first();

        return view('alokasi_mitra.form_alokasiMitra', compact('pageCategory', 'pageName', 'lop'));
    }

    public function store(Request $r)
    {
        try {
            $alokasiMitra = new AlokasiMitra();

            $alokasiMitra->id_lop = $r->lop_id;
            $alokasiMitra->alokasi_mitra = $r->alokasi_mitra;

            $alokasiMitra->save();

            Lop::where('id', $r->lop_id)->update([
                'status' => 'Persiapan',
            ]);

            // return view('')
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }
}
