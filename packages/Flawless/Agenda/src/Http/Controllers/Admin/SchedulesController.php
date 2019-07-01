<?php

namespace Flawless\Agenda\Http\Controllers\Admin;

use Flawless\Agenda\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use Flawless\Agenda\Http\Requests\Admin\StoreSchedulesRequest;
use Flawless\Agenda\Http\Requests\Admin\UpdateSchedulesRequest;

class SchedulesController extends Controller
{
    /**
     * Display a listing of Schedule.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $schedules= Schedule::all();

      return view('agenda::agenda.admin.schedules.index', compact('schedules'));
    }

    /**
     * Show the form for creating new Schedule.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     return view('agenda::agenda.admin.schedules.create');
    // }

    /**
     * Store a newly created Schedule in storage.
     *
     * @param  \App\Http\Requests\StoreSchedulesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSchedulesRequest $request)
    {
        $schedule = Schedule::create($request->all());

        return redirect()->route('admin.schedules.index');
    }


    /**
     * Show the form for editing Schedule.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $schedule = Schedule::findOrFail($id);

        return view('agenda::agenda.admin.schedules.edit', compact('schedule'));
    }

    /**
     * Update Schedule in storage.
     *
     * @param  \App\Http\Requests\UpdateSchedulesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function update(UpdateSchedulesRequest $request, $id)
     {
         $schedule = Schedule::findOrFail($id);
         $schedule->update($request->all());

         session()->flash('success', 'Horario de trabajo actualizado');
         return redirect()->route('agenda.schedules.index');
         return redirect()->route($this->_config['redirect']);
     }


    /**
     * Display Schedule.
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
    //     $working_hour = Schedule::findOrFail($id);
    //
    //     return view('admin.schedules.show', compact('working_hour') + $relations);
    // }


    // /**
    //  * Remove Schedule from storage.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy($id)
    // {
    //
    //     $working_hour = Schedule::findOrFail($id);
    //     $working_hour->delete();
    //
    //     return redirect()->route('admin.schedules.index');
    // }
    //
    // /**
    //  * Delete all selected Schedule at once.
    //  *
    //  * @param Request $request
    //  */
    // public function massDestroy(Request $request)
    // {
    //
    //     if ($request->input('ids')) {
    //         $entries = Schedule::whereIn('id', $request->input('ids'))->get();
    //
    //         foreach ($entries as $entry) {
    //             $entry->delete();
    //         }
    //     }
    // }

}
