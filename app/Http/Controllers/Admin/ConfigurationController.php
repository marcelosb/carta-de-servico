<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ConfigurationRequest;
use App\Models\Configuration;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ConfigurationController extends Controller
{
    /**
     * Exibe a página de editar as configurações gerais
     * 
     * @route dashboard/configurations/edit  GET
     * @return Illuminate\Http\Response
     */
    public function edit()
    {
        $this->authorize('view', Configuration::class);

        $configuration = Configuration::getConfiguration();

        return view('admin.dashboard.configurations.edit', [
            'configuration' => $configuration
        ]);
    }

    /**
     * Realiza a alteração das configurações gerais
     * 
     * @route dashboard/configurations/update  PUT
     * @param App\Http\Requests\ConfigurationRequest  $request
     * @return Illuminate\Http\Response
     */
    public function update(ConfigurationRequest $request)
    {   
        $this->authorize('edit', Configuration::class);

        if ($request->hasFile('logo') && $request->file('logo')->isValid()) {
            $logoCurrent = $this->createImage($request->file('logo'));

            $extension = $request->file('logo')->extension();
            $pathLogo = "public/images/{$this->year()}/{$this->fileName($extension)}";
            Storage::put($pathLogo, (string) $logoCurrent->encode());

            if ($request->logo_path_old !== 'default') {
                $this->deleteFile($request->logo_path_old);
            }

            $logo = "storage/{$pathLogo}";
        }

        if ($request->hasFile('favicon') && $request->file('favicon')->isValid()) {
            $faviconCurrent = Image::make($request->file('favicon'))->fit(192, 192);

            $extension = $request->file('favicon')->extension();
            $pathFavicon = "public/images/{$this->year()}/{$this->fileName($extension)}";
            Storage::put($pathFavicon, (string) $faviconCurrent->encode());

            if ($request->favicon_path_old !== 'default') {
                $this->deleteFile($request->favicon_path_old);
            }

            $favicon = "storage/{$pathFavicon}";
        }

        Configuration::where('id', '>', 0)->update([
            'website_title' => $request->website_title,
            'logo' => $logo ?? 'default',
            'favicon' => $favicon ?? 'default'
        ]);

        return redirect()->route('dashboard.configurations.edit')
            ->with('status', 'Configurações atualizadas com sucesso!');
    }

    /**
     * Cria uma nova imagem com 180px de largura
     * 
     * @param  mixed  $image
     * @return Intervention\Image\Image  $imageCurrent
     */
    private function createImage($image)
    {
        $imageCurrent = Image::make($image);
        $imageCurrent->resize(180, null, function ($constraint) {
            $constraint->aspectRatio();
        });

        return $imageCurrent;
    }

    /**
     * Deleta a imagem antiga
     * 
     * @param string  $oldPath
     * @return bool
     */
    private function deleteFile(string $oldPath)
    {
        $pathOldLogo = substr($oldPath, 8);
        Storage::delete($pathOldLogo);
    }

    /**
     * Retorna um nome aletório de imagem e concatena com a extensão atual
     *
     * @param string  $extension
     * @return string
     */
    private function fileName(string $extension)
    {
        $name = Str::random(32);
        return "{$name}.{$extension}";
    }

    /**
     * Retorna o ano corrente
     *
     * @return string
     */
    private function year()
    {
        return date('Y');
    }

}
