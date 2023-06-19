<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lop;

class GoLiveController extends Controller
{
    public function index($lop_id) {
        $pageName = 'Go Live';
        $pageCategory = 'Project';

        $lop = Lop::where('id', $lop_id)
            ->first();

        return view('golive-odp.golive-odp', compact('pageName', 'pageCategory', 'lop'));
    }
}
