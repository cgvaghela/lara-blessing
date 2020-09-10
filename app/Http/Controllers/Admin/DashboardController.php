<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Prayers;
use App\Http\Controllers\Controller;


class DashboardController extends Controller {
    
    public function __construct() {
        
    }

    /**
     * Admin dashboard
     *
     */
    public function index() {
        $pages = \App\Page::count();
        $sliders = \App\Slider::count();
        $totalActive = \App\Prayers::where('active', '1')->count();
        $totalClose = \App\Prayers::where('active', '2')->count();
        $totalArchived = \App\Prayers::where('active', '3')->count();
        $flagged = \App\Flags::count();
        $paires = \App\PraiseReports::count();
        $banned = \App\BannedIps::count();
        return view('admin/dashboard',  compact('pages','sliders','totalActive','totalClose','totalArchived','flagged','paires','banned'));
    }
}
