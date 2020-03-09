<?php

namespace App\DataTables;

use App\Admin;
use App\Models\Admin\PjbranchDlv;
use App\User;
use Yajra\DataTables\Services\DataTable;

class StoresDataTable extends DataTable
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
                return '<a href="stores/'.$query->ID_No.'/edit" class="btn btn-success"><i class="fa fa-edit"></i></a>';
            })
            ->addColumn('branch_name', function ($query) {
                return $query->branch->{'Brn_Nm'.ucfirst(session('lang'))};
            })
            ->addColumn('delete', 'admin.stores.btn.delete')
            ->rawColumns([
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
        return PjbranchDlv::with('branch');
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
                    [10,25,50,100,-1],[10,25,50,trans('admin.all_record')]
                ],
                'buttons' => [
                    [
                        'text' => '<i class="fa fa-plus"></i> ' . trans('admin.new_store'),
                        'className' => 'btn btn-primary create',
                        'action' => 'function( e, dt, button, config){ 
                             window.location = "stores/create";
                         }',
                    ],
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
                    }"

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
            ['name'=>'pjbranchdlv.Dlv_Stor','data'=>'Dlv_Stor','title'=>trans('admin.number')],
            ['name'=>'Dlv_Nm'.ucfirst(session('lang')),'data'=>'Dlv_Nm'.ucfirst(session('lang')),'title'=>trans('admin.name_ar')],
            ['name'=>'branch.Brn_Nm'.ucfirst(session('lang')),'data'=>'branch_name','title'=>trans('admin.Branches')],
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
        return 'Stores_' . date('YmdHis');
    }
}
