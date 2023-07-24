<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use App\Models\Lop;
use App\Models\Validasi;
use App\Models\KonfirmasiMitra;
use App\Models\Connectivity;
use App\Models\GoLive;

class GoLiveController extends Controller
{
    public function index($lop_id)
    {
        $pageName = 'Go Live';
        $pageCategory = 'Project';

        $data = [
            'pageName' => $pageName,
            'pageCategory' => $pageCategory,
            'lop' => Lop::find($lop_id),
            'validasi' => Validasi::where('lop_id', $lop_id)->first(),
            'konfirmasiMitra' => KonfirmasiMitra::where('lop_id', $lop_id)->first(),
            'connectivity' => Connectivity::where('lop_id', $lop_id)->first(),
            'goLive' => GoLive::where('lop_id', $lop_id)->first(),
        ];

        return view('golive-odp.golive-odp', $data);
    }

    public function store($lop_id, Request $request)
    {
        $request->validate([
            'keterangan_withoutGoLive' => 'required_if:isNeed,false',
            'evidence_golive' => 'file|max:10240',
            'validasi_progress' => 'integer|between:0,100',
            'konfirmasi_mitra_progress' => 'integer|between:0,100',
            'connectivity_progress' => 'integer|between:0,100',
            'golive_progress' => 'integer|between:0,100',
        ]);

        $goLiveData = [
            'isNeed' => $request->filled('isNeed') ? $request->isNeed == "true" : null,
            'lop_id' => $lop_id,
        ];

        // Handle file upload if evidence_golive exists and is valid
        if ($request->hasFile('evidence_golive') && $request->file('evidence_golive')->isValid()) {
            $file = $request->file('evidence_golive');
            $fileName = Str::random(40) . '.' . $file->getClientOriginalExtension(); // Generate a unique filename
            $file->storeAs('public/uploads/evidence_golive', $fileName);

            $goLiveData['evidence_golive'] = $fileName;
        }

        // Check if keterangan_withGolive is filled
        if ($request->filled('keterangan_withGoLive')) {
            $goLiveData['keterangan_withGolive'] = $request->input('keterangan_withGoLive');
        }
        $goLiveData['isApproved'] = null;

        // Check if keterangan_withoutGoLive is filled
        if ($request->filled('keterangan_withoutGoLive')) {
            $goLiveData['keterangan_withoutGoLive'] = $request->input('keterangan_withoutGoLive');
        }

        // Check if keterangan_validasi is filled
        if ($request->filled('keterangan_validasi')) {
            $validasiData = [
                'keterangan_validasi' => $request->input('keterangan_validasi'),
            ];
        }
        $validasiData['isApproved'] = null;

        // Check if keterangan_konfirmasi_mitra is filled
        if ($request->filled('keterangan_konfirmasi_mitra')) {
            $konfirmasiMitraData = [
                'keterangan_konfirmasi_mitra' => $request->input('keterangan_konfirmasi_mitra'),
            ];
        }
        $konfirmasiMitraData['isApproved'] = null;

        // Check if keterangan_connectivity is filled
        if ($request->filled('keterangan_connectivity')) {
            $connectivityData = [
                'keterangan_connectivity' => $request->input('keterangan_connectivity'),
            ];
        }
        $connectivityData['isApproved'] = null;

        // dd($request->all(), $goLiveData);

        GoLive::updateOrCreate(['lop_id' => $lop_id], $goLiveData);

        Validasi::updateOrCreate(['lop_id' => $lop_id], $validasiData);

        KonfirmasiMitra::updateOrCreate(['lop_id' => $lop_id], $konfirmasiMitraData);

        Connectivity::updateOrCreate(['lop_id' => $lop_id], $connectivityData);

        return redirect('/goLive/' . $lop_id)->with('Sukses', 'Berhasil diproses!');
    }

    public function markValidasiAsDone(Request $request, $lop_id) {
        $validasi = Validasi::where('lop_id',$lop_id)->firstOrFail();

        // Update the isApproved field based on the value from the URL
        $validasi->isApproved = true;
        $validasi->save();

        // update status lop
        $lop = $validasi->lop;
        $lop->status = "Validasi";
        $lop->save();

        // Return a response if needed (e.g., JSON response)
        return response()->json(['message' => 'GoLiveODP updated successfully']);
    }

    public function markKonfirmasiMitraAsDone(Request $request, $lop_id) {
        $konfirmasiMitra = KonfirmasiMitra::where('lop_id',$lop_id)->firstOrFail();

        // Update the isApproved field based on the value from the URL
        $konfirmasiMitra->isApproved = true;
        $konfirmasiMitra->save();

        // update status lop
        $lop = $konfirmasiMitra->lop;
        $lop->status = "Konfirmasi Mitra";
        $lop->save();

        // Return a response if needed (e.g., JSON response)
        return response()->json(['message' => 'GoLiveODP updated successfully']);
    }

    public function markConnectivityAsDone(Request $request, $lop_id) {
        $connectivity = Connectivity::where('lop_id',$lop_id)->firstOrFail();

        // Update the isApproved field based on the value from the URL
        $connectivity->isApproved = true;
        $connectivity->save();

        // update status lop
        $lop = $connectivity->lop;
        $lop->status = "Connectivity";
        $lop->save();

        // Return a response if needed (e.g., JSON response)
        return response()->json(['message' => 'GoLiveODP updated successfully']);
    }

    public function markOdpAsDone(Request $request, $lop_id) {
        $goLive = GoLive::where('lop_id',$lop_id)->firstOrFail();

        // Update the isApproved field based on the value from the URL
        $goLive->isApproved = true;
        $goLive->save();

        // update status lop
        $lop = $goLive->lop;
        $lop->status = "GoLive";
        $lop->save();

        // Return a response if needed (e.g., JSON response)
        return response()->json(['message' => 'GoLiveODP updated successfully']);
    }
}
