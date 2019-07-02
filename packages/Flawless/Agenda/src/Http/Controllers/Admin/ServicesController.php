<?php

namespace Flawless\Agenda\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Flawless\Agenda\Models\Service;
use Illuminate\Http\Request;
use Flawless\Agenda\Http\Requests\Admin\StoreServicesRequest;
use Flawless\Agenda\Http\Requests\Admin\UpdateServicesRequest;
use Flawless\Agenda\Models\Group;

class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::all();

        return view('agenda::agenda.admin.services.index', compact('services'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('agenda::agenda.admin.services.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Flawless\Agenda\Http\Requests\Admin\StoreServicesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreServicesRequest $request)
    {

        $service = Service::create($request->all());

        session()->flash('success', 'Nuevo servicio creado');
        return redirect()->route('agenda.services.index');
    }

    /**
     * Show the form for editing Service.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

      $service = Service::findOrFail($id);

      return view('agenda::agenda.admin.services.edit', compact('service'));
    }

    /**
     * Update Service in storage.
     *
     * @param  Flawless\Agenda\Http\Requests\Admin\UpdateServicesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateServicesRequest $request, $id)
    {
        $service = Service::findOrFail($id);
        $service->name = $request->name;
        $service->price = $request->price;
        $service->duration = $request->duration;
        $service->available = $request->available;
        $service->description = $request->description;
        $service->save();

        session()->flash('success', 'Servicio Actualizado');
        return redirect()->route('agenda.services.index');
        return redirect()->route($this->_config['redirect']);
    }

    /**
     * Remove Service from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $service = Service::findOrFail($id);
        $service->delete();
        session()->flash('success', 'Fecha Eliminada');
        return redirect()->route('agenda.services.index');
    }

    /**
     * Delete all selected Service at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {

        if ($request->input('ids')) {
            $entries = Service::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }
}
