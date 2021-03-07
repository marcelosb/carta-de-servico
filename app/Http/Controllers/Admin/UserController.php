<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Exibe a lista de usuários.
     * @route /dashboard/users  GET
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', User::class);

        $users = User::all();

        return view('admin.dashboard.users.index', [
            'users' => $users
        ]);
    }

    /**
     * Exibe o formulário de criar um novo usuário.
     *
     * @route /dashboard/users/create  GET
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', User::class);

        $roles = Role::all(['id', 'name']);

        return view('admin.dashboard.users.create', [
            'roles' => $roles
        ]);
    }

    /**
     * Realiza a criação de um nov usuário.
     *
     * @route /dashboard/users  POST
     * @param  \Illuminate\Http\UserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    { 
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        User::createRelationshipWithRole($user->id, $request->role_id);

        return redirect()->route('dashboard.users.index')
            ->with('status', 'Usuário cadastrado com sucesso!');
    }

    /**
     * Exibe o formulário de alterar um usuário existente.
     *
     * @route /dashboard/users/{user}/edit  GET
     * @param int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('edit', User::class);

        $user = User::where('id', $id)->firstOrFail();
        $roleId = $user->roles()->first()->id;
        $roles = Role::all(['id', 'name']);
        
        return view('admin.dashboard.users.edit', [
            'user' => $user,
            'roleId' => $roleId,
            'roles' => $roles
        ]);
    }

    /**
     * Realiza a alteração de um usuário existente.
     *
     * @route /dashboard/users/{user}  PUT
     * @param  \Illuminate\Http\UserRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $user = User::where('id', $id)->firstOrFail();

        User::updateRelationshipWithRole($user->id, $request->role_id);

        return redirect()->route('dashboard.users.index')
            ->with('status', 'Usuário editado com sucesso!');
    }

    /**
     * Realiza a remoção de um usuário específico.
     *
     * @route /dashboard/users/{user}  DELETE
     * @param int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('delete', User::class);

        $user = User::where('id', $id)->firstOrFail();
        
        // Deleta a foto de perfil do usuário, caso não seja a imagem padrão
        if ($user->avatar !== 'default') {
            $pathAvatar = substr($user->avatar, 8);
            Storage::delete($pathAvatar);
        }

        // Deleta o usuário
        $user->delete();

        return redirect()->route('dashboard.users.index')
            ->with('status', 'Usuário excluído com sucesso!');
    }
    
}
