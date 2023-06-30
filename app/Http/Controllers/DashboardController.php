<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

        if (Auth::user()->hasRole('mitra')) {
            $lop = Lop::where('mitra_id', Auth::id())->take(10)->get();
        } else {
            $lop = Lop::where('status', '<>', 'Selesai')->take(10)->get();
        }
        

        return view('dashboard.home', compact('pageCategory', 'pageName', 'anggaranTerpakai', 'listOfProject', 'listPermintaan', 'lop'));
    }
}
