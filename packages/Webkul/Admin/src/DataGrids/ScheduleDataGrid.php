<?php

namespace Webkul\Admin\DataGrids;

use Webkul\Ui\DataGrid\DataGrid;
use DB;

/**
 * ProductDataGrid Class
 *
 * @author Carlos Gamez <carlosgarts@gmail.com>
 * @copyright 2019 Carlos Gamez
 */
class ScheduleDataGrid extends DataGrid
{
    protected $sortOrder = 'desc'; //asc or desc

    protected $index = 'id';

    protected $itemsPerPage = 20;

    public function prepareQueryBuilder()
    {
        $queryBuilder = DB::table('schedules')
        ->where('deleted_at', null)
        ->groupBy('id');

        $this->setQueryBuilder($queryBuilder);
    }

    public function addColumns()
    {
        $this->addColumn([
            'index' => 'id',
            'label' => 'ID',
            'type' => 'number',
            'searchable' => true,
            'sortable' => true,
            'filterable' => true
        ]);

        $this->addColumn([
            'index' => 'start_time',
            'label' => 'Hora de Entrada',
            'type' => 'string',
            'searchable' => false,
            'sortable' => false,
            'filterable' => false
        ]);

        $this->addColumn([
            'index' => 'finish_time',
            'label' => 'Hora de Salida',
            'type' => 'string',
            'searchable' => false,
            'sortable' => false,
            'filterable' => false
        ]);
    }

    public function prepareActions() {
        $this->addAction([
            'type' => 'Edit',
            'method' => 'GET', // use GET request only for redirect purposes
            'route' => 'agenda.schedules.edit',
            'icon' => 'icon pencil-lg-icon'
        ]);

        // $this->addAction([
        //     'type' => 'Delete',
        //     'method' => 'POST', // use GET request only for redirect purposes
        //     'route' => 'agenda.hollydays.delete',
        //     'confirm_text' => 'Esta seguro de querer eliminar?',
        //     'icon' => 'icon trash-icon'
        // ]);

        $this->enableAction = true;
    }

    public function prepareMassActions() {
        $this->addMassAction([
            'type' => 'delete',
            'label' => 'Delete',
            'action' => route('agenda.schedules.massdelete'),
            'method' => 'DELETE'
        ]);

        $this->enableMassAction = false;
    }
}
