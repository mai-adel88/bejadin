<?php

namespace App\Http\Controllers\Admin\expulsion;

use App\Department;
use App\glcc;
use App\limitations;
use App\limitationsType;
use App\pjitmmsfl;
use App\receipts;
use App\receiptsData;
use App\receiptsType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class expulsionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.expulsion.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if ($request->ajax()){
            if ($request->from && $request->to) {
                $from = $request->from;
                $to = $request->to;
                return view('admin.expulsion.create',compact('from','to'))->render();
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->ajax()){
            if ($request->from && $request->to){
                $from = $request->from;
                $to = $request->to;
                $receipts = DB::table('receipts')->whereDate('created_at','>=', $from)->whereDate('created_at','<=',$to)->get();
                pjitmmsfl::where('type','1')->delete();
//                this for receipts sum all debtor and creditor in pjitmmsfls
                $receipts_type = receiptsType::where('tree_id','!=',null)->whereHas('receipts',function ($query) use ($from,$to){
                    $query->whereDate('created_at','>=', $from)->whereDate('created_at','<=',$to);
                })->get();
                foreach ($receipts_type as $type){
                    $limitation_exists = pjitmmsfl::where('type','1')->where('tree_id',$type['tree_id'])->where('month','=',date('n',strtotime($type->receipts->created_at)))->where('year',date('Y',strtotime($type->receipts->created_at)))->exists();
//                    dd(!$limitation_exists);
                    if ($limitation_exists){
                        pjitmmsfl::where('type','1')->where('tree_id',$type['tree_id'])->where('month','=',date('n',strtotime($type->receipts->created_at)))->where('year','=',date('Y',strtotime($type->receipts->created_at)))->update(['creditor'=> DB::raw('creditor + '.$type['creditor']),'debtor'=> DB::raw('debtor + '.$type['debtor']),'current_balance' => DB::raw('current_balance + '.($type['creditor'] - $type['debtor']))]);
                    }
                    if (!$limitation_exists){
                        pjitmmsfl::create(['debtor'=> $type['debtor'],'creditor'=> $type['creditor'],'tree_id'=>$type['tree_id'],'month'=>date('n',strtotime($type->receipts->created_at)),'year'=>date('Y',strtotime($type->receipts->created_at)),'type'=>'1']);
                    }
                    expulsion_transaction($type->tree_id,$type->debtor,$type->creditor,$type->receipts->created_at,$type->receipts->created_at);
                }
//                this for limitations sum all debtor and creditor in pjitmmsfls
                $limitations_type = limitationsType::where('tree_id','!=',null)->whereHas('limitations',function ($query) use ($from,$to){
                    $query->whereDate('created_at','>=', $from)->whereDate('created_at','<=',$to);
                })->get();
                foreach ($limitations_type as $type){
                    $limitation_exists = pjitmmsfl::where('type','1')->where('tree_id',$type['tree_id'])->where('month','=',date('n',strtotime($type->limitations->created_at)))->where('year',date('Y',strtotime($type->limitations->created_at)))->exists();
//                    dd(!$limitation_exists);
                    if ($limitation_exists){
                        pjitmmsfl::where('type','1')->where('tree_id',$type['tree_id'])->where('month','=',date('n',strtotime($type->limitations->created_at)))->where('year','=',date('Y',strtotime($type->limitations->created_at)))->update(['creditor'=> DB::raw('creditor + '.$type['creditor']),'debtor'=> DB::raw('debtor + '.$type['debtor']),'current_balance' => DB::raw('current_balance + '.($type['creditor'] - $type['debtor']))]);
                    }
                    if (!$limitation_exists){
                        pjitmmsfl::create(['debtor'=> $type['debtor'],'creditor'=> $type['creditor'],'tree_id'=>$type['tree_id'],'month'=>date('n',strtotime($type->limitations->created_at)),'year'=>date('Y',strtotime($type->limitations->created_at)),'type'=>'1']);
                    }
                    expulsion_transaction($type->tree_id,$type->debtor,$type->creditor,$type->limitations->created_at,$type->limitations->created_at);
                }

//                sum all move in pjitmmsfls to make pjitmmsfls
                $depatments = Department::where('type','1')->pluck('id')->toArray();
                $pjitmmsfldep = pjitmmsfl::where('type','1')->whereIn('tree_id',$depatments)->where('month','>=',date('n',strtotime($from)))->where('month','<=',date('n',strtotime($to)))->where('year',date('Y',strtotime($from)))->where('year',date('Y',strtotime($to)))->get();

                DB::table('departments')->update(['creditor'=>0,'debtor'=>0,'estimite'=>0]);
                $allpjitmmsfls = pjitmmsfl::where('type','1')->where('tree_id','!=',null)->where('month','>=',date('n',strtotime($from)))->where('month','<=',date('n',strtotime($to)))->where('year',date('Y',strtotime($from)))->where('year',date('Y',strtotime($to)))->get();
                foreach ($allpjitmmsfls as $value){
                    Department::where('type','1')->where('id',$value->tree_id)->update(['creditor'=>DB::raw('creditor + '.$value->creditor),'debtor'=>DB::raw('debtor + '.$value->debtor),'estimite'=>DB::raw('estimite + '.($value->creditor - $value->debtor))]);
                }
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
