<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ListPermintaan;
use App\Models\Lop;
use Carbon\Carbon;

class LopController extends Controller
{
    public function index($id_permintaan = null)
    {
        $pageName = 'List of Project';
        $pageCategory = 'Project';

        if ($id_permintaan !== null) {
            $lop = Lop::where('permintaan_id', $id_permintaan)->get();
        } else {
            $lop = Lop::get();
        }

        return view('lop.list_lop', compact('pageName', 'pageCategory', 'lop'));
    }

    public function formAddLop($permintaan_id)
    {
        $pageName = 'Create Project (LOP)';
        $pageCategory = 'Project';
        $currentDate = Carbon::now()->format('m-d-Y');

        $permintaan = ListPermintaan::where('id', $permintaan_id)->first();

        return view('lop.formAdd_lop', compact('permintaan', 'pageName', 'pageCategory', 'currentDate'));
    }

    public function storeLop(Request $r, $toAlokasiMitra = false)
    {
        $validated = $r->validate([
            'tanggal_permintaan' => 'required',
            'permintaan_id' => 'required',
            'nama_lop' => 'required',
            'tematik_lop' => 'required',
            'sto' => 'required',
            'longitude' => 'required',
            'latitude' => 'required',
            'lokasi_lop' => 'required',
            'keterangan_lop' => 'required',
        ]);

        $lop = new Lop();
        $lop->tanggal_permintaan = $validated['tanggal_permintaan'];
        $lop->permintaan_id = $validated['permintaan_id'];
        $lop->nama_lop = $validated['nama_lop'];
        $lop->tematik_lop = $validated['tematik_lop'];
        $lop->sto = $validated['sto'];
        $lop->longitude = $validated['longitude'];
        $lop->latitude = $validated['latitude'];
        $lop->lokasi_lop = $validated['lokasi_lop'];
        $lop->keterangan_lop = $validated['keterangan_lop'];

        if ($r->tematik_lop == 'PT 2') {
            $lop->estimasi_rab = $r->estimasi_rab;
            if ($toAlokasiMitra == true) {
                $lop->rab_ondesk = "< 20 Jt";
                $lop->keterangan_rab = "Kurang dari 20 Jt";
                $lop->status = 'Alokasi Mitra';
            } else {
                $lop->status = 'Survey + RAB';
            }
        } elseif ($r->tematik_lop == 'HEM') {
            $lop->estimasi_rab = '';
            $lop->status = 'Survey + RAB';
        }

        $lop->save();

        $lop_id = $lop->id;

        if ($toAlokasiMitra == false) {
            return redirect('/surveyRab/' . $lop_id)->with('Sukses', 'LOP berhasil ditambahkan!');
        } else {
            return redirect('/alokasiMitra/' . $lop_id)->with('Sukses', 'Survey + Rab berhasil dibuat!');
        }
    }

    public function surveyRabForm($lop_id)
    {
        $pageCategory = 'Project';
        $pageName = 'Alokasi Mitra';

        $lop = Lop::where('id', $lop_id)->first();

        return view('survey_rab.formAdd_surveyRab', compact('pageCategory', 'pageName', 'lop'));
    }

    public function storeSurveyRabForm(Request $r)
    {
        $validated = $r->validate([
            'rab_ondesk' => 'required',
            'keterangan_rab' => 'required',
        ]);
        $validated['status'] = 'Alokasi Mitra';

        Lop::where('id', $r->lop_id)->update($validated);

        return redirect('/alokasiMitra/' . $r->lop_id)->with('Sukses', 'Survey + Rab berhasil dibuat!');
    }

    public function alokasiMitraForm($lop_id)
    {
        $pageCategory = 'Project';
        $pageName = 'Alokasi Mitra';

        $lop = Lop::where('id', $lop_id)->first();

        return view('alokasi_mitra.form_alokasiMitra', compact('pageCategory', 'pageName', 'lop'));
    }

    public function storeAlokasiMitraForm(Request $r)
    {
        $validated = $r->validate([
            'alokasi_mitra' => 'required',
        ]);
        $validated['status'] = 'Persiapan';

        Lop::where('id', $r->lop_id)->update($validated);

        return redirect('/lop')->with('Sukses', 'Berhasil menambahkan LOP baru!');
    }

    public function edit($id, Request $r)
    {
    }

    public function delete($id)
    {
    }
}
