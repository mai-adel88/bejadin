<?php

namespace App\Http\Controllers\Admin\expulsion;

use App\glcc;
use App\limitationsType;
use App\pjitmmsfl;
use App\receiptsType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class expulsionccController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.expulsioncc.index');
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
                return view('admin.expulsioncc.create',compact('from','to'))->render();
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
                pjitmmsfl::where('type','2')->delete();
//                this for receipts sum all debtor and creditor in pjitmmsfls
                $receipts_type = receiptsType::where('cc_id','!=',null)->whereHas('receipts',function ($query) use ($from,$to){
                    $query->whereDate('created_at','>=', $from)->whereDate('created_at','<=',$to);
                })->get();
                foreach ($receipts_type as $type){
                    $limitation_exists = pjitmmsfl::where('type','2')->where('cc_id',$type['cc_id'])->where('month','=',date('n',strtotime($type->receipts->created_at)))->where('year',date('Y',strtotime($type->receipts->created_at)))->exists();
//                    dd(!$limitation_exists);
                    if ($limitation_exists){
                        pjitmmsfl::where('type','2')->where('cc_id',$type['cc_id'])->where('month','=',date('n',strtotime($type->receipts->created_at)))->where('year','=',date('Y',strtotime($type->receipts->created_at)))->update(['creditor'=> DB::raw('creditor + '.$type['creditor']),'debtor'=> DB::raw('debtor + '.$type['debtor']),'current_balance' => DB::raw('current_balance + '.$type['creditor'] - $type['debtor'])]);
                    }
                    if (!$limitation_exists){
                        pjitmmsfl::create(['debtor'=> $type['debtor'],'creditor'=> $type['creditor'],'cc_id'=>$type['cc_id'],'month'=>date('n',strtotime($type->receipts->created_at)),'year'=>date('Y',strtotime($type->receipts->created_at)),'type'=>'1']);
                    }
                    expulsion_cc_transaction($type->cc_id,$type->debtor,$type->creditor,$type->receipts->created_at,$type->receipts->created_at);
                }
//                this for limitations sum all debtor and creditor in pjitmmsfls
                $limitations_type = limitationsType::where('cc_id','!=',null)->whereHas('limitations',function ($query) use ($from,$to){
                    $query->whereDate('created_at','>=', $from)->whereDate('created_at','<=',$to);
                })->get();
                foreach ($limitations_type as $type){
                    $limitation_exists = pjitmmsfl::where('type','2')->where('cc_id',$type['cc_id'])->where('month','=',date('n',strtotime($type->limitations->created_at)))->where('year',date('Y',strtotime($type->limitations->created_at)))->exists();
//                    dd(!$limitation_exists);
                    if ($limitation_exists){
                        pjitmmsfl::where('type','2')->where('cc_id',$type['cc_id'])->where('month','=',date('n',strtotime($type->limitations->created_at)))->where('year','=',date('Y',strtotime($type->limitations->created_at)))->update(['creditor'=> DB::raw('creditor + '.$type['creditor']),'debtor'=> DB::raw('debtor + '.$type['debtor']),'current_balance' => DB::raw('current_balance + '.$type['creditor'] - $type['debtor'])]);
                    }
                    if (!$limitation_exists){
                        pjitmmsfl::create(['debtor'=> $type['debtor'],'creditor'=> $type['creditor'],'cc_id'=>$type['cc_id'],'month'=>date('n',strtotime($type->limitations->created_at)),'year'=>date('Y',strtotime($type->limitations->created_at)),'type'=>'1']);
                    }
                    expulsion_cc_transaction($type->cc_id,$type->debtor,$type->creditor,$type->limitations->created_at,$type->limitations->created_at);
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
        //
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
