<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequest;
use App\Models\Secretary;
use App\Models\Service;

class ServiceController extends Controller
{
    /**
     * Exibe a lista de serviços.
     * @route /dashboard/services  GET
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Service::class);

        $services = Service::with('secretary')->paginate(10);

        return view('admin.dashboard.services.index', [
            'services' => $services
        ]);
    }

    /**
     * Exibe o formulário de criar um novo serviço.
     *
     * @route /dashboard/services/create  GET
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Service::class);

        $secretaries = Secretary::all(['id', 'name']);

        return view('admin.dashboard.services.create', [
            'secretaries' => $secretaries
        ]);
    }

    /**
     * Realiza a criação de um novo serviço.
     *
     * @route /dashboard/services  POST
     * @param  \Illuminate\Http\ServiceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceRequest $request)
    {
        Service::create($request->all());

        return redirect()->route('dashboard.services.index')
            ->with('status', 'Serviço cadastrado com sucesso!');
    }

    /**
     * Exibe o formulário de alterar um serviço existente.
     *
     * @route /dashboard/services/{service}/edit  GET
     * @param int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('edit', Service::class);

        $service = Service::where('id', $id)->firstOrFail();
        $secretaries = Secretary::all(['id', 'name']);

        return view('admin.dashboard.services.edit', [
            'service' => $service,
            'secretaries' => $secretaries
        ]);
    }

    /**
     * Realiza a alteração de um serviço existente.
     *
     * @route /dashboard/services/{service}  PUT
     * @param  \Illuminate\Http\ServiceRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ServiceRequest $request, $id)
    {
        $service = Service::where('id', $id)->firstOrFail();
        $service->fill($request->all());
        $service->save();

        return redirect()->route('dashboard.services.index')
            ->with('status', 'Serviço atualizado com sucesso!');
    }

    /**
     * Realiza a remoção de um serviço específico.
     *
     * @route /dashboard/services/{service}  DELETE
     * @param int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('delete', Service::class);

        $service = Service::where('id', $id)->firstOrFail();
        $service->delete();

        return redirect()->route('dashboard.services.index')
            ->with('status', 'Serviço excluído com sucesso!');
    }
    
}
