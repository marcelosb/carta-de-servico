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
     * Display a listing of the resource.
     *
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
     * Show the form for creating a new resource.
     *
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
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
