<?php

namespace App\DataTables\Hr;

use App\Models\Hr\HrPyhousTyp;
use App\User;
use Yajra\DataTables\Services\DataTable;

class HouseTypeClassDataTable extends DataTable
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
            ->addColumn('edit', function($query){
                return '<a href="'.route('houseTypeClass.edit', $query->ID_NO).'" class="btn btn-success"><i class="fa fa-edit"></i></a>';
            })
            ->addColumn('show', function($query){
                return '<a href="'.route('houseTypeClass.show', $query->ID_NO).'" class="btn btn-info"><i class="fa fa-info"></i></a>';
            })
            ->addColumn('delete', 'hr.settings.house_type_class.btn.delete')
            ->rawColumns([
                'edit','delete','show'
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
        return HrPyhousTyp::query();
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
//                    ->addAction(['width' => '80px'])
            ->parameters([
                'dom' => 'Blfrtip',
                'lengthMenu' => [
                    [10,25,50,100,-1],[10,25,50,trans('admin.all_record')]
                ],
                'buttons' => [
                    [
                        'text' => '<i class="fa fa-plus"></i> ' . trans('hr.house_create'),
                        'className' => 'btn btn-primary create',
                        'action' => 'function( e, dt, button, config){ 
                                window.location = "houseTypeClass/create";
                                }',
                    ],
                    ['extend' => 'print','className' => 'btn btn-primary' , 'text' => '<i class="fa fa-print"></i>'],
                    ['extend' => 'excel','className' => 'btn btn-success' , 'text' => '<i class="fa fa-file"></i> ' . trans('hr.excel')],
                    ['extend' => 'reload','className' => 'btn btn-info' , 'text' => '<i class="fa fa-refresh"></i>']
                ],
                "initComplete" => "function () {
                    this.api().columns([0,1,2]).every(function () {
                        var column = this;
                        var input = document.createElement(\"input\");
                        $(input).appendTo($(column.footer()).empty())
                        .on('keyup', function () {
                            var val = $.fn.dataTable.util.escapeRegex($(this).val());

                            column.search(val ? val : '', true, false).draw();
                        });
                    });
                    }",
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
            ['name'=>'HusTyp_No','data'=>'HusTyp_No','title'=>trans('hr.number')],
            ['name'=>'HusTyp_NmAr','data'=>'HusTyp_NmAr','title'=>trans('hr.house_name_ar')],
            ['name'=>'HusTyp_NmEn','data'=>'HusTyp_NmEn','title'=>trans('hr.house_name_en')],
            ['name'=>'created_at','data'=>'created_at','title'=>trans('hr.created_at')],
            ['name'=>'updated_at','data'=>'updated_at','title'=>trans('hr.updated_at')],
            ['name'=>'edit','data'=>'edit','title'=>trans('hr.edit')],
            ['name'=>'show','data'=>'show','title'=>trans('hr.show')],
            ['name'=>'delete','data'=>'delete','title'=>trans('hr.delete')],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Hr\HouseTypeClass_' . date('YmdHis');
    }
}
