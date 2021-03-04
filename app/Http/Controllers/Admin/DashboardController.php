<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Secretary;
use App\Models\Service;

class DashboardController extends Controller
{
    /** 
     * Exibe a página inicial do painel de controle
     * 
     * @route  /dashboard  GET
     * @return \Illuminate\Http\Response 
    */
    public function index() 
    {
        $secretaries = Secretary::all()->count();
        $services = Service::all()->count();

        return view('admin.dashboard.home.index', [
            'secretariesTotal' => $secretaries,
            'servicesTotal' => $services
        ]);
    }
    
}
