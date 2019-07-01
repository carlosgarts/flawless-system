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
class ServiceDataGrid extends DataGrid
{
    protected $sortOrder = 'desc'; //asc or desc

    protected $index = 'id';

    protected $itemsPerPage = 20;

    public function prepareQueryBuilder()
    {
        $queryBuilder = DB::table('services')
            ->leftJoin('groups', 'services.group_id', '=', 'groups.id')
            ->select('services.id as id', 'services.name as service_name', 'groups.name as group_name', 'services.price as price', 'services.duration as duration', 'services.available as available')
            ->where('services.deleted_at', null)
            ->groupBy('services.id');

        $this->addFilter('id', 'services.id');
        $this->addFilter('service_name', 'services.name');
        $this->addFilter('group_name', 'groups.name');

        $this->setQueryBuilder($queryBuilder);

        // SELECT
        //  s.id AS 'id',
        //  s.name AS 'service_name',
        //  g.name AS 'group_name',
        //  s.price AS 'price',
        //  s.duration AS 'duration',
        //  s.available AS 'available'
        // FROM
        //  services s
        // LEFT JOIN groups g ON s.group_id = g.id;
    }

    public function addColumns()
    {
        $this->addColumn([
            'index' => 'id',
            'label' => 'ID',
            'type' => 'number',
            'searchable' => false,
            'sortable' => true,
            'filterable' => true
        ]);

        $this->addColumn([
            'index' => 'service_name',
            'label' => 'Nombre',
            'type' => 'string',
            'searchable' => true,
            'sortable' => true,
            'filterable' => true
        ]);

        $this->addColumn([
            'index' => 'group_name',
            'label' => 'Grupo',
            'type' => 'string',
            'searchable' => true,
            'sortable' => true,
            'filterable' => true
        ]);

        $this->addColumn([
            'index' => 'price',
            'label' => 'Precio',
            'type' => 'string',
            'searchable' => false,
            'sortable' => true,
            'filterable' => true
        ]);

        $this->addColumn([
            'index' => 'duration',
            'label' => 'Duracion',
            'type' => 'string',
            'searchable' => false,
            'sortable' => true,
            'filterable' => true
        ]);

        $this->addColumn([
            'index' => 'available',
            'label' => 'Limite',
            'type' => 'number',
            'searchable' => false,
            'sortable' => true,
            'filterable' => true
        ]);
    }

    public function prepareActions() {
        $this->addAction([
            'type' => 'Edit',
            'method' => 'GET', // use GET request only for redirect purposes
            'route' => 'agenda.services.edit',
            'icon' => 'icon pencil-lg-icon'
        ]);

        $this->addAction([
            'type' => 'Delete',
            'method' => 'POST', // use GET request only for redirect purposes
            'route' => 'agenda.services.delete',
            'confirm_text' => 'Esta seguro de querer eliminar?',
            'icon' => 'icon trash-icon'
        ]);

        $this->enableAction = true;
    }

    public function prepareMassActions() {
        $this->addMassAction([
            'type' => 'delete',
            'label' => 'Delete',
            'action' => route('agenda.services.massdelete'),
            'method' => 'DELETE'
        ]);

        $this->enableMassAction = false;
    }
}
