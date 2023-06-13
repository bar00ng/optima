<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ListPermintaan;

class LopController extends Controller
{
    public function index() {
        $pageName = "List of Project";
        $pageCategory = "Project";

        return view('lop.list_lop', compact('pageName', 'pageCategory'));
    }

    public function formAddLop($id) {
        $pageName = "Create Project (LOP)";
        $pageCategory = "Project";

        $permintaan = ListPermintaan::where('id',$id)->first();

        return view('lop.formAdd_lop', compact('permintaan', 'pageName', 'pageCategory'));
    }

    public function edit($id, Request $r) {}

    public function delete($id) {}
}
