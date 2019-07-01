<?php

namespace Flawless\Agenda\Http\Controllers\Admin;

use Flawless\Agenda\Models\Appointment;
use Flawless\Agenda\Models\Service;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Flawless\Agenda\Http\Requests\Admin\StoreAppointmentsRequest;
use Flawless\Agenda\Http\Requests\Admin\UpdateAppointmentsRequest;

class AppointmentsController extends Controller
{
    /**
     * Display a listing of Appointment.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $appointments = Appointment::all();

        return view('agenda::agenda.admin.appointments.index', compact('appointments'));
    }


    /**
     * Show the form for creating new Appointment.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('agenda::agenda.admin.appointments.create');
    }

    /**
     * Store a newly created Appointment in storage.
     *
     * @param  \Flawless\Agenda\Http\Requests\Admin\StoreAppointmentsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAppointmentsRequest $request)
    {
      $service = Service::find($request->service_id);
      $rawstart = "".$request->date." ".$request->starting_hour .":".$request->starting_minute.":00";
      $rawend = "".$request->date." ".$request->finish_hour .":".$request->finish_minute.":00";


      $space = DB::table('appointments')
              ->select(DB::raw('count(id) as bussy') )
              ->where('service_id', '=', $request->service_id,)
              ->whereBetween('start_time', [$rawstart, $rawend])
              ->orWhereBetween('finish_time', [$rawstart, $rawend])
              ->orWhereBetween('finish_time', [$rawstart, $rawend])
              ->value('bussy');


                if ($space >= $service->available) {
                  session()->flash('error', 'Las citas para este servicio estan agotadas a esta hora revise el calendario e intente un lote vacio');
                  return view('agenda::agenda.admin.appointments.create');
                } else {
                    $start = Carbon::parse($rawstart);
                    $end = Carbon::parse($rawend);
                    $appointment = new Appointment;
                		$appointment->customer_id = $request->customer_id;
                		$appointment->service_id = $request->service_id;
                		$appointment->start_time = $start;
                		$appointment->finish_time = $end;
                    $appointment->confirmed = $request->confirmed;
                		$appointment->comments = $request->comments;
                		$appointment->save();

                    session()->flash('success', 'Nueva cita creada');
                    return redirect()->route('agenda.appointments.index');

                  // SELECT COUNT(`service_id`) FROM appointments
                  // WHERE (( @start >= `start_time` AND @start <= `finish_time`)
                  //  OR
                  //  ( @end >= `start_time` AND @end <= `finish_time`))
                  //   AND @id = `service_id`

                  // SELECT COUNT(coincidencias)
                  // FROM appointments
                  // WHERE '@start' >= `start_time`
                  //     AND '@start' <= `finish_time`
                  //     AND '@end' >= `start_time`
                  //     AND '@end' <= `finish_time`
                  //     AND '@id' = `service_id`
                }
    }


    /**
     * Show the form for editing Appointment.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $appointment = Appointment::findOrFail($id);

      return view('agenda::agenda.admin.appointments.edit', compact('appointment'));
    }

    /**
     * Update Appointment in storage.
     *
     * @param  \Flawless\Agenda\Http\Requests\Admin\UpdateAppointmentsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAppointmentsRequest $request, $id)
    {
        $appointment = Appointment::findOrFail($id);
        $space = DB::table('appointments')
                ->select(DB::raw('count(id) as bussy') )
                ->where('service_id', '=', $appointment->service_id,)
                ->whereBetween('start_time', [$request->start_time, $request->finish_time])
                ->orWhereBetween('finish_time', [$request->start_time, $request->finish_time])
                ->orWhereBetween('finish_time', [$request->start_time, $request->finish_time])
                ->value('bussy');

                if ($space >= $appointment->service->available) {
                  session()->flash('error', 'Las citas para este servicio estan agotadas a esta hora revise el calendario e intente un lote vacio');
                  return view('agenda::agenda.admin.appointments.edit', compact('appointment'));
                } else {
                  $start = Carbon::parse($request->start_time);
                  $end = Carbon::parse($request->finish_time);
                  $appointment->start_time = $start;
                  $appointment->finish_time = $end;
                  $appointment->confirmed = $request->confirmed;
                  $appointment->comments = $request->comments;
                  $appointment->update();
                  session()->flash('success', 'Cita Actualizada');
                  return redirect()->route('agenda.appointments.index');
                }
    }

    /**
     * Update Appointment in storage.
     *
     * @param  \Flawless\Agenda\Http\Requests\Admin\UpdateAppointmentsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function confirm($id)
    {
      $appointment = Appointment::findOrFail($id);
      $appointment->confirmed = true;
      $appointment->save();

      session()->flash('success', 'Cita Confirmada');
      return redirect()->route('agenda.appointments.index');
    }


    /**
     * Display Appointment.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
    //     if (! Gate::allows('appointment_view')) {
    //         return abort(401);
    //     }
    //     $relations = [
    //         'users' => \App\User::get()->pluck('name', 'id')->prepend('Please select', ''),
    //         'employees' => \App\Employee::get()->pluck('first_name', 'id')->prepend('Please select', ''),
    //     ];
    //
    //     $appointment = Appointment::findOrFail($id);
    //
    //     return view('admin.appointments.show', compact('appointment') + $relations);
    // }


    /**
     * Remove Appointment from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->delete();

        session()->flash('success', 'Grupo Eliminado');
        return redirect()->route('agenda.appointments.index');
    }

    /**
     * Delete all selected Appointment at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if ($request->input('ids')) {
            $entries = Appointment::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
