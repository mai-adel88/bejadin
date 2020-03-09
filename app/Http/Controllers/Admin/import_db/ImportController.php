<?php

namespace App\Http\Controllers\Admin\import_db;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Admin\GLjrnTrs;
use App\Models\Admin\GLJrnal;
use Auth;

class ImportController extends Controller
{
    public function import(){
        return view('admin.import_db.import');
    }

    public function send(Request $request){
        if($request->ajax()){
            if($request->select == 2){
                //ترحيل سندات القبض
                dd('cache in');
            }
            else if($request->select == 4){
                //ترحيل سندات الصرف
                dd('cache out');
            }
            else if($request->select == 6){
                //ترحيل قيود اليوميه
                $limitations = DB::connection('mysql2')->table('limitations')->get();

                // $limitations_type = DB::connection('mysql2')->table('limitations_type')->get();
                // $limitations_data = DB::connection('mysql2')->table('limitations_datas')->get();
                $headers = GLJrnal::all();
                $trns = GLjrnTrs::all();
                //trancate new database tables
                if(count($headers) > 0){
                    foreach($headers as $header){
                        $header->delete();
                    }
                }
                if(count($trns) > 0){
                    foreach($trns as $trn){
                        $trn->delete();
                    }
                }

                //insert old database records to new database  --> create header
                foreach($limitations as $lim){

                    //get total debtors and creditors
                    $total = DB::connection('mysql2')->table('limitations_datas')->where('invoice_id', $lim->invoice_id)->get(['debtor', 'creditor'])->first();

                    //get Acc_No, Ac_Ty, Tr_Ds, Tr_Ds1, Dc_No
                    $tree_id = DB::connection('mysql2')->table('limitations_type')->where('invoice_id', $lim->invoice_id)
                                                            ->get(['tree_id', 'operation_id', 'note', 'note_en', 'receipt_number'])->first();
                    $Acc_No = DB::connection('mysql2')->table('departments')->where('id', $tree_id->tree_id)->pluck('code')->first();

                    //get Ac_Ty and custm_No / Sup_No / Emp_No / Chrt_No / Sysub_Account
                    $Chrt_No = null; $Cstm_No = null; $Sup_No = null; $Emp_No = null; $Sysub_Account = null;

                    if($tree_id->operation_id == 4){  //حسابات
                        $Ac_Ty = 1;
                        $Chrt_No = DB::connection('mysql2')->table('departments')->where('id', $tree_id->tree_id)->pluck('code')->first();
                        $Sysub_Account = $Chrt_No;

                    }
                    if($tree_id->operation_id == 2){ // عملاء
                        $Ac_Ty = 2;
                        $Cstm_No = DB::connection('mysql2')->table('subscriptions')->where('tree_id', $tree_id->tree_id)->pluck('id')->first();
                        $Sysub_Account = $Cstm_No;
                    }
                    if($tree_id->operation_id == 1){ // موردين
                        $Ac_Ty = 3;
                        $Sup_No = DB::connection('mysql2')->table('suppliers')->where('tree_id', $tree_id->tree_id)->pluck('id')->first();
                        $Sysub_Account = $Sup_No;
                    }
                    if($tree_id->operation_id == 5){ // موظفين
                        $Ac_Ty = 4;
                        $Emp_No = DB::connection('mysql2')->table('employees')->where('tree_id', $tree_id->tree_id)->pluck('id')->first();
                        $Sysub_Account = $Emp_No;
                    }

                    //get Month_No, Entr_Dt, Entr_Time
                    // $timestamp = strtotime($lim->created_at);
                    // $Month_No = date('M', $timestamp);
                    // $Entr_Dt = date('Y-m-d', $timestamp);
                    // $Entr_Time = date('H:i:s', $timestamp);

                    $header = GLJrnal::create([
                        'Cmp_No' =>  1,
                        'Brn_No' => $lim->branche_id,
                        'Jr_Ty' => 6,
                        'Tr_No' => $lim->limitationId,
                        'Month_No' => $lim->created_at,
                        'Tr_Dt' => $lim->created_at,
                        'Tr_DtAr' => $lim->date,
                        'Acc_No' => $Acc_No,
                        'Ac_Ty' => $Ac_Ty,
                        'Cstm_No' => $Cstm_No ? $Cstm_No : null,
                        'Sup_No' => $Sup_No ? $Sup_No : null,
                        'Emp_No' => $Emp_No ? $Emp_No : null,
                        'Chrt_No' => $Chrt_No ? $Chrt_No : null,
                        'User_ID' => auth::user()->id,
                        'Entr_Dt' => $lim->created_at,
                        'Entr_Time' => $lim->created_at,
                        'Tr_Db' => $total->debtor,
                        'Tr_Cr' => $total->creditor,
                        'Tot_Amunt' => $total->debtor,
                        'Tr_Ds' => $tree_id->note,
                        'Tr_Ds1' => $tree_id->note_en,
                        'Dc_No' => $tree_id->receipt_number,
                        'created_at' => $lim->created_at,
                        'updated_at' => $lim->updated_at,
                        'status' => $lim->status,
                    ]);


                    //insert old database records to new database  --> create transactions

                    //get transactions Ln_No
                    $lines = DB::connection('mysql2')->table('limitations_type')->where('invoice_id', $lim->invoice_id)->get();
                    $counter = 0;

                    //get Sysub_Account
                    foreach($lines as $line){
                        $counter += 1;
                        $Ln_Acc_No = DB::connection('mysql2')->table('departments')->where('id', $line->tree_id)->pluck('code')->first();
                        GLjrnTrs::create([
                            'Cmp_No' =>  1,
                            'Brn_No' => $lim->branche_id,
                            'Jr_Ty' => 6,
                            'Tr_No' => $lim->limitationId,
                            'Ln_No' => $counter,
                            'Month_No' => $line->created_at,
                            'Tr_Dt' => $lim->created_at,
                            'Tr_DtAr' => $lim->date,
                            'Ac_Ty' => $Ac_Ty,
                            'Sysub_Account' => $Sysub_Account ? $Sysub_Account : null,
                            'Acc_No' => $Ln_Acc_No,
                            'Tr_Db' => $line->debtor,
                            'Tr_Cr' => $line->creditor,
                            'Dc_No' => $line->receipt_number,
                            'Tr_Ds' => $line->note,
                            'Tr_Ds1' => $line->note_en,
                            'Costcntr_No' => $line->cc_id,
                            'User_ID' => auth::user()->id,
                            'Entr_Dt' => $line->created_at,
                            'Entr_Time' => $line->created_at,
                            'Rcpt_Value' => $line->debtor ? $line->debtor : $line->creditor,
                            'created_at' => $line->created_at,
                            'updated_at' => $line->updated_at,
                        ]);
                    }

                }
            }
        }

    }
}
