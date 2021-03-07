<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SecretaryRequest;
use App\Models\Secretary;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class SecretaryController extends Controller
{
    /**
     * Exibe a lista de secretarias.
     * @route /dashboard/secretaries  GET
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Secretary::class);

        $secretaries = Secretary::all();

        return view('admin.dashboard.secretaries.index', [
            'secretaries' => $secretaries
        ]);
    }

    /**
     * Exibe o formulário de criar um nova secretaria.
     *
     * @route /dashboard/secretaries/create  GET
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Secretary::class);

        return view('admin.dashboard.secretaries.create');
    }

    /**
     * Realiza a criação de uma nova secretaria.
     *
     * @route /dashboard/secretaries  POST
     * @param  \Illuminate\Http\SecretaryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SecretaryRequest $request)
    {
        if ($request->hasFile('image_secretary') && $request->file('image_secretary')->isValid()) {
            $imageSecretary = Image::make($request->file('image_secretary'));
            $imageSecretary->fit(150, 150);

            $extension = $request->file('image_secretary')->extension();
            $path = 'public/images/'.year().'/'.fileName($extension);
            Storage::put($path, (string) $imageSecretary->encode());

            Secretary::create([
                'name' => $request->name,
                'theme' => $request->theme,
                'theme_slug' => Str::slug($request->theme, '-'),
                'address' => $request->address,
                'telephone' => $request->telephone,
                'email' => $request->email ?? null,
                'opening_hours' => $request->opening_hours,
                'icon' => 'storage/' . $path
            ]);

        } else {
            Secretary::create([
                'name' => $request->name,
                'theme' => $request->theme,
                'theme_slug' => Str::slug($request->theme, '-'),
                'address' => $request->address,
                'telephone' => $request->telephone,
                'email' => $request->email ?? null,
                'opening_hours' => $request->opening_hours
            ]);
        }

        return redirect()->route('dashboard.secretaries.index')
            ->with('status', 'Secretaria cadastrada com sucesso!');
    }

    /**
     * Exibe o formulário de alterar uma secretaria existente.
     *
     * @route /dashboard/secretaries/{secretary}/edit  GET
     * @param int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('edit', Secretary::class);
        
        $secretary = Secretary::where('id', $id)->firstOrFail(); 

        return view('admin.dashboard.secretaries.edit', [
            'secretary' => $secretary
        ]);
    }
                
    /**
     * Realiza a alteração de um perfil existente.
     *
     * @route /dashboard/secretaries/{secretary}  PUT
     * @param  \Illuminate\Http\SecretaryRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SecretaryRequest $request, $id)
    {
        if ($request->hasFile('image_secretary') && $request->file('image_secretary')->isValid()) {
            $imageSecretary = Image::make($request->file('image_secretary'));
            $imageSecretary->fit(150, 150);

            $extension = $request->file('image_secretary')->extension();
            $path = 'public/images/'.year().'/'.fileName($extension);
            Storage::put($path, (string) $imageSecretary->encode());

            secretary::where('id', $id)->firstOrFail()->update([
                'name' => $request->name,
                'theme' => $request->theme,
                'theme_slug' => Str::slug($request->theme, '-'),
                'address' => $request->address,
                'telephone' => $request->telephone,
                'email' => $request->email ?? null,
                'opening_hours' => $request->opening_hours,
                'icon' => 'storage/' . $path
            ]);

            if ($request->icon_path_old !== 'default') {
                $pathOld = substr($request->icon_path_old, 8);
                Storage::delete($pathOld);
            }

        } else {
            secretary::where('id', $id)->firstOrFail()->update([
                'name' => $request->name,
                'theme' => $request->theme,
                'theme_slug' => Str::slug($request->theme, '-'),
                'address' => $request->address,
                'telephone' => $request->telephone,
                'email' => $request->email ?? null,
                'opening_hours' => $request->opening_hours
            ]);
        }

        return redirect()->route('dashboard.secretaries.index')
            ->with('status', 'Secretaria atualizada com sucesso!');
    }

    /**
     * Realiza a remoção de uma secretaria específica.
     *
     * @route /dashboard/secretaries/{secretary}  DELETE
     * @param int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('delete', Secretary::class);

        $secretary = Secretary::where('id', $id)->firstOrFail();
        
        // Deleta a foto de perfil do usuário, caso não seja a imagem padrão
        if ($secretary->icon !== 'default') {
            $pathAvatar = substr($secretary->icon, 8);
            Storage::delete($pathAvatar);
        }

        // Deleta o usuário
        $secretary->delete();

        return redirect()->route('dashboard.secretaries.index')
            ->with('status', 'Secretaria excluída com sucesso!');
    }
}
