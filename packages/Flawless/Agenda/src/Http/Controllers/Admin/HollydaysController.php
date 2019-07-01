<?php

namespace Flawless\Agenda\Http\Controllers\Admin;

use Flawless\Agenda\Models\Hollyday;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use Flawless\Agenda\Http\Requests\Admin\StoreHollydaysRequest;
use Flawless\Agenda\Http\Requests\Admin\UpdateHollydaysRequest;

class HollydaysController extends Controller
{

    /**
     * Contains route related configuration
     *
     * @var array
     */
    protected $_config;

    /**
     * Display a listing of Hollyday.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hollydays= Hollyday::all();

        return view('agenda::agenda.admin.hollydays.index', compact('hollydays'));
    }

    /**
     * Show the form for creating new Hollyday.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('agenda::agenda.admin.hollydays.create');
    }

    /**
     * Store a newly created Hollyday in storage.
     *
     * @param  \App\Http\Requests\StoreHollydaysRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreHollydaysRequest $request)
    {

        $hollyday = Hollyday::create($request->all());

        session()->flash('success', 'Nueva fecha creado');
        return redirect()->route('agenda.hollydays.index');

    }


    /**
     * Show the form for editing Hollyday.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

      $hollyday = Hollyday::findOrFail($id);

      return view('agenda::agenda.admin.hollydays.edit', compact('hollyday'));
    }

    /**
     * Update Hollyday in storage.
     *
     * @param  Flawless\Agenda\Http\Requests\Admin\UpdateHollydaysRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateHollydaysRequest $request, $id)
    {
        $hollyday = Hollyday::findOrFail($id);
        $hollyday->update($request->all());

        session()->flash('success', 'Fecha Actualizado');
        return redirect()->route('agenda.hollydays.index');
        return redirect()->route($this->_config['redirect']);
    }


    /**
     * Display Hollyday.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
    //
    //     $relations = [
    //         'employees' => \App\Employee::get()->pluck('first_name', 'id')->prepend('Please select', ''),
    //     ];
    //
    //     $hollyday = Hollyday::findOrFail($id);
    //
    //     return view('admin.hollydays.show', compact('hollyday') + $relations);
    // }


    /**
     * Remove Hollyday from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $hollyday = Hollyday::findOrFail($id);
        $hollyday->delete();
        session()->flash('success', 'Fecha Eliminada');
        return redirect()->route('agenda.hollydays.index');
    }

    /**
     * Delete all selected Hollyday at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {

        if ($request->input('ids')) {
            $entries = Hollyday::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
