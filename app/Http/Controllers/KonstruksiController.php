<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lop;
use App\Models\Persiapan;
use App\Models\Instalasi;
use App\Models\SelesaiFisik;

class KonstruksiController extends Controller
{
    public function index($lop_id)
    {
        $pageName = 'Konstruksi';
        $pageCategory = 'Project';

        $lop = Lop::where('id', $lop_id)->first();

        $persiapan = Persiapan::where('lop_id', $lop_id)->first();
        $data_persiapan_array = [];
        if ($persiapan) {
            $data_persiapan_array = json_decode($persiapan->data, true)['data_array'];
        }

        $instalasi = Instalasi::where('lop_id', $lop_id)->first();
        $data_instalasi_array = [];
        if ($instalasi) {
            $data_instalasi_array = json_decode($instalasi->data, true)['data_array'];
        }

        $selesaiFisik = SelesaiFisik::where('lop_id', $lop_id)->first();
        $data_selesaiFisik_array = [];
        if ($selesaiFisik) {
            $data_selesaiFisik_array = json_decode($selesaiFisik->data, true)['data_array'];
        }

        return view('konstruksi.konstruksi', compact('pageName', 'pageCategory', 'lop', 'persiapan', 'data_persiapan_array', 'instalasi', 'data_instalasi_array', 'selesaiFisik', 'data_selesaiFisik_array'));
    }

    public function store($lop_id, Request $r)
    {
        $persiapan = new Persiapan();
        $instalasi = new Instalasi();
        $selesai = new SelesaiFisik();

        if ($r->hasFile('evidence_persiapan') && $r->file('evidence_persiapan')->isValid()) {
            $file = $r->file('evidence_persiapan');
            $fileName = $file->getClientOriginalName();

            $file->storeAs('public/uploads/evidence_persiapan', $fileName);

            $evidence_persiapan = [
                'id' => rand(10,100), // Add 'id' key with the value of $persiapan->id
                'filename' => $fileName, // Add 'filename' key with the value of $fileName
                'isApproved' => null, // Add 'isApproved' key with the initial value of null
            ];

            $data = Persiapan::where('lop_id', $lop_id)->first();
            if ($data) {
                // Kalau data sudah ada. maka append
                $data_before = json_decode($data->data, true);

                $data_before['data_array'][] = $evidence_persiapan;

                $data_after = json_encode($data_before);

                $data->update([
                    'data' => $data_after,
                ]);
            } else {
                $data_new = [
                    'data_array' => [$evidence_persiapan]
                ];
                $persiapan->lop_id = $lop_id;
                $persiapan->data = json_encode($data_new);

                if ($r->keterangan_persiapan !== '') {
                    $persiapan->keterangan_persiapan = $r->keterangan_persiapan;
                }

                $persiapan->save();
            }
        }
        Persiapan::where('lop_id', $lop_id)->update([
            'persiapan_progress' => (int)$r->persiapan_progress
        ]);

        if ($r->hasFile('evidence_instalasi') && $r->file('evidence_instalasi')->isValid()) {
            $file = $r->file('evidence_instalasi');
            $fileName = $file->getClientOriginalName();

            $file->storeAs('public/uploads/evidence_instalasi', $fileName);
            $evidence_instalasi = [
                'id' => rand(10,100), // Add 'id' key with the value of $persiapan->id
                'filename' => $fileName, // Add 'filename' key with the value of $fileName
                'isApproved' => null, // Add 'isApproved' key with the initial value of null
            ];

            $data = Instalasi::where('lop_id', $lop_id)->first();
            if ($data) {
                // Kalau data sudah ada. maka append
                $data_before = json_decode($data->data, true);

                $data_before['data_array'][] = $evidence_instalasi;

                $data_after = json_encode($data_before);

                $data->update([
                    'data' => $data_after,
                ]);
            } else {
                $data_new = [
                    'data_array' => [$evidence_instalasi]
                ];
                $instalasi->lop_id = $lop_id;
                $instalasi->data = json_encode($data_new);

                if ($r->keterangan_instalasi !== '') {
                    $instalasi->keterangan_instalasi = $r->keterangan_instalasi;
                }

                $instalasi->save();
            }
        }
        Instalasi::where('lop_id', $lop_id)->update([
            'instalasi_progress' => (int)$r->instalasi_progress
        ]);

        if ($r->hasFile('evidence_selesai') && $r->file('evidence_selesai')->isValid()) {
            $file = $r->file('evidence_selesai');
            $fileName = $file->getClientOriginalName();

            $file->storeAs('public/uploads/evidence_selesai', $fileName);
            $evidence_selesai_fisik = [
                'id' => rand(10,100), // Add 'id' key with the value of $persiapan->id
                'filename' => $fileName, // Add 'filename' key with the value of $fileName
                'isApproved' => null, // Add 'isApproved' key with the initial value of null
            ];

            $data = SelesaiFisik::where('lop_id',$lop_id)->first();
            if ($data) {
                // Kalau data sudah ada. maka append
                $data_before = json_decode($data->data, true);

                $data_before['data_array'][] = $evidence_selesai_fisik;

                $data_after = json_encode($data_before);

                $data->update([
                    'data' => $data_after,
                ]);
            } else {
                $data_new = [
                    'data_array' => [$evidence_selesai_fisik]
                ];
                $selesai->lop_id = $lop_id;
                $selesai->data = json_encode($data_new);

                if ($r->keterangan_selesai !== '') {
                    $selesai->keterangan_selesai = $r->keterangan_selesai;
                }

                $selesai->save();
            }
        }
        SelesaiFisik::where('lop_id', $lop_id)->update([
            'selesai_fisik_progress' => (int)$r->selesai_fisik_progress
        ]);

        return redirect('/konstruksi/' . $lop_id)->with('Sukses', 'Proses upload evidence berhasil');
    }

    public function approvePersiapan($approved, $persiapan_id, $evidence_id)
    {
        $persiapan = Persiapan::where('id', $persiapan_id)->first();

        // Get before data
        $data_before = $persiapan->data;

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

            $persiapan->data = $data_after;
            $persiapan->save();

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
            $persiapan->data = $data_after;
            $persiapan->save();

            // update status lop
            $lop = $persiapan->lop;
            $lop->status = "Persiapan";
            $lop->save();

            $message = "Evidence persiapan di Approve";
        }

        return back()->with('Sukses', $message);
    }

    public function approveInstalasi($approved, $instalasi_id, $evidence_id)
    {
        $instalasi = Instalasi::where('id', $instalasi_id)->first();

        // Get before data
        $data_before = $instalasi->data;

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

            $instalasi->data = $data_after;
            $instalasi->save();

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
            $instalasi->data = $data_after;
            $instalasi->save();

            // update status lop
            $lop = $instalasi->lop;
            $lop->status = "Instalasi";
            $lop->save();

            $message = "Evidence persiapan di Approve";
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

            // update status lop
            $lop = $selesaiFisik->lop;
            $lop->status = "Selesai Fisik";
            $lop->save();

            $message = "Evidence persiapan di Approve";
        }

        return back()->with('Sukses', $message);
    }
}
