<?php

namespace App\DataTables;

use App\Models\Admin\HREmpCnt;
use App\Enums\HrHousePaymentType;
use Yajra\DataTables\Services\DataTable;

class employeeDataTable extends DataTable
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
            ->addColumn('Pymnt_No', function ($query) {
                return HrHousePaymentType::getDescription($query->Pymnt_No);
            })
            ->addColumn('edit', function ($query) {
                return '<a href="employees/'.$query->ID_No.'/edit" class="btn btn-success edit"><i class="fa fa-edit"></i> '.'</a>';
            })
            ->addColumn('show', function ($query) {
                return '<a href="employees/'.$query->ID_No.'" class="btn btn-primary"><i class="fa fa-eye"></i></a>';
            })
            ->addColumn('delete', 'admin.employees.btn.delete')
            ->rawColumns([
                'edit',
                'show',
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
        return HREmpCnt::query()->orderByDesc('ID_No');
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
                                'text' => '<i class="fa fa-plus"></i> ' . trans('admin.Add_New_employee'),
                                'className' => 'btn btn-primary create',
                                'action' => 'function( e, dt, button, config){
                                             window.location = "employees/create";
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
            ['name'=>'Emp_Nm'.ucfirst(session('lang')),'data'=>'Emp_Nm'.ucfirst(session('lang')),'title'=>trans('admin.name')],
            ['name'=>'Cnt_Stdt','data'=>'Cnt_Stdt','title'=>trans('admin.Cnt_Stdt')],
            ['name'=>'Cnt_Endt','data'=>'Cnt_Endt','title'=>trans('admin.Cnt_Endt')],
            ['name'=>'Cnt_Nwdt','data'=>'Cnt_Nwdt','title'=>trans('admin.Cnt_Nwdt')],
            ['name'=>'Bsc_Salary','data'=>'Bsc_Salary','title'=>trans('admin.basic_salary')],
            ['name'=>'Pymnt_No','data'=>'Pymnt_No','title'=>trans('admin.payment_methods')],
            ['name'=>'edit','data'=>'edit','title'=>trans('admin.edit'),'printable'=>false,'exportable'=>false,'orderable'=>false,'searchable'=>false],
            ['name'=>'show','data'=>'show','title'=>trans('admin.show'),'printable'=>false,'exportable'=>false,'orderable'=>false,'searchable'=>false],
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
        return 'employee_' . date('YmdHis');
    }
}
