<?php

namespace App\DataTables;

use App\Enums\CurrencyType;
use App\Enums\SupplierType;
use App\Models\Admin\MtsSuplir;
use App\supplier;
use Yajra\DataTables\Services\DataTable;

class supplierDataTable extends DataTable
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
            ->addColumn('currency', function ($query) {
                return CurrencyType::getDescription($query->currency);
            })
            ->addColumn('show', function ($query) {
                return '<a href="suppliers/'.$query->ID_No.'" class="btn btn-info edit"><i class="fa fa-search"></i> '. '</a>';
            })
            ->addColumn('edit', function ($query) {
                return '<a href="suppliers/'.$query->ID_No.'/edit" class="btn btn-success edit"><i class="fa fa-edit"></i> ' . '</a>';
            })
            ->addColumn('delete', 'admin.supplier.btn.delete')
            ->rawColumns([
                'show',
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

        return MtsSuplir::query()->orderByDesc('ID_No');
    }
    public static function lang(){
        $langJson = [
            "sProcessing"=> trans('admin.sProcessing'),
            "sZeroRecords"=> trans('admin.sZeroRecords'),
            "sEmptyTable"=> trans('admin.sEmptyTable'),
            "sInfoFiltered"=> trans('admin.sInfoFiltered'),
            "sInfoPostFix"=> trans('admin.sInfoPostFix'),
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
                                'text' => '<i class="fa fa-plus"></i> ' . trans('admin.Add_New_Supplier'),
                                'className' => 'btn btn-primary create',
                                'action' => 'function( e, dt, button, config){ 
                                             window.location = "suppliers/create";
                                         }',
                            ],
                            ['extend' => 'print','className' => 'btn btn-primary' , 'text' => '<i class="fa fa-print"></i>'],
                            ['extend' => 'excel','className' => 'btn btn-success' , 'text' => '<i class="fa fa-file"></i> ' . trans('admin.EXCEL')],
                            ['extend' => 'reload','className' => 'btn btn-info' , 'text' => '<i class="fa fa-refresh"></i>']
                        ],
                        "initComplete" => "function () {
                                    this.api().columns([0,1,2,3,4]).every(function () {
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
            ['name'=>'Sup_Nm'.ucfirst(session('lang')),'data'=>'Sup_Nm'.ucfirst(session('lang')),'title'=>trans('admin.name')],
            ['name'=>'Sup_Adr','data'=>'Sup_Adr','title'=>trans('admin.addriss')],
            ['name'=>'Cntct_Prsn1','data'=>'Cntct_Prsn1','title'=>trans('admin.responsible')],
            ['name'=>'Sup_Email','data'=>'Sup_Email','title'=>trans('admin.email')],
            ['name'=>'Credit_Value','data'=>'Credit_Value','title'=>trans('admin.credit_limit')],
//            ['name'=>'Fbal_Db','data'=>'Fbal_Db','title'=>trans('admin.debtor')],
//            ['name'=>'Fbal_CR','data'=>'Fbal_CR','title'=>trans('admin.creditor')],
//            ['name'=>'currency','data'=>'currency','title'=>trans('admin.currency')],
//            ['name'=>'phone1','data'=>'phone1','title'=>trans('admin.mob')],
//            ['name'=>'phone2','data'=>'phone2','title'=>trans('admin.phone')],
//            ['name'=>'fax','data'=>'fax','title'=>trans('admin.fax')],
//            ['name'=>'account_num','data'=>'account_num','title'=>trans('admin.account_number')],
//            ['name'=>'tax_num','data'=>'tax_num','title'=>trans('admin.tax_number')],
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
        return 'supplier_' . date('YmdHis');
    }
}
