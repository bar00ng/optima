<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lop;
use App\Models\Persiapan;
use Illuminate\Support\Str;
use App\Models\Instalasi;
use App\Models\SelesaiFisik;
use App\Models\SelesaiFisikDetail;

class KonstruksiController extends Controller
{
    public function index($lop_id)
    {
        $pageName = 'Konstruksi';
        $pageCategory = 'Project';

        $lop = Lop::where('id', $lop_id)->first();

        $persiapan = $lop->persiapan;
       
        $instalasi = $lop->instalasi;
        
        $selesaiFisik = $lop->selesaiFisik;

        return view('konstruksi.konstruksi', compact('pageName', 'pageCategory', 'lop', 'persiapan', 'instalasi', 'selesaiFisik'));
    }

    public function store($lop_id, Request $r)
    {
        // dd($r);
        $validated = $r->validate([
            'keterangan_persiapan' => 'sometimes|required|max:255',
            'keterangan_instalasi' => 'sometimes|required|max:255',
            'keterangan_selesai' => 'sometimes|required|max:255',
        ]);

        if ($r->filled('keterangan_persiapan')) {
            $queryPersiapan = Persiapan::updateOrCreate(
                ['lop_id' => $lop_id],
                [
                    'keterangan_persiapan' => $validated['keterangan_persiapan']
                ]
            );
            if ($queryPersiapan) {
                $message = "Berhasil upload keterangan Persiapan";
            }
        }

        if ($r->filled('keterangan_instalasi')) {
            $queryInstalasi = Instalasi::updateOrCreate(
                ['lop_id' => $lop_id],
                [
                    'keterangan_instalasi' => $validated['keterangan_instalasi']
                ]
            );
            if ($queryInstalasi) {
                $message = "Berhasil upload keterangan Instalasi";
            }
        }

        if ($r->filled('keterangan_selesai')) {
            $querySelesaiFisik = SelesaiFisik::updateOrCreate(
                ['lop_id' => $lop_id],
                [
                    'keterangan_selesai' => $validated['keterangan_selesai']
                ]
            );
            if ($querySelesaiFisik) {
                $message = "Berhasil upload keterangan selesai fisik";
            }
        }

        if ($r->hasFile('evidence_selesai') && $r->file('evidence_selesai')->isValid()) {
            $file = $r->file('evidence_selesai');
            $fileName = Str::random(40) . '.' . $file->getClientOriginalExtension(); // Generate a unique filename
            
            $file->storeAs('public/uploads/evidence_selesai', $fileName);

            $querySelesaiFisikDetail = SelesaiFisikDetail::create([
                'selesai_fisik_id' => $querySelesaiFisik->id,
                'evidence_name' => $fileName,
                'isApproved' => null
            ]);

            if ($querySelesaiFisikDetail) {
                $message = "Berhasil upload evidence selesai fisik";
            }
        }

        return back()->with('Sukses', $message);
    }

    public function approveEvidence($detail_id)
    {
        try {
            $selesaiFisikDetail = SelesaiFisikDetail::where('id', $detail_id)->update([
                'isApproved' => true
            ]);
        
            return response()->json(['message' => 'Evidence Selesai Fisik di Approve']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);
        }        
    }

    public function rejectEvidence($detail_id)
    {
        try {
            $selesaiFisikDetail = SelesaiFisikDetail::where('id', $detail_id)->update([
                'isApproved' => false
            ]);
    
            return response()->json(['message' => 'Evidence Selesai Fisik di Reject']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }

    public function markPersiapanAsDone(Request $request, $isApproved, $persiapan_id)
    {
        // Find the persiapan by ID
        $persiapan = Persiapan::findOrFail($persiapan_id);

        // Update the isApproved field based on the value from the URL
        $persiapan->isApproved = filter_var($isApproved, FILTER_VALIDATE_BOOLEAN);
        $persiapan->save();

        // update status lop
        $lop = $persiapan->lop;
        $lop->status = "Persiapan";
        $lop->save();

        // Return a response if needed (e.g., JSON response)
        return response()->json(['message' => 'Persiapan updated successfully']);
    }

    public function markInstalasiAsDone(Request $request, $isApproved, $instalasi_id)
    {
        // Find the persiapan by ID
        $instalasi = Instalasi::findOrFail($instalasi_id);

        // Update the isApproved field based on the value from the URL
        $instalasi->isApproved = filter_var($isApproved, FILTER_VALIDATE_BOOLEAN);
        $instalasi->save();

        // update status lop
        $lop = $instalasi->lop;
        $lop->status = "Instalasi";
        $lop->save();

        // Return a response if needed (e.g., JSON response)
        return response()->json(['message' => 'Instalasi updated successfully']);
    }

    public function markSelesaiAsDone(Request $request, $isApproved, $selesai_fisik_id)
    {
        // Find the persiapan by ID
        $selesaiFisik = SelesaiFisik::findOrFail($selesai_fisik_id);

        // Update the isApproved field based on the value from the URL
        $selesaiFisik->isApproved = filter_var($isApproved, FILTER_VALIDATE_BOOLEAN);
        $selesaiFisik->save();

        // update status lop
        $lop = $selesaiFisik->lop;
        $lop->status = "Selesai Fisik";
        $lop->save();

        // Return a response if needed (e.g., JSON response)
        return response()->json(['message' => 'Selsai Fisik updated successfully']);
    }
}
