<?php

namespace App\DataTables;

use App\User;
use App\Project;
use App\employee;
use Yajra\DataTables\Services\DataTable;

class projectDataTable extends DataTable
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
            ->addColumn('edit', function ($query) {
                return '<a href="projects/'.$query->id.'/edit" class="btn btn-success edit"><i class="fa fa-edit"></i> ' . trans('admin.edit') . '</a>';
            })
            ->addColumn('show', function ($query) {
                return '<a href="projects/'.$query->id.'" class="btn btn-primary show"><i class="fa fa-show"></i> ' . trans('admin.show') . '</a>';
            })
            // ->addColumn('subscribers', function ($query) {
            //     return $query->subscribers->map(function($subscribers) {
            //         return $subscribers->name_ar;
            //     })->implode(' ');
            // })
            ->addColumn('delete', 'admin.projects.btn.delete')
            ->rawColumns([
                'show',
                'edit',
                'delete',
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
        return Project::query()->orderByDesc('id');
    }
    public static function lang(){
        $langJson = [
            "sProcessing"=> trans('admin.sProcessing'),
            "sZeroRecords"=> trans('admin.sZeroRecords'),
            "sEmptyTable"=> trans('admin.sEmptyTable'),
            "sInfoFiltered"=> trans('admin.sInfoFiltered'),
            "sSearch"=> trans('admin.sSearch'),
            "sUrl"=> trans('admin.sUrl'),
            "sInfoThousands"=> trans('admin.sInfoThousands'),
            "sLoadingRecords"=> trans('admin.sLoadingRecords'),
            "oPaginate"=> [
                "sFirst"=> trans('admin.sFirst'),
                "sLast"=> trans('admin.sLast'),
                "sNext"=> trans('admin.sNext'),
                "sPrevious"=> trans('admin.sPrevious')
            ],
            "oAria"=> [
                "sSortAscending"=> trans('admin.sSortAscending'),
                "sSortDescending"=> trans('admin.sSortDescending')
            ]
        ];
        return $langJson;
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
                    ->parameters([
                        'dom' => 'Blfrtip',
                        'lengthMenu' => [
                            [10,25,50,100,-1],[10,25,50,trans('admin.all_record')]
                        ],
                        'buttons' => [
                            [
                                'text' => '<i class="fa fa-plus"></i> ' . trans('admin.add_new_project'),
                                'className' => 'btn btn-primary create',
                                'action' => 'function( e, dt, button, config){
                                             window.location = "projects/create";
                                         }',
                            ],
                            ['extend' => 'print','className' => 'btn btn-primary' , 'text' => '<i class="fa fa-print"></i>'],
                            ['extend' => 'excel','className' => 'btn btn-success' , 'text' => '<i class="fa fa-file"></i> ' . trans('admin.EXCEL')],
                            ['extend' => 'reload','className' => 'btn btn-info' , 'text' => '<i class="fa fa-refresh"></i>']
                        ],
                        "initComplete" => "function () {
                                    this.api().columns([0]).every(function () {
                                        var column = this;
                                        var input = document.createElement(\"input\");
                                        $(input).appendTo($(column.footer()).empty())
                                        .on('keyup', function () {
                                            var val = $.fn.dataTable.util.escapeRegex($(this).val());

                                            column.search(val ? val : '', true, false).draw();
                                        });
                                    });
                                    }",
                        "language" =>  self::lang(),

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
            ['name'=>'name_'.session('lang'),'data'=>'name_'.session('lang'),'title'=>trans('admin.name')],
            ['name'=>'contract_number','data'=>'contract_number','title'=>trans('admin.contract_number')],
            ['name'=>'phone_number','data'=>'phone_number','title'=>trans('admin.phone_number')],
            ['name'=>'email','data'=>'email','title'=>trans('admin.email_project')],
            ['name'=>'warehouse','data'=>'warehouse','title'=>trans('admin.warehouse')],
            ['name'=>'responsible_person','data'=>'responsible_person','title'=>trans('admin.responsible_person')],
            ['name'=>'show','data'=>'show','title'=>trans('admin.show'),'printable'=>false,'exportable'=>false,'orderable'=>false,'searchable'=>false],
            ['name'=>'edit','data'=>'edit','title'=>trans('admin.edit'),'printable'=>false,'exportable'=>false,'orderable'=>false,'searchable'=>false],
            ['name'=>'delete','data'=>'delete','title'=>trans('admin.delete'),'printable'=>false,'exportable'=>false,'orderable'=>false,'searchable'=>false],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'project_' . date('YmdHis');
    }
}
