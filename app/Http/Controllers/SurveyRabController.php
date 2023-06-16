<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SurveyRab;
use App\Models\Lop;

class SurveyRabController extends Controller
{
    public function index($id) {
        $pageCategory = "Dashboard";
        $pageName = "Survey RAB OnDesk";

        $lop = Lop::join('list_permintaan', 'lop.permintaan_id', '=', 'list_permintaan.id')
            ->select('lop.*', 'list_permintaan.*')
            ->where('lop.id', $id)
            ->first();

        return view('survey_rab.formAdd_surveyRab', compact('pageCategory', 'pageName', 'lop'));
    }

    public function store(Request $r) {
        try {
            $surveyRab = new SurveyRab();

            $surveyRab->lop_id = $r->lop_id;
            $surveyRab->rab_ondesk = $r->rab_ondesk;
            $surveyRab->keterangan = $r->keterangan;

            $surveyRab->save();

            Lop::where('id', $r->lop_id)
                ->update([
                    'status' => 'Alokasi Mitra'
                ]);

            // Redirect ke halaman alokasi Mitra
            return redirect('/alokasiMitra/'. $r->lop_id)->with('Sukses', 'Survey + Rab berhasil!');

        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }
}
