<?php

namespace App\Http\Controllers\Admin\Companies;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\MainCompany;
use Up;
use App\DataTables\CompanyDataTable;
use Illuminate\Support\Facades\DB;
use App\Models\Admin\ActivityTypes;
use App\Models\Admin\AstCurncy;

class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CompanyDataTable $company)
    {
        $id = MainCompany::where('Cmp_NmAr','=',null)->orWhere('Cmp_NmAr','=','')->pluck('ID_No');
        DB::table('maincompany')->where('Cmp_NmEn',null)->where('Cmp_NmAr',null)->orWhere('Cmp_NmAr','=','')->delete();

        return $company->render('admin.companies.index',['title'=>trans('admin.company')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //create new Cmp_No
        $Cmp_No = 0;
        if(count(MainCompany::all()) == 0){
            $Cmp_No = 1;
        }
        else{
            $last_cmp = MainCompany::orderBy('Cmp_No', 'desc')->first();
            if($last_cmp == null){
                $Cmp_No = 1;
            }
            else{
                $Cmp_No = $last_cmp->Cmp_No + 1;
            }
        }

        $company = MainCompany::findOrFail(MainCompany::create([
            'Cmp_NmAr' => '',
        ])->ID_No);

        if (!empty($company)){
            $company->Cmp_No = $Cmp_No;
            $company->save();
        }
        return redirect(aurl('companies/' . $company->ID_No . '/edit'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $cmp = MainCompany::where('ID_No', $id)->first();

        $id = ActivityTypes::where('Name_Ar','=',null)->orWhere('Name_Ar','=','')->pluck('ID_No');
        DB::table('activitytypes')->where('Name_En',null)->where('Name_En',null)->orWhere('Name_Ar','=','')->delete();
        $acts = ActivityTypes::get(['Actvty_No', 'Name_'.ucfirst(session('lang'))]);
        $crncy = AstCurncy::get(['Curncy_No', 'Curncy_Nm'.ucfirst(session('lang'))]);

        return view('admin.companies.create',['title'=> trans('admin.company_fixed_data'), 'cmp' => $cmp, 'acts' => $acts, 'crncy' => $crncy]);
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

        //ثوابت الشركه
        $data = $this->validate($request,[
            'Actvty_No' => 'required',
            'Local_Lang' => 'required',
            'Cmp_NmAr' => 'required',
            'Cmp_NmEn' => 'required',
            'Cmp_AddAr' => 'required',
            'Cmp_Tel' => 'required',

        ],[],[
            'Actvty_No' => trans('admin.activity_type'),
            'Local_Lang' => trans('admin.main_lang'),
            'Cmp_NmAr' => trans('admin.arabic_name'),
            'Cmp_NmEn' => trans('admin.english_name'),
            'Cmp_AddAr' => trans('admin.Cmp_AddAr'),
            'Cmp_Tel' => trans('admin.phone'),
        ]);

        $cmp = MainCompany::where('ID_No', $id)->first();
        $cmp->update($data);
        if($request->hasFile('Picture')){
            $cmp->Picture = Up::upload([
                'request' => 'Picture',
                'path'=>'companies',
                'upload_type' => 'single',
                'delete_file'=> $cmp->Picture
            ]);
        }

        $cmp->Actvty_No = $request->Actvty_No;
        $cmp->Local_Lang = $request->Local_Lang;
        $cmp->Cmp_AddAr = $request->Cmp_AddAr;
        $cmp->Sys_SetupNo = $request->Sys_SetupNo;
        $cmp->Cmp_NmAr2 = $request->Cmp_NmAr2;
        $cmp->Cmp_NmEn2 = $request->Cmp_NmEn2;
        $cmp->Cmp_AddEn = $request->Cmp_AddEn;
        $cmp->Cmp_Fax = $request->Cmp_Fax;
        $cmp->Cmp_Email = $request->Cmp_Email;
        $cmp->Cmp_ShrtNm = $request->Cmp_ShrtNm;
        $cmp->Start_Month = $request->Start_Month;
        $cmp->Start_year = $request->Start_year;
        $cmp->End_Month = $request->End_Month;
        $cmp->End_Year = $request->End_Year;
        $cmp->Start_MonthHij = $request->Start_MonthHij;
        $cmp->Start_YearHij = $request->Start_YearHij;
        $cmp->End_MonthHij = $request->End_MonthHij;
        $cmp->End_YearHij = $request->End_YearHij;
        $cmp->CR_No = $request->CR_No;
        $cmp->CC_No = $request->CC_No;
        $cmp->License_No = $request->License_No;
        $cmp->Tax_No = $request->Tax_No;
        $cmp->TaxExtra_Prct = $request->TaxExtra_Prct;
        if($request->Itm_SrchRef){$cmp->Itm_SrchRef = 1;}else{$cmp->Itm_SrchRef = 0;}
        if($request->Date_Status){$cmp->Date_Status = 1;}else{$cmp->Date_Status = 0;}
        if($request->JvAuto_Mnth){$cmp->JvAuto_Mnth = 1;}else{$cmp->JvAuto_Mnth = 0;}
        if($request->Cshr_Status){$cmp->Cshr_Status = 1;}else{$cmp->Cshr_Status = 0;}
        if($request->PhyTy_CostPrice){$cmp->PhyTy_CostPrice = 1;}else{$cmp->PhyTy_CostPrice = 0;}
        if($request->PhyTy_SalePrice){$cmp->PhyTy_SalePrice = 1;}else{$cmp->PhyTy_SalePrice = 0;}
        if($request->Fraction_Cost){$cmp->Fraction_Cost = 1;}else{$cmp->Fraction_Cost = 0;}
        if($request->Fraction_Curncy){$cmp->Fraction_Curncy = 1;}else{$cmp->Fraction_Curncy = 0;}

        //الترحيل للحسابات
        if($request->JVPst_SalCash){$cmp->JVPst_SalCash = 1;}else{$cmp->JVPst_SalCash = 0;}
        if($request->JVPst_PurCash){$cmp->JVPst_PurCash = 1;}else{$cmp->JVPst_PurCash = 0;}
        if($request->JVPst_NetSalCrdt){$cmp->JVPst_NetSalCrdt = 1;}else{$cmp->JVPst_NetSalCrdt = 0;}
        if($request->JVPst_NetPurCrdt){$cmp->JVPst_NetPurCrdt = 1;}else{$cmp->JVPst_NetPurCrdt = 0;}
        if($request->JVPst_TrnsferVch){$cmp->JVPst_TrnsferVch = 1;}else{$cmp->JVPst_TrnsferVch = 0;}
        if($request->JVPst_AdjustVch){$cmp->JVPst_AdjustVch = 1;}else{$cmp->JVPst_AdjustVch = 0;}
        if($request->JVPst_InvCost){$cmp->JVPst_InvCost = 1;}else{$cmp->JVPst_InvCost = 0;}
        if($request->JVPst_InvSal){$cmp->JVPst_InvSal = 1;}else{$cmp->JVPst_InvSal = 0;}
        $cmp->save();

        if($request->JVPst_InvCost || $request->JVPst_InvSal){
            $cmp->JVPst_TrnsferVch = 1;
            $cmp->JVPst_AdjustVch = 1;
            $cmp->save();
        }
        else{
            $cmp->JVPst_TrnsferVch = 0;
            $cmp->JVPst_AdjustVch = 0;
            $cmp->save();
        }

        //النماذج الخاصه و الطابعات
        if($request->Spcrpt_Rcpt){$cmp->Spcrpt_Rcpt = 1;}else{$cmp->Spcrpt_Rcpt = 0;}
        if($request->Spcrpt_Pymt){$cmp->Spcrpt_Pymt = 1;}else{$cmp->Spcrpt_Pymt = 0;}
        if($request->Spcrpt_Sal){$cmp->Spcrpt_Sal = 1;}else{$cmp->Spcrpt_Sal = 0;}
        if($request->Spcrpt_Pur){$cmp->Spcrpt_Pur = 1;}else{$cmp->Spcrpt_Pur = 0;}
        if($request->Spcrpt_Trnf){$cmp->Spcrpt_Trnf = 1;}else{$cmp->Spcrpt_Trnf = 0;}
        if($request->Spcrpt_Adjust){$cmp->Spcrpt_Adjust = 1;}else{$cmp->Spcrpt_Adjust = 0;}
        if($request->Spcrpt_SRV){$cmp->Spcrpt_SRV = 1;}else{$cmp->Spcrpt_SRV = 0;}
        if($request->Spcrpt_DNV){$cmp->Spcrpt_DNV = 1;}else{$cmp->Spcrpt_DNV = 0;}
        if($request->PrintOrder_DNV){$cmp->PrintOrder_DNV = 1;}else{$cmp->PrintOrder_DNV = 0;}
        if($request->PrintOrder_SRV){$cmp->PrintOrder_SRV = 1;}else{$cmp->PrintOrder_SRV = 0;}
        if($request->SelctNorm_Prntr1){$cmp->SelctNorm_Prntr1 = 1;}else{$cmp->SelctNorm_Prntr1 = 0;}
        if($request->SelctNorm_Prntr2){$cmp->SelctNorm_Prntr2 = 1;}else{$cmp->SelctNorm_Prntr2 = 0;}
        if($request->SelctNorm_Prntr3){$cmp->SelctNorm_Prntr3 = 1;}else{$cmp->SelctNorm_Prntr3 = 0;}
        if($request->SelctBarCod_Prntr1){$cmp->SelctBarCod_Prntr1 = 1;}else{$cmp->SelctBarCod_Prntr1 = 0;}
        if($request->SelctBarCod_Prntr2){$cmp->SelctBarCod_Prntr2 = 1;}else{$cmp->SelctBarCod_Prntr2 = 0;}
        if($request->SelctBarCod_Prntr3){$cmp->SelctBarCod_Prntr3 = 1;}else{$cmp->SelctBarCod_Prntr3 = 0;}
        if($request->SelctPosSlip_Prntr1){$cmp->SelctPosSlip_Prntr1 = 1;}else{$cmp->SelctPosSlip_Prntr1 = 0;}
        if($request->SelctPosSlip_Prntr2){$cmp->SelctPosSlip_Prntr2 = 1;}else{$cmp->SelctPosSlip_Prntr2 = 0;}
        if($request->SelctPosSlip_Prntr3){$cmp->SelctPosSlip_Prntr3 = 1;}else{$cmp->SelctPosSlip_Prntr3 = 0;}

        //اعدادات عامه
        if($request->AllwItm_RepatVch){$cmp->AllwItm_RepatVch = 1;}else{$cmp->AllwItm_RepatVch = 0;}
        if($request->AllwItmLoc_ZroBlnc){$cmp->AllwItmLoc_ZroBlnc = 1;}else{$cmp->AllwItmLoc_ZroBlnc = 0;}
        if($request->AllwItmQty_CostCalc){$cmp->AllwItmQty_CostCalc = 1;}else{$cmp->AllwItmQty_CostCalc = 0;}
        if($request->AllwDisc1Pur_Dis1Sal){$cmp->AllwDisc1Pur_Dis1Sal = 1;}else{$cmp->AllwDisc1Pur_Dis1Sal = 0;}
        if($request->AllwDisc2Pur_Dis2Sal){$cmp->AllwDisc2Pur_Dis2Sal = 1;}else{$cmp->AllwDisc2Pur_Dis2Sal = 0;}
        if($request->AllwStock_Minus){$cmp->AllwStock_Minus = 1;}else{$cmp->AllwStock_Minus = 0;}
        if($request->AllwPur_Disc1){$cmp->AllwPur_Disc1 = 1;}else{$cmp->AllwPur_Disc1 = 0;}
        if($request->AllwPur_Disc2){$cmp->AllwPur_Disc2 = 1;}else{$cmp->AllwPur_Disc2 = 0;}
        if($request->AllwPur_Bouns){$cmp->AllwPur_Bouns = 1;}else{$cmp->AllwPur_Bouns = 0;}
        if($request->AllwSal_Disc1){$cmp->AllwSal_Disc1 = 1;}else{$cmp->AllwSal_Disc1 = 0;}
        if($request->AllwSal_Disc2){$cmp->AllwSal_Disc2 = 1;}else{$cmp->AllwSal_Disc2 = 0;}
        if($request->AllwSal_Bouns){$cmp->AllwSal_Bouns = 1;}else{$cmp->AllwSal_Bouns = 0;}
        if($request->AllwTrnf_Cost){$cmp->AllwTrnf_Cost = 1;}else{$cmp->AllwTrnf_Cost = 0;}
        if($request->AllwTrnf_Disc1){$cmp->AllwTrnf_Disc1 = 1;}else{$cmp->AllwTrnf_Disc1 = 0;}
        if($request->AllwTrnf_Bouns){$cmp->AllwTrnf_Bouns = 1;}else{$cmp->AllwTrnf_Bouns = 0;}
        if($request->AllwBatch_No){$cmp->AllwBatch_No = 1;}else{$cmp->AllwBatch_No = 0;}
        if($request->AllwExpt_Dt){$cmp->AllwExpt_Dt = 1;}else{$cmp->AllwExpt_Dt = 0;}
        if($request->ActvDnv_No){$cmp->ActvDnv_No = 1;}else{$cmp->ActvDnv_No = 0;}
        if($request->ActvSRV_No){$cmp->ActvSRV_No = 1;}else{$cmp->ActvSRV_No = 0;}
        if($request->ActvTrnf_No){$cmp->ActvTrnf_No = 1;}else{$cmp->ActvTrnf_No = 0;}
        if($request->TabOrder_Pur){$cmp->TabOrder_Pur = 1;}else{$cmp->TabOrder_Pur = 0;}
        if($request->TabOrder_SaL){$cmp->TabOrder_SaL = 1;}else{$cmp->TabOrder_SaL = 0;}
        if($request->Foreign_Curncy){$cmp->Foreign_Curncy = 1;}else{$cmp->Foreign_Curncy = 0;}
        if($request->Alw_slmacc){$cmp->Alw_slmacc = 1;}else{$cmp->Alw_slmacc = 0;}
        $cmp->L_Curncy_No = $request->L_Curncy_No;
        $cmp->save();

        return redirect(aurl('companies'))->with(session()->flash('message',trans('admin.success_update')));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = MainCompany::findOrFail($id);
        $company->delete();
        return redirect(aurl('companies'));
    }
}
