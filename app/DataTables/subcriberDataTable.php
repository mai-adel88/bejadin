<?php

namespace App\DataTables;

use App\Branches;
use App\Enums\GenderType;
use App\Enums\PayType;
use App\Enums\TypeType;
use App\subscription;
use App\Models\Admin\MTsCustomer;
use Yajra\DataTables\Services\DataTable;

class subcriberDataTable extends DataTable
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
                return '<a  href="subscribers/'.$query->ID_No.'/edit" class="btn btn-success edit"><i class="fa fa-edit"></i></a>';
            })
            ->addColumn('branches', function ($query) {
                return session_lang($query->branches['name_en'],$query->branches['name_ar']);
            })
            ->addColumn('details', function ($query) {
                return '<a href="subscribers/'.$query->ID_No.'" class="btn btn-primary"><i class="fa fa-search"></i></a>';
            })

            ->addColumn('delete', 'admin.subscribers.btn.delete')
            ->addColumn('status', 'admin.subscribers.status')
            ->addColumn('type', function ($query) {
                return TypeType::getDescription($query->type);
            })
            ->rawColumns([
                'edit',
                'delete',
                'details',
//                'cart',
                'parent',
                'parent_phone',
//                'pay_status',
                'branches',
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
            return MTsCustomer::query()->orderByDesc('ID_No');


        // if (auth()->guard('admin')->user()->branches_id == $branches->first()->id){
        // }else{
        //     return MTsCustomer::query()->orderByDesc('id')->where('branches_id','=',auth()->guard('admin')->user()->branches_id);
        // }
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
                    [5,10,25,50,100,-1],[5,10,25,50,trans('admin.all_record')]
                ],
                'buttons' => [
                    [
                        'text' => '<i class="fa fa-plus"></i> ' . trans('admin.Add_New_Subscriber'),
                        'className' => 'btn btn-primary create',
                        'action' => 'function( e, dt, button, config){
                             window.location = "subscribers/create";
                         }',
                    ],[
                        'text' => '<i class="fa fa-flag"></i> ' . trans('admin.relatedness'),
                        'className' => 'btn btn-primary',
                        'action' => 'function( e, dt, button, config){
                             window.location = "relatedness";
                         }',
                    ],
                    ['extend' => 'print','className' => 'btn btn-primary' , 'text' => '<i class="fa fa-print"></i>'],
                    ['extend' => 'excel','className' => 'btn btn-success' , 'text' => '<i class="fa fa-file"></i> ' . trans('admin.EXCEL')],
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
            ['name'=>'ID_No','data'=>'ID_No','title'=>trans('admin.id')],
            ['name'=>'Cstm_Nm'.ucfirst(session('lang')),'data'=>'Cstm_Nm'.ucfirst(session('lang')),'title'=>trans('admin.name')],
            ['name'=>'Cstm_No','data'=>'Cstm_No','title'=>trans('admin.subscriber_no')],
            //['name'=>'Cstm_Active','data'=>'Cstm_Active','title'=>trans('admin.active')],
            //['name'=>'Cstm_Ctg','data'=>'Cstm_Ctg','title'=>trans('admin.customer_catg')],
            //['name'=>'Cstm_Refno','data'=>'Cstm_Refno','title'=>trans('admin.customer_Ref_no')],
            //['name'=>'Internal_Invoice','data'=>'Internal_Invoice','title'=>trans('admin.Internal_Invoice')],
            //['name'=>'Acc_No','data'=>'Acc_No','title'=>trans('admin.account_number')],
            //['name'=>'Catg_No','data'=>'Catg_No','title'=>trans('admin.classification_by_dealing')],
            //['name'=>'Slm_No','data'=>'Slm_No','title'=>trans('admin.slm_no')],
            //['name'=>'Mrkt_No','data'=>'Mrkt_No','title'=>trans('admin.mrkt_no')],
            //['name'=>'Nutr_No','data'=>'Nutr_No','title'=>trans('admin.Nutr_No')],
            //['name'=>'Cntry_No','data'=>'country.country_name_'.session('lang'),'title'=>trans('admin.country')],
            //['name'=>'City_No','data'=>'City_No','title'=>trans('admin.city')],
            //['name'=>'Area_No','data'=>'Area_No','title'=>trans('admin.area')],
            //['name'=>'Credit_Value','data'=>'Credit_Value','title'=>trans('admin.credit_value')],
            //['name'=>'Credit_Days','data'=>'Credit_Days','title'=>trans('admin.credit_days')],
            //['name'=>'Cstm_Adr','data'=>'Cstm_Adr','title'=>trans('admin.address')],
            //['name'=>'Cstm_POBox','data'=>'Cstm_POBox','title'=>trans('admin.mail_box')],
            //['name'=>'Cstm_ZipCode','data'=>'Cstm_ZipCode','title'=>trans('admin.mail_area')],
            //['name'=>'Cstm_Rsp','data'=>'Cstm_Rsp','title'=>trans('admin.person_rsp')],
            //['name'=>'Cstm_Othr','data'=>'Cstm_Othr','title'=>trans('admin.other_note')],
            ['name'=>'Cstm_Email','data'=>'Cstm_Email','title'=>trans('admin.email')],
            ['name'=>'Cstm_Tel','data'=>'Cstm_Tel','title'=>trans('admin.tel')],
            ['name'=>'Cstm_Fax','data'=>'Cstm_Fax','title'=>trans('admin.fax')],
            ['name'=>'Tel1','data'=>'Tel1','title'=>trans('admin.tel_1')],


            ['name'=>'created_at','data'=>'created_at','title'=>trans('admin.created_at')],
            ['name'=>'updated_at','data'=>'updated_at','title'=>trans('admin.updated_at')],
            ['name'=>'details','data'=>'details','title'=>trans('admin.details'),'printable'=>false,'exportable'=>false,'orderable'=>false,'searchable'=>false],
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
        return 'subscriber_' . date('YmdHis');
    }
}
