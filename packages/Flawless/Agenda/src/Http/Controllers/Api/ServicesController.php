<?php

namespace Flawless\Agenda\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Flawless\Agenda\Models\Service;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Collection;
use App\Http\Requests\Admin\StoreAppointmentsRequest;
use App\Http\Requests\Admin\UpdateAppointmentsRequest;
use Carbon\Carbon;
use DB;
use Flawless\Agenda\Models\Group;
use Flawless\Agenda\Http\Requests\Admin\StoreGroupsRequest;
use Flawless\Agenda\Http\Requests\Admin\UpdateGroupsRequest;

class ServicesController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function retrieveServices()
    {
        $groups = Group::all();
        $services = Service::all();

        return response()->json([
          "grupos" => $groups,
          "servicios"=> $services
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function checkAvailable(Request $request)
    {
      $service = Service::find($request['service_id']);
      $finish_time = Carbon::createFromFormat('Y-m-d H:i:s', $request['start_time'])->addMinutes($service->duration)->toDateTimeString();

      $space = DB::table('appointments')
              ->select(DB::raw('count(id) as bussy') )
              ->where('service_id', '=', $request['service_id'])
              ->where('deleted_at', null)
              ->whereBetween('start_time', [$request['start_time'], $finish_time])
              ->orWhereBetween('finish_time', [$request['start_time'], $finish_time])
              ->orWhereBetween('finish_time', [$request['start_time'], $finish_time])
              ->value('bussy');


                if ($space >= $service->available) {
                  return response()->json([
                    "response" => "full"
                  ]);
                } else {
                  return response()->json([
                    "response" => "free"
                  ]);
                }
              }
  }
