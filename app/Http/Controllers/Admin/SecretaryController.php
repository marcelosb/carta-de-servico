<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SecretaryRequest;
use App\Models\Secretary;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class SecretaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $secretaries = Secretary::all();

        return view('admin.dashboard.secretaries.index', [
            'secretaries' => $secretaries
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.dashboard.secretaries.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
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

        // Secretary::create($request->all());

        // return redirect()->route('dashboard.secretaries.index')
        //     ->with('status', 'Secretaria cadastrada com sucesso!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $secretary = Secretary::where('id', $id)->firstOrFail(); 

        return view('admin.dashboard.secretaries.edit', [
            'secretary' => $secretary
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
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

        // $secretary = Secretary::where('id', $id)->firstOrFail();
        // $secretary->fill($request->all());
        // $secretary->save();

        return redirect()->route('dashboard.secretaries.index')
            ->with('status', 'Secretaria atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $secretary = Secretary::where('id', $id)->firstOrFail();
        
        // Deleta a foto de perfil do usuário, caso não seja a imagem padrão
        if ($secretary->icon !== 'default') {
            $pathAvatar = substr($secretary->icon, 8);
            Storage::delete($pathAvatar);
        }

        // Deleta o usuário
        $secretary->delete();

        // $secretary = Secretary::where('id', $id)->firstOrFail();
        // $secretary->delete();

        return redirect()->route('dashboard.secretaries.index')
            ->with('status', 'Secretaria excluída com sucesso!');
    }
}
