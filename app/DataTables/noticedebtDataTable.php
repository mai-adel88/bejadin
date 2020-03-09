<?php

namespace App\DataTables;

use App\limitationReceipts;
use App\limitations;
use App\User;
use Yajra\DataTables\Services\DataTable;

class noticedebtDataTable extends DataTable
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
                if (limitationReceipts::where('id',$query->limitationsType_id)->first()->type == 2){
                    return '<a href="../../openingentrydata/show/'.$query->id.'" class="btn btn-info">' . trans('admin.show') . '</a>';
                }else{
                    return '<a href="../../limitations/show/'.$query->id.'" class="btn btn-info">' . trans('admin.show') . '</a>';
                }
            })
            ->addColumn('limitations', function ($query) {
                return session_lang(limitationReceipts::where('id',$query->limitationsType_id)->first()->name_en,limitationReceipts::where('id',$query->limitationsType_id)->first()->name_ar);
            })

            ->addColumn('edit', function ($query) {
                if (limitationReceipts::where('id',$query->limitationsType_id)->first()->type == 2) {
                    return '<a href="../../openingentry/'.$query->id.'/edit" class="btn btn-success edit"><i class="fa fa-edit"></i> ' .trans('admin.edit').'</a>';
                }else{
                    return '<a href="../../limitations/'.$query->id.'/edit" class="btn btn-success edit"><i class="fa fa-edit"></i> ' .trans('admin.edit').'</a>';
                }

            })
            ->addColumn('delete', 'admin.limitations.btn.delete')
            ->editColumn('created_at', function ($query)
            {
//change over here
                return date('Y/m/d', strtotime($query->created_at));
            })
            ->rawColumns([
                'show',
                'limitations',
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
        return limitations::query()->orderByDesc('created_at')->whereIn('status',[1,2])->whereIn('limitationsType_id',[6,7]);
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
                        'text' => '<i class="fa fa-plus"></i> ' .trans('admin.create_debt_limitations'),
                        'className' => 'btn btn-primary create',
                        'action' => 'function( e, dt, button, config){
                                     window.location = "../../limitations/dept/create";
                                 }',
                    ],
                    // [
                    //     'text' => '<i class="fa fa-plus"></i> ' .trans('admin.create_cred_limitations'),
                    //     'className' => 'btn btn-primary create',
                    //     'action' => 'function( e, dt, button, config){
                    //                  window.location = "../../limitations/cred/create";
                    //              }',
                    // ],
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

            ['name'=>'limitationId','data'=>'limitationId','title'=>trans('admin.id')],
            ['name'=>'invoice_id','data'=>'invoice_id','title'=>trans('admin.invoice')],
            ['name'=>'limitations','data'=>'limitations','title'=>trans('admin.limitations')],
            ['name'=>'created_at','data'=>'created_at','title'=>trans('admin.created_at')],
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
        return 'noticedebt_' . date('YmdHis');
    }
}
