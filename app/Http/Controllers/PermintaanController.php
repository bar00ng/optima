<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use PDF;

use Illuminate\Http\Request;
use App\Models\ListPermintaan;
use App\Models\Lop;
use Carbon\Carbon;
use Illuminate\Database\QueryException;

class PermintaanController extends Controller
{
    public function index()
    {
        $pageCategory = 'List Permintaan';
        $pageName = 'List Permintaan';
        $permintaan = ListPermintaan::all();

        $LOPCount = [];

        foreach ($permintaan as $p) {
            $LOPCount[$p->id] = Lop::where('permintaan_id', $p->id)->count();
        }

        return view('permintaan.list_permintaan', compact('permintaan', 'pageName', 'pageCategory', 'LOPCount'));
    }

    public function formAddPermintaan()
    {
        $pageCategory = 'List Permintaan';
        $pageName = 'Form Add Permintaan';

        return view('permintaan.formAdd_permintaan', compact('pageCategory', 'pageName'));
    }

    public function store(Request $r)
    {
        $validation_messages = [
            'tanggal_permintaan.required' => 'Kolom tanggal permintaan harus diisi.',
            'tanggal_permintaan.date' => 'Kolom tanggal permintaan harus berupa tanggal yang valid.',
            'tematik_permintaan.required' => 'Kolom tematik permintaan harus diisi.',
            'nama_permintaan.required' => 'Kolom nama permintaan harus diisi.',
            'pic_permintaan.required' => 'Kolom PIC permintaan harus diisi.',
            'keterangan.required' => 'Kolom keterangan harus diisi.',
            'no_nota_dinas.required_if' => 'Kolom nomor nota dinas harus diisi.',
            'reff_permintaan.required_if' => 'Kolom referensi permintaan harus diisi.',
            'reff_permintaan.file' => 'Kolom referensi permintaan harus berupa file.',
        ];

        $validated = $r->validate([
            'tanggal_permintaan' => 'required|date',
            'tematik_permintaan' => 'required',
            'nama_permintaan' => 'required',
            'pic_permintaan' => 'required',
            'keterangan' => 'required',
            'no_nota_dinas' => 'required_if:_notaDinas,1', // optional field
            'reff_permintaan' => 'required_if:_notaDinas,1|file', // file upload
        ], $validation_messages);

        $validated['status'] = 'Order';

        if ($r->hasFile('reff_permintaan')) {
            $file = $r->file('reff_permintaan');
            $fileName = Str::random(40) . '.' . $file->getClientOriginalName();

            $file->storeAs('public/uploads/refferal_permintaan', $fileName);

            $validated['refferal_permintaan'] = $fileName;
        }

        ListPermintaan::create($validated);

        return redirect('/permintaan')->with('Sukses', 'Permintaan berhasil ditambahkan!');
    }

    // Other methods: formEditPermintaan, patch, delete

    public function createReport()
    {
        $reports = ListPermintaan::all();

        $LOPCount = [];

        foreach ($reports as $p) {
            $LOPCount[$p->id] = Lop::where('permintaan_id', $p->id)->count();
        }

        $data = [
            'reports' => $reports,
            'lop_count' => $LOPCount
        ];

        $pdf = PDF::loadView('pdf.report', $data);

        // Set the PDF orientation to landscape
        $pdf->setPaper('A4', 'landscape');

        $filename = 'report_' . Carbon::now()->format('Ymd_His') . '.pdf';

        return $pdf->download($filename);
    }
}
