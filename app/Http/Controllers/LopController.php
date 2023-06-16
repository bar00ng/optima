<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ListPermintaan;
use App\Models\Lop;

class LopController extends Controller
{
    public function index() {
        $pageName = "List of Project";
        $pageCategory = "Project";

        return view('lop.list_lop', compact('pageName', 'pageCategory'));
    }

    public function formAddLop($id) {
        $pageName = "Create Project (LOP)";
        $pageCategory = "Project";

        $permintaan = ListPermintaan::where('id',$id)->first();

        return view('lop.formAdd_lop', compact('permintaan', 'pageName', 'pageCategory'));
    }

    public function store(Request $r) {
        try {
            $lop = new Lop();

            $lop->permintaan_id = $r->permintaan_id;
            $lop->nama_lop = $r->nama_lop;
            $lop->tematik_lop = $r->tematik_lop;
            $lop->estimasi_rab = $r->estimasi_rab;
            $lop->sto = $r->sto;
            $lop->tikor_lop = $r->longitude;
            $lop->lokasi_lop = $r->lokasi_lop;
            $lop->keterangan = $r->keterangan;
            $lop->status = 'Survey + RAB';

            $lop->save();

            $lop_id = $lop->id;

            return redirect('/surveyRab/'.$lop_id)->with('Sukses', 'LOP berhasil ditambahkan!');
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    public function edit($id, Request $r) {}

    public function delete($id) {}
}
