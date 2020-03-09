<?php

namespace App\DataTables;

use App\Branches;
use App\Enums\GenderType;
use App\Enums\PayType;
use App\Enums\TypeType;
use App\subscription;
use App\Models\Admin\AstMarket;

use Yajra\DataTables\Services\DataTable;

class SupervisorDataTable extends DataTable
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
                return '<a  href="supervisors/'.$query->ID_No.'/edit" class="btn btn-success edit"><i class="fa fa-edit"></i></a>';
            })
            ->addColumn('branches', function ($query) {
                return session_lang($query->branches['name_en'],$query->branches['name_ar']);
            })

            ->addColumn('details', function ($query) {
                return '<a href="supervisors/'.$query->ID_No.'" class="btn btn-primary"><i class="fa fa-info"></i></a>';
            })


            ->addColumn('delete', 'admin.supervisors.btn.delete')
            ->addColumn('status', 'admin.supervisors.status')
            ->addColumn('type', function ($query) {
                return TypeType::getDescription($query->type);
            })

            ->addColumn('gender',  function ($query) {
                return GenderType::getDescription($query->gender);
            })
            ->rawColumns([
                'edit',
                'delete',
                'details',
                'parent',
                'parent_phone',
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
        return AstMarket::query()->orderByDesc('ID_No');
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
                    [5,10,25,50,100,-1],[5,10,25,50,trans('admin.all_record')]
                ],
                'buttons' => [
                    [
                        'text' => '<i class="fa fa-plus"></i> ' . trans('admin.create_new_supervisor'),
                        'className' => 'btn btn-primary create',
                        'action' => 'function( e, dt, button, config){
                             window.location = "supervisors/create";
                         }',
                    ],[
                        'text' => '<i class="fa fa-flag"></i> ' . trans('admin.relatedness'),
                        'className' => 'btn btn-primary',
                        'action' => 'function( e, dt, button, config){
                             window.location = "relatedness";
                         }',
                    ],
                    ['extend' => 'print','className' => 'btn btn-primary' , 'text' => '<i class="fa fa-print"></i>'],
                    ['extend' => 'excel','className' => 'btn btn-success' , 'text' => '<i class="fa fa-file"></i> ' . trans('admin.EXCEL')],
                    ['extend' => 'reload','className' => 'btn btn-info' , 'text' => '<i class="fa fa-refresh"></i>']
                ],
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
            ['name'=>'Mrkt_No','data'=>'Mrkt_No','title'=>trans('admin.Mrkt_No')],
            ['name'=>'Mrkt_NmAr','data'=>'Mrkt_NmAr','title'=>trans('admin.arabic_name')],
            ['name'=>'Mrkt_NmEn','data'=>'Mrkt_NmEn','title'=>trans('admin.english_name')],
            //['name'=>'Brn_No','data'=>'Brn_No','title'=>trans('admin.Brn_No')],
            ['name'=>'created_at','data'=>'created_at','title'=>trans('admin.created_at')],
            ['name'=>'updated_at','data'=>'updated_at','title'=>trans('admin.updated_at')],
            ['name'=>'details','data'=>'details','title'=>trans('admin.details'),'printable'=>false,'exportable'=>false,'orderable'=>false,'searchable'=>false],
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
        return 'subscriber_' . date('YmdHis');
    }
}
