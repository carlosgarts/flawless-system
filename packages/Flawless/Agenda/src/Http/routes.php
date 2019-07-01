<?php

    // Route::view('/agenda', 'agenda::agenda.agenda');
    // Route::view('/agenda/citas', 'agenda::agenda.agenda');
    // Route::view('/agenda/servicios', 'agenda::agenda.agenda');
    // Route::view('/agenda/horarios', 'agenda::agenda.agenda');
Route::group(['middleware' => ['admin']], function () {
    Route::get('agenda', 'Flawless\Agenda\Http\Controllers\AgendaController@index')->defaults('_config', ['view' => 'agenda::agenda.index'])->name('agenda.index');
    Route::get('agenda/citas', 'Flawless\Agenda\Http\Controllers\AgendaController@index')->defaults('_config', ['view' => 'agenda::agenda.citas.index'])->name('agenda.citas.index');
    Route::get('agenda/horarios', 'Flawless\Agenda\Http\Controllers\AgendaController@index')->defaults('_config', ['view' => 'agenda::agenda.horarios.index'])->name('agenda.horarios.index');

      //Admin Groups
    Route::get('agenda/groups', 'Flawless\Agenda\Http\Controllers\Admin\GroupsController@index')->name('agenda.groups.index');
    Route::get('agenda/groups/create', 'Flawless\Agenda\Http\Controllers\Admin\GroupsController@create')->name('agenda.groups.create');
    Route::post('agenda/groups/store', 'Flawless\Agenda\Http\Controllers\Admin\GroupsController@store')
      ->defaults('_config',['redirect' => 'agenda.groups.index'])
      ->name('agenda.groups.store');//Store
    Route::get('agenda/groups/edit/{id}', 'Flawless\Agenda\Http\Controllers\Admin\GroupsController@edit')->name('agenda.groups.edit');
    Route::put('agenda/groups/update/{id}', 'Flawless\Agenda\Http\Controllers\Admin\GroupsController@update')
      ->defaults('_config',['redirect' => 'agenda.groups.index'])
      ->name('agenda.groups.update');//Update
    Route::post('agenda/groups/delete/{id}', 'Flawless\Agenda\Http\Controllers\Admin\GroupsController@destroy')
      ->defaults('_config',['redirect' => 'agenda.groups.index'])
      ->name('agenda.groups.delete');//Delete
    Route::post('agenda/groups/massdelete', 'Flawless\Agenda\Http\Controllers\Admin\GroupsController@massDestroy')
      ->defaults('_config',['redirect' => 'agenda.groups.index'])
      ->name('agenda.groups.massdelete');

    //Admin Hollydays
    Route::get('agenda/hollydays', 'Flawless\Agenda\Http\Controllers\Admin\HollydaysController@index')->name('agenda.hollydays.index');
    Route::get('agenda/hollydays/create', 'Flawless\Agenda\Http\Controllers\Admin\HollydaysController@create')->name('agenda.hollydays.create');
    Route::post('agenda/hollydays/store', 'Flawless\Agenda\Http\Controllers\Admin\HollydaysController@store')
      ->defaults('_config',['redirect' => 'agenda.hollydays.index'])
      ->name('agenda.hollydays.store');//Store
    Route::get('agenda/hollydays/edit/{id}', 'Flawless\Agenda\Http\Controllers\Admin\HollydaysController@edit')->name('agenda.hollydays.edit');
    Route::put('agenda/hollydays/update/{id}', 'Flawless\Agenda\Http\Controllers\Admin\HollydaysController@update')
      ->defaults('_config',['redirect' => 'agenda.hollydays.index'])
      ->name('agenda.hollydays.update');//Update
    Route::post('agenda/hollydays/delete/{id}', 'Flawless\Agenda\Http\Controllers\Admin\HollydaysController@destroy')
      ->defaults('_config',['redirect' => 'agenda.hollydays.index'])
      ->name('agenda.hollydays.delete');//Delete
    Route::post('agenda/hollydays/massdelete', 'Flawless\Agenda\Http\Controllers\Admin\HollydaysController@massDestroy')
      ->defaults('_config',['redirect' => 'agenda.hollydays.index'])
      ->name('agenda.hollydays.massdelete');

      //Admin Services
      Route::get('agenda/services', 'Flawless\Agenda\Http\Controllers\Admin\ServicesController@index')->name('agenda.services.index');
      Route::get('agenda/services/create', 'Flawless\Agenda\Http\Controllers\Admin\ServicesController@create')->name('agenda.services.create');
      Route::post('agenda/services/store', 'Flawless\Agenda\Http\Controllers\Admin\ServicesController@store')
        ->defaults('_config',['redirect' => 'agenda.services.index'])
        ->name('agenda.services.store');//Store
      Route::get('agenda/services/edit/{id}', 'Flawless\Agenda\Http\Controllers\Admin\ServicesController@edit')->name('agenda.services.edit');
      Route::put('agenda/services/update/{id}', 'Flawless\Agenda\Http\Controllers\Admin\ServicesController@update')
        ->defaults('_config',['redirect' => 'agenda.services.index'])
        ->name('agenda.services.update');//Update
      Route::post('agenda/services/delete/{id}', 'Flawless\Agenda\Http\Controllers\Admin\ServicesController@destroy')
        ->defaults('_config',['redirect' => 'agenda.services.index'])
        ->name('agenda.services.delete');//Delete
      Route::post('agenda/services/massdelete', 'Flawless\Agenda\Http\Controllers\Admin\ServicesController@massDestroy')
        ->defaults('_config',['redirect' => 'agenda.services.index'])
        ->name('agenda.services.massdelete');

        //Admin Schedules
        Route::get('agenda/schedules', 'Flawless\Agenda\Http\Controllers\Admin\SchedulesController@index')->name('agenda.schedules.index');
        Route::get('agenda/schedules/create', 'Flawless\Agenda\Http\Controllers\Admin\SchedulesController@create')->name('agenda.schedules.create');
        Route::post('agenda/schedules/store', 'Flawless\Agenda\Http\Controllers\Admin\SchedulesController@store')
          ->defaults('_config',['redirect' => 'agenda.schedules.index'])
          ->name('agenda.schedules.store');//Store
        Route::get('agenda/schedules/edit/{id}', 'Flawless\Agenda\Http\Controllers\Admin\SchedulesController@edit')->name('agenda.schedules.edit');
        Route::put('agenda/schedules/update/{id}', 'Flawless\Agenda\Http\Controllers\Admin\SchedulesController@update')
          ->defaults('_config',['redirect' => 'agenda.schedules.index'])
          ->name('agenda.schedules.update');//Update
        Route::post('agenda/schedules/delete/{id}', 'Flawless\Agenda\Http\Controllers\Admin\SchedulesController@destroy')
          ->defaults('_config',['redirect' => 'agenda.schedules.index'])
          ->name('agenda.schedules.delete');//Delete
        Route::post('agenda/schedules/massdelete', 'Flawless\Agenda\Http\Controllers\Admin\SchedulesController@massDestroy')
          ->defaults('_config',['redirect' => 'agenda.schedules.index'])
          ->name('agenda.schedules.massdelete');

        //Admin Appointments
        Route::get('agenda/appointments', 'Flawless\Agenda\Http\Controllers\Admin\AppointmentsController@index')->name('agenda.appointments.index');
        Route::get('agenda/appointments/create', 'Flawless\Agenda\Http\Controllers\Admin\AppointmentsController@create')->name('agenda.appointments.create');
        Route::post('agenda/appointments/store', 'Flawless\Agenda\Http\Controllers\Admin\AppointmentsController@store')
          ->defaults('_config',['redirect' => 'agenda.appointments.index'])
          ->name('agenda.appointments.store');//Store
        Route::get('agenda/appointments/edit/{id}', 'Flawless\Agenda\Http\Controllers\Admin\AppointmentsController@edit')->name('agenda.appointments.edit');
        Route::put('agenda/appointments/update/{id}', 'Flawless\Agenda\Http\Controllers\Admin\AppointmentsController@update')
          ->defaults('_config',['redirect' => 'agenda.appointments.index'])
          ->name('agenda.appointments.update');//Update
        Route::post('agenda/appointments/delete/{id}', 'Flawless\Agenda\Http\Controllers\Admin\AppointmentsController@destroy')
          ->defaults('_config',['redirect' => 'agenda.appointments.index'])
          ->name('agenda.appointments.delete');//Delete
        Route::post('agenda/appointments/massdelete', 'Flawless\Agenda\Http\Controllers\Admin\AppointmentsController@massDestroy')
          ->defaults('_config',['redirect' => 'agenda.appointments.index'])
          ->name('agenda.appointments.massdelete');
          Route::get('agenda/appointments/confirm/{id}', 'Flawless\Agenda\Http\Controllers\Admin\AppointmentsController@confirm')->name('agenda.appointments.confirm');
});
