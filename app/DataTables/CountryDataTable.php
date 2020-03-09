<?php

namespace App\DataTables;

use App\country;
use Yajra\DataTables\Services\DataTable;

class CountryDataTable extends DataTable
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
            ->addColumn('logo', function ($query) {
                $url= asset('storage/'.$query->logo);
                if ($query->logo != null) {
                    return '<img src="' . $url . '" border="0" width="40" class="img-rounded" align="center" />';
                }else{
                    return '<img src="https://cdn3.volusion.com/jhqje.emawp/v/vspfiles/photos/Saudi-Arabia-Flag-2.gif?1355398483" class="profile-user-img img-responsive img-circle" alt="User Image">';
                }
            })

            ->addColumn('edit', function ($query) {
                return '<a href="countries/'.$query->id.'/edit" class="btn btn-success edit"><i class="fa fa-edit"></i> ' . trans('admin.edit') .'</a>';
            })
            ->addColumn('delete', 'admin.countries.btn.delete')
            ->rawColumns([
                'edit',
                'delete',
                'logo'
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
        return country::query()->orderByDesc('id');
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
                                'text' => '<i class="fa fa-plus"></i> ' . trans('admin.Add_New_Country'),
                                'className' => 'btn btn-primary create',
                                'action' => 'function( e, dt, button, config){ 
                                     window.location = "countries/create";
                                 }',
                            ],
                            [
                                'text' => '<i class="fa fa-flag"></i> ' . trans('admin.cities'),
                                'className' => 'btn btn-primary',
                                'action' => 'function( e, dt, button, config){ 
                                     window.location = "cities";
                                 }',
                            ],
                            [
                                'text' => '<i class="fa fa-flag"></i> ' . trans('admin.regions'),
                                'className' => 'btn btn-primary',
                                'action' => 'function( e, dt, button, config){ 
                                     window.location = "state";
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
            ['name'=>'country_name_'.session('lang'),'data'=>'country_name_'.session('lang'),'title'=>trans('admin.name')],
            ['name'=>'mob','data'=>'mob','title'=>trans('admin.mob')],
            ['name'=>'code','data'=>'code','title'=>trans('admin.code')],
            ['name'=>'logo','data'=>'logo','title'=>trans('admin.logo')],
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
        return 'Country_' . date('YmdHis');
    }
}
