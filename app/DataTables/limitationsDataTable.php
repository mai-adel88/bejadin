<?php

namespace App\DataTables;

use App\DatabaseStorageModel;
use App\Department;
use App\Enums\dataLinks\LimitationsType;
use App\limitationReceipts;
use App\limitations;
use App\Models\Admin\GLJrnal;
use App\Models\Admin\GLjrnTrs;
use App\User;
use Yajra\DataTables\Services\DataTable;

class limitationsDataTable extends DataTable
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
            ->addColumn('show', function ($query) {
                return '<a href="'.route('limitations.show', $query->ID_No).'" class="btn btn-info"><i class="fa fa-eye"></i></a>';
            })

            ->addColumn('edit', function ($query) {
                return '<a href="'.route('limitations.edit', $query->Tr_No).'" class="btn btn-success"><i class="fa fa-edit"></i></a>';
            })

            ->addColumn('status', function ($query) {
                if ($query->status == 0){
                    return '<span class="label label-success">'.trans('admin.active').'</span>';
                } else {
                    return '<span class="label label-danger">'.trans('admin.deactive').'</span>';
                }

            })
            ->addColumn('delete', 'admin.limitations.btn.delete')
            ->rawColumns([
                'show',
                'edit',
                'delete',
                'status',
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
        return GLJrnal::where('Jr_Ty', 6)->orderByDesc('ID_NO');
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
                        'text' => '<i class="fa fa-plus"></i> ' .trans('admin.create_limitations'),
                        'className' => 'btn btn-primary create',
                        'action' => 'function( e, dt, button, config){
                                     window.location = "limitations/create";
                                 }',
                    ],
                    [
                        'text' => '<i class="fa fa-plus"></i> ' .trans('admin.create_opening_entry'),
                        'className' => 'btn btn-primary create',
                        'action' => 'function( e, dt, button, config){
                                     window.location = "openingentry/create";
                                 }',
                    ],
                    ['extend' => 'print','className' => 'btn btn-primary' , 'text' => '<i class="fa fa-print"></i>'],
                    ['extend' => 'excel','className' => 'btn btn-success' , 'text' => '<i class="fa fa-file"></i> ' . trans('admin.EXCEL')],
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

            ['name'=>'Tr_No','data'=>'Tr_No','title'=>trans('admin.number')],
            ['name'=>'Tr_Ds','data'=>'Tr_Ds','title'=>trans('admin.note_for')],
            ['name'=>'created_at','data'=>'created_at','title'=>trans('admin.limitation_date')],
            ['name'=>'status','data'=>'status','title'=>trans('admin.status'),'printable'=>false,'exportable'=>false,'orderable'=>false,'searchable'=>false],
//            ['name'=>'show','data'=>'show','title'=>trans('admin.show'),'printable'=>false,'exportable'=>false,'orderable'=>false,'searchable'=>false],
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
        return 'limitations_' . date('YmdHis');
    }
}
