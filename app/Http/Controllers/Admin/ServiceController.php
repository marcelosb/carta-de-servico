<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequest;
use App\Models\Secretary;
use App\Models\Service;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::with('secretary')->paginate(10);

        return view('admin.dashboard.services.index', [
            'services' => $services
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $secretaries = Secretary::all(['id', 'name']);

        return view('admin.dashboard.services.create', [
            'secretaries' => $secretaries
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceRequest $request)
    {
        Service::create($request->all());

        return redirect()->route('dashboard.services.index')
            ->with('status', 'Serviço cadastrado com sucesso!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $service = Service::where('id', $id)->firstOrFail();
        $secretaries = Secretary::all(['id', 'name']);

        return view('admin.dashboard.services.edit', [
            'service' => $service,
            'secretaries' => $secretaries
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $service = Service::where('id', $id)->firstOrFail();
        $service->delete();

        return redirect()->route('dashboard.services.index')
            ->with('status', 'Serviço excluído com sucesso!');
    }
}
