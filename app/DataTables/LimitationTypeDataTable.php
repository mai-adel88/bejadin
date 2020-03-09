<?php

namespace App\DataTables;

use App\Admin;
use App\Models\Admin\GLAstJrntyp;
use App\User;
use Yajra\DataTables\Services\DataTable;

class LimitationTypeDataTable extends DataTable
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
                return '<a href="'.route('limitationType.edit', $query->ID_NO).'" class="btn btn-success"><i class="fa fa-edit"></i></a>';
            })

            ->addColumn('active', function ($query) {
                $query->active == 1 ? $class='success': $class='danger';
                $query->active == 1 ? $icon='check': $icon='close';
//                '<a data-url='.route('activeClass').' data-id="'.$query->Class_ID.'" class="btn btn-'.$class.' class_active_link link_'.$query->Class_ID.'"><i class="fa fa-'.$icon.'"></i></a>';

                return '<a data-url="'.route('limitationType.show', $query->ID_NO).'" data-id="'.$query->ID_NO.'" class="btn btn-'.$class.' class_active_link link_'.$query->ID_NO.'"><i class="fa fa-'.$icon.'"></i></a>';
            })

//            ->addIndexColumn()

            ->rawColumns([
                'edit',
                'active',
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
        return GLAstJrntyp::query();
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
//            ->addColumnBefore([
//                'defaultContent' => '',
//                'data'           => 'DT_RowIndex',
//                'name'           => 'DT_RowIndex',
//                'title'          => trans('admin.id'),
//                'render'         => null,
//                'orderable'      => false,
//                'searchable'     => false,
//                'exportable'     => false,
//                'printable'      => true,
//                'footer'         => '',
//            ])
            ->parameters([
                'dom' => 'Blfrtip',
                'lengthMenu' => [
                    [10,25,50,100,-1],[10,25,50,trans('admin.all_record')]
                ],
                'buttons' => [
                    [
                        'text' => '<i class="fa fa-plus"></i> ' . trans('admin.create_new_limitation_type'),
                        'className' => 'btn btn-primary create',
                        'action' => 'function( e, dt, button, config){ 
                             window.location = "limitationType/create";
                         }',
                    ],
                    ['extend' => 'print','className' => 'btn btn-primary' , 'text' => '<i class="fa fa-print"></i>'],
                    ['extend' => 'excel','className' => 'btn btn-success' , 'text' => '<i class="fa fa-file"></i> ' . trans('admin.EXCEL')],
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
            ['name'=>'Jr_Ty','data'=>'Jr_Ty','title'=>trans('admin.number')],
            ['name'=>'Jrty_NmAr','data'=>'Jrty_NmAr','title'=>trans('admin.name_ar')],
            ['name'=>'Jrty_NmEn','data'=>'Jrty_NmEn','title'=>trans('admin.name_en')],
//            ['name'=>'created_at','data'=>'created_at','title'=>trans('admin.created_at')],
//            ['name'=>'updated_at','data'=>'updated_at','title'=>trans('admin.updated_at')],
            ['name'=>'edit','data'=>'edit','title'=>trans('admin.edit'),'printable'=>false,'exportable'=>false,'orderable'=>false,'searchable'=>false],
            ['name'=>'active','data'=>'active','title'=>trans('admin.status'),'printable'=>false,'exportable'=>false,'orderable'=>false,'searchable'=>false],

        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Admins_' . date('YmdHis');
    }
}
