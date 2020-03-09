<?php

namespace App\DataTables;

// use App\Branches;
use App\Models\Admin\MainBranch;
use App\Models\Admin\MainCompany;
use App\User;
use Illuminate\Support\Facades\Broadcast;
use Yajra\DataTables\Services\DataTable;

class BranchesDataTable extends DataTable
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
            ->addColumn('Cmp_Nm'.ucfirst(session('lang')), function($query){
                return MainCompany::where('Cmp_No', $query->Cmp_No)->first()->{'Cmp_Nm'.ucfirst(session('lang'))};
            })
            ->addColumn('edit', function ($query) {
                return '<a href="branches/'.$query->ID_No.'/edit" class="btn btn-success edit"><i class="fa fa-edit"></i></a>';
            })
            ->addColumn('delete', 'admin.branches.btn.delete')
            ->rawColumns([
                'edit',
                'delete'
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
        if(session('Cmp_No') == -1){
            return MainBranch::all();
        }
        else{
            return MainBranch::where('Cmp_No', session('Cmp_No'));
        }
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
                                'text' => '<i class="fa fa-plus"></i> ' . trans('admin.add_new_branches'),
                                'className' => 'btn btn-primary create',
                                'action' => 'function( e, dt, button, config){ 
                                                             window.location = "branches/create";
                                                         }',
                            ],[
                                'text' => '<i class="fa fa-users"></i> ' . trans('admin.admins'),
                                'className' => 'btn btn-primary',
                                'action' => 'function( e, dt, button, config){ 
                                             window.location = "admins";
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
            ['name'=>'Brn_Nm'.ucfirst(session('lang')),'data'=>'Brn_Nm'.ucfirst(session('lang')),'title'=>trans('admin.name')],
            ['name'=>'Cmp_Nm'.ucfirst(session('lang')),'data'=>'Cmp_Nm'.ucfirst(session('lang')),'title'=>trans('admin.cmp_no')],
//            ['name'=>'mini_charge','data'=>'mini_charge','title'=>trans('admin.mini_charge')],
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
        return 'Branches_' . date('YmdHis');
    }
}
