<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Models\Permission;
use App\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all(['id', 'name']);

        return view('admin.dashboard.roles.index', [
            'roles' => $roles
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all(['id', 'name']);

        return view('admin.dashboard.roles.create', [
            'permissions' => $permissions
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        $role = Role::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        foreach ($request->permission as $permissionId) {
            Role::createPermission($role->id, $permissionId);
        }

        return redirect()->route('dashboard.roles.index')
            ->with('status', 'Perfil cadastrado com sucesso!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::where('id', $id)->firstOrFail();
        $permissions = Permission::all();

        $permissionArray = [];
        foreach ($role->permissions as $permission) {
            $permissionArray[] = $permission->name;
        }

        return view('admin.dashboard.roles.edit', [
            'role' => $role,
            'rolePermissions' => $permissionArray,
            'permissions' => $permissions
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, $id)
    {
        // VERIFICA SE O USUÁRIO EXISTE, CASO FALHE REDIRECIONA PARA A PÁGINA DE ERRO 404
        $role = Role::where('id', $id)->firstOrFail();

        // DELETA TODAS OS ID DE PERFIL ASSOCIADOS COM AS PERMISSÕES ANTIGAS
        Role::deletePermissionsOld($role->id);

        // CRIA NOVAS PERMISSÕES PARA O USUÁRIO CORRENTE
        foreach ($request->permission as $permissionId) {
            Role::createPermission($role->id, $permissionId);
        }

        return redirect()->route('dashboard.roles.index')
            ->with('status', 'Perfil alterado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::where('id', $id)->firstOrFail();
        $role->delete();

        return redirect()->route('dashboard.roles.index')
            ->with('status', 'Perfil excluído com sucesso!');
    }
}
