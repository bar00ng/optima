<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lop;
use App\Models\Persiapan;
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
            'evidence_selesai' => 'required|file'
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
        }

        if ($r->hasFile('evidence_selesai') && $r->file('evidence_selesai')->isValid()) {
            $file = $r->file('evidence_selesai');
            $fileName = $file->getClientOriginalName();

            $file->storeAs('public/uploads/evidence_selesai', $fileName);

            $querySelesaiFisikDetail = SelesaiFisikDetail::create([
                'selesai_fisik_id' => $querySelesaiFisik->id,
                'evidence_name' => $fileName,
                'isApproved' => null
            ]);
        }

        if ($querySelesaiFisik && $querySelesaiFisikDetail) {
            $message = "Berhasil upload evidence dan keterangan selesai fisik";
        }

        return back()->with('Sukses', $message);
    }

    public function approveSelesaiFisik($approved, $selesai_fisik_id, $evidence_id)
    {
        $selesaiFisik = SelesaiFisik::where('id', $selesai_fisik_id)->first();

        // Get before data
        $data_before = $selesaiFisik->data;

        // Convert json to asosiative array
        $dataArray = json_decode($data_before, true);

        if ($approved == 'false') {
            foreach ($dataArray['data_array'] as &$item) {
                $id = $item['id'];

                if ($id == $evidence_id) {
                    $item['isApproved'] = false;
                }
            }

            $data_after = json_encode($dataArray);

            $selesaiFisik->data = $data_after;
            $selesaiFisik->save();

            $message = "Evidence persiapan di Reject";
        } elseif ($approved == 'true') {
            foreach ($dataArray['data_array'] as &$item) {
                $id = $item['id'];

                if ($id == $evidence_id) {
                    $item['isApproved'] = true;
                }
            }

            $data_after = json_encode($dataArray);

            // update new data
            $selesaiFisik->data = $data_after;
            $selesaiFisik->save();

            $message = "Evidence persiapan di Approve";
        }

        return back()->with('Sukses', $message);
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
