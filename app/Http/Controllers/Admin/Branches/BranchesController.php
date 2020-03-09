<?php

namespace App\Http\Controllers\Admin\Branches;

// use App\Branches;
use App\Models\Admin\MainBranch;
use App\Models\Admin\MainCompany;
use App\DataTables\BranchesDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BranchesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(BranchesDataTable $branches)
    {
        $id = MainBranch::where('Brn_NmAr','=',null)->orWhere('Brn_NmAr','=','')->pluck('ID_No');
        DB::table('mainbranch')->where('Brn_NmEn',null)->where('Brn_NmAr',null)->orWhere('Brn_NmAr','=','')->delete();

        return $branches->render('admin.branches.index',['title'=>trans('admin.Branches')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //create new Brn_No
        $Brn_No = 0;
        if(count(MainBranch::all()) == 0){
            $Brn_No = 1;
        }
        else{
            $last_brn = MainBranch::orderBy('Brn_No', 'desc')->first();
            if($last_brn == null){
                $Brn_No = 1;
            }
            else{
                $Brn_No = $last_brn->Brn_No + 1;
            }
        }

        $branch = MainBranch::findOrFail(MainBranch::create([
            'Brn_NmAr' => '',
        ])->ID_No);

        if (!empty($branch)){
            $branch->Brn_No = $Brn_No;
            $branch->save();
            return redirect(aurl('branches/' . $branch->ID_No . '/edit'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,MainBranch $branches)
    {
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
        $branch = MainBranch::findOrFail($id);
        if(session('Cmp_No') == -1){
            $branches = MainBranch::get(['Brn_No', 'Brn_Nm'.ucfirst(session('lang'))]);
            $company = MainCompany::all();
        }
        else{
            $branches = MainBranch::where('ID_No', '!=', $id)
                                ->where('Cmp_No', session('Cmp_No'))
                                ->get(['Brn_No', 'Brn_Nm'.ucfirst(session('lang'))]);
            $company = MainCompany::where('Cmp_No', session('Cmp_No'))->get(['Cmp_No', 'Cmp_Nm'.ucfirst(session('lang'))]);
        }
        return view('admin.branches.create',['title'=> trans('admin.add_new_branches')])->with('branch', $branch)
                                                                                        ->with('branches', $branches)
                                                                                        ->with('company', $company);
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
        // return $request;
        $data = $this->validate($request,[
            'Cmp_No' => 'required',
            'Br_Ty' => 'required',
            'Brn_NmAr' => 'required',
            'Brn_NmEn' => 'required',
            'Brn_Adrs' => 'required',
            'Brn_Tel' => 'required',
            'Brn_Email' => 'required',
        ],[],[
            'Cmp_No' => trans('admin.cmp_no'),
            'Br_Ty' => trans('admin.type'),
            'Brn_NmAr' => trans('admin.arabic_name'),
            'Brn_NmEn' => trans('admin.english_name'),
            'Brn_Adrs' => trans('admin.addriss'),
            'Brn_Tel' => trans('admin.brn_tel'),
            'Brn_Email' => trans('admin.email'),
        ]);

        $branch = MainBranch::findOrFail($id);
        if($request->Main_Brn === null){
            $branch->update([
                'Main_Brn' => $branch->Brn_No,
            ]);
        }
        else{
            $branch->update([
                'Main_Brn' => $request->Main_Brn,
            ]);
        }
        $branch->Br_Ty = $request->Br_Ty;
        $branch->Brn_NmAr = $request->Brn_NmAr;
        $branch->Brn_NmEn = $request->Brn_NmEn;
        $branch->Brn_Tel = $request->Brn_Tel;
        $branch->Brn_Fax = $request->Brn_Fax;
        $branch->Brn_Adrs = $request->Brn_Adrs;
        $branch->Brn_Email = $request->Brn_Email;
        $branch->Cmp_No = $request->Cmp_No;
        $branch->Dlv_Stor = $request->Dlv_Stor;
        if($request->Rcpt_Flg){$branch->Rcpt_Flg = 1;}else{$branch->Rcpt_Flg = 0;}
        if($request->Pymt_Flg){$branch->Pymt_Flg = 1;}else{$branch->Pymt_Flg = 0;}
        if($request->Jv_Flg){$branch->Jv_Flg = 1;}else{$branch->Jv_Flg = 0;}
        if($request->Sal_Flg){$branch->Sal_Flg = 1;}else{$branch->Sal_Flg = 0;}
        if($request->Pur_Flg){$branch->Pur_Flg = 1;}else{$branch->Pur_Flg = 0;}
        if($request->Inv_Flg){$branch->Inv_Flg = 1;}else{$branch->Inv_Flg = 0;}
        if($request->DlyPst_CshSal){$branch->DlyPst_CshSal = 1;}else{$branch->DlyPst_CshSal = 0;}
        if($request->DlyPst_CshPur){$branch->DlyPst_CshPur = 1;}else{$branch->DlyPst_CshPur = 0;}
        $branch->Acc_TaxExtraDb = $request->Acc_TaxExtraDb;
        $branch->Acc_TaxExtraCR = $request->Acc_TaxExtraCR;
        $branch->Acc_CrdSal = $request->Acc_CrdSal;
        $branch->Acc_CshSal = $request->Acc_CshSal;
        $branch->Acc_RetSal = $request->Acc_RetSal;
        $branch->Acc_DiscSal = $request->Acc_DiscSal;
        $branch->Acc_CrdPur = $request->Acc_CrdPur;
        $branch->Acc_CshPur = $request->Acc_CshPur;
        $branch->Acc_RetPur = $request->Acc_RetPur;
        $branch->Acc_DiscPur = $request->Acc_DiscPur;
        $branch->Acc_Cashier = $request->Acc_Cashier;
        $branch->Acc_Customer = $request->Acc_Customer;
        $branch->Acc_Suplier = $request->Acc_Suplier;
        $branch->Inv_Undprs = $request->Inv_Undprs;
        $branch->Inv_RM = $request->Inv_RM;
        $branch->Inv_Prdctn = $request->Inv_Prdctn;
        $branch->Cost_SalInvt = $request->Cost_SalInvt;
        $branch->Cost_INVt = $request->Cost_INVt;
        $branch->Acc_InvAdj = $request->Acc_InvAdj;
        $branch->save();

        return redirect(aurl('branches'))->with(session()->flash('message',trans('admin.success_update')));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $branch = MainBranch::findOrFail($id);
        $branch->delete();
        return redirect(aurl('branches'));
    }

    public function getBranchesAndStores(Request $request){
        if($request->ajax()){
            $branches = MainBranch::where('Cmp_No', $request->Cmp_No)->get(['Brn_No', 'Brn_Nm'.ucfirst(session('lang'))]);
            return view('admin.branches.dlv_stor', compact('branches'));
        }
    }
}
