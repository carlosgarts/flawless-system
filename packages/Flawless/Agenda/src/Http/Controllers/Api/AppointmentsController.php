<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Appointment;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\Admin\StoreAppointmentsRequest;
use App\Http\Requests\Admin\UpdateAppointmentsRequest;
use Carbon\Carbon;

class AppointmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAppointmentsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $finish = Carbon::parse($request['start'])->addHour();
        try {
            $appointment = new Appointment;
            $appointment->user_id = $request['id_user'];
            $appointment->employee_id = '1';
            $appointment->start_time = $request['start'];
            $appointment->finish_time = $finish;
            $appointment->comments = $request['comments'];
            $appointment->save();
        } catch (\Throwable $th) {
            return ['status' => 'error'];
        }
        return ['status' => 'succes'];
		
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        try {
            $appointment = Appointment::where('user_id', $request['user_id'])->where('start_time', '>=', Carbon::now())->orderBy('start_time', 'asc')->take(3)->get();
        } catch (\Throwable $th) {
            return ['status' => 'error'];
        }
        return response()->json($appointment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {
            $appointment = Appointment::findOrFail($request['id']);
            $appointment->update([
                        'start_time' => $request['start_time'],
                        'finish_time' => $request['finish_time'],
                        'comments' => $request['comments']
                        ]);
        } catch (\Throwable $th) {
            return ['status'=>'error'];
        }
        return ['status'=>'succes'];
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function delete(Request $request)
    {
        try {
            $appointment = Appointment::findOrFail($request['id']);
            $appointment->delete();
        } catch (\Throwable $th) {
            return ['status'=>'error'];
        }
        return ['status'=>'succes'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
