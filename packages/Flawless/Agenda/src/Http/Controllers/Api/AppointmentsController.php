<?php

namespace Flawless\Agenda\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Flawless\Agenda\Models\Appointment;
use Flawless\Agenda\Models\Service;
use Flawless\Agenda\Http\Requests\Admin\StoreAppointmentsRequest;
use Flawless\Agenda\Http\Requests\Admin\UpdateAppointmentsRequest;
use Carbon\Carbon;

class AppointmentsController extends Controller
{

    protected $_config;

    public function __construct()
    {
        $this->_config = request('_config');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAppointmentsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $appointment = new Appointment;
            $appointment->customer_id = $request['customer_id'];
            $appointment->service_id = $request['service_id'];
            $appointment->start_time = $request['start_time'];
            $appointment->finish_time = $request['finish_time'];
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
            $appointment = Appointment::where('customer_id', $request['customer_id'])->where('start_time', '>=', Carbon::now())->orderBy('start_time', 'asc')->take(3)->get();
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
