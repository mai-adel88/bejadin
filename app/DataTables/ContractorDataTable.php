<?php

namespace App\DataTables;

use App\Contractors;
use App\ContractorType;
use App\responsiblePerson;
use App\Enums\CurrencyType;
use Yajra\DataTables\Services\DataTable;
use Session;

class ContractorDataTable extends DataTable
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
                return '<a href="contractors/'.$query->id.'/edit" class="btn btn-success edit"><i class="fa fa-edit"></i> ' . trans('admin.edit') . '</a>';
            })
            ->addColumn('show', function ($query) {
                return '<a href="contractors/'.$query->id.'" class="btn btn-primary show"><i class="fa fa-show"></i> ' . trans('admin.show') . '</a>';
            })
            ->addColumn('contractor_type', function ($query) {
                if (app()->getLocale() == 'ar') {
                    return $query->contractortype['name_ar'];
                }
                if (app()->getLocale() == 'en') {
                    return $query->contractortype['name_en'];
                }
            })
            ->addColumn('country_name', function ($query) {
                if (app()->getLocale() == 'ar') {
                    return $query->country['country_name_ar'];
                }
                if (app()->getLocale() == 'en') {
                    return $query->country['country_name_en'];
                }
            })
            ->addColumn('currency_name', function ($query) {
                if (app()->getLocale() == 'ar') {
                    if ($query->currency == 0) {
                        return "ريال سعودى";
                    } elseif ($query->currency == 1) {
                        return "دولار";
                    } elseif ($query->currency == 2){
                        return "يورو";
                    }
                }
                if (app()->getLocale() == 'en') {
                    if ($query->currency == 0) {
                        return "SAR";
                    } elseif ($query->currency == 1) {
                        return "USD";
                    } elseif ($query->currency == 2){
                        return "EUR";
                    }
                }
            })
            ->addColumn('delete', 'admin.contractors.btn.delete')
            ->rawColumns([
                'show',
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
        return Contractors::query()->orderByDesc('id')->with('contractortype');
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
                                'text' => '<i class="fa fa-plus"></i> ' . trans('admin.Add_a_contractor'),
                                'className' => 'btn btn-primary create',
                                'action' => 'function( e, dt, button, config){
                                             window.location = "contractors/create";
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
            ['name'=>'name_'.session('lang'),'data'=>'name_'.session('lang'),'title'=>trans('admin.name')],
            ['name'=>'contractor_type','data'=>'contractor_type','title'=>trans('admin.Type_of_Contractor')],
            ['name'=>'address','data'=>'address','title'=>trans('admin.address')],
            ['name'=>'country_name','data'=>'country_name','title'=>trans('admin.country')],
            ['name'=>'currency_name','data'=>'currency_name','title'=>trans('admin.currency')],
            ['name'=>'account_number','data'=>'account_number','title'=>trans('admin.account_number')],
            ['name'=>'debtor','data'=>'debtor','title'=>trans('admin.debtor')],
            ['name'=>'creditor','data'=>'creditor','title'=>trans('admin.creditor')],
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
        return 'Contractor_' . date('YmdHis');
    }
}
