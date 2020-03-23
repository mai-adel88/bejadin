<?php

namespace App\DataTables\Hr;
use App\Models\Hr\HREmpAttach;
use App\Enums\Hr\HrAstAttachType;
use Yajra\DataTables\Services\DataTable;

class AttachmentsDataTable extends DataTable
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
            ->addColumn('Attch_Ty', function ($query) {
                return HrAstAttachType::getDescription($query->Attch_Ty);
            })
            ->addColumn('employee', function ($query) {
                return $query->employee?$query->employee->{'Emp_Nm'.ucfirst(session('lang'))}: '';
            })
            ->addColumn('edit', function($query){
                return '<a  href="attachments/'.$query->ID_NO.'/edit" class="btn btn-success edit"><i class="fa fa-edit"></i></a>';
            })
            ->addColumn('show', function($query){
                return '<a href="'.route('attachments.show', $query->ID_NO).'" class="btn btn-info"><i class="fa fa-info"></i></a>';
            })

            
            ->addColumn('delete', 'hr.attachments.btn.delete')
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
        return HREmpAttach::query();
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
                                window.location = "attachments/create";
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
            ['name'=>'employee','data'=>'employee','title'=>trans('hr.employee_name')],
            ['name'=>'Attch_Ty','data'=>'Attch_Ty','title'=>trans('hr.attach_type')],
            ['name'=>'Attch_Desc','data'=>'Attch_Desc','title'=>trans('hr.desc')],
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
        return 'Hr\Attachments_' . date('YmdHis');
    }
}
