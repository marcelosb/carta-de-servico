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
     * Exibe os dados do perfil do usuário
     * 
     * @route dashboard/user-profile  GET
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $user = Auth::user();

        return view('admin.dashboard.user-profile.index', [
            'user' => $user
        ]);
    }

    /**
     * Show the form for editing the user profile.
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
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

            User::where('id', Auth::user()->id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'avatar' => 'storage/' . $path
            ]);

            if ($request->avatar_path_old !== 'default') {
                $pathOld = substr($request->avatar_path_old, 8);
                Storage::delete($pathOld);
            }

        } else {
            User::where('id', Auth::user()->id)->update([
                'name' => $request->name,
                'email' => $request->email
            ]);
        }

        return redirect()->route('dashboard.user.profile.index')
            ->with('status', 'Perfil do usuário atualizado com sucesso!');
    }

    /**
     * Show the form for editing the user profile.
     *
     * @route dashboard/user-profile/edit  GET
     * @return \Illuminate\Http\Response
     */
    public function editPassword()
    {
        return view('admin.dashboard.user-profile.edit-password');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(UserProfilePasswordRequest $request)
    {
        $id = Auth::user()->id;
        User::where('id', $id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return redirect()->route('dashboard.user.profile.index')
            ->with('status', 'Senha atualizada com sucesso!');
    }
    
}
