<?php

namespace App\DataTables\Hr;

use App\Models\Hr\HREmpDependents;
use Yajra\DataTables\Services\DataTable;

class DependentsDataTable extends DataTable
{

    public function dataTable($query)
    {
        return datatables($query)
            ->addColumn('Photo', function ($query) {
                $url= asset('/'.$query->Photo);
                if ($query->Photo != null) {
                    return '<img src="' . $url . '" border="0" height="100" align="center" />';
                }
            })
            ->addColumn('edit', function($query){
                return '<a  href="dependents/'.$query->ID_No.'/edit" class="btn btn-success edit"><i class="fa fa-edit"></i></a>';
            })
            ->addColumn('show', function($query){
                return '<a href="'.route('dependents.show', $query->ID_No).'" class="btn btn-info"><i class="fa fa-info"></i></a>';
            })
            ->addColumn('delete', 'hr.settings.dependents.btn.delete')
            ->rawColumns([
                'Photo','edit','delete','show'
            ]);
    }



    public function query()
    {
        return HREmpDependents::query();
    }


    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
                //    ->addAction(['width' => '80px'])
            ->parameters([
                'dom' => 'Blfrtip',
                'lengthMenu' => [
                    [10,25,50,100,-1],[10,25,50,trans('admin.all_record')]
                ],
                'buttons' => [
                    [
                        'text' => '<i class="fa fa-plus"></i> ' . trans('hr.add_new_escorts'),
                        'className' => 'btn btn-primary create',
                        'action' => 'function( e, dt, button, config){
                                window.location = "dependents/create";
                                }',
                    ],
                    ['extend' => 'print','className' => 'btn btn-primary' , 'text' => '<i class="fa fa-print"></i>'],
                    ['extend' => 'excel','className' => 'btn btn-success' , 'text' => '<i class="fa fa-file"></i> ' . trans('hr.excel')],
                    ['extend' => 'reload','className' => 'btn btn-info' , 'text' => '<i class="fa fa-refresh"></i>']
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
            ['name'=>'Host_No','data'=>'Host_No','title'=>trans('hr.escorts_no')],
            ['name'=>'Host_NmAr','data'=>'Host_NmAr','title'=>trans('hr.Host_Nm')],
            ['name'=>'Photo','data'=>'Photo','title'=>trans('hr.escorts_img')],
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
        return 'Hr\HREmpDependents_' . date('YmdHis');
    }
}
