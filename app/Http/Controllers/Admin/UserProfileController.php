<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserProfilePasswordRequest;
use App\Http\Requests\UserProfileRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class UserProfileController extends Controller
{
    /**
     * Exibe os dados do perfil do usuário.
     * @route /dashboard/user-profile  GET
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $user = Auth::user();
        $role = $user->roles->pluck('name')->first();

        return view('admin.dashboard.user-profile.index', [
            'user' => $user,
            'role' => $role
        ]);
    }

    /**
     * Exibe o formulário de alterar o perfil do usuário.
     *
     * @route dashboard/user-profile/edit  GET
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user = Auth::user();

        return view('admin.dashboard.user-profile.edit', [
            'user' => $user
        ]);
    }

    /**
     * Realiza a alteração do perfil de um usuário existente.
     *
     * @route dashboard/user-profile/update  PUT
     * @param  \Illuminate\Http\UserProfileRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UserProfileRequest $request)
    {
        if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
            $avatar = Image::make($request->file('avatar'));
            $avatar->fit(200, 200);

            $extension = $request->file('avatar')->extension();
            $path = 'public/images/'.year().'/'.fileName($extension);
            Storage::put($path, (string) $avatar->encode());

            $avatar = 'storage/' . $path;

            if ($request->avatar_path_old !== 'default') {
                $pathOld = substr($request->avatar_path_old, 8);
                Storage::delete($pathOld);
            }
        }

        $id = Auth::user()->id;
        User::findOrFail($id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'avatar' => isset($avatar) ? $avatar : $request->avatar_path_old
        ]);

        return redirect()->route('dashboard.user.profile.index')
            ->with('status', 'Perfil do usuário atualizado com sucesso!');
    }

   /**
     * Exibe o formulário de editar a senha do usuário logado.
     *
     * @route dashboard/user-profile/edit/password  GET
     * @return \Illuminate\Http\Response
     */
    public function editPassword()
    {
        return view('admin.dashboard.user-profile.edit-password');
    }

    /**
     * Realiza a alteração de senha do perfil de um usuário logado.
     *
     * @route dashboard/user-profile/update/password  PUT
     * @param  \Illuminate\Http\UserProfilePasswordRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(UserProfilePasswordRequest $request)
    {
        $id = Auth::user()->id;
        User::findOrFail($id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return redirect()->route('dashboard.user.profile.index')
            ->with('status', 'Senha atualizada com sucesso!');
    }
    
}
