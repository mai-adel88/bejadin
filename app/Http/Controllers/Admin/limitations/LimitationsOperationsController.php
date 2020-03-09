<?php

namespace App\Http\Controllers\Admin\limitations;

use App\DataTables\limitationsDataTable;
use App\Models\Admin\AstSalesman;
use App\Models\Admin\GLJrnal;
use App\Models\Admin\GLjrnTrs;
use App\Models\Admin\MainBranch;
use App\Models\Admin\MainCompany;
use App\Models\Admin\MtsChartAc;
use App\Models\Admin\MtsCostcntr;
use App\Models\Admin\MTsCustomer;
use App\Models\Admin\MtsSuplir;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class LimitationsOperationsController extends Controller
{

    public function store(Request $request)
    {
        if ($request->ajax()){

            $transHeader = GLJrnal::where('Tr_No', $request->Tr_No)->where('Jr_Ty', $request->Jr_Ty)->first();
            $catch_data = $request->catch_data;
            //Create heade
            if($catch_data != null && count($catch_data) > 0){

                if ($transHeader == null){
                    $header = GLJrnal::create([
                        'Cmp_No' => $request->Cmp_No,
                        'Brn_No' => $request->Brn_No,
                        'Jr_Ty' => $request->Jr_Ty,
                        'Tr_No' => $request->Tr_No,
                        'Month_No' => Carbon::now()->month,
//                'Month_Jvno' => $catch_data[$last_index]->Month_Jvno,
                        'Tr_Dt' => $catch_data[0]['Tr_Dt'],
                        'Tr_DtAr' => $catch_data[0]['Tr_DtAr'],
                        'Acc_No' => $catch_data[0]['Acc_No'],
                        'User_ID' => auth()->user()->id,
                        'Ac_Ty' => $catch_data[0]['Ac_Ty'],
                        'Curncy_No' => $catch_data[0]['Curncy_No'],
                        'Curncy_Rate' => $catch_data[0]['Curncy_Rate'],
//                'Tot_Amunt' => $catch_data[0]->Tr_Db_Db,
                        'Tr_Ds' => $catch_data[0]['Tr_Ds'],
                        'Tr_Ds1' => $catch_data[0]['Tr_Ds1'],
                        'Dc_No' => $catch_data[0]['Dc_No'],
                        'Tr_Db' => $request->debit_sum,
                        'Tr_Cr' => $request->credit_sum,
                        'Slm_No' => $catch_data[0]['Slm_No'],
                    ]);

//            foreach($catch_data as $data){
//                $header->FTot_Amunt += $data->FTot_Amunt;
//            }
                    $header->Entr_Dt = $header->created_at->format('Y-m-d');
                    $header->Entr_Time = $header->created_at->format('H:i:s');
                    if($catch_data[0]['Ac_Ty'] == 1){$header->Chrt_No = $catch_data[0]['Sysub_Account'];}
                    if($catch_data[0]['Ac_Ty'] == 2){$header->Cstm_No = $catch_data[0]['Sysub_Account'];}
                    if($catch_data[0]['Ac_Ty'] == 3){$header->Sup_No = $catch_data[0]['Sysub_Account'];}
                    if($catch_data[0]['Ac_Ty'] == 4){$header->Emp_No = $catch_data[0]['Sysub_Account'];}
                    $header->save();


//            $tot_rcpt_val = 0;
//            foreach($catch_data as $data){
//                $tot_rcpt_val += $data->Tot_Amunt;
//            }

                    foreach($catch_data as $data){

                        //Create transaction credit
                        $trans_cr = GLjrnTrs::create([
                            'Cmp_No' => $data['Cmp_No'],
                            'Brn_No' => $data['Brn_No'],
                            'Jr_Ty' => $request->Jr_Ty,
                            'Tr_No' => $request->Tr_No,
                            'Month_No' => Carbon::now()->month,
                            'Month_Jvno' => $data['Tr_No'],
                            'Tr_Dt' => $data['Tr_Dt'],
                            'Tr_DtAr' => $data['Tr_DtAr'],
                            'Ac_Ty' => $data['Ac_Ty'],
                            'Sysub_Account' => $data['Sysub_Account'],
                            'Acc_No' => $data['Acc_No'],
                            'Tr_Db' => $data['Tr_Db'],
                            'Tr_Cr' => $data['Tr_Cr'],
                            'FTr_Db' => $data['Tr_Cr'] == '0' ? $data['FTot_Amunt']:0,
                            'FTr_Cr' => $data['Tr_Db'] == '0' ? $data['FTot_Amunt']:0,
                            'Dc_No' => $data['Dc_No'],
                            'Tr_Ds' => $data['Tr_Ds'],
                            'Tr_Ds1' => $data['Tr_Ds1'],
                            'User_ID' => auth()->user()->id,
                            'Rcpt_Value' => $data['Tot_Amunt'],
                            'FTot_Amunt' => $data['FTot_Amunt'],
                            'Ln_No' => $data['Ln_No'],
                        ]);
                        $trans_cr->Entr_Dt = $trans_cr->created_at->format('Y-m-d');
                        $trans_cr->Entr_Time = $trans_cr->created_at->format('H:i:s');
                        $trans_cr->save();

                    }
                } else {
                    $transHeader->update([
                        'Cmp_No' => $request->Cmp_No,
                        'Brn_No' => $request->Brn_No,
                        'Jr_Ty' => $request->Jr_Ty,
                        'Tr_No' => $request->Tr_No,
                        'Month_No' => Carbon::now()->month,
//                'Month_Jvno' => $catch_data[$last_index]->Month_Jvno,
                        'Tr_Dt' => $catch_data[0]['Tr_Dt'],
                        'Tr_DtAr' => $catch_data[0]['Tr_DtAr'],
                        'Acc_No' => $catch_data[0]['Acc_No'],
                        'User_ID' => auth()->user()->id,
                        'Ac_Ty' => $catch_data[0]['Ac_Ty'],
                        'Curncy_No' => $catch_data[0]['Curncy_No'],
                        'Curncy_Rate' => $catch_data[0]['Curncy_Rate'],
//                'Tot_Amunt' => $catch_data[0]->Tr_Db_Db,
                        'Tr_Ds' => $catch_data[0]['Tr_Ds'],
                        'Tr_Ds1' => $catch_data[0]['Tr_Ds1'],
                        'Dc_No' => $catch_data[0]['Dc_No'],
                        'Tr_Db' => $request->debit_sum,
                        'Tr_Cr' => $request->credit_sum,
                        'Slm_No' => $catch_data[0]['Slm_No'],
                    ]);

//            foreach($catch_data as $data){
//                $header->FTot_Amunt += $data->FTot_Amunt;
//            }
                    $transHeader->Entr_Dt = $transHeader->created_at->format('Y-m-d');
                    $transHeader->Entr_Time = $transHeader->created_at->format('H:i:s');
                    if($catch_data[0]['Ac_Ty'] == 1){$transHeader->Chrt_No = $catch_data[0]['Sysub_Account'];}
                    if($catch_data[0]['Ac_Ty'] == 2){$transHeader->Cstm_No = $catch_data[0]['Sysub_Account'];}
                    if($catch_data[0]['Ac_Ty'] == 3){$transHeader->Sup_No = $catch_data[0]['Sysub_Account'];}
                    if($catch_data[0]['Ac_Ty'] == 4){$transHeader->Emp_No = $catch_data[0]['Sysub_Account'];}
                    $transHeader->save();


//            $tot_rcpt_val = 0;
//            foreach($catch_data as $data){
//                $tot_rcpt_val += $data->Tot_Amunt;
//            }

                    foreach ($transHeader->trans as $tran) {
                        $tran->delete();
                    }

                    foreach($catch_data as $data){

                        //Create transaction credit
                        $trans_cr = GLjrnTrs::create([
                            'Cmp_No' => $data['Cmp_No'],
                            'Brn_No' => $data['Brn_No'],
                            'Jr_Ty' => $request->Jr_Ty,
                            'Tr_No' => $request->Tr_No,
                            'Month_No' => Carbon::now()->month,
                            'Month_Jvno' => $data['Tr_No'],
                            'Tr_Dt' => $data['Tr_Dt'],
                            'Tr_DtAr' => $data['Tr_DtAr'],
                            'Ac_Ty' => $data['Ac_Ty'],
                            'Sysub_Account' => $data['Sysub_Account'],
                            'Acc_No' => $data['Acc_No'],
                            'Tr_Db' => $data['Tr_Db'],
                            'Tr_Cr' => $data['Tr_Cr'],
                            'FTr_Db' => $data['Tr_Cr'] == '0' ? $data['FTot_Amunt']:0,
                            'FTr_Cr' => $data['Tr_Db'] == '0' ? $data['FTot_Amunt']:0,
                            'Dc_No' => $data['Dc_No'],
                            'Tr_Ds' => $data['Tr_Ds'],
                            'Tr_Ds1' => $data['Tr_Ds1'],
                            'User_ID' => auth()->user()->id,
                            'Rcpt_Value' => $data['Tot_Amunt'],
                            'FTot_Amunt' => $data['FTot_Amunt'],
                            'Ln_No' => $data['Ln_No'],
                        ]);
                        $trans_cr->Entr_Dt = $trans_cr->created_at->format('Y-m-d');
                        $trans_cr->Entr_Time = $trans_cr->created_at->format('H:i:s');
                        $trans_cr->save();

                    }
                }

            }
        }
    }

    public function updateTrns(Request $request){

        $updated_data = $request->catch_data;
        $newData = [];



        if ($updated_data != null){
            foreach ($updated_data as $key => $value){
                if ($value != null){
                    array_push($newData, $value);
                }
            }
        }


        if(count($newData) > 0){
            //update header
            $header = GLJrnal::where('Tr_No', $request->Tr_No)->first();

            $header->update([
                'Cmp_No' => $request->Cmp_No,
                'Brn_No' => $request->Brn_No,
                'Jr_Ty' => $request->Jr_Ty,
                'Tr_No' => $request->Tr_No,
                'status' => 0,
                'Month_No' => Carbon::now()->month,
//                'Month_Jvno' => $catch_data[$last_index]->Month_Jvno,
                'Tr_Dt' => $newData[0]['Tr_Dt'],
                'Tr_DtAr' => $newData[0]['Tr_DtAr'],
                'Acc_No' => $newData[0]['Acc_No'],
                'User_ID' => auth()->user()->id,
                'Ac_Ty' => $newData[0]['Ac_Ty'],
                'Curncy_No' => $newData[0]['Curncy_No'],
                'Curncy_Rate' => $newData[0]['Curncy_Rate'],
//                'Tot_Amunt' => $newData[0]->Tr_Db_Db,
                'Tr_Ds' => $newData[0]['Tr_Ds'],
                'Tr_Ds1' => $newData[0]['Tr_Ds1'],
                'Dc_No' => $newData[0]['Dc_No'],
                'Tr_Db' => $request->debit_sum,
                'Tr_Cr' => $request->credit_sum,
                'Slm_No' => $newData[0]['Slm_No'],
            ]);

            if($newData[0]['Ac_Ty'] == 1){$header->Chrt_No = $newData[0]['Sysub_Account'];}
            if($newData[0]['Ac_Ty'] == 2){$header->Cstm_No = $newData[0]['Sysub_Account'];}
            if($newData[0]['Ac_Ty'] == 3){$header->Sup_No = $newData[0]['Sysub_Account'];}
            if($newData[0]['Ac_Ty'] == 4){$header->Emp_No = $newData[0]['Sysub_Account'];}
            $header->save();

            foreach($newData as $data){
                $trns = GLjrnTrs::where('Tr_No', $request->Tr_No)
                    ->where('Ln_No', $data['Ln_No'])->first();
                if ($trns == null){
                    GLjrnTrs::create([
                        'Cmp_No' => $data['Cmp_No'],
                        'Brn_No' => $data['Brn_No'],
                        'Jr_Ty' => $request->Jr_Ty,
                        'Tr_No' => $request->Tr_No,
                        'Month_No' => Carbon::now()->month,
                        'Month_Jvno' => $data['Tr_No'],
                        'Tr_Dt' => $data['Tr_Dt'],
                        'Tr_DtAr' => $data['Tr_DtAr'],
                        'Ac_Ty' => $data['Ac_Ty'],
                        'Sysub_Account' => $data['Sysub_Account'],
                        'Acc_No' => $data['Acc_No'],
                        'Tr_Db' => $data['Tr_Db'],
                        'Tr_Cr' => $data['Tr_Cr'],
                        'FTr_Db' => $data['Tr_Cr'] == '0' ? $data['FTot_Amunt']:0,
                        'FTr_Cr' => $data['Tr_Db'] == '0' ? $data['FTot_Amunt']:0,
                        'Dc_No' => $data['Dc_No'],
                        'Tr_Ds' => $data['Tr_Ds'],
                        'Tr_Ds1' => $data['Tr_Ds1'],
                        'User_ID' => auth()->user()->id,
                        'Rcpt_Value' => $data['Tot_Amunt'],
                        'FTot_Amunt' => $data['FTot_Amunt'],
                        'Ln_No' => $data['Ln_No'],
                    ]);
                } else {
                    //Update transaction credit
                    $trns->update([
                        'Cmp_No' => $data['Cmp_No'],
                        'Brn_No' => $data['Brn_No'],
                        'Jr_Ty' => $request->Jr_Ty,
                        'Tr_No' => $request->Tr_No,
                        'Month_No' => Carbon::now()->month,
                        'Month_Jvno' => $data['Tr_No'],
                        'Tr_Dt' => $data['Tr_Dt'],
                        'Tr_DtAr' => $data['Tr_DtAr'],
                        'Ac_Ty' => $data['Ac_Ty'],
                        'Sysub_Account' => $data['Sysub_Account'],
                        'Acc_No' => $data['Acc_No'],
                        'Tr_Db' => $data['Tr_Db'],
                        'Tr_Cr' => $data['Tr_Cr'],
                        'FTr_Db' => $data['Tr_Cr'] == '0' ? $data['FTot_Amunt']:0,
                        'FTr_Cr' => $data['Tr_Db'] == '0' ? $data['FTot_Amunt']:0,
                        'Dc_No' => $data['Dc_No'],
                        'Tr_Ds' => $data['Tr_Ds'],
                        'Tr_Ds1' => $data['Tr_Ds1'],
                        'User_ID' => auth()->user()->id,
                        'Rcpt_Value' => $data['Tot_Amunt'],
                        'FTot_Amunt' => $data['FTot_Amunt'],
                        'Ln_No' => $data['Ln_No'],
                    ]);
                }

            }

            //update debt Tot_Amunt
            //1- get all credit lines - sum credit money
//            $trnses = GLjrnTrs::where('Tr_No', $header->Tr_No)
//                ->where('Ln_No' , '>', 1)->get();
//            if($trnses && count($trnses)){
//                $total = 0;
//                $ftotal = 0;
//                foreach($trnses as $trns){
//                    $total += $trns->Tr_Cr;
//                }
//                foreach($trnses as $trns){
//                    $ftotal += $trns->FTr_Cr;
//                }
//
//                //2- get debt line - update money with new total
//                $debt = GLjrnTrs::where('Tr_No', $header->Tr_No)
//                    ->where('Ln_No', 1)->first();
//                $debt->update([
//                    'Tr_Db' => $total,
//                    'FTr_Db' => $ftotal,
//                    'FTot_Amunt' => $ftotal,
//                    'Rcpt_Value' => $total,
//                ]);
//                $header->update(['FTot_Amunt' => $ftotal]);
//            }
        }
    }

    public function branchForEdit(Request $request){
        if($request->ajax()){
            if($request->id){
                $gl = GLJrnal::where('Tr_No', $request->id)->get(['Brn_No'])->first();
                $branches = MainBranch::where('Cmp_No', $request->Cmp_No)->get();
                return view('admin.limitations.catch.branch', compact('branches', 'gl'));
            }
            else{
                $gl = null;
                $branches = MainBranch::where('Cmp_No', $request->Cmp_No)->get();
                return view('admin.limitations.catch.branch', compact('branches', 'gl'));
            }
        }
    }

    public function getCmpSalesMen(Request $request){
        if($request->ajax()){
            $salesman = AstSalesman::where('Cmp_No', $request->Cmp_No)->get(['Slm_No', 'Slm_Nm'.ucfirst(session('lang'))]);
            return view('admin.limitations.catch.salesman', compact('salesman'));
        }
    }

    public function getSalesMan(Request $request){
        if($request->ajax()){
            $customer = MTsCustomer::where('Cstm_No', $request->Acc_No)->get(['Slm_No'])->first();
            $salesman = AstSalesman::where('Slm_No', $customer->Slm_No)->get(['Slm_No', 'Slm_Nm'.ucfirst(session('lang'))])->first();
            // return $salesman->{'Slm_Nm'.ucfirst(session('lang'))};
            return view('admin.cash.catch.salman', ['salesman' => $salesman]);
        }
    }

    public function checkSetting(Request $request){
        if ($request->ajax()){
            $settings = MainCompany::find($request->Cmp_No);
            return response()->json(['settings' => $settings]);
        }
    }

    public function createTrNo(Request $request){

        if ($request->ajax() && ($request->Cmp_No || $request->Brn_No)){
            $flag = MainCompany::where('Cmp_No', $request->Cmp_No)->first();
            if($flag->JvAuto_Mnth == 1){
                return response()->json([
                    'last_no' => $this->createMonthAccNo(Carbon::now()->month, $request->Brn_No),
                    'activity' => $flag->Actvty_No,
                    'company' => $request->Cmp_No,
                    'branch' => $request->Brn_No,
                ]);
            }
            else{
                if(count(GLJrnal::all()) == 0){
                    $last_no = 0;
                }
                else{
                    $last_trans = GLJrnal::where('Brn_No', $request->Brn_No)->orderBy('Tr_No', 'desc')->first();
                    if($last_trans){
                        $last_no = $last_trans->Tr_No;
                    }
                    else{
                        $last_no = 0;
                    }
                }

            }

            return response()->json([
                'last_no' => $last_no + 1,
                'activity' => $flag->Actvty_No,
                'company' => $request->Cmp_No,
                'branch' => $request->Brn_No?$request->Brn_No:0,
            ]);
        }
    }

    public function getMainAccNo(Request $request){
        if($request->ajax()){
            // حسابات
            if($request->Acc_Ty == 1){
                $AccNm = MtsChartAc::where('Cmp_No', $request->Cmp_No)
                    ->where('Acc_No', $request->Acc_No)
                    ->get(['Parnt_Acc', 'CostCntr_Flag as cc_flag', 'Costcntr_No as cc_no'])->first();
                $mainAccNm = MtsChartAc::where('Acc_No', $AccNm->Parnt_Acc)
                    ->get(['Acc_Nm'.ucfirst(session('lang')).' as acc_name'])->first();
                $mainAccNo = MtsChartAc::where('Acc_No', $AccNm->Parnt_Acc)
                    ->get(['Acc_No as acc_no'])->first();
                return response()->json(['mainAccNo' => $mainAccNo, 'mainAccNm' => $mainAccNm, 'AccNm' => $AccNm] );
            }
            // عملاء
            else if($request->Acc_Ty == 2){
                $mainAccNo = MainBranch::where('Brn_No', $request->Brn_No)->get(['Acc_Customer as acc_no'])->first();
                $mainAccNm = MtsChartAc::where('Acc_No', $mainAccNo->acc_no)->get(['Acc_Nm'.ucfirst(session('lang')).' as acc_name'])->first();
                return response()->json(['mainAccNo' => $mainAccNo, 'mainAccNm' => $mainAccNm]);
            }
            // موردين
            else if($request->Acc_Ty == 3){
                $mainAccNo = MainBranch::where('Brn_No', $request->Brn_No)->get(['Acc_Suplier as acc_no'])->first();
                $mainAccNm = MtsChartAc::where('Acc_No', $mainAccNo->acc_no)->get(['Acc_Nm'.ucfirst(session('lang')).' as acc_name'])->first();
                return response()->json(['mainAccNo' => $mainAccNo, 'mainAccNm' => $mainAccNm]);
            }
            // موظفين
            else if($request->Acc_Ty == 4){

            }
        }
    }

    public function getSubAcc(Request $request)
    {
        if ($request->ajax()) {
            //حسابات
            if ($request->Acc_Ty == 1) {
                $charts = MtsChartAc::where('Cmp_No', $request->Cmp_No)
                    ->where('Level_Status', 1)
                    ->where('Acc_Typ', 1)
                    ->get(['Acc_No as no', 'Acc_Nm' . ucfirst(session('lang')) . ' as name']);
                return view('admin.limitations.notice.SubAcc', ['subAccs' => $charts]);
            } // عملاء
            else if ($request->Acc_Ty == 2) {
                $customers = MTsCustomer::where('Cmp_No', $request->Cmp_No)
                    ->where('Brn_No', $request->Brn_No)
                    ->get(['Cstm_No as no', 'Cstm_Nm' . ucfirst(session('lang')) . ' as name']);
                return view('admin.limitations.notice.SubAcc', ['subAccs' => $customers]);

            } // موردين
            else if ($request->Acc_Ty == 3) {
                $suppliers = MtsSuplir::where('Cmp_No', $request->Cmp_No)
                    ->where('Brn_No', $request->Brn_No)
                    ->get(['Sup_No as no', 'Sup_Nm' . ucfirst(session('lang')) . ' as name']);
                return view('admin.limitations.notice.SubAcc', ['subAccs' => $suppliers]);
            } // موظفين
            else if ($request->Acc_Ty == 4) {
            }


        } else {
            if ($request->Acc_Ty == 1) {
                return 1;
                $charts = MtsChartAc::where('Cmp_No', $request->Cmp_No)
                    ->where('Level_Status', 1)
                    ->where('Acc_Typ', 1)
                    ->get(['Acc_No as no', 'Acc_Nm' . ucfirst(session('lang')) . ' as name']);
                return $charts;
            } // عملاء
            else if ($request->Acc_Ty == 2) {
                $customers = MTsCustomer::where('Cmp_No', $request->Cmp_No)
                    ->where('Brn_No', $request->Brn_No)
                    ->get(['Cstm_No as no', 'Cstm_Nm' . ucfirst(session('lang')) . ' as name']);
                return $customers;

            } // موردين
            else if ($request->Acc_Ty == 3) {
                return 3;
                $suppliers = MtsSuplir::where('Cmp_No', $request->Cmp_No)
                    ->where('Brn_No', $request->Brn_No)
                    ->get(['Sup_No as no', 'Sup_Nm' . ucfirst(session('lang')) . ' as name']);
                return $suppliers;
            } // موظفين
            else if ($request->Acc_Ty == 4) {
                return 4;
            }
        }
    }

    public function getSubAccByNumber(Request $request)
    {
        $Ac_Ty = $request->Ac_Ty;


        switch ($Ac_Ty){
            case "1":
                $charts = MtsChartAc::where('Cmp_No', $request->Cmp_No)
                    ->where('Level_Status', 1)
                    ->where('Acc_Typ', 1)
                    ->get(['Acc_No as no', 'Acc_Nm' . ucfirst(session('lang')) . ' as name']);
                return view('admin.limitations.notice.SubAcc', ['subAccs' => $charts]);
                break;
            case '2':
                $customers = MTsCustomer::where('Cmp_No', $request->Cmp_No)
                    ->where('Brn_No', $request->Brn_No)
                    ->get(['Cstm_No as no', 'Cstm_Nm' . ucfirst(session('lang')) . ' as name']);
                return view('admin.limitations.notice.SubAcc', ['subAccs' => $customers]);
                break;
            case '3':
                $suppliers = MtsSuplir::where('Cmp_No', $request->Cmp_No)
                    ->where('Brn_No', $request->Brn_No)
                    ->get(['Sup_No as no', 'Sup_Nm' . ucfirst(session('lang')) . ' as name']);
                return view('admin.limitations.notice.SubAcc', ['subAccs' => $suppliers]);
                break;
        }
    }

    public function validateCache(Request $request)
    {
        if ($request->ajax()) {
            $validator = Validator::make($request->all(), [
                'Cmp_No' => 'required',
                'Brn_No' => 'required',
                'Jr_Ty' => 'required',
                'Tr_No' => 'required',
                'Tr_Dt' => 'required',
                'Tr_DtAr'  => 'required',
                'Curncy_No' => 'required',
                'FTot_Amunt' => 'required',
                'Curncy_Rate' => 'required',
                'Tot_Amunt' => 'required',
                'Ac_Ty' => 'required',
                'Acc_No' => 'sometimes',
                'Sysub_Account' => 'required',
                'Tr_Cr' => 'sometimes',
                'Tr_Db' => 'sometimes',
                'Tr_Ds' => 'required',
                'Tr_Ds1' => 'sometimes',
                'Dc_No' => 'required',
                'Costcntr_No' => 'sometimes',
                'Slm_No' => 'sometimes',
                'debit_sum',
                'credit_sum',
                'Ln_No',
            ], [], [
                'Cmp_No' => trans('admin.Cmp_No'),
                'Brn_No' => trans('admin.branche'),
                'Jr_Ty' => trans('admin.receipts_type'),
                'Tr_No' => trans('admin.number_of_receipt'),
                'Tr_Dt' => trans('admin.receipt_date'),
                'Tr_DtAr' => trans('admin.higri_date'),
                'Curncy_No' => trans('admin.currency'),
                'FTot_Amunt' => trans('admin.Linv_Net'),
                'Tot_Amunt' => trans('admin.amount'),
                'Salman_No' => trans('admin.sales_officer2'),
                'Ac_Ty' => trans('admin.Level_Status'),
                'Sysub_Account' => trans('admin.account_number'),
                'Tr_Cr' => trans('admin.amount_cr'),
                'Dc_No' => trans('admin.receipt_number'),
                'Tr_Ds' => trans('admin.note_ar'),
                'Tr_Ds1' => trans('admin.note_en'),
            ]);

            if ($validator->fails()) {

                return response([
                    'success' => false,
                    'message' => $validator->messages()->first(),
                ]);
            } else {
                return response([
                    'success' => true,
                    'message' => $validator->messages()->first(),
                ]);
            }
        }
    }

    public function getRcptDetails(Request $request){
        if($request->ajax()){

            $trans = GLjrnTrs::where('Tr_No', $request->Tr_No)
                ->where('Ln_No', $request->Ln_No)
                ->first();

            return response()->json($trans);
        }
    }

    public function createMonthAccNo($month, $Brn_No){
        if(count(GLJrnal::all()) == 0){
            $Month_Jvno = $month.'01';
        }
        else{
            $gls = GLJrnal::where('Month_No', $month)
                ->where('Brn_No', $Brn_No)
                ->orderBy('Month_Jvno', 'desc')->get(['Month_Jvno'])->first();
            if($gls){
                $Month_Jvno = $gls->Month_Jvno + 1;
            }
            else{
                $Month_Jvno = $month.'01';
            }
        }
        return $Month_Jvno;
    }

    //Delete trans line from GLjrnTrs
    public function deleteTrns(Request $request){
        if($request->ajax()){
            $header = GLJrnal::where('Tr_No', $request->Tr_No)->first();
            $trans = GLjrnTrs::where('Tr_No', $request->Tr_No)->where('Ln_No', $request->Ln_No)->first()->delete();
            if (count($header->trans) == 0){
                $header->update(['status'=> 1]);
            }
            return response()->json(['message' => trans('admin.success_deleted')]);
        }

    }

}
