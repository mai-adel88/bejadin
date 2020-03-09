<?php

namespace App\DataTables;

use App\limitationReceipts;
use App\receipts;
use App\Models\Admin\GLJrnal;
use App\Models\Admin\MtsChartAc;
use App\User;
use Yajra\DataTables\Services\DataTable;

class catchDataTable extends DataTable
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
                return '<a href="'.route('rcatchs.show', $query->Tr_No).'" class="btn btn-info">' . '<i class="fa fa-eye"></i>' . '</a>';
            })
            ->addColumn('print', function ($query) {
                return '<a href="../../receipts/print/'.$query->Tr_No.'" class="btn btn-info" target="_blanck">' .'<i class="fa fa-print"></i>'  . '</a>';
            })
            ->addColumn('Doc_Type', function ($query) {
                return \App\Enums\dataLinks\ReceiptType::getDescription(GLJrnal::where('Tr_No', $query->Tr_No)
                                                            ->pluck('Jr_Ty')->first());
            })
            ->addColumn('Sysub_Account', function ($query) {
                $trans = GLJrnal::where('Tr_No', $query->Tr_No)
                                    ->get(['Tr_Ds'])->first();
                return $trans->Tr_Ds;
            })
            ->addColumn('status', function ($query) {
                if($query->status == 1){
                    return trans('admin.rcpt_deleted');
                }
            })
            ->addColumn('edit', function ($query) {
                if($query->status != 1){
                    return '<a href="'.route('rcatchs.edit', $query->Tr_No).'" class="btn btn-success edit">' .'<i class="fa fa-edit"></i> ' .'</a>';
                }
            })
            ->editColumn('Entr_Dt', function ($query){
                return GLJrnal::where('Tr_No', $query->Tr_No)
                                ->pluck('Entr_Dt')->first();
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
    public function query(){
        if(session()->has('recpt_cmp_no')){
            return GLJrnal::query()->orderBy('Tr_No','Desc')->where('Jr_Ty', 2)
                                                            ->where('Cmp_No', session('recpt_cmp_no'));   
        }
        else{
            return GLJrnal::query()->orderBy('Tr_No','Desc')->where('Jr_Ty', 2);
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
        // $url = 'getRecieptByCmp';
        // if ($this->request()->has("Cmp_No")) {
        //     $url = 'getRecieptByCmp';
        // }
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            // ->minifiedAjax($url)
            ->parameters([
                'dom' => 'Blfrtip',
                'lengthMenu' => [
                    [10,25,50,100,-1],[10,25,50,trans('admin.all_record')]
                ],
                'buttons' => [
                    [
                        'text' => '<i class="fa fa-plus"></i> ' .trans('admin.create_catch_receipt'),
                        'className' => 'btn btn-primary create',
                        'action' => 'function( e, dt, button, config){ 
                                     window.location = "../catch/all";
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

    // public function minifiedAjax(){
    //     return $this->datatables
    //         ->eloquent($this->query())
    //         ->addColumn('Tr_No', 'restaurant.datatables_actions')
    //         ->filter(function ($query) {           
    //             if ($this->request()->has("Cmp_No")) {
    //                 $query->where("Cmp_No", $this->request()->get("Cmp_No"));
    //             }
    //         })
    //         ->make(true);
    // }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [

            ['name'=>'Tr_No','data'=>'Tr_No','title'=>trans('admin.number_of_receipt')],
            ['name'=>'Doc_Type','data'=>'Doc_Type','title'=>trans('admin.receipts_type')],
            ['name'=>'Entr_Dt','data'=>'Entr_Dt','title'=>trans('admin.receipt_date')],
            ['name'=>'Acc_Nm'.ucfirst(session('lang')),'data'=>'Sysub_Account','title'=>trans('admin.note_for')],
            ['name'=>'status', 'data'=>'status', 'title'=>trans('admin.rcpt_status')],
            ['name'=>'show','data'=>'show','title'=>trans('admin.show'),'printable'=>false,'exportable'=>false,'orderable'=>false,'searchable'=>false],
            ['name'=>'print','data'=>'print','title'=>trans('admin.print'),'printable'=>false,'exportable'=>false,'orderable'=>false,'searchable'=>false],
            ['name'=>'edit','data'=>'edit','title'=>trans('admin.edit'),'printable'=>false,'exportable'=>false,'orderable'=>false,'searchable'=>false],
            // ['name'=>'delete','data'=>'delete','title'=>trans('admin.delete'),'printable'=>false,'exportable'=>false,'orderable'=>false,'searchable'=>false],

        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'catch_' . date('YmdHis');
    }
}
