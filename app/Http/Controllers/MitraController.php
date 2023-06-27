<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class MitraController extends Controller
{
    public function index() {
        $pageName = 'List Mitra';
        $pageCategory = 'Mitra';

        $mitra = User::whereHasRole('mitra')->get();

        return view('mitra.list_mitra', compact('pageName', 'pageCategory', 'mitra'));
    }

    public function formAddMitra() {
        $pageName = 'Form Tambah Mitra';
        $pageCategory = 'Mitra';

        return view('mitra.formAdd_mitra', compact('pageName', 'pageCategory'));
    }

    public function storeMitra(Request $r) {
        $mitra = new User();

        $validated = $r->validate([
            'username' => 'required',
            'email' => 'required',
            'first_name' => 'required',
            'password' => 'required'
        ]);
        $mitra->username = $validated['username'];
        $mitra->email = $validated['email'];
        $mitra->first_name = $validated['first_name'];
        $mitra->password = Hash::make($validated['password']);

        if($r->filled('last_name')){
            $validated['last_name'] = $r->last_name;

            $mitra->last_name = $validated['last_name'];
        }

        $mitra->save();

        $mitra->addRole('mitra');

        return redirect('/mitra')->with('Sukses', 'Berhasil menambahkan mitra!');
    }

    public function formEditMitra($id) {
        $pageName = 'Form Edit Mitra';
        $pageCategory = 'Mitra';

        $mitra = User::where('id', $id)->first();

        return view('mitra.formEdit_mitra', compact('pageName', 'pageCategory', 'mitra'));
    }

    public function patchMitra(Request $r, $id) {
        $validated = $r->validate([
            'username' => 'required',
            'email' => 'required',
            'first_name' => 'required',
        ]);
        $validated['last_name'] = $r->last_name;

        User::where('id', $id)->update($validated);

        return redirect('/mitra')->with('Sukses', 'Berhasil mengedit mitra!');
    }

    public function delete($id) {
        User::where('id', $id)->delete();

        return redirect('/mitra')->with('Sukses', 'Berhasil menghapus mitra!');
    }
}
