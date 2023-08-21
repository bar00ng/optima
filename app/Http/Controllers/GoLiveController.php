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
use App\Models\WithGoLive;
use App\Models\WithoutGoLive;
use App\Models\WithGoLiveDetail;

class GoLiveController extends Controller
{
    public function index($lop_id)
    {
        $pageName = 'Go Live';
        $pageCategory = 'Project';

        $lop = Lop::find($lop_id);
        $validasiData = $lop->validasi;
        $konfirmasiMitraData = $lop->konfirmasiMitra;
        $connectivityData = $lop->connectivity;
        $goLiveData = $lop->goLive;

        return view('golive-odp.golive-odp', compact('lop', 'validasiData', 'konfirmasiMitraData', 'connectivityData', 'goLiveData', 'pageName', 'pageCategory'));
    }

    public function store($lop_id, Request $request)
    {
        $validated = $request->validate([
            'isNeed' => 'required',
            'keterangan_tanpa_golive' => 'required_if:isNeed,false',
            'keterangan_validasi' => 'sometimes|required|max:255',
            'keterangan_konfirmasi_mitra' => 'sometimes|required|max:255',
            'keterangan_connectivity' => 'sometimes|required|max:255',
            'keterangan_dengan_golive' => 'sometimes|required_if:isNeed,true|max:255',
        ]);

        if ($request->isNeed == "true") {
            // Check Terlebih dahulu jika ada data Golive Yang sama dengan value isNeed yang beda
            $findGoLive = GoLive::where('lop_id', $lop_id)->first();

            if(!is_null($findGoLive) && $findGoLive->isNeed == false) {
                $findGoLive->delete();
            } 
            
            $queryGolive = GoLive::updateOrcreate(
                ['lop_id' => $lop_id],
                [
                    'lop_id' => $lop_id,
                    'isNeed' => true,
                    'isApproved' => null,
                ]); 

            if($queryGolive){
                WithGoLive::updateOrcreate(
                    ['go_live_id' => $queryGolive->id],
                    [
                        'go_live_id' => $queryGolive->id,
                        'keterangan_golive' => null
                    ]);

                $message = "Berhasil update status Go Live ODP";
            }

        } elseif ($request->isNeed == "false") {
            $findGoLive = GoLive::where('lop_id', $lop_id)->first();

            if(!is_null($findGoLive) && $findGoLive->isNeed == true) {
                $findGoLive->delete();
            } 

            $queryGolive = GoLive::updateOrcreate(
                ['lop_id' => $lop_id],
                [
                    'lop_id' => $lop_id,
                    'isNeed' => false,
                    'isApproved' => null,
                ]); 
             
            if ($queryGolive) {
                WithoutGoLive::updateOrcreate(
                    ['go_live_id' => $queryGolive->id],
                    [
                        'go_live_id' => $queryGolive->id,
                        'keterangan_golive' => $validated['keterangan_tanpa_golive']
                    ]);

                $message = "Berhasil update status Go Live ODP";
            }
        }

        if ($request->filled('keterangan_validasi')) {
            $queryValidasi = Validasi::updateOrCreate(
                ['lop_id' => $lop_id],
                [
                    'keterangan_validasi' => $validated['keterangan_validasi']
                ]
            );
            if ($queryValidasi) {
                $message = 'Berhasil upload keterangan Validasi';
            }
        }

        if ($request->filled('keterangan_konfirmasi_mitra')) {
            $queryKonfirmasiMitra = KonfirmasiMitra::updateOrCreate(
                ['lop_id' => $lop_id],
                [
                    'keterangan_konfirmasi_mitra' => $validated['keterangan_konfirmasi_mitra']
                ]
            );
            if($queryKonfirmasiMitra) {
                $message = 'Berhasil upload keterangan Konfirmasi Mitra';
            }
        }

        if ($request->filled('keterangan_connectivity')) {
            $queryConnectivity = Connectivity::updateOrCreate(
                ['lop_id' => $lop_id],
                [
                    'keterangan_connectivity' => $validated['keterangan_connectivity']
                ]
            );
            if ($queryConnectivity) {
                $message = 'Berhasil upload keterangan Connectivity';
            }
        }

        if ($request->filled('keterangan_dengan_golive')) {
            $queryWithGoLive = GoLive::where('lop_id', $lop_id)->first(); // Retrieve the GoLive model instance
            if ($queryWithGoLive) {
                $queryWithGoLive->withGoLive->update([
                    'keterangan_golive' => $validated['keterangan_dengan_golive'],
                ]);

                // Check if the update was successful
                if ($queryWithGoLive->withGoLive) {
                    $message = "Berhasil upload keterangan Go Live ODP";
                }
            }
        }

        if ($request->hasFile('evidence_golive') && $request->file('evidence_golive')->isValid()) {
            $file = $request->file('evidence_golive');
            $fileName = Str::random(40) . '.' . $file->getClientOriginalExtension(); // Generate a unique filename

            $file->storeAs('public/uploads/evidence_golive', $fileName);

            $queryGoliveDetail = WithGoLiveDetail::create([
                'with_golive_id' => $queryWithGoLive->id,
                'evidence_name' => $fileName,
                'isApproved' => null
            ]);

            if ($queryGoliveDetail) {
                $message = "Berhasil upload evidence golive";
            }
        }

        return back()->with('Sukses', $message);
    }

    public function markValidasiAsDone(Request $request, $validasi_id) {
        $validasi = Validasi::findOrFail($validasi_id);

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

    public function markKonfirmasiMitraAsDone(Request $request, $konfirmasi_mitra_id) {
        $konfirmasiMitra = KonfirmasiMitra::findOrFail($konfirmasi_mitra_id);

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

    public function markConnectivityAsDone(Request $request, $connectivity_id) {
        $connectivity = Connectivity::findOrFail($connectivity_id);

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

    public function markOdpAsDone(Request $request, $odp_id) {
        $goLive = GoLive::findOrFail($odp_id);

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
