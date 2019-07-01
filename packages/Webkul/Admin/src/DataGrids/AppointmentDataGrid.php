<?php

namespace Webkul\Admin\DataGrids;

use Webkul\Ui\DataGrid\DataGrid;
use DB;

/**
 * CustomerDataGrid class
 *
 * @author Prashant Singh <prashant.singh852@webkul.com> @prashant-webkul
 * @copyright 2018 Webkul Software Pvt Ltd (http://www.webkul.com)
 */
class AppointmentDataGrid extends DataGrid
{
    protected $index = 'id'; //the column that needs to be treated as index column

    protected $sortOrder = 'desc'; //asc or desc

    protected $itemsPerPage = 10;

    public function prepareQueryBuilder()
    {
      $queryBuilder = DB::table('appointments')
              ->leftJoin('customers', 'appointments.customer_id', '=', 'customers.id')
              ->leftJoin('services', 'appointments.service_id', '=', 'services.id')
              ->select('appointments.id as id', 'customers.phone as phone', 'services.name as service_name', 'appointments.start_time as start_time', 'appointments.finish_time as finish_time', 'appointments.confirmed as confirmed')
              ->addSelect(DB::raw('CONCAT(customers.first_name, " ", customers.last_name) as full_name'))
              ->groupBy('appointments.id');

              $this->addFilter('id', 'appointments.service_id');
              $this->addFilter('phone', 'customers.phone');
              $this->addFilter('service_name', 'services.name');
              $this->addFilter('start_time', 'appointments.start_time');
              $this->addFilter('finish_time', 'appointments.start_time');
              $this->addFilter('confirmed', 'appointments.confirmed');

              $this->setQueryBuilder($queryBuilder);
              // SELECT
              //    a.id AS 'id',
              //    c.first_name AS 'Nombre',
              //    c.last_name AS 'Apellido',
              //    c.phone AS 'telefono',
              //    s.name AS 'servicio',
              //    a.start_time AS 'llegada',
              //    a.finish_time AS 'salida',
              //    a.confirmed AS 'confirmado'
              //   FROM
              //    appointments a
              //   LEFT JOIN customers c ON a.customer_id = c.id
              //   LEFT JOIN services s ON a.service_id = s.id
              //   GROUP BY a.id;
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
          'index' => 'full_name',
          'label' => 'Nombre',
          'type' => 'string',
          'searchable' => true,
          'sortable' => true,
          'filterable' => true
      ]);

      $this->addColumn([
          'index' => 'phone',
          'label' => 'Telefono',
          'type' => 'string',
          'searchable' => true,
          'sortable' => true,
          'filterable' => true
      ]);

      $this->addColumn([
          'index' => 'service_name',
          'label' => 'Servicio',
          'type' => 'string',
          'searchable' => false,
          'sortable' => true,
          'filterable' => true
      ]);

      $this->addColumn([
          'index' => 'start_time',
          'label' => 'Inicio',
          'type' => 'string',
          'searchable' => false,
          'sortable' => true,
          'filterable' => true
      ]);

      $this->addColumn([
          'index' => 'finish_time',
          'label' => 'Fin',
          'type' => 'number',
          'searchable' => false,
          'sortable' => true,
          'filterable' => true
      ]);

        $this->addColumn([
            'index' => 'confirmed',
            'label' => 'Confirmado',
            'type' => 'boolean',
            'searchable' => false,
            'sortable' => true,
            'filterable' => true,
            'wrapper' => function ($row) {
                if ($row->confirmed == 1) {
                    return 'SI';
                } else {
                    return 'NO';
                }
            }
        ]);
    }

    public function prepareActions() {
        $this->addAction([
            'type' => 'Edit',
            'method' => 'GET', // use GET request only for redirect purposes
            'route' => 'agenda.appointments.edit',
            'icon' => 'icon pencil-lg-icon',
            'title' => 'Editar'
        ]);

        $this->addAction([
            'type' => 'Delete',
            'method' => 'POST', // use GET request only for redirect purposes
            'route' => 'agenda.appointments.delete',
            'confirm_text' => 'Esta seguro de querer eliminar la cita?',
            'icon' => 'icon trash-icon',
            'title' => 'Borrar'
        ]);

        $this->addAction([
            'type' => 'Add Note',
            'method' => 'GET',
            'route' => 'agenda.appointments.confirm',
            'icon' => 'icon note-icon',
            'title' => 'Confirmar'
        ]);
    }

    /**
     * Customer Mass Action To Delete And Change Their
     */
    public function prepareMassActions()
    {
        // $this->addMassAction([
        //     'type' => 'delete',
        //     'label' => 'Delete',
        //     'action' => route('admin.customer.mass-delete'),
        //     'method' => 'PUT',
        // ]);
        //
        // $this->addMassAction([
        //     'type' => 'update',
        //     'label' => 'Update Status',
        //     'action' => route('admin.customer.mass-update'),
        //     'method' => 'PUT',
        //     'options' => [
        //         'Active' => 1,
        //         'Inactive' => 0
        //     ]
        // ]);

        $this->enableMassAction = false;
    }
}
