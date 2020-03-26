<?php

namespace App\DataTables\Hr;
use App\Models\Hr\HREmphld;
use Yajra\DataTables\Services\DataTable;

class EmpHldDataTable extends DataTable
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
            ->addColumn('employee', function ($query) {
                return $query->employee?$query->employee->{'Emp_Nm'.ucfirst(session('lang'))}: '';
            })
            ->addColumn('edit', function($query){
                return '<a  href="emphlds/'.$query->ID_No.'/edit" class="btn btn-success edit"><i class="fa fa-edit"></i></a>';
            })
            ->addColumn('show', function($query){
                return '<a href="'.route('emphlds.show', $query->ID_NO).'" class="btn btn-info"><i class="fa fa-info"></i></a>';
            })


            ->addColumn('delete', 'hr.emphlds.btn.delete')
            ->rawColumns([
                'edit','delete','show','employee'
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
        return HREmphld::query();
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
                        'text' => '<i class="fa fa-plus"></i> ' . trans('hr.add_new_attachment'),
                        'className' => 'btn btn-primary create',
                        'action' => 'function( e, dt, button, config){
                                window.location = "emphlds/create";
                                }',
                    ],
                    ['extend' => 'print','className' => 'btn btn-primary' , 'text' => '<i class="fa fa-print"></i>'],
                    ['extend' => 'excel','className' => 'btn btn-success' , 'text' => '<i class="fa fa-file"></i> ' . trans('hr.excel')],
                    ['extend' => 'reload','className' => 'btn btn-info' , 'text' => '<i class="fa fa-refresh"></i>']
                ],
                "initComplete" => "function () {
                    this.api().columns([0,1]).every(function () {
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
            ['name'=>'Emp_No','data'=>'Emp_No','title'=>trans('hr.employee_name')],
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
        return 'Hr\HREmphld_' . date('YmdHis');
    }
}
