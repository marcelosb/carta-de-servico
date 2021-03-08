<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Models\Role;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    /**
     * Exibe a lista de perfis.
     * @route /dashboard/roles  GET
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Role::class);

        $roles = Role::where('name', '!=', config('permissions.role.admin'))->get(['id', 'name']);
        
        return view('admin.dashboard.roles.index', [
            'roles' => $roles
        ]);
    }

    /**
     * Exibe o formulário de criar perfil.
     *
     * @route /dashboard/roles/create  GET
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Role::class);

        return view('admin.dashboard.roles.create');
    }

    /**
     * Realiza a criação de um novo perfil.
     *
     * @route /dashboard/roles  POST
     * @param  \Illuminate\Http\RoleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        DB::beginTransaction();
            $role = Role::create($request->all());
            $role->permissions()->create($request->all());
        DB::commit();

        return redirect()->route('dashboard.roles.index')
            ->with('status', 'Perfil cadastrado com sucesso!');
    }

    /**
     * Exibe o formulário de alterar um perfil existente.
     *
     * @route /dashboard/roles/{role}/edit  GET
     * @param int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('edit', Role::class);

        $role = Role::findOrFail($id);
        $codes = explode(',', $role->permissions->codes);

        return view('admin.dashboard.roles.edit', [
            'role' => $role,
            'codes' => $codes
        ]);
    }

    /**
     * Realiza a alteração de um perfil existente.
     *
     * @route /dashboard/roles/{role}  PUT
     * @param  \Illuminate\Http\RoleRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, $id)
    {
        $role = Role::findOrFail($id);

        DB::beginTransaction();
            $role->update($request->all());
            $role->permissions->update($request->all());
        DB::commit();

        return redirect()->route('dashboard.roles.index')
            ->with('status', 'Perfil alterado com sucesso!');
    }

    /**
     * Realiza a remoção de um perfil específico.
     *
     * @route /dashboard/roles/{role}  DELETE
     * @param int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('delete', Role::class);

        $role = Role::findOrFail($id);
        $role->delete();

        return redirect()->route('dashboard.roles.index')
            ->with('status', 'Perfil excluído com sucesso!');
    }
    
}
