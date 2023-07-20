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
        $goLiveData['golive_progress'] = $request->input('golive_progress', 0);

        // Check if keterangan_withoutGoLive is filled
        if ($request->filled('keterangan_withoutGoLive')) {
            $goLiveData['keterangan_withoutGoLive'] = $request->input('keterangan_withoutGoLive');
        }
        $goLiveData['golive_progress'] = $request->input('golive_progress', 0);

        // Check if keterangan_validasi is filled
        if ($request->filled('keterangan_validasi')) {
            $validasiData = [
                'keterangan_validasi' => $request->input('keterangan_validasi'),
            ];
        }
        $validasiData['validasi_progress'] = $request->input('validasi_progress', 0);

        // Check if keterangan_konfirmasi_mitra is filled
        if ($request->filled('keterangan_konfirmasi_mitra')) {
            $konfirmasiMitraData = [
                'keterangan_konfirmasi_mitra' => $request->input('keterangan_konfirmasi_mitra'),
            ];
        }
        $konfirmasiMitraData['konfirmasi_mitra_progress'] = $request->input('konfirmasi_mitra_progress',0);

        // Check if keterangan_connectivity is filled
        if ($request->filled('keterangan_connectivity')) {
            $connectivityData = [
                'keterangan_connectivity' => $request->input('keterangan_connectivity'),
            ];
        }
        $connectivityData['connectivity_progress'] = $request->input('connectivity_progress',0);

        // dd($request->all(), $goLiveData);

        GoLive::updateOrCreate(['lop_id' => $lop_id], $goLiveData);

        Validasi::updateOrCreate(['lop_id' => $lop_id], $validasiData);

        KonfirmasiMitra::updateOrCreate(['lop_id' => $lop_id], $konfirmasiMitraData);

        Connectivity::updateOrCreate(['lop_id' => $lop_id], $connectivityData);

        if ($request->input('golive_progress') == 100) {
            Lop::where('id', $lop_id)->update(['status' => 'GoLive']);
        }

        return redirect('/goLive/' . $lop_id)->with('Sukses', 'Berhasil diproses!');
    }
}
