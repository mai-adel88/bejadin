<?php

namespace App\Http\Controllers\Admin\banks;

use App\Branches;
use App\DataTables\receiptDataTable;
use App\DataTables\cachingDataTable;
use App\DataTables\catchDataTable;
use App\Department;
use App\drivers;
use App\glcc;
use App\Http\Controllers\Controller;
use App\limitationReceipts;
use App\operation;
use App\pjitmmsfl;
use App\receipts;
use App\receiptsData;
use App\receiptsType;
use App\subscription;
use App\supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\DatabaseStorageModel;
use Illuminate\Support\Facades\Redirect;
use Matrix\Exception;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class ReceiptController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        \Cart::session()->clear();
        if (session()->get('id')){
            $id = session()->get('id');
            $type = session()->get('type');
            $receiptsType = session()->get('receiptsType');
            $receipts = receipts::where('invoice_id',$id)->first();
            $data = receiptsType::where('invoice_id',$id)->get();
            $receiptsData = receiptsData::where('invoice_id',$id)->first();
            if ($receiptsType == 0 || $receiptsType == 1){
                return view('admin.banks.invoice.invoice',compact('data','id','type','receiptsType','receiptsData','receipts'));
            }else{
                return view('admin.banks.invoice.invoice2',compact('data','id','type','receiptsType','receiptsData','receipts'));
            }
        }else{
            return redirect()->route('receipt.create');
        }
    }
    public function create()
    {

        return view('admin.banks.create');
//        \Cart::session()->clear();
    }
    public function invoice(Request $request)
    {
        if($request->ajax()){


            if($request->id){
                $receipts = receipts::where('id','=',$request->id)->first();
                $receipts->status = 1;
                $receipts->save();
                Db::table('receipts_data')->where('invoice_id',$receipts->invoice_id)->update(['receipts_id'=> $receipts->id]);
                Db::table('receipts_type')->where('invoice_id',$receipts->invoice_id)->update(['receipts_id'=> $receipts->id,'status'=>1]);
                $receiptsData = receiptsData::where('invoice_id',$receipts->invoice_id)->first();
                $receiptsType = receiptsType::where('invoice_id',$receipts->invoice_id)->get();
                $operations = receiptsType::where('invoice_id',$receipts->invoice_id)->pluck('operation_id');
                $receiptsData->receiptsType()->attach($receiptsType);
                $departments = DB::table('departments')->where('id',$receiptsData->tree_id)->first();
                if ($departments->debtor != null){
                    DB::table('departments')->where('id',$receiptsData->tree_id)->update(['debtor' => DB::raw('debtor + '.$receiptsData->debtor),'creditor' => DB::raw('creditor + '.$receiptsData->creditor)]);
                }else{
                    DB::table('departments')->where('id',$receiptsData->tree_id)->update(['debtor' => $receiptsData->debtor,'creditor' => $receiptsData->creditor]);
                }
                getSitioPadre($receiptsData->tree_id,$receiptsData->debtor,$receiptsData->creditor);
//                for receiptsType departement
                $tree_id = receiptsType::where('invoice_id',$receipts->invoice_id)->whereIn('operation_id',$operations)->pluck('tree_id');
                $receiptsTypetree = receiptsType::where('invoice_id',$receipts->invoice_id)->whereIn('tree_id',$tree_id)->get();
                foreach ($receiptsTypetree as $type){
                    DB::table('departments')->where('id',$type->tree_id)->update(['debtor' => DB::raw('debtor + '.$type->debtor),'creditor' => DB::raw('creditor + '.$type->creditor)]);
                    getSitioPadre($type->tree_id,$type->debtor,$type->creditor);
                }
//                for receiptsType glcc
                $cc_id = receiptsType::where('invoice_id',$receipts->invoice_id)->where('cc_id','!=',null)->whereIn('operation_id',$operations)->pluck('cc_id');
                $receiptsTypecc = receiptsType::where('invoice_id', $receipts->invoice_id)->whereIn('cc_id',$cc_id)->get();
                foreach ($receiptsTypecc as $type){
                    DB::table('glccs')->where('id',$type->cc_id)->update(['debtor' => DB::raw('debtor + '.$type->debtor),'creditor' => DB::raw('creditor + '.$type->creditor)]);
                    getSitiocc($type->cc_id,$type->debtor,$type->creditor);
                }
                return ' ';
            }
        }
    }
    public function store(Request $request)
    {
        $data = $this->validate($request,[
            'branche_id'=>'required',
            'receipts'=>'required',
        ],[],[
            'branche_id'=>trans('admin.branche'),
            'receipts'=>trans('admin.receipts'),
        ]);
        $type = $request->type;
        $tree = $request->tree;
//        dd($request->all());
        $receipts_id = limitationReceipts::where('id',$request->receipts)->first()->limitationReceiptsId;
        $receiptsType = $receipts_id;
        $receipts = new receipts();
        $receipts->branche_id = $request->branche_id;
        $receipts->date = $request->date;
        $receipts->invoice_id = $request->invoice;
        $receipts->receiptsType_id = $request->receipts;
        $receipts->receiptId = checkIdReceipts($request->receipts);
        $receipts->operation_id = $type;
        $receipts->save();
        $receiptData = new receiptsData();
        $receiptData->debtor = $request->debtor != null ? $request->debtor : 0;
        $receiptData->creditor = $request->creditor != null ? $request->creditor : 0;
        $receiptData->check = $request->check;
        $receiptData->checkDate = $request->checkDate;
        $receiptData->person = $request->person;
        $receiptData->taken = $request->taken;
        $receiptData->invoice_id = $request->invoice;
        $receiptData->tree_id = $request->fundsBanks;
        $receiptData->operation_id = Department::where('id',$request->fundsBanks)->first()->operation_id;
        $receiptData->note = $request->note_credit != null ? $request->note_credit : $request->note_debt;
        $receiptData->save();
        $id = $request->invoice;
        return Redirect::route('receipts.invoice')->with( ['id'=>$id,'tree'=>$tree,'type'=>$type,'receiptsType'=>$receiptsType] );
//        ,'check'=>$check,'checkDate'=>$checkDate,'tax'=>$tax,'fundsBanks'=>$fundsBanks


    }
    public function show(Request $request)
    {
        if($request->ajax()){
            $branches_id = $request->branches;
            $date = $request->date;
            $receiptsId = $request->receipts;
            if($branches_id != null && $date != null && $receiptsId != null){
                $receipts_id = limitationReceipts::where('id',$request->receipts)->first()->limitationReceiptsId;
                $branches = Branches::where('id',$branches_id)->first();
//                $data = receiptsData::where('cart_storage_id',$request->invoice)->get();
                if ($receipts_id == 0){
                    $operations = operation::whereIn('receipt',[1,2])->pluck('name_'.session('lang'),'id');
                    DB::table('receipts_type')->where('status',0)->delete();
                    $contents = view('admin.banks.catchReceipt.show', ['receiptsId'=>$receiptsId,'branches'=>$branches,'receipts_id'=>$receipts_id,'operations'=>$operations])->render();
                    return $contents;
                }elseif ($receipts_id == 1){
                    $operations = operation::whereIn('receipt',[1,2])->pluck('name_'.session('lang'),'id');
                    DB::table('receipts_type')->where('status',0)->delete();
                    $contents = view('admin.banks.catchReceipt.check', ['receiptsId'=>$receiptsId,'branches'=>$branches,'receipts_id'=>$receipts_id,'operations'=>$operations])->render();
                    return $contents;
                }elseif ($receipts_id == 2){
                    $operations = operation::whereIn('receipt',[1,2])->pluck('name_'.session('lang'),'id');
                    DB::table('receipts_type')->where('status',0)->delete();
                    $contents = view('admin.banks.receipt.show', ['receiptsId'=>$receiptsId,'branches'=>$branches,'receipts_id'=>$receipts_id,'operations'=>$operations])->render();
                    return $contents;
                }elseif ($receipts_id == 3){
                    $operations = operation::whereIn('receipt',[1,2])->pluck('name_'.session('lang'),'id');
                    DB::table('receipts_type')->where('status',0)->delete();
                    $contents = view('admin.banks.receipt.check', ['receiptsId'=>$receiptsId,'branches'=>$branches,'receipts_id'=>$receipts_id,'operations'=>$operations])->render();
                    return $contents;
                }
            }
        }
    }
    public function detailsSelect(Request $request)
    {
        if($request->ajax()){
            $type = $request->type;
            $receipts = $request->receipts_id;
            $operation = operation::where('id',$type)->first();
            $fundsBanks = Department::whereIn('operation_id',[6,7])->where('type','1')->get();
            $data = receiptsType::where('invoice_id',$request->invoice)->get();
            if ($receipts == 2 || $receipts == 3){
                if ($type == 4){
                    $tree = Department::where('levelType','=',1)->pluck('dep_name_'.session('lang'),'id');
                    $contents = view('admin.banks.receipt.detailsselect', ['data'=>$data,'receipts'=>$receipts,'type'=>$type,'operation'=>$operation,'tree'=>$tree,'fundsBanks'=>$fundsBanks])->render();
                    return $contents;
                }else{
                    if ($operation != null){
                        if ($operation->id == 1){
                            $tree = $operation->suppliers->pluck('name_'.session('lang'),'id');
                            $contents = view('admin.banks.receipt.detailsselect', ['data'=>$data,'receipts'=>$receipts,'type'=>$type,'operation'=>$operation,'tree'=>$tree,'fundsBanks'=>$fundsBanks])->render();
                            return $contents;
                        }elseif ($operation->id == 5){
                            $tree = $operation->drivers->pluck('name_'.session('lang'),'id');
                            $contents = view('admin.banks.receipt.detailsselect', ['data'=>$data,'receipts'=>$receipts,'type'=>$type,'operation'=>$operation,'tree'=>$tree,'fundsBanks'=>$fundsBanks])->render();
                            return $contents;
                        }elseif ($operation->id == 2){
                            $tree = $operation->subscribers->pluck('name_'.session('lang'),'id');
                            $contents = view('admin.banks.catchReceipt.detailsselect', ['data'=>$data,'receipts'=>$receipts,'type'=>$type,'operation'=>$operation,'tree'=>$tree,'fundsBanks'=>$fundsBanks])->render();
                            return $contents;
                        }
                    }
                }
            }else{
                if ($type == 4){
                    $tree = Department::where('levelType','=',1)->pluck('dep_name_'.session('lang'),'id');
                    $contents = view('admin.banks.catchReceipt.detailsselect', ['data'=>$data,'receipts'=>$receipts,'type'=>$type,'operation'=>$operation,'tree'=>$tree,'fundsBanks'=>$fundsBanks])->render();
                    return $contents;
                }else{
                    if ($operation != null){
                        if ($operation->id == 1){
                            $tree = $operation->suppliers->pluck('name_'.session('lang'),'id');
                            $contents = view('admin.banks.catchReceipt.detailsselect', ['data'=>$data,'receipts'=>$receipts,'type'=>$type,'operation'=>$operation,'tree'=>$tree,'fundsBanks'=>$fundsBanks])->render();
                            return $contents;
                        }elseif ($operation->id == 5){
                            $tree = $operation->drivers->pluck('name_'.session('lang'),'id');
                            $contents = view('admin.banks.catchReceipt.detailsselect', ['data'=>$data,'receipts'=>$receipts,'type'=>$type,'operation'=>$operation,'tree'=>$tree,'fundsBanks'=>$fundsBanks])->render();
                            return $contents;
                        }elseif ($operation->id == 2){
                            $tree = $operation->subscribers->pluck('name_'.session('lang'),'id');
                            $contents = view('admin.banks.catchReceipt.detailsselect', ['data'=>$data,'receipts'=>$receipts,'type'=>$type,'operation'=>$operation,'tree'=>$tree,'fundsBanks'=>$fundsBanks])->render();
                            return $contents;
                        }
                    }
                }
            }

        }
    }
    public function select(Request $request)
    {
        if($request->ajax()){
            $type = $request->type;
            $receipts = $request->receipts_id;
            $operation = operation::where('id',$type)->first();
            $fundsBanks = Department::whereIn('operation_id',[6,7])->where('type','1')->get();
            $data = receiptsType::where('invoice_id',$request->invoice)->get();
            if ($type == 4){
                $tree = Department::where('levelType','=',1)->pluck('dep_name_'.session('lang'),'id');
                $contents = view('admin.banks.edit.detailsselect', ['data'=>$data,'receipts'=>$receipts,'type'=>$type,'operation'=>$operation,'tree'=>$tree,'fundsBanks'=>$fundsBanks])->render();
                return $contents;
            }else{
                if ($operation != null){
                    if ($operation->id == 1){
                        $tree = $operation->suppliers->pluck('name_'.session('lang'),'id');
                        $contents = view('admin.banks.edit.detailsselect', ['data'=>$data,'receipts'=>$receipts,'type'=>$type,'operation'=>$operation,'tree'=>$tree,'fundsBanks'=>$fundsBanks])->render();
                        return $contents;
                    }elseif ($operation->id == 5){
                        $tree = $operation->drivers->pluck('name_'.session('lang'),'id');
                        $contents = view('admin.banks.edit.detailsselect', ['data'=>$data,'receipts'=>$receipts,'type'=>$type,'operation'=>$operation,'tree'=>$tree,'fundsBanks'=>$fundsBanks])->render();
                        return $contents;
                    }elseif ($operation->id == 2){
                        $tree = $operation->subscribers->pluck('name_'.session('lang'),'id');
                        $contents = view('admin.banks.edit.detailsselect', ['data'=>$data,'receipts'=>$receipts,'type'=>$type,'operation'=>$operation,'tree'=>$tree,'fundsBanks'=>$fundsBanks])->render();
                        return $contents;
                    }
                }
            }
        }
    }
    public function receipts(receiptDataTable $receipts)
    {
        return $receipts->render('admin.banks.invoice.index',['title'=>trans('admin.receipts')]);
    }
    public function receiptsShow($id)
    {
        $receipts = receipts::where('id',$id)->first();
        $receiptsData= $receipts->receiptsData;
        $data = $receipts->receipts_type;
        if ($receipts->limitationReceipts->limitationReceiptsId == 0 || $receipts->limitationReceipts->limitationReceiptsId == 1){
            return view('admin.banks.invoice.show',compact('receiptsData','data','receipts'));
        }else{
            return view('admin.banks.invoice.show2',compact('receiptsData','data','receipts'));
        }
    }

    public function receiptsData(Request $request)
    {
        if($request->ajax()){
            if($request->add) {


                $operation = $request->operation;
                $type = $request->type;
                $receiptsType = receiptsType::create([
                    'name_ar' => ''
                ]);
                $receiptType = receiptsType::where('id',$receiptsType->id)->first();
                $receipts = $request->receipts;
                if($request->percentage != null){
                    $receiptType->tax = $request->total - ($request->total / ($request->percentage/100 + 1));
                }
                if($request->discount != null){
                    $receiptType->tax = round($request->total - ($request->total / (1 - $request->discount/100)));
                }
                if ($type == 1){
                    $receiptType->name_ar = supplier::where('id',$request->tree)->first()->name_ar;
                    $receiptType->name_en = supplier::where('id',$request->tree)->first()->name_en;
                    $receiptType->tree_id = supplier::where('id',$request->tree)->first()->tree_id;
                }elseif ($type == 4){
                    $receiptType->name_ar = Department::where('id',$request->tree)->first()->dep_name_ar;
                    $receiptType->name_en = Department::where('id',$request->tree)->first()->dep_name_en;
                    $receiptType->tree_id = Department::where('id',$request->tree)->first()->id;
                }elseif ($type == 5){
                    $receiptType->name_ar = drivers::where('id',$request->tree)->first()->name_ar;
                    $receiptType->name_en = drivers::where('id',$request->tree)->first()->name_en;
                    $receiptType->tree_id = drivers::where('id',$request->tree)->first()->tree_id;
                }elseif ($type == 2){
                    $receiptType->name_ar = subscription::where('id',$request->tree)->first()->name_ar;
                    $receiptType->name_en = subscription::where('id',$request->tree)->first()->name_en;
                    $receiptType->tree_id = subscription::where('id',$request->tree)->first()->tree_id;
                }
                $receiptType->operation_id = $request->operation;
                $receiptType->relation_id = $request->tree;
                $receiptType->cc_id = $request->cc;

                if ($request->receipts == 0 || $request->receipts == 1){
                    $receiptType->debtor = 0;
                    $receiptType->creditor = $request->total;
                }else{
                    $receiptType->creditor = 0;
                    $receiptType->debtor = $request->total;
                }
                if ($request->note_credit){
                    $receiptType->note = $request->note_credit;
                }else{
                    $receiptType->note = $request->note_debt;
                }

                $receiptType->invoice_id = $request->invoice;
                $receiptType->save();
                $data = receiptsType::where('invoice_id',$request->invoice)->get();
                $contents = view('admin.banks.catchReceipt.data_table', ['data' => $data,'receipts' => $receipts])->render();
                return $contents;
            }else{
                $data = receiptsType::where('invoice_id',$request->invoice)->get();
                $contents = view('admin.banks.catchReceipt.data_table', ['data' => $data])->render();
                return $contents;
            }
        }
    }
    public function editdatatable(Request $request)
    {
        if($request->ajax()){
            if($request->add) {
                $operation = $request->operation;
                $type = $request->type;
                $receiptsType = receiptsType::create([
                    'name_ar' => ''
                ]);
                $receiptType = receiptsType::where('id',$receiptsType->id)->first();
                $receipts = limitationReceipts::where('id',$request->receipts)->first()->limitationReceiptsId;
                if($request->percentage != null){
                    $receiptType->tax = $request->total - ($request->total / ($request->percentage/100 + 1));
                }
                if ($type == 1){
                    $receiptType->name_ar = supplier::where('id',$request->tree)->first()->name_ar;
                    $receiptType->name_en = supplier::where('id',$request->tree)->first()->name_en;
                    $receiptType->tree_id = supplier::where('id',$request->tree)->first()->tree_id;
                }elseif ($type == 4){
                    $receiptType->name_ar = Department::where('id',$request->tree)->first()->dep_name_ar;
                    $receiptType->name_en = Department::where('id',$request->tree)->first()->dep_name_en;
                    $receiptType->tree_id = Department::where('id',$request->tree)->first()->id;
                }elseif ($type == 5){
                    $receiptType->name_ar = drivers::where('id',$request->tree)->first()->name_ar;
                    $receiptType->name_en = drivers::where('id',$request->tree)->first()->name_en;
                    $receiptType->tree_id = drivers::where('id',$request->tree)->first()->tree_id;
                }elseif ($type == 2){
                    $receiptType->name_ar = subscription::where('id',$request->tree)->first()->name_ar;
                    $receiptType->name_en = subscription::where('id',$request->tree)->first()->name_en;
                    $receiptType->tree_id = subscription::where('id',$request->tree)->first()->tree_id;
                }
                $receiptType->operation_id = $request->type;
                $receiptType->cc_id = $request->cc;
                $receiptType->relation_id = $request->tree;
                if ($receipts == 0 || $receipts == 1){
                    $receiptType->debtor = 0;
                    $receiptType->creditor = $request->total;
                }else{
                    $receiptType->creditor = 0;
                    $receiptType->debtor = $request->total;
                }
                if ($request->note_credit){
                    $receiptType->note = $request->note_credit;
                }else{
                    $receiptType->note = $request->note_debtor;
                }
                $receiptType->invoice_id = $request->invoice;
                $receiptType->save();
                $data = receiptsType::where('invoice_id',$request->invoice)->get();
                $contents = view('admin.banks.edit.data_table', ['data' => $data,'receiptType'=>$receiptType,'receipts' => $receipts])->render();
                return $contents;
            }else{
                $data = receiptsType::where('invoice_id',$request->invoice)->get();
                $contents = view('admin.banks.edit.data_table', ['data' => $data])->render();
                return $contents;
            }
        }
    }
    public function edit($id)
    {
        DB::table('receipts_type')->where('status',0)->delete();
        DB::table('receipts')->where('status',0)->delete();
        DB::table('receipts_data')->where('receipts_id',null)->delete();

        $receipts = receipts::findOrFail($id);
        $title = trans('admin.edit_receipts');
        $operations = operation::whereIn('receipt',[1,2])->pluck('name_'.session('lang'),'id');
        $data = receiptsType::where('receipts_id',$receipts->id)->get();
        $receiptsData = receiptsData::where('receipts_id',$receipts->id)->first();
        $fundsBanks = Department::whereIn('operation_id',[6,7])->where('type','1')->get();
        return view('admin.banks.edit.show',compact('receipts','operations','title','data','receiptsData','fundsBanks'));

    }
    public function update(Request $request, $id)
    {
        $receipts = receipts::findOrFail($id);
        $operations = receiptsType::where('invoice_id',$request->invoice)->pluck('operation_id');
        $receiptData = receiptsData::where('invoice_id',$receipts->invoice_id)->where('receipts_id',$id)->first();
        $receiptsType = receiptsType::where('invoice_id',$receipts->invoice_id)->get();
        if (!empty($receiptData->receiptsType)){
            DB::table('departments')->where('id',$receiptData->tree_id)->update(['debtor' => DB::raw('debtor - '.$receiptData->debtor),'creditor' => DB::raw('creditor - '.$receiptData->creditor)]);

            getSitioPadre($receiptData->tree_id, -$receiptData->debtor, -$receiptData->creditor);

//                for receiptsType departement
            if (receiptsType::where('invoice_id',$receipts->invoice_id)->where('receipts_id',$id)->exists()){
                $operations = receiptsType::where('invoice_id',$receipts->invoice_id)->pluck('operation_id');
                $tree_id = receiptsType::where('invoice_id',$receipts->invoice_id)->whereIn('operation_id',$operations)->pluck('tree_id');
                $receiptsTypetree = $receiptData->receiptsType;
                foreach ($receiptsTypetree as $type){
                    DB::table('departments')->where('id',$type->tree_id)->update(['debtor' => DB::raw('debtor - '.$type->debtor),'creditor' => DB::raw('creditor - '.$type->creditor)]);
                    getSitioPadre($type->tree_id,-$type->debtor,-$type->creditor);
                }

//                for receiptsType glcc
                $cc_id = receiptsType::where('invoice_id',$receipts->invoice_id)->where('cc_id','!=',null)->whereIn('operation_id',$operations)->pluck('cc_id');
                $receiptsTypecc = $receiptData->receiptsType;
                foreach ($receiptsTypecc as $type){
                    DB::table('glccs')->where('id',$type->cc_id)->update(['debtor' => DB::raw('debtor - '.$type->debtor),'creditor' => DB::raw('creditor - '.$type->creditor)]);
                    getSitiocc($type->cc_id,-$type->debtor,-$type->creditor);
                }
            }

        }


        $receiptData->receiptsType()->detach($receiptsType);

        if ($receipts->limitationReceipts->id == 1 || $receipts->limitationReceipts->id == 2){
            $receiptData->debtor = $request->debtor;
            $receiptData->creditor = 0;
        }else{
            $receiptData->debtor = 0;
            $receiptData->creditor = $request->creditor;
        }
        $receiptData->save();
        $receiptData->receiptsType()->attach($receiptsType);
        DB::table('receipts_type')->where('invoice_id',$request->invoice)->update(['receipts_id'=>$id,'status'=>1]);
        DB::table('receipts_data')->where('invoice_id',$request->invoice)->update(['receipts_id'=>$id]);


        DB::table('departments')->where('id',$receiptData->tree_id)->update(['debtor' => DB::raw('debtor + '.$receiptData->debtor),'creditor' => DB::raw('creditor + '.$receiptData->creditor)]);
        getSitioPadre($receiptData->tree_id,$receiptData->debtor,$receiptData->creditor);
//                for receiptsType departement
        if (receiptsType::where('invoice_id',$receipts->invoice_id)->exists()) {
            $tree_id2 = receiptsType::where('invoice_id', $receipts->invoice_id)->whereIn('operation_id', $operations)->pluck('tree_id');
            $receiptsTypetree2 = receiptsType::where('invoice_id', $receipts->invoice_id)->whereIn('tree_id', $tree_id2)->get();
            foreach ($receiptsTypetree2 as $type) {
                DB::table('departments')->where('id', $type->tree_id)->update(['debtor' => DB::raw('debtor + ' . $type->debtor), 'creditor' => DB::raw('creditor + ' . $type->creditor)]);
                getSitioPadre($type->tree_id, $type->debtor, $type->creditor);
            }
//                for receiptsType glcc
            $cc_id2 = receiptsType::where('invoice_id',$receipts->invoice_id)->where('cc_id','!=',null)->whereIn('operation_id',$operations)->pluck('cc_id');
            $receiptsTypecc2 = receiptsType::where('invoice_id', $receipts->invoice_id)->whereIn('cc_id', $cc_id2)->get();
            foreach ($receiptsTypecc2 as $type){
                DB::table('glccs')->where('id',$type->cc_id)->update(['debtor' => DB::raw('debtor + '.$type->debtor),'creditor' => DB::raw('creditor + '.$type->creditor)]);
                getSitiocc($type->cc_id, $type->debtor, $type->creditor);
            }
        }
        $data = $receipts->receipts_type;
        if ($receipts->limitationReceipts->limitationReceiptsId == 0 || $receipts->limitationReceipts->limitationReceiptsId == 1){
            $receiptsData = $receipts->receiptsData;
            return view('admin.banks.invoice.show',compact('receiptData','receiptsData','data','receipts'));
        }else{
            $receiptsData = $receipts->receiptsData;
            return view('admin.banks.invoice.show2',compact('receiptData','receiptsData','data','receipts'));
        }
    }
    public function destroy($id,Request $request)
    {
        $receipts = receipts::findOrFail($id);
        $receiptData = receiptsData::where('invoice_id',$receipts->invoice_id)->first();
        DB::beginTransaction();
        try{
//            $minusdep = DB::table('departments')->where('id',$receiptData->tree_id)->update(['debtor' => DB::raw('debtor - '.$receiptData->debtor),'creditor' => DB::raw('creditor - '.$receiptData->creditor)]);
            pjitmmsfl::where('tree_id',$receiptData->tree_id)->where('month',date('n',strtotime($receiptData->receipts->created_at)))->where('year',date('Y',strtotime($receiptData->receipts->created_at)))->update(['debtor' => DB::raw('debtor - '.$receiptData->debtor),'creditor' => DB::raw('creditor - '.$receiptData->creditor)]);
            $minusgetSitioPadre = getSitioPadre($receiptData->tree_id, -$receiptData->debtor, -$receiptData->creditor,$receiptData->receipts->created_at);

//                for receiptsType departement
            if (receiptsType::where('invoice_id',$receipts->invoice_id)->exists()){
                $operations = receiptsType::where('invoice_id',$receipts->invoice_id)->pluck('operation_id');
                $tree_id = receiptsType::where('invoice_id',$receipts->invoice_id)->whereIn('operation_id',$operations)->pluck('tree_id');
                $receiptsTypetree = receiptsType::where('invoice_id',$receipts->invoice_id)->whereIn('tree_id',$tree_id)->get();
                foreach ($receiptsTypetree as $type){
//                    $minusdep1 = DB::table('departments')->where('id',$type->tree_id)->update(['debtor' => DB::raw('debtor - '.$type->debtor),'creditor' => DB::raw('creditor - '.$type->creditor)]);
                    pjitmmsfl::where('tree_id',$type->tree_id)->where('month',date('n',strtotime($type->receipts->created_at)))->where('year',date('Y',strtotime($type->receipts->created_at)))->update(['debtor' => DB::raw('debtor - '.$type->debtor),'creditor' => DB::raw('creditor - '.$type->creditor)]);
                    $minusgetSitioPadre1 = getSitioPadre($type->tree_id,-$type->debtor,-$type->creditor,$type->receipts->created_at);
                }

//                for receiptsType glcc
                $cc_id = receiptsType::where('invoice_id',$receipts->invoice_id)->where('cc_id','!=',null)->whereIn('operation_id',$operations)->pluck('cc_id');
                $receiptsTypecc = receiptsType::where('invoice_id',$receipts->invoice_id)->whereIn('cc_id',$cc_id)->get();
                foreach ($receiptsTypecc as $type){
                    $minuscc = DB::table('glccs')->where('id',$type->cc_id)->update(['debtor' => DB::raw('debtor - '.$type->debtor),'creditor' => DB::raw('creditor - '.$type->creditor)]);
                    pjitmmsfl::where('cc_id',$type->cc_id)->where('month',date('n',strtotime($type->receipts->created_at)))->where('year',date('Y',strtotime($type->receipts->created_at)))->update(['debtor' => DB::raw('debtor - '.$type->debtor),'creditor' => DB::raw('creditor - '.$type->creditor)]);
                    $minusgetSitiocc = getSitiocc($type->cc_id,-$type->debtor,-$type->creditor,$type->receipts->created_at);
                }
            }
            if ($receipts->status != 1) {
                $delete = $receipts->delete();
            }else{
                $receiptsType = receiptsType::where('invoice_id',$receipts->invoice_id)->get();
                $receiptsData = receiptsData::where('invoice_id',$receipts->invoice_id)->first();
                $receiptsData->receiptsType()->detach($receiptsType);
                $limitationsDatadel = $receiptsData->delete();
                $limitationsTypedel = receiptsType::where('invoice_id',$receipts->invoice_id)->delete();
                $delete = $receipts->delete();
            }

            DB::commit();
        }catch (Exception $e){
            return $e;
            DB::rollBack();
        }
        $minusgetSitioPadre;
        $minusgetSitioPadre1;
        $minuscc;
        $minusgetSitiocc;
        $delete;
        $limitationsDatadel;
        $limitationsTypedel;
        return redirect()->route('receipts');

    }
    public function delete(Request $request)
    {
        if($request->ajax()){
            $id = $request->id;
            $invoice = $request->invoice;
            $receiptsType = receiptsType::where('id',$id)->where('invoice_id',$invoice)->first();
            $receiptsData = receiptsData::where('invoice_id',$invoice)->first();
            DB::table('departments')->where('id',$receiptsType->tree_id)->update(['debtor' => DB::raw('debtor - '.$receiptsType->debtor),'creditor' => DB::raw('creditor - '.$receiptsType->creditor)]);
            DB::table('departments')->where('id',$receiptsData->tree_id)->update(['debtor' => DB::raw('debtor - '.$receiptsType->creditor),'creditor' => DB::raw('creditor - '.$receiptsType->debtor)]);
            getSitioPadre($receiptsData->tree_id,-$receiptsType->creditor,-$receiptsType->debtor);
            getSitioPadre($receiptsType->tree_id,-$receiptsType->debtor,-$receiptsType->creditor);
            if ($receiptsType->cc_id != null){
                DB::table('glccs')->where('id',$receiptsType->cc_id)->update(['debtor' => DB::raw('debtor - '.$receiptsType->debtor),'creditor' => DB::raw('creditor - '.$receiptsType->creditor)]);
                getSitiocc($receiptsType->cc_id,-$receiptsType->debtor,-$receiptsType->creditor);
            }
            $receiptsData->debtor = $receiptsData->debtor - $receiptsType->creditor;
            $receiptsData->creditor = $receiptsData->creditor - $receiptsType->debtor;
            $receiptsData->save();
            if ($receiptsType->receiptsData() != null){
                $receiptsType->receiptsData()->detach($receiptsData);
            }

            $receiptsType->delete();
            $data = receiptsType::where('invoice_id',$invoice)->get();
            $receipts = $request->type;
            $contents = view('admin.banks.edit.data_table', ['data' => $data,'receiptsType' => $receiptsType,'receipts'=>$receipts])->render();
            return $contents;
        }
    }
    public function singledelete(Request $request)
    {
        if($request->ajax()){
            $id = $request->id;
            $invoice = $request->invoice;
            $receiptsType = receiptsType::where('id',$id)->where('invoice_id',$invoice)->first();
            $receiptsType->delete();
            $data = receiptsType::where('invoice_id',$invoice)->get();
            $receipts = $request->type;

            $contents = view('admin.banks.edit.data_table', ['data' => $data,'receiptsType' => $receiptsType,'receipts'=>$receipts])->render();
            return $contents;
        }
    }
    public function cc(Request $request)
    {
        if($request->ajax()){
            $tree = $request->tree;
            $cc = Department::where('id',$tree)->first()->glcc ? Department::where('id',$tree)->first()->glcc->id: null;

            if ($tree != null){
                $products = [];
                $glcc = glcc::where('id',$cc)->get();
                while(count($glcc) > 0){
                    $nextCategories = [];
                    foreach ($glcc as $category) {
                        $products = array_merge($products, $category->children->all());
                        $nextCategories = array_merge($nextCategories, $category->children->all());
                    }
                    $glcc = $nextCategories;
                }
                $contents = view('admin.banks.catchReceipt.cc', ['cc' => $cc,'products'=>$products])->render();
                return $contents;
            }
        }
    }
//    edit by Ibrahim El Monier
    public function pdf($id,Request $request) {
        $invoice_id = $request->invoice_id;
        $receipts = receipts::where('id','=',$id)->first();
        $receipts->status = 1;
        $receipts->save();
        Db::table('receipts_data')->where('invoice_id',$invoice_id)->update(['receipts_id'=> $id]);
        Db::table('receipts_type')->where('invoice_id',$invoice_id)->update(['receipts_id'=> $id,'status'=>1]);
        $receiptsData = receiptsData::where('invoice_id',$invoice_id)->first();
        $receiptsType = receiptsType::where('invoice_id',$invoice_id)->get();
        $operations = receiptsType::where('invoice_id',$invoice_id)->pluck('operation_id');
        $receiptsData->receiptsType()->attach($receiptsType);
        $departments = DB::table('departments')->where('id',$receiptsData->tree_id)->first();
        if ($departments->debtor != null){
            DB::table('departments')->where('id',$receiptsData->tree_id)->update(['debtor' => DB::raw('debtor + '.$receiptsData->debtor),'creditor' => DB::raw('creditor + '.$receiptsData->creditor)]);
        }else{
            DB::table('departments')->where('id',$receiptsData->tree_id)->update(['debtor' => $receiptsData->debtor,'creditor' => $receiptsData->creditor]);
        }
        getSitioPadre($receiptsData->tree_id,$receiptsData->debtor,$receiptsData->creditor);
//                for receiptsType departement
        $tree_id = receiptsType::where('invoice_id',$receipts->invoice_id)->whereIn('operation_id',$operations)->pluck('tree_id');
        $receiptsTypetree = receiptsType::where('invoice_id',$receipts->invoice_id)->whereIn('tree_id',$tree_id)->get();
        foreach ($receiptsTypetree as $type){
            DB::table('departments')->where('id',$type->tree_id)->update(['debtor' => DB::raw('debtor + '.$type->debtor),'creditor' => DB::raw('creditor + '.$type->creditor)]);
            getSitioPadre($type->tree_id,$type->debtor,$type->creditor);
        }
//                for receiptsType glcc
        $cc_id = receiptsType::where('invoice_id',$receipts->invoice_id)->where('cc_id','!=',null)->whereIn('operation_id',$operations)->pluck('cc_id');
        $receiptsTypecc = receiptsType::where('invoice_id', $receipts->invoice_id)->whereIn('cc_id',$cc_id)->get();
        foreach ($receiptsTypecc as $type){
            DB::table('glccs')->where('id',$type->cc_id)->update(['debtor' => DB::raw('debtor + '.$type->debtor),'creditor' => DB::raw('creditor + '.$type->creditor)]);
            getSitiocc($type->cc_id,$type->debtor,$type->creditor);
        }
        $receipts = receipts::where('id',$id)->first();
        $receiptsData = $receipts->receiptsData;
        $data = $receipts->receipts_type;
        if ($receipts->limitationReceipts['limitationReceiptsId'] == 0 || $receipts->limitationReceipts['limitationReceiptsId'] == 1){
            $config = ['instanceConfigurator' => function($mpdf) {
                $mpdf->SetHTMLFooter('
                    <div dir="ltr" style="text-align: right">{DATE j-m-Y H:m}</div>
                    <div dir="ltr" style="text-align: center">{PAGENO} of {nbpg}</div>'
                );
            }];
            $pdf = PDF::loadView('admin.banks.invoice.pdf.report', compact('receiptsData','data','receipts'),[],['format' => 'A5-L'], $config);
            return $pdf->stream();
        }else{
            $config = ['instanceConfigurator' => function($mpdf) {
                $mpdf->SetHTMLFooter('
                    <div dir="ltr" style="text-align: right">{DATE j-m-Y H:m}</div>
                    <div dir="ltr" style="text-align: center">{PAGENO} of {nbpg}</div>'
                );
            }];
            $pdf = PDF::loadView('admin.banks.invoice.pdf.report2', compact('receiptsData','data','receipts'),[],['format' => 'A5-L'], $config);
            return $pdf->stream();
        }

    }
    public function print($id){
        $receipts = receipts::where('id',$id)->first();
        $receiptsData = $receipts->receiptsData;
        $data = $receipts->receipts_type;
        if (count($data) > 1){
            if ($receipts->limitationReceipts['limitationReceiptsId'] == 0 || $receipts->limitationReceipts['limitationReceiptsId'] == 1){
                $config = ['instanceConfigurator' => function($mpdf) {
                    $mpdf->SetHTMLFooter('
                    <div dir="ltr" style="text-align: right">{DATE j-m-Y H:m}</div>
                    <div dir="ltr" style="text-align: center">{PAGENO} of {nbpg}</div>'
                    );
                }];
                $pdf = PDF::loadView('admin.banks.invoice.pdf.multi_report', compact('receiptsData','data','receipts'),[],['format' => 'A4'], $config);
                return $pdf->stream();
            }else{
                $config = ['instanceConfigurator' => function($mpdf) {
                    $mpdf->SetHTMLFooter('
                    <div dir="ltr" style="text-align: right">{DATE j-m-Y H:m}</div>
                    <div dir="ltr" style="text-align: center">{PAGENO} of {nbpg}</div>'
                    );
                }];
                $pdf = PDF::loadView('admin.banks.invoice.pdf.multi_report2', compact('receiptsData','data','receipts'),[],['format' => 'A4'], $config);
                return $pdf->stream();
            }
        }elseif(count($data) == 1){
            if ($receipts->limitationReceipts['limitationReceiptsId'] == 0 || $receipts->limitationReceipts['limitationReceiptsId'] == 1){
                $config = ['instanceConfigurator' => function($mpdf) {
                    $mpdf->SetHTMLFooter('
                    <div dir="ltr" style="text-align: right">{DATE j-m-Y H:m}</div>
                    <div dir="ltr" style="text-align: center">{PAGENO} of {nbpg}</div>'
                    );
                }];
                $pdf = PDF::loadView('admin.banks.invoice.pdf.report', compact('receiptsData','data','receipts'),[],['format' => 'A4'], $config);
                return $pdf->stream();
            }else{
                $config = ['instanceConfigurator' => function($mpdf) {
                    $mpdf->SetHTMLFooter('
                    <div dir="ltr" style="text-align: right">{DATE j-m-Y H:m}</div>
                    <div dir="ltr" style="text-align: center">{PAGENO} of {nbpg}</div>'
                    );
                }];
                $pdf = PDF::loadView('admin.banks.invoice.pdf.report2', compact('receiptsData','data','receipts'),[],['format' => 'A4'], $config);
                return $pdf->stream();
            }
        }

    }

//    end edit by Ibrahim El Monier


//Edit by: Norhan Hesham Foda
    public function catchindex(catchDataTable $receipts)
    {
        return $receipts->render('admin.banks.invoice.index',['title'=>trans('admin.catch_receipt')]);
    }

    public function cachingindex(cachingDataTable $receipts)
    {
        return $receipts->render('admin.banks.invoice.index',['title'=>trans('admin.caching_receipt')]);
    }

    public function catch()
    {
        return view('admin.banks.catch.create');

    }
    
    public function caching()
    {
        return view('admin.banks.caching.create');
    }

}
