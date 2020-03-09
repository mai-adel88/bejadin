<?php

namespace App\DataTables;

use App\User;
use App\Blog;
use Yajra\DataTables\Services\DataTable;

class blogDataTable extends DataTable
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
                return '<a href="blog/'.$query->id.'/edit" class="btn btn-success edit"><i class="fa fa-edit"></i> ' . trans('admin.edit') .' </a>';
            })
            ->addColumn('image', function ($query) {
                $url= asset('storage/'.$query->image);
                if ($query->image != null) {
                    return '<img src="' . $url . '" border="0" width="40" class="img-rounded" align="center" style="width:140px" />';
                }else{
                    return '<img src="'.asset('/').'adminlte/Bus.png" class="profile-user-img img-responsive img-circle" style="width:140px" alt="User Image">';
                }
            })
            ->addColumn('delete', 'admin.blog.btn.delete')
            ->rawColumns([
                'edit',
                'delete',
                'summary',
                'image',
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
        return Blog::query()->orderByDesc('id');
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
                                'text' => '<i class="fa fa-plus"></i> ' . trans('admin.Add_new_Blog'),
                                'className' => 'btn btn-primary create',
                                'action' => 'function( e, dt, button, config){ 
                                             window.location = "blog/create";
                                         }',
                            ],
                            ['extend' => 'print','className' => 'btn btn-primary' , 'text' => '<i class="fa fa-print"></i>'],
                            ['extend' => 'excel','className' => 'btn btn-success' , 'text' => '<i class="fa fa-file"></i> '. trans('admin.EXCEL')],
                            ['extend' => 'reload','className' => 'btn btn-info' , 'text' => '<i class="fa fa-refresh"></i>']
                        ],
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
            ['name'=>'id','data'=>'id','title'=>trans('admin.id')],
            ['name'=>'publish_after','data'=>'publish_after','title'=>trans('admin.publish_after')],
            ['name'=>'title','data'=>'title','title'=>trans('admin.title_blog')],
            ['name'=>'author_name','data'=>'author_name','title'=>trans('admin.name')],
            ['name'=>'author_email','data'=>'author_email','title'=>trans('admin.email')],
            ['name'=>'image','data'=>'image','title'=>trans('admin.image')],
            ['name'=>'summary','data'=>'summary','title'=>trans('admin.summary')],
            ['name'=>'created_at','data'=>'created_at','title'=>trans('admin.created_at')],
            ['name'=>'updated_at','data'=>'updated_at','title'=>trans('admin.updated_at')],
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
        return 'blog_' . date('YmdHis');
    }
}
