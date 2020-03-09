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
use App\limitations;
use App\limitationsData;
use App\limitationsType;
use App\operation;
use App\pjitmmsfl;
use App\Project;
use App\subscription;
use App\supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Matrix\Exception;

class openingentryController extends Controller
{
//    public function __construct(){
//        $this->middleware('auth:api');
//    }
    public function index(){
        $limitationReceipts = limitationReceipts::where('type',2)->get();
        $branches = Branches::all();
        $operations = operation::whereIn('receipt',[1,2])->get();
        $cc = glcc::where('type','1')->get();
        return response()->json([$limitationReceipts,$branches,$operations,$cc]);
    }
    public function store(Request $request){
        DB::beginTransaction();
        try{

        $requests = $request->all();
//        dd($requests);
        $sumdebtor = collect($requests)->sum('debtor');
        $sumcreditor = collect($requests)->sum('creditor');
        $invoice_id = '';
        $cc = '';
        $limitation_id = '';
        $operations = [];
        foreach ($requests as $key => $r){
            $invoice_id = $r['invoice'];
            if($key == 0){
                $limitationId = limitations::orderBy('id', 'desc')->whereIn('limitationsType_id',['12'])->where('limitationsType_id',$r['limitations'])->first();
                $limitation_id = limitations::findOrfail(limitations::create([
                    'limitationId' => $limitationId ? $limitationId->limitationId + 1 : 1,
                    'branche_id' => $r['branches'],
                    'date' => date('Y-m-d',strtotime($r['date'])),
                    'created_at' => $r['created_at'],
                    'limitationsType_id' => $r['limitations'],
                    'invoice_id' => $r['invoice'],
                    'status' => 2,
                ])->id)->id;
                $limitationsData = limitationsData::create([
                    'invoice_id' => $r['invoice'],
                    'limitations_id' => $limitation_id,
                    'status' => 2,
                    'debtor' => $sumdebtor,
                    'creditor' => $sumcreditor,
                ]);
            }
            $operation = operation::where('id',$r['operations'])->first();
            if ($operation->id == 4){
                $tree = $r['tree'];
            }elseif ($operation->id == 2){
                $tree = Company::where('id',$r['tree'])->first()['tree_id'];
            }elseif ($operation->id == 5){
                $tree = employee::where('id',$r['tree'])->first()['tree_id'];
            }
            $limitationsType = limitationsType::create([
                'name_ar' => $r['name'],
                'name_en' => $r['name'],
                'tree_id' => $tree,
                'operation_id' => $r['operations'],
                'limitations_id' => $limitation_id,
                'relation_id' => $r['tree'],
                'cc_id' => $r['cc'],
                'debtor' => $r['debtor'] != null ? $r['debtor'] : 0,
                'creditor' => $r['creditor'] != null ? $r['creditor'] : 0,
                'month_for' => $r['month_for'],
                'note' => $r['note'],
                'note_en' => $r['note_en'],
                'receipt_number' => $limitationId ? $limitationId->limitationId + 1 : 1,
                'invoice_id' => $r['invoice'],
                'status' => 2,
            ]);
            $limitationsData->limitationsType()->attach($limitationsType);
            $operations[] = $r['operations'];
        }
//        end create in limitations

//                for limitation departement
            $tree_id = limitationsType::where('invoice_id',$invoice_id)->whereIn('operation_id',$operations)->pluck('tree_id');
            $limitationsTypetree = limitationsType::where('invoice_id',$invoice_id)->whereIn('tree_id',$tree_id)->get();
//            if (count($limitationsTypetree) > 1){
//                foreach ($limitationsTypetree as $type){
////                    $updatedeb = DB::table('departments')->where('id',$type->tree_id)->update(['debtor' => DB::raw('debtor + '.$type->debtor),'creditor' => DB::raw('creditor + '.$type->creditor)]);
//                    $pjitmmsflexists = pjitmmsfl::where('tree_id',$type->tree_id)->where('month',date('n',strtotime($type->limitations->created_at)))->where('year',date('Y',strtotime($type->limitations->created_at)))->where('month',date('n',strtotime($type->limitations->created_at)))->where('year',date('Y',strtotime($type->limitations->created_at)))->exists();
//                    if($pjitmmsflexists){
//                        pjitmmsfl::where('tree_id',$type->tree_id)->update(['debtor' => DB::raw('debtor + '.$type->debtor),'creditor' => DB::raw('creditor + '.$type->creditor)]);
//                    }else{
//                        pjitmmsfl::create(['debtor'=>$type->debtor,'creditor'=>$type->creditor,'tree_id'=>$type->tree_id,'month'=>date('m',strtotime($type->limitations->created_at)),'year'=>date('Y',strtotime($type->limitations->created_at)),'type'=>'1']);
//                    }
//                    $getSitioPadre = getSitioPadre($type->tree_id,$type->debtor,$type->creditor,$type->limitations->created_at);
//                }
//            }elseif (count($limitationsTypetree) == 1){
//                $limitationType = limitationsType::where('invoice_id',$invoice_id)->first();
////                $bupdatedeb = DB::table('departments')->where('id',$limitationType->tree_id)->update(['debtor' => DB::raw('debtor + '.$limitationType->debtor),'creditor' => DB::raw('creditor + '.$limitationType->creditor)]);
//                $pjitmmsflexists = pjitmmsfl::where('tree_id',$limitationType->tree_id)->where('month',date('n',strtotime($limitationType->limitations->created_at)))->where('year',date('Y',strtotime($limitationType->limitations->created_at)))->exists();
//                if($pjitmmsflexists){
//                    pjitmmsfl::where('tree_id',$limitationType->tree_id)->where('month',date('n',strtotime($limitationType->created_at)))->where('year',date('Y',strtotime($limitationType->created_at)))->update(['debtor' => DB::raw('debtor + '.$limitationType->debtor),'creditor' => DB::raw('creditor + '.$limitationType->creditor)]);
//                }else{
//                    pjitmmsfl::create(['debtor'=>$limitationType->debtor,'creditor'=>$limitationType->creditor,'tree_id'=>$limitationType->tree_id,'month'=>date('n',strtotime($limitationType->limitations->created_at)),'year'=>date('Y',strtotime($limitationType->limitations->created_at)),'type'=>'1']);
//                }
//                $bgetSitioPadre = getSitioPadre($limitationType->tree_id,$limitationType->debtor,$limitationType->creditor,$limitationType->limitations->created_at);
//            }
////                for limitation glcc
//            $cc_id = limitationsType::where('invoice_id',$invoice_id)->whereIn('operation_id',$operations)->pluck('cc_id');
//            $limitationsTypecc = limitationsType::where('invoice_id',$invoice_id)->whereIn('cc_id',$cc_id)->get();
//            foreach ($limitationsTypecc as $type){
//                $updatecc = DB::table('glccs')->where('id',$type->cc_id)->update(['debtor' => DB::raw('debtor + '.$type->debtor),'creditor' => DB::raw('creditor + '.$type->creditor)]);
//                $pjitmmsflexistscc = pjitmmsfl::where('cc_id',$type->cc_id)->where('month',date('n',strtotime($type->limitations->created_at)))->where('year',date('Y',strtotime($type->limitations->created_at)))->exists();
//                if($pjitmmsflexistscc){
//                    pjitmmsfl::where('cc_id',$type->cc_id)->where('month',date('n',strtotime($type->limitations->created_at)))->where('year',date('Y',strtotime($type->limitations->created_at)))->update(['debtor' => DB::raw('debtor + '.$type->debtor),'creditor' => DB::raw('creditor + '.$type->creditor)]);
//                }else{
//                    pjitmmsfl::create(['debtor'=>$type->debtor,'creditor'=>$type->creditor,'cc_id'=>$type->cc_id,'month'=>date('n',strtotime($type->limitations->created_at)),'year'=>date('Y',strtotime($type->limitations->created_at)),'type'=>'2']);
//                }
//                $getSitiocc = getSitiocc($type->cc_id,$type->debtor,$type->creditor,$type->limitations->created_at);
//            }
        DB::commit();
        }
        catch (Exception $e){
            return $e;
            DB::rollBack();
        }
        $limitation_id;
        $limitationsData;
        $limitationsType;
//        $getSitioPadre;
//        $bgetSitioPadre;
//        $updatecc;
//        $getSitiocc;

        return route('openingentry.print',$limitation_id);

    }
}
