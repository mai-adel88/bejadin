<?php

namespace App\Http\Controllers\Admin\activities;

use App\activities;
use App\DataTables\ActivitiesDataTable;
use App\subscription;
use App\Models\Admin\AstNutrbusn;
use App\Models\Admin\ActivityTypes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;

class ActivitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ActivitiesDataTable $activities)
    {
        $id = ActivityTypes::where('Name_Ar','=',null)->orWhere('Name_Ar','=','')->pluck('ID_No');
        DB::table('activitytypes')->where('Name_En',null)->where('Name_Ar',null)->orWhere('Name_Ar','=','')->delete();

        return $activities->render('admin.activities.index',['title'=>trans('admin.types_of_activities')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $last = ActivityTypes::orderBy('Actvty_No', 'desc')->latest()->first(); //latest record

        if(!empty($last) || $last || $last < 0){
            $last = $last->Actvty_No+1;
        }else{
            $last =  1;
        }

        return view('admin.activities.create',['title'=> trans('admin.add_type_of_activitie')], compact('last'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validate($request,[
            'Actvty_No'  =>'sometimes',
            'Name_Ar'=>'required',
            'Name_En'=>'required',
        ]);
        $act = ActivityTypes::create($data);
        return redirect(aurl('activities'))->with(session()->flash('message',trans('admin.success_add')));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\activities  $activities
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $act= ActivityTypes::findOrFail($id);
        return view('admin.activities.show',compact('act'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\activities  $activities
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $act= ActivityTypes::findOrFail($id);
        return view('admin.activities.edit',['title'=> trans('admin.edit_type_of_activitie'),'act'=>$act]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\activities  $activities
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $this->validate($request,[
            'Actvty_No'  =>'sometimes',
            'Name_Ar'=>'required',
            'Name_En'=>'required',
        ]);

        $act  = ActivityTypes::where('ID_No',$id)->first();
        $act->update($data);
        return redirect(aurl('activities'))->with(session()->flash('message',trans('admin.success_update')));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\activities  $activities
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $activitie  = ActivityTypes::where('ID_No',$id);
        //subscription::where('AstNutrbusn_id',$id)->update(['AstNutrbusn_id'=>null]);
        $activitie->delete();
        return redirect(aurl('activities'));
    }
}
