<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Secretary;
use App\Models\Service;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /** 
     * Exibe a página inicial do painel de controle
     * 
     * @route /dashboard  GET
     * @return \Illuminate\Http\Response 
    */
    public function index() 
    {
        // Verifica se o perfil Admin ainda não foi criado
        $role = Role::where('name', config('permissions.role.admin'))->first();
        if (!isset($role)) {
            $role = Role::create([
                'name' => config('permissions.role.admin'),
                'description' => 'Tem acesso a todos os módulos do sistema'
            ]);

            $user = User::where('id', Auth::user()->id)->first();
            $user->roles()->sync($role->id);
        }

        $secretaries = Secretary::all()->count();
        $services = Service::all()->count();

        return view('admin.dashboard.home.index', [
            'secretariesTotal' => $secretaries,
            'servicesTotal' => $services
        ]);
    }
    
}
