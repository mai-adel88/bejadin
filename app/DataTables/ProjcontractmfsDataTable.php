<?php

namespace App\DataTables;

use App\Models\Admin\Projcontractmfs;
use App\projectcontract;
use Yajra\DataTables\Services\DataTable;

class ProjcontractmfsDataTable extends DataTable
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
                return '<a href="project_contract/'.$query->ID_No.'/edit" class="btn btn-success edit"><i class="fa fa-edit"></i></a>';
            })
            ->addColumn('show', function ($query) {
                return '<a href="project_contract/'.$query->ID_No.'" class="btn btn-primary show"><i class="fa fa-search"></i></a>';
            })
            ->addColumn('branshes', function ($query) {

                return $query->branshe->map(function($branshe) {
                    if (app()->getLocale() == 'ar') {
                        return $branshe->Brn_NmAr;
                    }
                    if (app()->getLocale() == 'en') {
                        return $branshe->Brn_NmEn;
                    }
                })->implode(' ');
            })
            ->addColumn('projects', function ($query) {
                return $query->project->map(function($projecte) {

                    if (app()->getLocale() == 'ar') {
                        return $projecte->Prj_NmAr;
                    }
                    if (app()->getLocale() == 'en') {
                        return $projecte->Prj_NmEn;
                    }
                })->implode(' ');
            })
            ->addColumn('Cstm_No', function ($query) {
                return $query->subscriber->map(function($subscriber) {
                    if (app()->getLocale() == 'ar') {
                        return $subscriber->Cstm_NmAr;
                    }
                    if (app()->getLocale() == 'en') {
                        return $subscriber->Cstm_NmEn;
                    }
                })->implode(' ');
            })
            ->addColumn('delete', 'admin.Projcontractmfs.btn.delete')
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
        return Projcontractmfs::query()->orderByDesc('ID_No');
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
                        'text' => '<i class="fa fa-plus"></i> ' . trans('admin.add_project_contract'),
                        'className' => 'btn btn-primary create',
                        'action' => 'function( e, dt, button, config){
                                             window.location = "project_contract/create";
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
            ['name'=>'branshes','data'=>'branshes','title'=>trans('admin.section')],
            ['name'=>'projects','data'=>'projects','title'=>trans('admin.project_name')],
            ['name'=>'Tr_Dt','data'=>'Tr_Dt','title'=>trans('admin.Date_of_contract')],
            ['name'=>'CntCompL_Priod','data'=>'CntCompL_Priod','title'=>trans('admin.period_contract')],
            ['name'=>'Cstm_No','data'=>'Cstm_No','title'=>trans('admin.Subscribers')],
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
        return 'ProjectContract_' . date('YmdHis');
    }
}
