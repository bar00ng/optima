<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ListPermintaan;
use App\Models\Lop;
use App\Models\User;
use App\Models\RabApproval;
use League\Csv\Writer;
use Carbon\Carbon;
use Illuminate\Support\Facades\Response;

class LopController extends Controller
{
    public function index($id_permintaan = null)
    {
        $pageName = 'List of Project';
        $pageCategory = 'Project';

        $lop = ($id_permintaan !== null)
            ? Lop::where('permintaan_id', $id_permintaan)->paginate(15)
            : Lop::paginate(15);

        return view('lop.list_lop', compact('pageName', 'pageCategory', 'lop'));
    }

    public function formAddLop($permintaan_id)
    {
        $pageName = 'Create Project (LOP)';
        $pageCategory = 'Project';
        $currentDate = Carbon::now()->format('m-d-Y');

        $permintaan = ListPermintaan::where('id', $permintaan_id)->first();

        return view('lop.formAdd_lop', compact('permintaan', 'pageName', 'pageCategory', 'currentDate'));
    }

    public function storeLop(Request $r, $toAlokasiMitra = false)
    {
        $validation_messages = [
            'tanggal_permintaan.required' => 'Kolom tanggal permintaan harus diisi.',
            'tanggal_permintaan.date' => 'Kolom tanggal permintaan harus berupa tanggal yang valid.',
            'permintaan_id.required' => 'Kolom permintaan ID harus diisi.',
            'nama_lop.required' => 'Kolom nama LOP harus diisi.',
            'tematik_lop.required' => 'Kolom tematik LOP harus diisi.',
            'sto.required' => 'Kolom STO harus diisi.',
            'longitude.required' => 'Kolom longitude harus diisi.',
            'latitude.required' => 'Kolom latitude harus diisi.',
            'lokasi_lop.required' => 'Kolom lokasi LOP harus diisi.',
            'keterangan_lop.required' => 'Kolom keterangan LOP harus diisi.',
            'estimasi_rab.required_if' => 'Kolom estimasi RAB harus diisi jika tematik LOP bernilai PT 2.',
        ];

        $validated = $r->validate([
            'tanggal_permintaan' => 'required|date',
            'permintaan_id' => 'required',
            'nama_lop' => 'required',
            'tematik_lop' => 'required',
            'sto' => 'required',
            'longitude' => 'required',
            'latitude' => 'required',
            'lokasi_lop' => 'required',
            'keterangan_lop' => 'required',
            'estimasi_rab' => 'required_if:tematik_lop,PT 2'
        ], $validation_messages);

        $lop = new Lop();
        $lop->fill($validated);
        $lop->status = 'Survey + RAB';

        $lop->save();
        $lop_id = $lop->id;

        if ($toAlokasiMitra === false) {
            return redirect('/lop')->with('Sukses', 'Berhasil menambahkan LOP!');
        } else {
            return redirect('/alokasiMitra/' . $lop_id)->with('Sukses', 'Berhasil menambahkan LOP!');
        }
    }

    public function surveyRabForm($lop_id)
    {
        $pageCategory = 'Project';
        $pageName = 'Survey RAB';

        $lop = Lop::where('id', $lop_id)->first();

        return view('survey_rab.formAdd_surveyRab', compact('pageCategory', 'pageName', 'lop'));
    }

    public function storeSurveyRabForm(Request $r)
    {
        $validation_messages = [
            'rab_ondesk.required' => 'Kolom RAB ondesk harus diisi.',
            'rab_ondesk.integer' => 'Kolom RAB ondesk harus berupa angka bulat.',
            'keterangan_rab.required' => 'Kolom keterangan RAB harus diisi.',
            'tipe_professioning.required' => 'Kolom Tipe Professioning harus diisi.'
        ];

        $validated = $r->validate([
            'rab_ondesk' => 'required|integer',
            'keterangan_rab' => 'required',
            'tipe_professioning' => 'required'
        ], $validation_messages);

        Lop::where('id', $r->lop_id)->update($validated);

        RabApproval::create([
            'lop_id' => $r->lop_id,
            'isApproved' => false
        ]);

        return redirect('/lop')->with('Sukses', 'Berhasil mengisi Survey! Tunggu Approval dari OPTIMA!');
    }

    public function alokasiMitraForm($lop_id)
    {
        $pageCategory = 'Project';
        $pageName = 'Alokasi Mitra';

        $lop = Lop::where('id', $lop_id)->first();
        $mitra = User::whereHasRole('mitra')->withCount([
            'lop as lop_done_count' => function ($query) {
                $query->where('status', 'Selesai');
            },
            'lop as lop_not_done_count' => function ($query) {
                $query->where('status', '<>', 'Selesai');
            }
        ])->get();

        return view('alokasi_mitra.form_alokasiMitra', compact('pageCategory', 'pageName', 'lop', 'mitra'));
    }

    public function storeAlokasiMitraForm(Request $r)
    {
        $validation_messages = [
            'mitra_id.required' => 'Kolom mitra harus diisi.',
        ];

        $validated = $r->validate([
            'mitra_id' => 'required',
        ], $validation_messages);

        $validated['status'] = 'Persiapan';
        Lop::where('id', $r->lop_id)->update($validated);

        return redirect('/lop')->with('Sukses', 'Berhasil Mengalokasi Mitra!');
    }

    public function aprroveRab($approved, $lop_id)
    {
        if ($approved === "false") {
            RabApproval::where('lop_id', $lop_id)->update([
                'isApproved' => false
            ]);
            Lop::where('id', $lop_id)->update([
                'status' => 'Selesai'
            ]);

            return redirect('/lop')->with('Sukses', 'Survey RAB ditolak!');
        } elseif ($approved === "true") {
            RabApproval::where('lop_id', $lop_id)->update([
                'isApproved' => true
            ]);
            Lop::where('id', $lop_id)->update([
                'status' => 'Alokasi Mitra'
            ]);

            return redirect('/lop')->with('Sukses', 'Survey RAB disetujui!');
        }
    }

    public function createReport() {
        $reports = Lop::all();
        $no = 1;

        // Create a CSV writer
        $csv = Writer::createFromString('');

        $csv->insertOne([
            'No',
            'Nama Permintaan',
            'Tanggal Permintaan',
            'Nama LOP',
            'Tematik LOP',
            'Tipe Professioning',
            'Estimasi RAB',
            'STO',
            'Longitude',
            'Latitude',
            'Lokasi LOP',
            'Keterangan LOP',
            'RAB On Desk',
            'Keterangan RAB',
            'Nama Mitra',
            'Status'
        ]);

        foreach ($reports as $item) {
            $csv->insertOne([
                $no++,
                $item->listPermintaan->nama_permintaan,
                \Carbon\Carbon::parse($item->tanggal_permintaan)->format('j F Y'),
                !empty($item->nama_lop) ? $item->nama_lop : '-',
                !empty($item->tematik_lop) ? $item->tematik_lop : '-',
                !empty($item->tipe_professioning) ? $item->tipe_professioning : '-',
                !empty($item->estimasi_rab) ? $item->estimasi_rab : '-',
                !empty($item->sto) ? $item->sto : '-',
                !empty($item->longitude) ? $item->longitude : '-',
                !empty($item->latitude) ? $item->latitude : '-',
                !empty($item->lokasi_lop) ? $item->lokasi_lop : '-',
                !empty($item->keterangan_lop) ? $item->keterangan_lop : '-',
                !empty($item->rab_ondesk) ? $item->rab_ondesk : '-',
                !empty($item->keterangan_rab) ? $item->keterangan_rab : '-',
                !empty($item->user->first_name) ? $item->user->first_name : '-',
                !empty($item->status) ? $item->status : '-',
            ]);
        }

        // Set the appropriate headers for CSV download
        $headers = array(
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="report_lop_' . Carbon::now()->format('Ymd_His') . '.csv"',
        );

        // Generate the CSV response and return it
        return Response::make($csv->__toString(), 200, $headers);
    }
}
