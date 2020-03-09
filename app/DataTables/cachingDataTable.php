<?php

namespace App\DataTables;

use App\limitationReceipts;
use App\receipts;
use App\User;
use Yajra\DataTables\Services\DataTable;

class cachingDataTable extends DataTable
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
                return '<a href="../../receipts/'.$query->id.'" class="btn btn-info">' .'<i class="fa fa-eye"></i> ' . '</a>';
            })  ->addColumn('print', function ($query) {
                return '<a href="../../receipts/print/'.$query->id.'" class="btn btn-info" target="_blanck">' .'<i class="fa fa-print"></i> ' . '</a>';
            })
            ->addColumn('receiptsType', function ($query) {
                return session_lang(limitationReceipts::where('id',$query->receiptsType_id)->first()->name_en,limitationReceipts::where('id',$query->receiptsType_id)->first()->name_ar);
            })
            ->addColumn('invoice_id', function ($query) {
                return session_lang(\App\receiptsType::where('invoice_id',$query->invoice_id)->first()->name_en,\App\receiptsType::where('invoice_id',$query->invoice_id)->first()->name_ar) ;
            })
            ->addColumn('edit', function ($query) {
                return '<a href="../../receipts/'.$query->id.'/edit" class="btn btn-success edit"><i class="fa fa-edit"></i> '.'</a>';
            })
            ->editColumn('created_at', function ($query)
            {

                return date('Y/m/d', strtotime($query->created_at));
            })
            ->addColumn('delete', 'admin.banks.btn.delete')
            ->rawColumns([
                'show',
                'print',
                'receiptsType',
                'invoice_id',
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
//        return receipts::query()->orderByDesc('created_at')->where('status',1)->whereIn('receiptsType_id',[3,4]);

        return receipts::query()->orderBy('receiptId','Desc')->where('status',1)->whereIn('receiptsType_id',[3,4]);
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
                        'text' => '<i class="fa fa-plus"></i> ' .trans('admin.create_caching_receipt'),
                        'className' => 'btn btn-primary create',
                        'action' => 'function( e, dt, button, config){ 
                                     window.location = "../caching/all";
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

            ['name'=>'receiptId','data'=>'receiptId','title'=>trans('admin.number_of_receipt')],
//            ['name'=>'invoice_id','data'=>'invoice_id','title'=>trans('admin.invoice')],
            ['name'=>'receiptsType','data'=>'receiptsType','title'=>trans('admin.receipt_type')],
            ['name'=>'invoice_id','data'=>'invoice_id','title'=>trans('admin.invoice_id')],
            ['name'=>'created_at','data'=>'created_at','title'=>trans('admin.receipt_created_at')],
            ['name'=>'show','data'=>'show','title'=>trans('admin.show'),'printable'=>false,'exportable'=>false,'orderable'=>false,'searchable'=>false],
            ['name'=>'print','data'=>'print','title'=>trans('admin.print'),'printable'=>false,'exportable'=>false,'orderable'=>false,'searchable'=>false],
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
        return 'caching_' . date('YmdHis');
    }
}
