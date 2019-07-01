<?php

return [
    [
        'key' => 'agenda',          // uniquely defined key for menu-icon
        'name' => 'Agenda',        //  name of menu-icon
        'route' => 'agenda.index',  // the route for your menu-icon
        'sort' => 9,                    // Sort number on which your menu-icon should display
        'icon-class' => 'catalog-icon',   //class of menu-icn
    ], [
        'key' => 'agenda.citas',
        'name' => 'Citas',
        'route' => 'agenda.appointments.index',
        'sort' => 1,
        'icon-class' => '',
    ] ,[
        'key' => 'agenda.servicios',
        'name' => 'Servicios',
        'route' => 'agenda.services.index',
        'sort' => 2,
        'icon-class' => '',
    ], [
        'key' => 'agenda.groups',
        'name' => 'Grupos',
        'route' => 'agenda.groups.index',
        'sort' => 3,
        'icon-class' => '',
    ], [
        'key' => 'agenda.horarios',
        'name' => 'Horario',
        'route' => 'agenda.schedules.index',
        'sort' => 4,
        'icon-class' => '',
    ], [
        'key' => 'agenda.hollydays',
        'name' => 'Fechas Libres',
        'route' => 'agenda.hollydays.index',
        'sort' => 5,
        'icon-class' => '',
    ],
];
