<?php

namespace App\Http\Controllers\API;

use App\Applicant;
use App\Branches;
use App\Company;
use App\Contractors;
use App\Department;
use App\employee;
use App\glcc;
use App\limitationReceipts;
use App\operation;
use App\pjitmmsfl;
use App\Project;
use App\receipts;
use App\receiptsData;
use App\receiptsType;
use App\subscription;
use App\supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Matrix\Exception;

class receiptsController extends Controller
{
//    public function __construct(){
//        $this->middleware('auth:api');
//    }
    public function index(){
        $limitationReceipts = limitationReceipts::where('type',0)->get();
        $branches = Branches::all();
        $operations = operation::whereIn('receipt',[1,2])->get();
        $cc = glcc::where('type','1')->pluck('name_ar','id');
        $banksfunds = Department::whereIn('operation_id',[6,7])->where('type','1')->get();
        return response()->json([$limitationReceipts,$branches,$operations,$cc,$banksfunds]);
    }
    public function caching(){
        $limitationReceipts = limitationReceipts::whereIn('limitationReceiptsId',[2,3])->where('type',0)->get();
        return response()->json([$limitationReceipts]);
    }
    public function catch(){
        $limitationReceipts = limitationReceipts::whereIn('limitationReceiptsId',[0,1])->where('type',0)->get();
        return response()->json([$limitationReceipts]);
    }
    public function receiptnum($id){
        $number = checkIdReceipts($id);
        return response()->json($number);
    }
    public function roperations($id){
        switch ($id){
            case $id == 2;
                $type = Company::all();
                $message = ['عملاء'];
                return [$type,$message];
                break;
            case $id == 4;
                $type = Department::where('type','1')->get();
                $message = ['حسابات'];
                return [$type,$message];
                break;
            case $id == 5;
                $type = employee::all();
                $message = ['موظفين'];
                return [$type,$message];
                break;
        }
    }
    public function store(Request $request){
        DB::beginTransaction();
        try{
            $requests = $request->all();
            // dd($request);
            $invoice_id = '';
            $cc = '';
            $operations = [];
            $receipts_id = '';
            $endrequest = end($requests);
            foreach (array_slice($requests, 0, count($requests) - 1) as $key => $value){
                $invoice_id = $value['invoice'];
                // dd($invoice_id);
                $exists = receipts::where('invoice_id',$invoice_id)->exists();
                if (!$exists)
                {
                    // $receiptId = receipts::orderBy('id', 'desc')->where('receiptsType_id',$value['receipts'])->first();
                    $receiptId = receipts::where('receiptsType_id',$value['receipts'])->orderBy('receiptId', 'desc')->first();
                    // dd($receiptId);
                    $receipts_id = receipts::findOrfail(receipts::create([
                        'receiptId' => $receiptId ? $receiptId->receiptId + 1 : 1,
                        'branche_id' => $value['branches'],
                        'date' => date('Y-m-d',strtotime($value['date'])),
                        'created_at' => $value['created_at'],
                        'receiptsType_id' => $value['receipts'],
                        'invoice_id' => $invoice_id,
                        'status' => 1,
                    ])->id)->id;
                    $operation_fundsbanks = Department::where('id',$endrequest['banksfunds'])->first()->operation_id;
                    $receiptsData = receiptsData::create([
                        'debtor' => $value['creditor'] != 0 ? $endrequest['fcreditor'] : 0,
                        'creditor' => $value['debtor'] != 0 ? $endrequest['fdebtor'] : 0,
                        'check' => $value['check'],
                        'checkDate' => $value['checkDate'],
                        'person' => $value['person'],
                        'taken' => $value['taken'],
                        'invoice_id' => $invoice_id,
                        'receipts_id' => $receipts_id,
                        'tree_id' => $endrequest['banksfunds'],
                        'operation_id' => $operation_fundsbanks,
                        'note' => $endrequest['fnote'],
                        'note_en' => $endrequest['fnote_en'],
                        'receipt_number' => $endrequest['receipt_number_data'],
                    ]);
                }
            $operation = operation::where('id',$value['operations'])->first();
            if ($operation->id == 4){
                $tree = $value['tree'];
            }elseif ($operation->id == 2){
                $tree = Applicant::where('id',$value['tree'])->first()['tree_id'];
            }elseif ($operation->id == 5){
                $tree = employee::where('id',$value['tree'])->first()['tree_id'];
            }
            $receiptstype = receiptsType::create([
                'name_ar' => $value['name'],
                'name_en' => $value['name'],
                'tree_id' => $tree,
                'operation_id' => $value['operations'],
                'receipts_id' => $receipts_id,
                'relation_id' => $value['tree'],
                'cc_id' => $value['cc'],
                'debtor' => $value['debtor'],
                'creditor' => $value['creditor'],
                'note' => $value['note'],
                'note_en' => $value['note_en'],
                'tax' => $value['tax'],
                'invoice_id' => $invoice_id,
                'status' => 1,
            ]);
            $receiptsData->receiptsType()->attach($receiptstype);
            $operations[] = $value['operations'];
        }
//        end create in receipts
//            $departments = DB::table('departments')->where('id',$receiptsData->tree_id)->first();
//            $pjitmmsflexists = pjitmmsfl::where('tree_id',$receiptsData->tree_id)->where('month',date('n',strtotime($receiptsData->receipts->created_at)))->where('year',date('Y',strtotime($receiptsData->receipts->created_at)))->exists();
//            if($pjitmmsflexists){
//                pjitmmsfl::where('tree_id',$receiptsData->tree_id)->where('month',date('n',strtotime($receiptsData->receipts->created_at)))->where('year',date('Y',strtotime($receiptsData->receipts->created_at)))->update(['debtor' => DB::raw('debtor + '.$receiptsData->debtor),'creditor' => DB::raw('creditor + '.$receiptsData->creditor)]);
//            }else{
//                pjitmmsfl::create(['debtor'=>$receiptsData->debtor,'creditor'=>$receiptsData->creditor,'tree_id'=>$receiptsData->tree_id,'month'=>date('n',strtotime($receiptsData->receipts->created_at)),'year'=>date('Y',strtotime($receiptsData->receipts->created_at)),'type'=>'1']);
//            }
//            $getSitioPadre = getSitioPadre($receiptsData->tree_id,$receiptsData->debtor,$receiptsData->creditor,$receiptsData->receipts->created_at);
//
////                for receiptsType departement
//            $receipts = receipts::findOrFail($receipts_id);
//            $tree_id = receiptsType::where('invoice_id',$receipts->invoice_id)->whereIn('operation_id',$operations)->pluck('tree_id');
//            $receiptsTypetree = receiptsType::where('invoice_id',$receipts->invoice_id)->whereIn('tree_id',$tree_id)->get();
//            foreach ($receiptsTypetree as $type){
//                $pjitmmsflexists2 = pjitmmsfl::where('tree_id',$type->tree_id)->where('month',date('n',strtotime($type->receipts->created_at)))->where('year',date('Y',strtotime($type->receipts->created_at)))->exists();
//
////                $bdepupdate = DB::table('departments')->where('id',$type->tree_id)->update(['debtor' => DB::raw('debtor + '.$type->debtor),'creditor' => DB::raw('creditor + '.$type->creditor)]);
//                if($pjitmmsflexists2){
//                    pjitmmsfl::where('tree_id',$type->tree_id)->where('month',date('n',strtotime($type->receipts->created_at)))->where('year',date('Y',strtotime($type->receipts->created_at)))->update(['debtor' => DB::raw('debtor + '.$type->debtor),'creditor' => DB::raw('creditor + '.$type->creditor)]);
//                }else{
//                    pjitmmsfl::create(['debtor'=>$type->debtor,'creditor'=>$type->creditor,'tree_id'=>$type->tree_id,'month'=>date('n',strtotime($type->receipts->created_at)),'year'=>date('Y',strtotime($type->receipts->created_at)),'type'=>'1']);
//                }
//                $bgetSitioPadre = getSitioPadre($type->tree_id,$type->debtor,$type->creditor,$type->receipts->created_at);
//            }
////                for receiptsType glcc
//            $cc_id = receiptsType::where('invoice_id',$receipts->invoice_id)->where('cc_id','!=',null)->whereIn('operation_id',$operations)->pluck('cc_id');
//            $receiptsTypecc = receiptsType::where('invoice_id', $receipts->invoice_id)->whereIn('cc_id',$cc_id)->get();
//            foreach ($receiptsTypecc as $type){
//                $ccupdate = DB::table('glccs')->where('id',$type->cc_id)->update(['debtor' => DB::raw('debtor + '.$type->debtor),'creditor' => DB::raw('creditor + '.$type->creditor)]);
//                $pjitmmsflexistscc = pjitmmsfl::where('cc_id',$type->cc_id)->where('month',date('n',strtotime($receiptsData->receipts->created_at)))->where('year',date('Y',strtotime($receiptsData->receipts->created_at)))->exists();
//                if($pjitmmsflexistscc){
//                    pjitmmsfl::where('cc_id',$type->cc_id)->where('month',date('n',strtotime($type->receipts->created_at)))->where('year',date('Y',strtotime($type->receipts->created_at)))->update(['debtor' => DB::raw('debtor + '.$type->debtor),'creditor' => DB::raw('creditor + '.$type->creditor)]);
//                }else{
//                    pjitmmsfl::create(['debtor'=>$type->debtor,'creditor'=>$type->creditor,'cc_id'=>$type->cc_id,'month'=>date('n',strtotime($type->receipts->created_at)),'year'=>date('Y',strtotime($type->receipts->created_at)),'type'=>'2']);
//                }
//                $getSitiocc = getSitiocc($type->cc_id,$type->debtor,$type->creditor,$type->receipts->created_at);
//            }
            DB::commit();
        }
        catch (Exception $e){
            return $e;
            DB::rollBack();
        }
        $receipts_id;
        $receiptsData;
        $receiptstype;
//        $getSitioPadre;
//        $bgetSitioPadre;
//        $ccupdate;
//        $getSitiocc;

        return route('receipts.print',$receipts_id);
    }
    public function rgetcc($id,$operations){
        // dd($id,$operations);
        if ($id && $operations){
            $cc= '';
            $glcc= '';
            if ($operations == 4){
                if ($cc = Department::where('id',$id)->first()['cc_type'] != 0){
                    $cc = 1;
                    $glcc = glcc::where('type','1')->pluck('name_ar','id');
                }else{
                    $cc = 0;
                }
            }elseif ($operations == 2){
                // dd(Applicant::where('id',$id)->where('cc_type', '!=', 0)->first());
                if (Applicant::where('id',$id)->first()['cc_type'] != 0){
                    $cc = 1;
                    $glcc = glcc::where('type','1')->pluck('name_ar','id');
                }else{
                    $cc = 0;
                }
            }elseif ($operations == 5){
                if (employee::where('id',$id)->first()['cc_type'] != 0){
                    $cc = 1;
                    $glcc = glcc::where('type','1')->pluck('name_ar','id');
                }else{
                    $cc = 0;
                }
            }
            return [$cc,$glcc];
        }

    }
    public function rgetccname($id){
        if ($id){
            return glcc::where('id',$id)->first()->name_ar;
        }

    }

    public function edit($id){
        if ($id){
            $receiptsType = receiptsType::where('receipts_id',$id)->get();
            // dd($receiptsType);
            $receiptsdata = receiptsData::where('receipts_id',$id)->first();
            // return($receiptsType);
            return [$receiptsType,$receiptsdata];
        }

    }

    public function update($id,Request $request){
        $receipts = receipts::findOrFail($id);
        $operations = receiptsType::where('receipts_id',$id)->pluck('operation_id');
        $receiptData = receiptsData::where('receipts_id',$id)->first();
        $receiptsType = receiptsType::where('receipts_id',$id)->get();
        $branches = $receipts->branches_id;
        $date = $receipts->date;
        $created_at = $receipts->created_at;
        DB::beginTransaction();
        try{
//            if (!empty($receiptData->receiptsType)){
////                $minusdep = DB::table('departments')->where('id',$receiptData->tree_id)->update(['debtor' => DB::raw('debtor - '.$receiptData->debtor),'creditor' => DB::raw('creditor - '.$receiptData->creditor)]);
//                pjitmmsfl::where('tree_id',$receiptData->tree_id)->where('month',date('n',strtotime($receiptData->created_at)))->where('year',date('Y',strtotime($receiptData->created_at)))->update(['debtor' => DB::raw('debtor - '.$receiptData->debtor),'creditor' => DB::raw('creditor - '.$receiptData->creditor)]);
//                $minusgetSitioPadre = getSitioPadre($receiptData->tree_id, -$receiptData->debtor, -$receiptData->creditor,$receiptData->receipts->created_at);
////                for receiptsType departement
//                if (receiptsType::where('receipts_id',$id)->exists()){
//                    $operations = receiptsType::where('invoice_id',$receipts->invoice_id)->pluck('operation_id');
//                    $tree_id = receiptsType::where('invoice_id',$receipts->invoice_id)->whereIn('operation_id',$operations)->pluck('tree_id');
//                    $receiptsTypetree = $receiptData->receiptsType;
//                    foreach ($receiptsTypetree as $type){
////                        $minusdeptype = DB::table('departments')->where('id',$type->tree_id)->update(['debtor' => DB::raw('debtor - '.$type->debtor),'creditor' => DB::raw('creditor - '.$type->creditor)]);
//                        pjitmmsfl::where('tree_id',$type->tree_id)->where('month',date('n',strtotime($type->created_at)))->where('year',date('Y',strtotime($type->created_at)))->update(['debtor' => DB::raw('debtor - '.$type->debtor),'creditor' => DB::raw('creditor - '.$type->creditor)]);
//                        $minusgetSitioPadretype = getSitioPadre($type->tree_id,-$type->debtor,-$type->creditor,$type->receipts->created_at);
//                    }
////                for receiptsType glcc
//                    if (receiptsType::where('receipts_id',$id)->where('cc_id','!=',null)->exists()){
//                        $cc_id = receiptsType::where('receipts_id',$id)->where('cc_id','!=',null)->whereIn('operation_id',$operations)->pluck('cc_id');
//                        $receiptsTypecc = receiptsType::where('receipts_id',$id)->where('cc_id','!=',null)->get();
//                        foreach ($receiptsTypecc as $type){
//                            $minuscc = DB::table('glccs')->where('id',$type->cc_id)->update(['debtor' => DB::raw('debtor - '.$type->debtor),'creditor' => DB::raw('creditor - '.$type->creditor)]);
//                            pjitmmsfl::where('cc_id',$type->cc_id)->where('month',date('n',strtotime($type->receipts->created_at)))->where('year',date('Y',strtotime($type->receipts->created_at)))->update(['debtor' => DB::raw('debtor - '.$type->debtor),'creditor' => DB::raw('creditor - '.$type->creditor)]);
//                            $minusgetSitiocc = getSitiocc($type->cc_id,-$type->debtor,-$type->creditor,$type->receipts->created_at);
//                        }
//                    }
//
//                }
//            }
            $receiptData->receiptsType()->detach($receiptsType);
            $delete = receiptsType::where('receipts_id',$id)->delete();
            $requests = $request->all();
            $invoice_id = '';
            $cc = '';
            $receipts_id = '';
            $operations = [];
            $endrequest = end($requests);
            foreach (array_slice($requests, 0, count($requests) - 1) as $key => $r){
                if($key == 0){
                    receipts::where('id',$id)->first()->update(['created_at'=>$endrequest['created_at'],'date'=>date('Y-m-d',strtotime($endrequest['date']))]);
                    $invoice_id = $receipts->invoice_id;
                    $operation_fundsbanks = Department::where('id',$endrequest['banksfunds'])->first()->operation_id;
                    $receiptsData = $receiptData->update([
                        'debtor' => $r['creditor'] != 0 ? $endrequest['fcreditor'] : 0,
                        'creditor' => $r['debtor'] != 0 ? $endrequest['fdebtor'] : 0,
                        'check' => $endrequest['check'],
                        'checkDate' => $endrequest['checkDate'],
                        'person' => $endrequest['person'],
                        'taken' => $endrequest['taken'],
                        'invoice_id' => $invoice_id,
                        'receipts_id' => $receipts->id,
                        'tree_id' => $endrequest['banksfunds'],
                        'operation_id' => $operation_fundsbanks,
                        'note' => $endrequest['fnote'],
                        'note_en' => $endrequest['fnote_en'],
                    ]);
                }
                $operation = operation::where('id',$r['operation_id'])->first();
                if ($operation->id == 4){
                    $tree = $r['relation_id'];
                }elseif ($operation->id == 2){
                    $tree = Applicant::where('id',$r['relation_id'])->first()['tree_id'];
                }elseif ($operation->id == 5){
                    $tree = employee::where('id',$r['relation_id'])->first()['tree_id'];
                }
                $receiptstypes = receiptsType::create([
                    'name_ar' => $r['name_ar'],
                    'name_en' => $r['name_en'],
                    'tree_id' => $tree,
                    'operation_id' => $r['operation_id'],
                    'receipts_id' => $receipts->id,
                    'relation_id' => $r['relation_id'],
                    'cc_id' => $r['cc_id'],
                    'debtor' => $r['debtor'] != null ? $r['debtor'] : 0,
                    'creditor' => $r['creditor'] != null ? $r['creditor'] : 0,
                    'note' => $r['note'],
                    'note_en' => $r['note_en'],
                    'tax' => $r['tax'],
                    'invoice_id' => $invoice_id,
                    'status' => 1,
                ]);
                $receiptData->receiptsType()->attach($receiptstypes);
                $operations[] = $r['operation_id'];
            }
//        end create in receipts
//            $pjitmmsflexists = pjitmmsfl::where('tree_id',$receiptData->tree_id)->where('month',date('n',strtotime($receiptData->receipts->created_at)))->where('year',date('Y',strtotime($receiptData->receipts->created_at)))->exists();
//            if($pjitmmsflexists){
//                pjitmmsfl::where('tree_id',$receiptData->tree_id)->where('month',date('n',strtotime($receiptData->receipts->created_at)))->where('year',date('Y',strtotime($receiptData->receipts->created_at)))->update(['debtor' => DB::raw('debtor + '.$receiptData->debtor),'creditor' => DB::raw('creditor + '.$receiptData->creditor)]);
//            }else{
//                pjitmmsfl::create(['debtor'=>$receiptData->debtor,'creditor'=>$receiptData->creditor,'tree_id'=>$receiptData->tree_id,'month'=>date('n',strtotime($receiptData->receipts->created_at)),'year'=>date('Y',strtotime($receiptData->receipts->created_at)),'type'=>'1']);
//            }
//            $getSitioPadre = getSitioPadre($receiptData->tree_id,$receiptData->debtor,$receiptData->creditor,$receiptData->receipts->created_at);
////                for receiptsType departement
//            $receipts = receipts::findOrFail($receipts->id);
//            $tree_id = receiptsType::where('invoice_id',$receipts->invoice_id)->whereIn('operation_id',$operations)->pluck('tree_id');
//            $receiptsTypetree = receiptsType::where('invoice_id',$receipts->invoice_id)->whereIn('tree_id',$tree_id)->get();
//            foreach ($receiptsTypetree as $type){
//                $pjitmmsflexists2 = pjitmmsfl::where('tree_id',$type->tree_id)->where('month',date('n',strtotime($type->receipts->created_at)))->where('year',date('Y',strtotime($type->receipts->created_at)))->exists();
//                if($pjitmmsflexists2){
//                    pjitmmsfl::where('tree_id',$type->tree_id)->where('month',date('n',strtotime($type->receipts->created_at)))->where('year',date('Y',strtotime($type->receipts->created_at)))->update(['debtor' => DB::raw('debtor + '.$type->debtor),'creditor' => DB::raw('creditor + '.$type->creditor)]);
//                }else{
//                    pjitmmsfl::create(['debtor'=>$type->debtor,'creditor'=>$type->creditor,'tree_id'=>$type->tree_id,'month'=>date('n',strtotime($type->receipts->created_at)),'year'=>date('Y',strtotime($type->receipts->created_at)),'type'=>'1']);
//                }
////                $bdepupdate = DB::table('departments')->where('id',$type->tree_id)->update(['debtor' => DB::raw('debtor + '.$type->debtor),'creditor' => DB::raw('creditor + '.$type->creditor)]);
//                $bgetSitioPadre = getSitioPadre($type->tree_id,$type->debtor,$type->creditor,$type->receipts->created_at);
//            }
////                for receiptsType glcc
//            $cc_id = receiptsType::where('invoice_id',$receipts->invoice_id)->where('cc_id','!=',null)->whereIn('operation_id',$operations)->pluck('cc_id');
//            $receiptsTypecc = receiptsType::where('invoice_id', $receipts->invoice_id)->whereIn('cc_id',$cc_id)->get();
//            foreach ($receiptsTypecc as $type){
//                $ccupdate = DB::table('glccs')->where('id',$type->cc_id)->update(['debtor' => DB::raw('debtor + '.$type->debtor),'creditor' => DB::raw('creditor + '.$type->creditor)]);
//                $pjitmmsflexistscc = pjitmmsfl::where('cc_id',$type->cc_id)->where('month',date('n',strtotime($type->receipts->created_at)))->where('year',date('Y',strtotime($type->receipts->created_at)))->exists();
//                if($pjitmmsflexistscc){
//                    pjitmmsfl::where('cc_id',$type->cc_id)->where('month',date('n',strtotime($type->receipts->created_at)))->where('year',date('Y',strtotime($type->receipts->created_at)))->update(['debtor' => DB::raw('debtor + '.$type->debtor),'creditor' => DB::raw('creditor + '.$type->creditor)]);
//                }else{
//                    pjitmmsfl::create(['debtor'=>$type->debtor,'creditor'=>$type->creditor,'cc_id'=>$type->cc_id,'month'=>date('n',strtotime($type->receipts->created_at)),'year'=>date('Y',strtotime($type->receipts->created_at)),'type'=>'2']);
//                }
//                $getSitiocc = getSitiocc($type->cc_id,$type->debtor,$type->creditor,$type->receipts->created_at);
//            }
            DB::commit();
        }catch (Exception $e){
            return $e;
            DB::rollBack();
        }
//        $minusgetSitioPadre;
//        $minusgetSitioPadretype;
//        $minuscc;
//        $minusgetSitiocc;
        $delete;
        $receiptsData;
        $receiptstypes;
//        $getSitioPadre;
//        $bgetSitioPadre;
//        $ccupdate;
//        $getSitiocc;

        return route('receipts.print',$receipts->id);
    }
}
