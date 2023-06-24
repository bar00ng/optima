<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ListPermintaan;
use App\Models\Lop;
use App\Models\User;
use App\Models\RabApproval;
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

        if($r->filled('estimasi_rab')){
            $lop->estimasi_rab = $r->estimasi_rab;
        }
        $lop->status = 'Alokasi Mitra';

        $lop->save();

        $lop_id = $lop->id;

        if ($toAlokasiMitra == false) {
            return redirect('/lop')->with('Sukses', 'Berhasil menambahkan LOP!');
        } else {
            return redirect('/alokasiMitra/' . $lop_id)->with('Sukses', 'Berhasil menabahkan LOP!');
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
        $validated['status'] = 'Menunggu Approval RAB';

        Lop::where('id', $r->lop_id)->update($validated);
        RabApproval::create([
            'lop_id' => $r->lop_id,
            'isApproved' => false
        ]);

        return redirect('/lop')->with('Sukses', 'Berhasil mengisi Survey! tunggu Approval dari OPTIMA!');
    }

    public function alokasiMitraForm($lop_id)
    {
        $pageCategory = 'Project';
        $pageName = 'Alokasi Mitra';

        $lop = Lop::where('id', $lop_id)->first();
        $mitra = User::whereHasRole('mitra')->get();
        

        return view('alokasi_mitra.form_alokasiMitra', compact('pageCategory', 'pageName', 'lop', 'mitra'));
    }

    public function storeAlokasiMitraForm(Request $r)
    {
        $validated = $r->validate([
            'mitra_id' => 'required',
        ]);
        $validated['status'] = 'Survey + RAB';

        Lop::where('id', $r->lop_id)->update($validated);

        return redirect('/lop')->with('Sukses', 'Berhasil Mengalokasi Mitra!');
    }

    public function edit($id, Request $r)
    {
    }

    public function delete($id)
    {
    }
}
