<?php

namespace App\Http\Controllers\Admin\Supervisors;

use App\activity_type;
use App\Branches;
use App\city;
use App\country;
use App\DataTables\SupervisorDataTable;
use App\Department;
use App\employee;
use App\Models\Admin\AstMarket;
use App\Models\Admin\MainBranch;
use App\Enums\TypeType;
use App\glcc;
use App\Http\Controllers\Controller;
use App\Models\Admin\MainCompany;
use App\parents;
use App\state;
use App\subscription;
use BenSampo\Enum\Rules\EnumKey;
use BenSampo\Enum\Rules\EnumValue;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Up;

class SupervisorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SupervisorDataTable $supervisor)
    {
        return $supervisor->render('admin.supervisors.index', ['title'=> trans('admin.supervisor')]);
    }


    public function create()
    {
        $supervisor = AstMarket::get();
        $last = AstMarket::orderBy('ID_No', 'DESC')->latest()->first(); //latest record

        if(!empty($last) || $last || $last < 0){
            $last = $last->Mrkt_No+1;
        }else{
            $last =  1;
        }
        return view('admin.supervisors.create', compact('supervisor', 'last'));
    }


    public function store(Request $request,subscription $subscription)
    {

        //dd($request->all());
        $data = $this->validate($request, [
            'Mrkt_No'   => 'sometimes',
            'Brn_No'    => 'sometimes',
            'Cmp_No'    => 'sometimes',
            'Mrkt_NmEn' => 'required',
            'Mrkt_NmAr' => 'required',

        ],[
            'Mrkt_No'   => trans('admin.Mrkt_No'),
            'Brn_No'    => trans('admin.Brn_No'),
            'Cmp_No'    => trans('admin.Cmp_No'),
            'Mrkt_NmEn' => trans('admin.Cstm_No'),
            'Mrkt_NmAr' => trans('admin.Cstm_Active'),


        ]);

        //$input = $request->all();

        AstMarket::create($data);

        return redirect(aurl('supervisors'))->with(session()->flash('message',trans('admin.success_add')));



    }


    public function show($ID_No)
    {
        $supervisor= AstMarket::findOrFail($ID_No);
//        $companies = MainCompany::pluck('Cmp_Nm'.ucfirst(session('lang')),'ID_No');
        return view('admin.supervisors.show',compact('supervisor'));
    }


    public function edit($id)
    {

        $supervisor = AstMarket::where('ID_No',$id)->first();
        return view('admin.supervisors.edit',compact('supervisor'));
    }

    public function update(Request $request, $id)
    {

        $supervisor = AstMarket::where('ID_No',$id)->first();
        //dd($supervisor);
        $supervisor->update($request->all());


        return redirect(aurl('supervisors'))->with(session()->flash('message',trans('admin.success_update')));

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $supervisor = AstMarket::where('ID_No',$id)->first();
        $supervisor->delete();
        return redirect(aurl('supervisors'))->with(session()->flash('message',trans('admin.success_deleted')));
    }

    public function getBranches(Request $request)
    {
        //dd($request->Cmp_No);
        $branches = MainBranch::where('Cmp_No', $request->Cmp_No)->get();

        return view('admin.supervisors.get_branches', compact('branches'));
    }


}
