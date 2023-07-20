<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SdiController extends Controller
{
    public function index() {
        $pageName = 'List SDI';
        $pageCategory = 'SDI';

        $sdi = User::whereHasRole('sdi')->get();

        return view('sdi.list_sdi', compact('pageName', 'pageCategory', 'sdi'));
    }

    public function formAddSdi() {
        $pageName = 'Form Tambah SDI';
        $pageCategory = 'SDI';

        return view('sdi.formAdd_sdi', compact('pageName', 'pageCategory'));
    }

    public function storeSdi(Request $r) {
        $sdi = new User();

        $validated = $r->validate([
            'username' => 'required',
            'email' => 'required',
            'first_name' => 'required',
            'password' => 'required'
        ]);
        $sdi->username = $validated['username'];
        $sdi->email = $validated['email'];
        $sdi->first_name = $validated['first_name'];
        $sdi->password = Hash::make($validated['password']);

        if($r->filled('last_name')){
            $validated['last_name'] = $r->last_name;

            $sdi->last_name = $validated['last_name'];
        }

        $sdi->save();

        $sdi->addRole('sdi');

        return redirect('/sdi')->with('Sukses', 'Berhasil menambahkan SDI!');
    }

    public function formEditSdi($id) {
        $pageName = 'Form Edit SDI';
        $pageCategory = 'SDI';

        $sdi = User::where('id', $id)->first();

        return view('sdi.formEdit_sdi', compact('pageName', 'pageCategory', 'sdi'));
    }

    public function patchSdi(Request $r, $id) {
        $validated = $r->validate([
            'username' => 'required',
            'email' => 'required',
            'first_name' => 'required',
        ]);
        $validated['last_name'] = $r->last_name;

        User::where('id', $id)->update($validated);

        return redirect('/sdi')->with('Sukses', 'Berhasil mengedit SDI!');
    }

    public function delete($id) {
        User::where('id', $id)->delete();

        return redirect('/sdi')->with('Sukses', 'Berhasil menghapus SDI!');
    }
}
