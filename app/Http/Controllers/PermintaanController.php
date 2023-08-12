<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use League\Csv\Writer;
use Illuminate\Support\Facades\Response;

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
        $permintaan = ListPermintaan::paginate(15);

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

        // Create a CSV writer
        $csv = Writer::createFromString('');

        // Add headers to the CSV file
        $csv->insertOne([
            'No',
            'Tgl. Permintaan',
            'Tematik Permintaan',
            'LOP',
            'No. Nota Dinas',
            'Nama Permintaan',
            'PIC Permintaan',
            'Keterangan',
        ]);

        // Add data rows to the CSV file
        foreach ($reports as $report) {
            $count = isset($LOPCount[$report->id]) ? $LOPCount[$report->id] : 0;

            $csv->insertOne([
                $report->id,
                \Carbon\Carbon::parse($report->tanggal_permintaan)->format('j F Y'),
                $report->tematik_permintaan,
                $count,
                !empty($report->no_nota_dinas) ? $report->no_nota_dinas : '-',
                $report->nama_permintaan,
                $report->pic_permintaan,
                $report->keterangan,
            ]);
        }

        // Set the appropriate headers for CSV download
        $headers = array(
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="report_permintaan_' . Carbon::now()->format('Ymd_His') . '.csv"',
        );

        // Generate the CSV response and return it
        return Response::make($csv->__toString(), 200, $headers);
    }
}
