<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lop;
use App\Models\Validasi;
use App\Models\KonfirmasiMitra;
use App\Models\Connectivity;
use App\Models\GoLive;

class GoLiveController extends Controller
{
    public function index($lop_id) {
        $pageName = 'Go Live';
        $pageCategory = 'Project';

        $lop = Lop::where('id', $lop_id)
            ->first();
        $validasi = Validasi::where('lop_id', $lop_id)
            ->first();
        $konfirmasiMitra = KonfirmasiMitra::where('lop_id', $lop_id)
            ->first();
        $connectivity = Connectivity::where('lop_id', $lop_id)
            ->first();
        $goLive = GoLive::where('lop_id', $lop_id)
            ->first();

        return view('golive-odp.golive-odp', compact('pageName', 'pageCategory', 'lop', 'validasi', 'konfirmasiMitra', 'connectivity', 'goLive'));
    }

    public function store($lop_id, Request $r){
        $validasi = new Validasi();
        $konfirmasiMitra = new KonfirmasiMitra();
        $connectivity = new Connectivity();
        $goLive = new GoLive();

        if ($r->has('is_withGoLive')) {
            // Kalau radio Dengan Go Live di checklist
            if($r->is_withGoLive == true) {
                $goLive->lop_id = $lop_id;
                $goLive->is_withGolive = true;
            }
            // Kalau radio Tanpa Go Live di checklist 
            elseif ($r->is_withGoLive == false) {
                $goLive->lop_id = $lop_id;
                $goLive->is_withGolive = false;
                $goLive->keterangan_withoutGolive = $r->keterangan_withoutGoLive;
            }

            $goLive->save();
        }

        if ($r->filled('keterangan_validasi')) {
            $validasi->lop_id = $lop_id;
            $validasi->keterangan_validasi = $r->keterangan_validasi;

            $validasi->save();
        }

        if ($r->filled('keterangan_konfirmasi_mitra')) {
            $konfirmasiMitra->lop_id = $lop_id;
            $konfirmasiMitra->keterangan_konfirmasi_mitra = $r->keterangan_konfirmasi_mitra;

            $konfirmasiMitra->save();
        }

        if ($r->filled('keterangan_connectivity')) {
            $connectivity->lop_id = $lop_id;
            $connectivity->keterangan_connectivity = $r->keterangan_connectivity;

            $connectivity->save();
        }

        if ($r->hasFile('evidence_golive') && $r->file('evidence_golive')->isValid()) {
            $file = $r->file('evidence_golive');
            $fileName = $file->getClientOriginalName();

            $file->store('public/uploads/evidence_golive'); 
            $goLive->evidence_golive = $fileName;

            if ($r->filled('keterangan_withGolive')) {
                $goLive->keterangan_withGolive = $r->keterangan_withGolive;
            }

            GoLive::where('lop_id', $lop_id)
                ->update($goLive->toArray());
        }

        return redirect('/goLive/'. $lop_id)->with('Sukses', 'Berhasil diproses!');
    }
}
