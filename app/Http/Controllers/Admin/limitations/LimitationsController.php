<?php

namespace App\Http\Controllers\Admin\limitations;

use App\Branches;
use App\DataTables\limitationsDataTable;
use App\DataTables\noticedebtDataTable;
use App\Department;
use App\Http\Controllers\Controller;
use App\limitationReceipts;
use App\limitations;
use App\limitationsData;
use App\limitationsType;
use App\Models\Admin\AstCurncy;
use App\Models\Admin\AstSalesman;
use App\Models\Admin\GLaccBnk;
use App\Models\Admin\GLAstJrntyp;
use App\Models\Admin\GLJrnal;
use App\Models\Admin\GLjrnTrs;
use App\Models\Admin\MainBranch;
use App\Models\Admin\MainCompany;
use App\Models\Admin\MtsChartAc;
use App\Models\Admin\MtsCostcntr;
use App\operation;
use App\pjitmmsfl;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Matrix\Exception;

class LimitationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param limitationsDataTable $limitations
     * @return Response
     */
    public function index(limitationsDataTable $limitations)
    {
        return $limitations->render('admin.limitations.invoice.index',['title'=>trans('admin.limitations')]);
    }

    public function get_limitions(){
        return view('admin.limitations.get_limitions ');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
//        DB::table('limitations_type')->where('status',0)->delete();
//        DB::table('limitations')->where('status',0)->delete();
//        DB::table('limitations_datas')->where('limitations_id',null)->delete();

//        $limitationReceipts = limitationReceipts::where('type',1)->pluck('name_'.session('lang'),'id');
//        $title = trans('admin.create_limitations');
//        $branches = Branches::pluck('name_'.session('lang'),'id');


        $last_record = GLJrnal::latest()->get(['Tr_No', 'Cmp_No', 'Brn_No'])->first();
        if(session('Cmp_No') == -1){
            $companies = MainCompany::get(['Cmp_Nm'.ucfirst(session('lang')), 'Cmp_No']);
        }
        else{
            $companies = MainCompany::where('Cmp_No', session('Cmp_No'))->get(['Cmp_Nm'.ucfirst(session('lang')), 'Cmp_No'])->first();
        }

        $cost_center = MtsCostcntr::where('Level_Status', 0)->get(['Costcntr_No', 'Costcntr_Nm'.session('lang')]);
        $crncy = AstCurncy::get(['Curncy_No', 'Curncy_Nm'.ucfirst(session('lang'))]);


//        $AllSalesman = AstSalesman::all();
//        $flags = GLaccBnk::all();
        // مسموح بظه+ور البنوك و الصنودق فى سند القبض النقدى
//        $banks = [];
//        foreach($flags as $flag){
//            if($flag->RcpCsh_Voucher == 1){
//                array_push($banks, $flag);
//            }
//        }

        $GLAstJrntyp = GLAstJrntyp::where('Jr_Ty','6')->first();


        return view('admin.limitations.create',compact([
//            'title',
//            'branches',
//            'limitationReceipts',
            'companies',
//            'banks',
            'last_record',
            'cost_center',
            'crncy',
            'GLAstJrntyp',
//            'AllSalesman',
        ]));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $gl = GLJrnal::find($id);
        $gltrns = GLjrnTrs::where('Tr_No', $id)->get();
        $debt_acc_no = GLjrnTrs::where('Sysub_Account', 0)
            ->where('Tr_No', $gl->Tr_No)
            ->where('Ln_No', 1)
            ->pluck('Acc_No')->first();
        $debt = MtsChartAc::where('Acc_No', $debt_acc_no)->pluck('Acc_Nm'.ucfirst(session('lang')))->first();
        $cmp = MainCompany::where('Cmp_No', $gl->Cmp_No)->get(['License_No', 'Cmp_Nm'.ucfirst(session('lang'))])->first();
        $brn = MainBranch::where('Cmp_No', $gl->Cmp_No)->get(['Brn_Nm'.ucfirst(session('lang'))])->first();
        return view('admin.limitations.catch.show', ['gl' => $gl, 'gltrns' => $gltrns, 'cmp' => $cmp, 'brn' => $brn, 'debt' => $debt]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $gl = GLJrnal::where('Tr_No', $id)->first();
        $gltrns  = GLjrnTrs::where('Tr_No', $id)->get();

        $last_record = GLJrnal::latest()->get(['Tr_No', 'Cmp_No', 'Brn_No'])->first();
        if(session('Cmp_No') == -1){
            $companies = MainCompany::get(['Cmp_Nm'.ucfirst(session('lang')), 'Cmp_No']);
        }
        else{
            $companies = MainCompany::where('Cmp_No', session('Cmp_No'))->get(['Cmp_Nm'.ucfirst(session('lang')), 'Cmp_No'])->first();
        }

        $cost_center = MtsCostcntr::where('Level_Status', 0)->get(['Costcntr_No', 'Costcntr_Nm'.session('lang')]);
        $crncy = AstCurncy::get(['Curncy_No', 'Curncy_Nm'.ucfirst(session('lang'))]);

        $crncy = AstCurncy::get(['Curncy_No', 'Curncy_Nm'.ucfirst(session('lang'))]);
        $salesman = AstSalesman::where('Cmp_No', $gl->Cmp_No)->get(['Slm_No', 'Slm_Nm'.ucfirst(session('lang'))]);

        return view('admin.limitations.catch.edit', compact([
            'companies',
            'last_record',
            'cost_center',
            'crncy',
            'gl',
            'gltrns',
        ]));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Response
     */

    public function update(Request $request, $id)
    {
        $limitations = limitations::findOrFail($id);
        $limitationsData = limitationsData::where('invoice_id',$limitations->invoice_id)->where('limitations_id',$id)->first();
        $limitationsType = limitationsType::where('invoice_id',$limitations->invoice_id)->where('limitations_id',$id)->get();


        if (!empty($limitationsData->limitationsType)){
//                for receiptsType departement
            if (limitationsType::where('invoice_id',$limitations->invoice_id)->where('limitations_id',$id)->exists()){
                $operations = limitationsType::where('invoice_id',$limitations->invoice_id)->pluck('operation_id');
                $tree_id = limitationsType::where('invoice_id',$limitations->invoice_id)->whereIn('operation_id',$operations)->pluck('tree_id');
                $limitationsTypetree = limitationsType::where('invoice_id', $limitations->invoice_id)->where('limitations_id',$id)->whereIn('tree_id', $tree_id)->get();
                foreach ($limitationsTypetree as $type){
                    DB::table('departments')->where('id',$type->tree_id)->update(['debtor' => DB::raw('debtor - '.$type->debtor),'creditor' => DB::raw('creditor - '.$type->creditor)]);
                    getSitioPadre($type->tree_id,-$type->debtor,-$type->creditor);
                }
//                for receiptsType glcc
                $cc_id = limitationsType::where('invoice_id',$limitations->invoice_id)->where('cc_id','!=',null)->whereIn('operation_id',$operations)->pluck('cc_id');
                $limitationsTypecc = limitationsType::where('invoice_id', $limitations->invoice_id)->whereIn('cc_id',$cc_id)->get();
                foreach ($limitationsTypecc as $type){
                    DB::table('glccs')->where('id',$type->cc_id)->update(['debtor' => DB::raw('debtor - '.$type->debtor),'creditor' => DB::raw('creditor - '.$type->creditor)]);
                    getSitiocc($type->cc_id,-$type->debtor,-$type->creditor);
                }
            }
        }
//        dd($limitationsData->limitationsType);

        $limitationsData->limitationsType()->detach($limitationsType);

        $limitationsData->debtor = $limitationsType->sum('debtor');
        $limitationsData->creditor = $limitationsType->sum('creditor');
        $limitationsData->save();
        $limitationsData->limitationsType()->attach($limitationsType);

        DB::table('limitations_type')->where('invoice_id',$limitations->invoice_id)->update(['limitations_id'=>$limitations->id,'status'=>1]);
        DB::table('limitations_datas')->where('invoice_id',$limitations->invoice_id)->update(['status'=>1,'limitations_id'=>$limitations->id]);
        $data = $limitations->limitations_type;
//        dd($data);
//        $operations = limitationsType::where('invoice_id',$limitations->invoice_id)->pluck('operation_id');
        $tree_id2 = limitationsType::where('invoice_id',$limitations->invoice_id)->pluck('tree_id');
        $limitationsTypetree2 = limitationsType::where('invoice_id', $limitations->invoice_id)->whereIn('tree_id', $tree_id2)->get();
        foreach ($limitationsTypetree2 as $type){
            DB::table('departments')->where('id',$type->tree_id)->update(['debtor' => DB::raw('debtor + '.$type->debtor),'creditor' => DB::raw('creditor + '.$type->creditor)]);
            getSitioPadre($type->tree_id,$type->debtor,$type->creditor);
        }
//                for receiptsType glcc
        $cc_id2 = limitationsType::where('invoice_id',$limitations->invoice_id)->pluck('cc_id');
        $limitationsTypecc2 = limitationsType::where('invoice_id', $limitations->invoice_id)->whereIn('cc_id',$cc_id2)->get();
        foreach ($limitationsTypecc2 as $type){
            DB::table('glccs')->where('id',$type->cc_id)->update(['debtor' => DB::raw('debtor + '.$type->debtor),'creditor' => DB::raw('creditor + '.$type->creditor)]);
            getSitiocc($type->cc_id,$type->debtor,$type->creditor);
        }
//        $limitationsData->debtor = $limitationsType->sum('debtor');
//        $limitationsData->creditor = $limitationsType->sum('creditor');
//        $limitationsData->save();
        return view('admin.limitations.invoice.show',compact('limitationsData','data','limitations'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //حذف كل سطور السند
        $gl = GLJrnal::where('ID_No', $id)->get(['Tr_No'])->first();
        $trns = GLjrnTrs::where('Tr_No', $gl->Tr_No)->get();
        if($trns && count($trns) > 0){
            foreach($trns as $trn){
                $trn->delete();
            }
        }
        GLJrnal::where('ID_No', $id)->first()->update(['status' => 1]);
        return redirect()->route('limitations.index')->with(session()->flash('message',trans('admin.success_deleted')));
    }

    //Edit by: Norhan Hesham Foda
    public function noticedebt(noticedebtDataTable $limitations)
    {
        return $limitations->render('admin.limitations.invoice.index',['title'=>trans('admin.limitations')]);
    }

    public function debt()
    {
        DB::table('limitations_type')->where('status',0)->delete();
        DB::table('limitations')->where('status',0)->delete();
        DB::table('limitations_datas')->where('limitations_id',null)->delete();
        $limitationReceipts = limitationReceipts::where('type',1)->where('limitationReceiptsId',1)->pluck('name_'.session('lang'),'id');
        $title = trans('admin.create_limitations');
        $branches = Branches::pluck('name_'.session('lang'),'id');
        return view('admin.banks.debt.create',compact('title','branches','limitationReceipts'));
    }
}
