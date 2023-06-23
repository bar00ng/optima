<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ListPermintaan;
use App\Models\Lop;
use Illuminate\Database\QueryException;

class PermintaanController extends Controller
{
    public function index()
    {
        $pageCategory = 'List Permintaan';
        $pageName = 'List Permintaan';
        $permintaan = ListPermintaan::all();

        $LOPCount = [];

        foreach($permintaan as $p) {
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
        $validated = $r->validate([
            'tanggal_permintaan' => 'required',
            'tematik_permintaan' => 'required',
            'nama_permintaan' => 'required',
            'pic_permintaan' => 'required',
            'keterangan' => 'required',
        ]);
        $validated['status'] = 'Order';

        if ($r->hasFile('reff_permintaan')) {
            $file = $r->file('reff_permintaan');
            $fileName = $file->getClientOriginalName();

            $file->store('public/uploads/refferal_permintaan');

            $validated['refferal_permintaan'] = $fileName;
        }

        if($r->filled('no_nota_dinas')) {
            $validated['no_nota_dinas'] = $r->no_nota_dinas;
        }

        ListPermintaan::create($validated);

        return redirect('/permintaan')->with('Sukses', 'Permintaan berhasil ditambahkan!');
    }

    public function formEditPermintaan($id)
    {
    }

    public function patch($id, Request $r)
    {
    }

    public function delete($id)
    {
    }
}
