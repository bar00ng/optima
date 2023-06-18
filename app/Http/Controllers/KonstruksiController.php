<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lop;
use App\Models\Persiapan;
use App\Models\Instalasi;
use App\Models\SelesaiFisik;


class KonstruksiController extends Controller
{
    public function index($lop_id) {
        $pageName = 'List of Project';
        $pageCategory = 'Project';

        $lop = Lop::where('id', $lop_id)
            ->first();
        $persiapan = Persiapan::where('lop_id', $lop_id)
                        ->first();
        $instalasi = Instalasi::where('lop_id', $lop_id)
                        ->first();
        $selesaiFisik = SelesaiFisik::where('lop_id', $lop_id)
                        ->first();

        return view('konstruksi.konstruksi', compact('pageName', 'pageCategory', 'lop', 'persiapan', 'instalasi','selesaiFisik'));
    }

    public function store($lop_id, Request $r) {
        $persiapan = new Persiapan();
        $instalasi = new Instalasi();
        $selesai = new SelesaiFisik();

        if ($r->hasFile('evidence_persiapan') && $r->file('evidence_persiapan')->isValid()) {
            $file = $r->file('evidence_persiapan');
            $fileName = $file->getClientOriginalName();

            $file->store('public/uploads/evidence_persiapan'); 
            $persiapan->lop = $lop_id;
            $persiapan->evidence_persiapan = $fileName;
            $persiapan->save();
        }

        if ($r->hasFile('evidence_instalasi') && $r->file('evidence_instalasi')->isValid()) {
            $file = $r->file('evidence_instalasi');
            $fileName = $file->getClientOriginalName();

            $file->store('public/uploads/evidence_instalasi'); 
            $persiapan->lop = $lop_id;
            $instalasi->evidence_instalasi = $fileName;
            $instalasi->save();
        }

        if ($r->hasFile('evidence_selesai') && $r->file('evidence_selesai')->isValid()) {
            $file = $r->file('evidence_selesai');
            $fileName = $file->getClientOriginalName();

            $file->store('public/uploads/evidence_selesai'); 
            $persiapan->lop = $lop_id;
            $selesai->evidence_selesai = $fileName;
            $selesai->save();
        }
    }
}
