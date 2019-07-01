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
class GroupDataGrid extends DataGrid
{
    protected $sortOrder = 'desc'; //asc or desc

    protected $index = 'id';

    protected $itemsPerPage = 20;

    public function prepareQueryBuilder()
    {
        $queryBuilder = DB::table('groups')
        ->where('deleted_at', null)
        ->groupBy('id');

        $this->addFilter('id', 'groups.id');
        $this->addFilter('product_name', 'groups.name');

        $this->setQueryBuilder($queryBuilder);
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
            'index' => 'name',
            'label' => 'Nombre',
            'type' => 'string',
            'searchable' => true,
            'sortable' => true,
            'filterable' => true
        ]);
    }

    public function prepareActions() {
        $this->addAction([
            'type' => 'Edit',
            'method' => 'GET', // use GET request only for redirect purposes
            'route' => 'agenda.groups.edit',
            'icon' => 'icon pencil-lg-icon'
        ]);

        $this->addAction([
            'type' => 'Delete',
            'method' => 'POST', // use GET request only for redirect purposes
            'route' => 'agenda.groups.delete',
            'confirm_text' => 'Esta seguro de querer eliminar?',
            'icon' => 'icon trash-icon'
        ]);

        $this->enableAction = true;
    }

    public function prepareMassActions() {
        $this->addMassAction([
            'type' => 'delete',
            'label' => 'Delete',
            'action' => route('agenda.groups.massdelete'),
            'method' => 'DELETE'
        ]);

        $this->enableMassAction = false;
    }
}
