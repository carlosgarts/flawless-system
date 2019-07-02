<?php

namespace Flawless\Agenda\Http\Controllers\Api;

use Flawless\Agenda\Models\Schedule;
use Flawless\Agenda\Models\Hollyday;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use Flawless\Agenda\Http\Requests\Admin\StoreSchedulesRequest;
use Flawless\Agenda\Http\Requests\Admin\UpdateSchedulesRequest;

class SchedulesController extends Controller
{
  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function retrieveSchedule()
  {
      $schedule = Schedule::all();

      return response()->json([
        "horario" => $schedule
      ]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function retrieveHollydays()
  {
      $hollyday = Hollyday::all();

      return response()->json([
        "feriados" => $hollyday
      ]);
  }
}
