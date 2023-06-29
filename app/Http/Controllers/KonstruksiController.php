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
        $pageName = 'Konstruksi';
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

            $file->storeAs('public/uploads/evidence_persiapan', $fileName); 
            $persiapan->lop_id = $lop_id;
            $persiapan->evidence_persiapan = $fileName;
            
            if ($r->keterangan_persiapan !== '') {
                $persiapan->keterangan_persiapan = $r->keterangan_persiapan;
            }

            $persiapan->save();

            Lop::where('id', $lop_id)
                ->update([
                    'status' => 'Instalasi'
                ]);
        }

        if ($r->hasFile('evidence_instalasi') && $r->file('evidence_instalasi')->isValid()) {
            $file = $r->file('evidence_instalasi');
            $fileName = $file->getClientOriginalName();

            $file->storeAs('public/uploads/evidence_instalasi', $fileName); 
            $instalasi->lop_id = $lop_id;
            $instalasi->evidence_instalasi = $fileName;

            if ($r->keterangan_instalasi !== '') {
                $instalasi->keterangan_instalasi = $r->keterangan_instalasi;
            }

            $instalasi->save();
            
            Lop::where('id', $lop_id)
                ->update([
                    'status' => 'Selesai Fisik'
                ]);
        }

        if ($r->hasFile('evidence_selesai') && $r->file('evidence_selesai')->isValid()) {
            $file = $r->file('evidence_selesai');
            $fileName = $file->getClientOriginalName();

            $file->storeAs('public/uploads/evidence_selesai', $fileName); 
            $selesai->lop_id = $lop_id;
            $selesai->evidence_selesai = $fileName;

            if ($r->keterangan_selesai !== '') {
                $selesai->keterangan_selesai = $r->keterangan_selesai;
            }

            $selesai->save();
        }

        return redirect('/konstruksi/'. $lop_id)->with('Sukses', 'Proses upload evidence berhasil');
    }

    public function approvePersiapan($approved, $persiapan_id) {
        if ($approved == "false") {
            Persiapan::where('id', $persiapan_id)->update([
                'isApproved' => false
            ]);

            return back()->with('Sukses', 'Evidence persiapan ditolak');
        } elseif ($approved == "true") {
            Persiapan::where('id', $persiapan_id)->update([
                'isApproved' => true
            ]);

            return back()->with('Sukses', 'Evidence persiapan disetujui');
        }
    }

    public function approveInstalasi($approved, $instalasi_id) {
        if ($approved == "false") {
            Instalasi::where('id', $instalasi_id)->update([
                'isApproved' => false
            ]);

            return back()->with('Sukses', 'Evidence instalasi ditolak');
        } elseif ($approved == "true") {
            Instalasi::where('id', $instalasi_id)->update([
                'isApproved' => true
            ]);

            return back()->with('Sukses', 'Evidence instalasi disetujui');
        }
    }

    public function approveSelesaiFisik($approved, $selesai_fisik_id) {
        if ($approved == "false") {
            SelesaiFisik::where('id', $selesai_fisik_id)->update([
                'isApproved' => false
            ]);

            return back()->with('Sukses', 'Evidence selesai fisik ditolak');
        } elseif ($approved == "true") {
            SelesaiFisik::where('id', $selesai_fisik_id)->update([
                'isApproved' => true
            ]);

            return back()->with('Sukses', 'Evidence selesai fisik disetujui');
        }
    }
}
