<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $pageCategory = "Dashboard";
        $pageName = "Dashboard";

        return view('layouts.dashboard', compact('pageCategory', 'pageName'));
    }
}
