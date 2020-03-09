<?php

namespace App\DataTables;

use App\Models\Admin\InvLodhdr;
use Yajra\DataTables\Services\DataTable;

class PurachesInvoicesDataTable extends DataTable
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
                return '<a href="purchasesInvoices/'.$query->Doc_No.'/edit" class="btn btn-success"><i class="fa fa-edit"></i></a>';
            })

            ->addColumn('customer', function ($query) {
                return $query->customer?$query->customer->{'Cstm_Nm'.ucfirst(session('lang'))}: '';
            })
            ->addColumn('status', function ($query) {
                return $query->status == 0?"<span class='btn btn-danger'>".trans('admin.delete')."</span>":"<span class='btn btn-success'>".trans('admin.active')."</span>";
            })
            ->addColumn('print', function ($query) {
                return '<a href="purchasesInvoices/print/'.$query->Doc_No.'" class="btn btn-info" target="_blanck">' .'<i class="fa fa-print"></i>'  . '</a>';
            })
            ->addColumn('delete', 'admin.purchases_invoices.btn.delete')

            ->addIndexColumn()

            ->rawColumns([
                'customer',
                'status',
                'print',
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
        return InvLodhdr::with('customer')->where('Doc_ty',2);
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

            ->addColumnBefore([
                'defaultContent' => '',
                'data'           => 'DT_RowIndex',
                'name'           => 'DT_RowIndex',
                'title'          => trans('admin.id'),
                'render'         => null,
                'orderable'      => false,
                'searchable'     => false,
                'exportable'     => false,
                'printable'      => true,
                'footer'         => '',
            ])
            ->minifiedAjax()


//                    ->parameters($this->getBuilderParameters());
            ->parameters([
                'dom' => 'Blfrtip',
                'lengthMenu' => [
                    [10,25,50,100,-1],[10,25,50,trans('admin.all_record')]
                ],
                'buttons' => [
                    [
                        'text' => '<i class="fa fa-plus"></i> ' . trans('admin.create_new_bill'),
                        'className' => 'btn btn-primary create',
                        'action' => 'function( e, dt, button, config){ 
                             window.location = "purchasesInvoices/create";
                         }',
                    ],
//                    ['extend' => 'print','className' => 'btn btn-primary' , 'text' => '<i class="fa fa-print"></i>'],
//                    ['extend' => 'excel','className' => 'btn btn-success' , 'text' => '<i class="fa fa-file"></i> ' . trans('admin.EXCEL')],
//                    ['extend' => 'reload','className' => 'btn btn-info' , 'text' => '<i class="fa fa-refresh"></i>']
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
            ['name'=>'Doc_No','data'=>'Doc_No','title'=>trans('admin.Doc_No')],
            ['name'=>'customer.Cstm_Nm'.ucfirst(session('lang')),'data'=>'customer','title'=>trans('admin.customer_name')],
//            ['name'=>'Doc_Ty','data'=>'Doc_Ty','title'=>trans('admin.Doc_Ty')],

            ['name'=>'status','data'=>'status','title'=>trans('admin.status'),'printable'=>false,'exportable'=>false,'orderable'=>false,'searchable'=>false],
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
        return 'InvoicesSales_' . date('YmdHis');
    }
}
