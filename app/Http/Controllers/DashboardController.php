<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ListPermintaan;
use App\Models\Lop;

class DashboardController extends Controller
{
    public function index() {
        $pageCategory = "Dashboard";
        $pageName = "Dashboard";
        
        $anggaranTerpakai = Lop::where('rab_ondesk', 'REGEXP', '^[0-9]+$')->sum('rab_ondesk');
        $listOfProject = Lop::count();
        $listPermintaan = ListPermintaan::count();

        $lop = Lop::take(5)->get();

        return view('dashboard.home', compact('pageCategory', 'pageName', 'anggaranTerpakai', 'listOfProject', 'listPermintaan', 'lop'));
    }
}
