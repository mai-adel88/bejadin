<?php

namespace App\Http\Controllers\Admin\Projcontractmfs;

use App\Branches;
use App\country;
use App\Models\Admin\Astsupctg;
use App\Models\Admin\MainBranch;
use App\Models\Admin\MainCompany;
use App\Models\Admin\MTsCustomer;
use App\Admin\Projcontractmfs;
use App\DataTables\ProjcontractmfsDataTable;
use App\Http\Controllers\Controller;
use App\Models\Admin\MtsSuplir;
use App\Models\Admin\Projectmfs;
use App\projectcontract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class ProjcontractmfsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ProjcontractmfsDataTable $projcontractmfs)
    {
        return $projcontractmfs->render('admin.Projcontractmfs.index',['title'=>trans('admin.projects_contracts')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = country::pluck('country_name_'.session('lang'),'id');
        $astsupctg = Astsupctg::pluck('Supctg_Nm'.session('lang'),'ID_No');
        $branches = MainBranch::pluck('Brn_Nm'.session('lang'),'ID_No');
        $subscription = MTsCustomer::all()->pluck('Cstm_Nm'.ucfirst(session('lang')), 'ID_No');

        $company = MainCompany::pluck('Cmp_Nm'.ucfirst(session('lang')),'ID_No');
        $Projects = Projectmfs::all()->pluck('Prj_Nm'.ucfirst(session('lang')), 'ID_No');

        return view('admin.Projcontractmfs.create',['title'=> trans('admin.add_project_contract'),'astsupctg' => $astsupctg,'company' => $company,'countries' => $countries,'branches' => $branches,'subscription' => $subscription,'Projects' => $Projects]);

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
            'Cntrct_No' => 'required',
            'Cmp_No' => 'required',
            'Rvisd_No' => 'sometimes',
            'Cntrct_Actv' => 'sometimes',
            'Tr_Dt' => 'sometimes',
            'Tr_DtAr' => 'sometimes',
            'Prj_No' => 'sometimes',
            'Prj_Year' => 'sometimes',

            'Prj_Stus' => 'sometimes',
            'Cstm_No' => 'sometimes',
            'Cnt_Refno' => 'sometimes',
            'Cnt_Dt' => 'sometimes',
            'CntStrt_Dt' => 'sometimes',

            'CntCompl_Dt' => 'sometimes',
            'CntCompL_Priod' => 'sometimes',
            'Inst_Dt' => 'sometimes',
            'Comisn_Dt' => 'sometimes',


            'Wrntstrt_dt' => 'sometimes',
            'Wrntend_Dt' => 'sometimes',
            'Acc_DB' => 'sometimes',
            'Acc_CR' => 'sometimes',


            'Comitd_Cost' => 'sometimes',
            'Actul_Cost' => 'sometimes',
            'Cnt_Vl' => 'sometimes',
            'Cnt_Bdgt' => 'sometimes',

            'Cntrb_VL' => 'sometimes',
            'Cntrb_Prct' => 'sometimes',
            'Gnrlovhd_VaL' => 'sometimes',

            'Gnrlovhd_Prct' => 'sometimes',
            'Dprtmovhd_Vl' => 'sometimes',
            'Dprtmovhd_Prct' => 'sometimes',



            'Wrnt_Prct' => 'sometimes',
            'Fince_Prct' => 'sometimes',




            'Subtot_VaL' => 'sometimes',
            'Subtot_Prct' => 'sometimes',
            'Netcntrib_VaL' => 'sometimes',
            'Netcntrib_Prct' => 'sometimes',

            'Tot_Rcpt' => 'sometimes',
            'Balance' => 'sometimes',
            'Bnkgrnt_No' => 'sometimes',
            'Bnkgrnt_IsudByAr' => 'sometimes',

            'Bnkgrnt_IsudByEn' => 'sometimes',
            'Bnkgrnt_Amount' => 'sometimes',
            'Insurnc_Comprehensive' => 'sometimes',
            'Insurnc_Contractors' => 'sometimes',

            'DwnPym' => 'sometimes',  //////////////
            'Dposit' => 'sometimes',
            'AdtionalWk' => 'sometimes',
            'WkDedction' => 'sometimes',

            'SitDedction' => 'sometimes',
            'NofEmp' => 'sometimes',
            'Emp_Hur' => 'sometimes',
            'NofMonths' => 'sometimes',
            'Mnthly_Pyment' => 'sometimes',
            'Cnt_DscAr' => 'sometimes',
            'Cnt_DscEn' => 'sometimes',
            'Brn_No' => 'sometimes',
        ],[],[


        ]);

        $request->merge(['User_ID' => Auth::user()->id]);
        $request->merge(['Opn_Date' => Carbon::now()]);
        \App\Models\Admin\Projcontractmfs::create($request->all());


        return redirect(aurl('project_contract'))->with(session()->flash('message','Contract\'s Project is added successfully'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Projcontractmfs  $projcontractmfs
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request ,$id)
    {
        $countries = country::pluck('country_name_'.session('lang'),'id');
        $astsupctg = Astsupctg::pluck('Supctg_Nm'.session('lang'),'ID_No');
        $branches = MainBranch::pluck('Brn_Nm'.session('lang'),'ID_No');
        $subscription = MTsCustomer::all()->pluck('name_'.session('lang'), 'ID_No');

        $company = MainCompany::pluck('Cmp_Nm'.ucfirst(session('lang')),'ID_No');
        $Projects = projectcontract::all()->pluck('name_'.session('lang'), 'id');

        $Projcontractmfs = \App\Models\Admin\Projcontractmfs::where('ID_No',$id)->first();
        return view('admin.Projcontractmfs.show',['title'=> trans('admin.contract_projects')  ,'Projcontractmfs'=>$Projcontractmfs,'astsupctg' => $astsupctg,'company' => $company,'countries' => $countries,'branches' => $branches,'subscription' => $subscription,'Projects' => $Projects]);

    }

    public function getComp(Request $request)
    {
        $getComp = \App\Models\Admin\Projcontractmfs::where('Cmp_No', $request->Cmp_No)->orderByDesc('ID_No')->first();
        if ($getComp == null || $getComp->Cntrct_No < 1){
            return 1 ;
        }else{
            return $getComp->Cntrct_No + 1 ;
        }

    }


    public function getproj( Request $request){
        $projects = \App\Models\Admin\Projectmfs::where('Cmp_No', $request->Cmp_No)->get();
        return view('admin.Projcontractmfs.getProject',compact('projects'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Projcontractmfs  $projcontractmfs
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request ,$id)
    {
        $pro = \App\Models\Admin\Projcontractmfs::where('ID_No',$id)->first();
        $countries = country::pluck('country_name_'.session('lang'),'id');
        $astsupctg = Astsupctg::pluck('Supctg_Nm'.session('lang'),'ID_No');
        $branches = MainBranch::pluck('Brn_Nm'.session('lang'),'ID_No');
        $subscription = MTsCustomer::all()->pluck('Cstm_Nm'.ucfirst(session('lang')), 'ID_No');

        $company = MainCompany::pluck('Cmp_Nm'.ucfirst(session('lang')),'ID_No');
        $Projects = projectcontract::all()->pluck('name_'.session('lang'), 'id');

        return view('admin.Projcontractmfs.edit',['title'=> trans('admin.edit_project_contract'),'pro' => $pro,'astsupctg' => $astsupctg,'company' => $company,'countries' => $countries,'branches' => $branches,'subscription' => $subscription,'Projects' => $Projects]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Projcontractmfs  $projcontractmfs
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request ,$id)
    {
        $data = $this->validate($request,[
            'Cntrct_No' => 'required',
            'Cmp_No' => 'required',
            'Rvisd_No' => 'sometimes',
            'Cntrct_Actv' => 'sometimes',
            'Tr_Dt' => 'sometimes',
            'Tr_DtAr' => 'sometimes',
            'Prj_No' => 'sometimes',
            'Prj_Year' => 'sometimes',

            'Prj_Stus' => 'sometimes',
            'Cstm_No' => 'sometimes',
            'Cnt_Refno' => 'sometimes',
            'Cnt_Dt' => 'sometimes',
            'CntStrt_Dt' => 'sometimes',

            'CntCompl_Dt' => 'sometimes',
            'CntCompL_Priod' => 'sometimes',
            'Inst_Dt' => 'sometimes',
            'Comisn_Dt' => 'sometimes',


            'Wrntstrt_dt' => 'sometimes',
            'Wrntend_Dt' => 'sometimes',
            'Acc_DB' => 'sometimes',
            'Acc_CR' => 'sometimes',


            'Comitd_Cost' => 'sometimes',
            'Actul_Cost' => 'sometimes',
            'Cnt_Vl' => 'sometimes',
            'Cnt_Bdgt' => 'sometimes',

            'Cntrb_VL' => 'sometimes',
            'Cntrb_Prct' => 'sometimes',
            'Gnrlovhd_VaL' => 'sometimes',

            'Gnrlovhd_Prct' => 'sometimes',
            'Dprtmovhd_Vl' => 'sometimes',
            'Dprtmovhd_Prct' => 'sometimes',



            'Wrnt_Prct' => 'sometimes',
            'Fince_Prct' => 'sometimes',




            'Subtot_VaL' => 'sometimes',
            'Subtot_Prct' => 'sometimes',
            'Netcntrib_VaL' => 'sometimes',
            'Netcntrib_Prct' => 'sometimes',

            'Tot_Rcpt' => 'sometimes',
            'Balance' => 'sometimes',
            'Bnkgrnt_No' => 'sometimes',
            'Bnkgrnt_IsudByAr' => 'sometimes',

            'Bnkgrnt_IsudByEn' => 'sometimes',
            'Bnkgrnt_Amount' => 'sometimes',
            'Insurnc_Comprehensive' => 'sometimes',
            'Insurnc_Contractors' => 'sometimes',

            'DwnPym' => 'sometimes',  //////////////
            'Dposit' => 'sometimes',
            'AdtionalWk' => 'sometimes',
            'WkDedction' => 'sometimes',

            'SitDedction' => 'sometimes',
            'NofEmp' => 'sometimes',
            'Emp_Hur' => 'sometimes',
            'NofMonths' => 'sometimes',
            'Mnthly_Pyment' => 'sometimes',
            'Cnt_DscAr' => 'sometimes',
            'Cnt_DscEn' => 'sometimes',
            'Brn_No' => 'sometimes',
        ],[],[


        ]);

        $request->merge(['User_ID' => Auth::user()->id]);
        $request->merge(['Updt_Date' => Carbon::now()]);
        $Projcontractmfs = \App\Models\Admin\Projcontractmfs::findOrFail($id);
        $Projcontractmfs->update($request->all());

        return redirect(aurl('project_contract'))->with(session()->flash('message','Contract\'s Project is added successfully'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Projcontractmfs  $projcontractmfs
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request ,$id)
    {
        $Projcontractmfs = \App\Models\Admin\Projcontractmfs::where('ID_No',$id);
        $Projcontractmfs->delete();
        return redirect(aurl('project_contract'));
    }


}
