<?php

namespace App\DataTables;

use App\Admin;
use App\Hr;
use App\User;
use Yajra\DataTables\Services\DataTable;

class HrDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables($query)
            ->addColumn('permission', 'hr.hrs.btn.tags')
            ->addColumn('edit', function ($query) {
                return '<a href="hrs/'.$query->id.'/edit" class="btn btn-success"><i class="fa fa-edit"></i></a>';
            })

            ->addColumn('delete', 'hr.hrs.btn.delete')
            ->rawColumns([
                'edit',
                'delete',
                'permission',
                'branches',
            ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return \App\Models\Hr\Hr::query();
    }
    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
//                    ->parameters($this->getBuilderParameters());
            ->parameters([
                'dom' => 'Blfrtip',
                'lengthMenu' => [
                    [10,25,50,100,-1],[10,25,50,trans('hr.all_record')]
                ],
                'buttons' => [
                    [
                        'text' => '<i class="fa fa-plus"></i> ' . trans('hr.create_hr'),
                        'className' => 'btn btn-primary create',
                        'action' => 'function( e, dt, button, config){ 
                             window.location = "hrs/create";
                         }',
                    ],[
                        'text' => '<i class="fa fa-flag"></i> ' . trans('hr.roles'),
                        'className' => 'btn btn-primary',
                        'action' => 'function( e, dt, button, config){ 
                             window.location = "HrRoles";
                         }',
                    ],
                    [
                        'text' => '<i class="fa fa-flag"></i> ' . trans('hr.permissions'),
                        'className' => 'btn btn-primary',
                        'action' => 'function( e, dt, button, config){ 
                             window.location = "HrPermissions";
                         }',
                    ],
                    ['extend' => 'print','className' => 'btn btn-primary' , 'text' => '<i class="fa fa-print"></i>'],
                    ['extend' => 'excel','className' => 'btn btn-success' , 'text' => '<i class="fa fa-file"></i> ' . trans('hr.excel')],
                    ['extend' => 'reload','className' => 'btn btn-info' , 'text' => '<i class="fa fa-refresh"></i>']
                ],
//                    "initComplete" => "function () {
//                    this.api().columns([0,1,2,3]).every(function () {
//                        var column = this;
//                        var input = document.createElement(\"input\");
//                        $(input).appendTo($(column.footer()).empty())
//                        .on('keyup', function () {
//                            var val = $.fn.dataTable.util.escapeRegex($(this).val());
//
//                            column.search(val ? val : '', true, false).draw();
//                        });
//                    });
//                    }",


            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            ['name'=>'id','data'=>'name','id'=>trans('hr.number')],
            ['name'=>'name','data'=>'name','title'=>trans('hr.name')],
            ['name'=>'email','data'=>'email','title'=>trans('hr.email')],
            ['name'=>'created_at','data'=>'created_at','title'=>trans('hr.created_at')],
            ['name'=>'updated_at','data'=>'updated_at','title'=>trans('hr.updated_at')],
            ['name'=>'permission','data'=>'permission','title'=>trans('hr.permissions') ,'printable'=>false,'exportable'=>false,'orderable'=>false,'searchable'=>false],
            ['name'=>'edit','data'=>'edit','title'=>trans('hr.edit'),'printable'=>false,'exportable'=>false,'orderable'=>false,'searchable'=>false],
            ['name'=>'delete','data'=>'delete','title'=>trans('hr.delete'),'printable'=>false,'exportable'=>false,'orderable'=>false,'searchable'=>false],

        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Hrs_' . date('YmdHis');
    }
}
