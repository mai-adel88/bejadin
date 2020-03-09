<?php

namespace App\Http\Controllers\Admin\Delegates;

use App\activity_type;
use App\Branches;
use App\city;
use App\country;
use App\DataTables\DelegateDataTable;
use App\Department;
use App\employee;
use App\Models\Admin\MTsCustomer;
use App\Models\Admin\MainBranch;
use App\Models\Admin\AstSalesman;
use App\Models\Admin\AstMarket;
use App\Enums\TypeType;
use App\glcc;
use App\Http\Controllers\Controller;
use App\parents;
use App\state;
use App\subscription;
use BenSampo\Enum\Rules\EnumKey;
use BenSampo\Enum\Rules\EnumValue;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Up;

class DelegatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DelegateDataTable $delegate)
    {

        return $delegate->render('admin.delegates.index', ['title'=> trans('admin.delegates')]);
    }


    public function create()
    {

        $delegate = AstSalesman::get();
        $last = AstSalesman::orderBy('ID_No', 'DESC')->latest()->first(); //latest record

        //dd($Cstm_No = $brn*1000 . 1);
        if(!empty($last) || $last || $last < 0){
            $last = $last->Slm_No+1;
        }else{
            $last =  1;
        }

        return view('admin.delegates.create', compact('delegate', 'last'));
    }


    public function store(Request $request)
    {

        //dd($request->all());
        $data = $this->validate($request, [
            'Slm_No'    => 'sometimes',
            'Cmp_No'    => 'sometimes',
            'Brn_No'    => 'sometimes',
            'Mark_No'   => 'sometimes',
            'StoreNo'   => 'sometimes',
            'Slm_NmEn'  => 'required',
            'Slm_NmAr'  => 'required',
            'Target'    => 'sometimes',
            'Slm_Tel'   => 'sometimes',
            'Slm_Active'=> 'sometimes',
            'Opn_Date'  => 'sometimes',
            'Opn_Time'  => 'sometimes',
            'User_ID'   => 'sometimes',
            'Updt_Date' => 'sometimes',

        ],[
            'Slm_No'  => trans('admin.Slm_No'),
            'Cmp_No'  => trans('admin.Cmp_No'),
            'Brn_No'  => trans('admin.Brn_No'),
            'Mark_No' => trans('admin.Mark_No'),
            'StoreNo' => trans('admin.StoreNo'),
            'Slm_NmEn'=> trans('admin.Slm_NmEn'),
            'Slm_NmAr'=> trans('admin.Slm_NmAr'),
            'Target'  => trans('admin.Target'),
            'Slm_Tel' => trans('admin.Slm_Tel'),
            'Slm_Active'=> trans('admin.Slm_Active'),
            'Opn_Date'=> trans('admin.Opn_Date'),
            'Opn_Time'=> trans('admin.Opn_Time'),
            'User_ID' => trans('admin.User_ID'),
            'Updt_Date'=> trans('admin.Updt_Date'),

        ]);
        AstSalesman::create($data);

        return redirect(aurl('delegates'))->with(session()->flash('message',trans('admin.success_add')));


    }
    public function show($ID_No)
    {
        $delegate= AstSalesman::findOrFail($ID_No);
        return view('admin.delegates.show',compact('delegate'));
    }


    public function edit($id)
    {


        $delegate = AstSalesman::where('ID_No',$id)->first();
        $markets  = AstMarket::get();
        return view('admin.delegates.edit',compact('delegate', 'markets'));
    }

    public function update(Request $request, $ID_No)
    {

//        dd($request->all());

        $data = $this->validate($request, [
            'Slm_No'    => 'sometimes',
            'Brn_No'    => 'sometimes',
            'Cmp_No'    => 'sometimes',
            'Mark_No'   => 'sometimes',
            'StoreNo'   => 'sometimes',
            'Slm_NmEn'  => 'required',
            'Slm_NmAr'  => 'required',
            'Target'    => 'sometimes',
            'Slm_Tel'   => 'sometimes',
            'Slm_Active'=> 'sometimes',
            'Opn_Date'  => 'sometimes',
            'Opn_Time'  => 'sometimes',
            'User_ID'   => 'sometimes',
            'Updt_Date' => 'sometimes',

        ],[
            'Slm_No'  => trans('admin.Slm_No'),
            'Brn_No'  => trans('admin.Brn_No'),
            'Cmp_No'  => trans('admin.Cmp_No'),
            'Mark_No'  => trans('admin.Mark_No'),
            'StoreNo' => trans('admin.StoreNo'),
            'Slm_NmEn'=> trans('admin.Slm_NmEn'),
            'Slm_NmAr'=> trans('admin.Slm_NmAr'),
            'Target'  => trans('admin.Target'),
            'Slm_Tel' => trans('admin.Slm_Tel'),
            'Slm_Active'=> trans('admin.Slm_Active'),
            'Opn_Date'=> trans('admin.Opn_Date'),
            'Opn_Time'=> trans('admin.Opn_Time'),
            'User_ID' => trans('admin.User_ID'),
            'Updt_Date'=> trans('admin.Updt_Date'),

        ]);
        $input = $request->all();
        $delegate = AstSalesman::find($ID_No);
        $delegate->update($input);

        return redirect(aurl('delegates'))->with(session()->flash('message',trans('admin.success_update')));

    }


    public function destroy($id)
    {
        $delegate = AstSalesman::where('ID_No',$id)->first();
        $delegate->delete();
        return redirect(aurl('delegates'))->with(session()->flash('message',trans('admin.success_deleted')));
    }

//    public function createDelegateNo($Slm_No)
//    {
//        $Slm_No = 0;
//        $last = AstSalesman::orderBy('ID_No', 'DESC')->first()->Slm_No; //latest record
//        //dd($last);
//        $Slm_No = $last->Slm_No;
//        //dd($Cstm_No = $brn*1000 . 1);
//        if($Slm_No){
//            $Slm_No = $Slm_No+1;
//        }else{
//            $Slm_No =  1;
//        }
//    }
//    public function createDelegateNo(Request $request){
//        if($request->ajax()){
//            $last_no = 0;
//            if(count(AstSalesman::all()) == 0){
////                return 'first';
//                //no records
//                $last_no = $request->Slm_No;
//            }else{
//                $last_Slm = AstSalesman::where('Brn_No',  $request->Brn_No)->orderBy('Slm_No', 'desc')->first();
//                if($last_cstm == null){
////                    return 'else first';
//                    $last_no = $request->Brn_No;
//                }
//                else{
////                    return 'else second';
//                    $last_no = $last_cstm->Slm_No;
//                }
//            }
//            return $last_no + 1;
//        }
//    }

    public function getBranches(Request $request)
    {

        $branches = MainBranch::where('Cmp_No', $request->Cmp_No)->get();


        return view('admin.delegates.get_branches', compact('branches'));
    }




}
