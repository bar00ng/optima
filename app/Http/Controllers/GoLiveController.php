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

        if ($r->has('isNeed')) {
            // Kalau radio Dengan Go Live di checklist
            if($r->isNeed == "true") {
                $goLive->isNeed = true;
                Lop::where('id', $lop_id)->update([
                    'status' => 'Selesai'
                ]);
            }
            // Kalau radio Tanpa Go Live di checklist 
            elseif ($r->isNeed == "false") {
                $validated = $r->validate([
                    'keterangan_withoutGoLive' => 'required'
                ]);
                $goLive->isNeed = false;
                $goLive->keterangan_withoutGolive = $validated['keterangan_withoutGoLive'];
            }
            $goLive->lop_id = $lop_id;

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

            $file->storeAs('public/uploads/evidence_golive', $fileName); 
            $goLive->evidence_golive = $fileName;

            if ($r->filled('keterangan_withGolive')) {
                $goLive->keterangan_withGolive = $r->keterangan_withGolive;
            }

            GoLive::where('lop_id', $lop_id)
                ->update($goLive->toArray());

            Lop::where('id', $lop_id)->update([
                    'status' => 'GoLive'
                ]);
        }
        
        // Get all progress
        Validasi::where('lop_id', $lop_id)->update([
            'validasi_progress' => $r->validasi_progress
        ]);

        KonfirmasiMitra::where('lop_id', $lop_id)->update([
            'konfirmasi_mitra_progress' => $r->konfirmasi_mitra_progress
        ]);

        Connectivity::where('lop_id', $lop_id)->update([
            'connectivity_progress' => $r->connectivity_progress
        ]);

        $check_golive = GoLive::where('lop_id', $lop_id)->first();
        if ($check_golive->isNeed === 1) {
            GoLive::where('lop_id', $lop_id)->update([
                'golive_progress' => $r->golive_progress
            ]);
        }

        return redirect('/goLive/'. $lop_id)->with('Sukses', 'Berhasil diproses!');
    }
}
