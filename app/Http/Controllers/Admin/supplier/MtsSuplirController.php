<?php

namespace App\Http\Controllers\Admin\supplier;

use App\Branches;
use App\city;
use App\country;
use App\DataTables\supplierDataTable;
use App\Department;
use App\Http\Controllers\Controller;
use App\Models\Admin\ActivityTypes;
use App\Models\Admin\AstNutrbusn;
use App\Models\Admin\AstMarket;
use App\Models\Admin\AstSalesman;
use App\Models\Admin\Astsupctg;
use App\Models\Admin\AstCurncy;
use App\Models\Admin\MainBranch;
use App\Models\Admin\MainCompany;
use App\Models\Admin\MtsChartAc;
use App\Models\Admin\MTsCustomer;
use App\Models\Admin\MtsSuplir;
use Illuminate\Http\Request;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class MtsSuplirController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(supplierDataTable $supplier)
    {
        return $supplier->render('admin.supplier.index',['title'=>trans('admin.suppliers')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//        $user = auth()->user()->branches_id;
//        dd($user);
        $countries = country::pluck('country_name_'.session('lang'),'id');
        $astsupctg = Astsupctg::pluck('Supctg_Nm'.session('lang'),'ID_No');
        $branches = MainBranch::pluck('Brn_Nm'.ucfirst(session('lang')),'ID_No');
        $company = MainCompany::pluck('Cmp_Nm'.ucfirst(session('lang')),'ID_No');
        $departments = Department::where('operation_id',1)->where('type','1')->pluck('dep_name_'.session('lang'),'id');
        $currency = AstCurncy::pluck('Curncy_Nm'.ucfirst(session('lang')),'ID_No');
        $Sup_No = MtsSuplir::orderByRaw('updated_at - created_at DESC')->pluck('Sup_No')->first();
        if ($Sup_No < 0 || $Sup_No == null){
            $suplir = 1;
        }else{
            $suplir = $Sup_No + 1;
        }
        return view('admin.supplier.create',['title'=> trans('admin.create_new_suppliers'),'suplir' => $suplir,'currency' => $currency,'astsupctg' => $astsupctg,'company' => $company,'countries' => $countries,'departments' => $departments,'branches' => $branches]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,MtsSuplir $supplier)
    {
//dd($request->all());
        $data = $this->validate($request,[
            'Cmp_No' => 'required',
            'Brn_No' => 'required',
            'Sup_No' => 'sometimes',
            'Cstm_POBox' => 'sometimes',
            'Cstm_ZipCode' => 'sometimes',
            'Sup_Refno' => 'sometimes',
            'SupCtg_No' => 'sometimes',
            'Cntry_No' => 'sometimes',
            'Sup_NmEn' => 'required',
            'Sup_NmAr' => 'required',
            'Sup_Adr' => 'sometimes',
            'Sup_Rsp' => 'sometimes',
            'Sup_Othr' => 'sometimes',
            'Curncy_No' => 'sometimes',
            'Sup_Email' => 'sometimes',
            'Sup_Tel1' => 'sometimes',
            'Sup_Tel2' => 'sometimes',
            'Mobile' => 'sometimes',
            'Sup_Fax' => 'sometimes',
            'Acc_No' => 'sometimes',
            'Credit_Value' => 'sometimes',
            'Credit_Days' => 'sometimes',
            'Fbal_Db' => 'sometimes',
            'Fbal_CR' => 'sometimes',
            'TradeOffer' => 'sometimes',
            'CR11' => 'sometimes',
            'CR12' => 'sometimes',
            'CR13' => 'sometimes',
            'CR14' => 'sometimes',
            'CR15' => 'sometimes',
            'CR16' => 'sometimes',
            'CR17' => 'sometimes',
            'CR18' => 'sometimes',
            'CR19' => 'sometimes',
            'CR20' => 'sometimes',
            'CR21' => 'sometimes',
            'CR22' => 'sometimes',

            'DB11' => 'sometimes',
            'DB12' => 'sometimes',
            'DB13' => 'sometimes',
            'DB14' => 'sometimes',
            'DB15' => 'sometimes',
            'DB16' => 'sometimes',
            'DB17' => 'sometimes',
            'DB18' => 'sometimes',
            'DB19' => 'sometimes',
            'DB20' => 'sometimes',
            'DB21' => 'sometimes',
            'DB22' => 'sometimes',
            'CBal' => 'sometimes',
            'Updt_Date' => 'sometimes',
            'User_ID' => 'sometimes',
            'Tax_No' => 'sometimes',
            'Opn_Date' => 'sometimes',
            'Opn_Time' => 'sometimes',

           // 'Cntct_Prsn1' => 'sometimes',
            'Cntct_Prsn2' => 'sometimes',
            'Cntct_Prsn3' => 'sometimes',
            'Cntct_Prsn4' => 'sometimes',
            'Cntct_Prsn5' => 'sometimes',

            'TitL1' => 'sometimes',
            'TitL2' => 'sometimes',
            'TitL3' => 'sometimes',
            'TitL4' => 'sometimes',
            'TitL5' => 'sometimes',

            'Mobile1' => 'sometimes',
            'Mobile2' => 'sometimes',
            'Mobile3' => 'sometimes',
            'Mobile4' => 'sometimes',
            'Mobile5' => 'sometimes',

            'Email1' => 'sometimes',
            'Email2' => 'sometimes',
            'Email3' => 'sometimes',
            'Email4' => 'sometimes',
            'Email5' => 'sometimes',

            'Linv_No' => 'sometimes',
            'Linv_Dt' => 'sometimes',
            'Linv_Net' => 'sometimes',
            'LRcpt_No' => 'sometimes',
            'LRcpt_Dt' => 'sometimes',
            'LRcpt_Db' => 'sometimes',

            'Sup_Active' => 'sometimes',
            'note' => 'sometimes',





        ],[],[
//            'Cmp_No' => trans('admin.arabic_name'),
//            'Brn_No' => trans('admin.english_name'),
//            'Sup_No' => trans('admin.addriss'),

        ]);

//        dd($data);

        $supplier->create($data);
        return redirect(aurl('suppliers'))->with(session()->flash('message',trans('admin.success_add')));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $supplier = MtsSuplir::where('ID_No',$id)->first();
        return view('admin.supplier.show',['title'=> trans('admin.show_suppliers')  ,'supplier'=>$supplier,]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $astsupctg = Astsupctg::pluck('Supctg_Nm'.session('lang'),'ID_No');
        $supplier = MtsSuplir::where('ID_No',$id)->first();
        $branches = Branches::pluck('name_'.session('lang'),'id');
        $company = MainCompany::pluck('Cmp_Nm'.ucfirst(session('lang')),'ID_No');
//        $branches = MainBranch::pluck('Brn_Nm'.ucfirst(session('lang')),'ID_No');
        $countries = country::pluck('country_name_'.session('lang'),'id');
//        $departments = Department::where('operation_id',1)->where('type','1')->pluck('dep_name_'.session('lang'),'id');
        return view('admin.supplier.edit',['title'=> trans('admin.edit_suppliers') ,'astsupctg'=>$astsupctg,'company'=>$company,'supplier'=>$supplier,'countries'=>$countries,'branches' => $branches]);
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
        $data = $this->validate($request,[
            'Cmp_No' => 'required',
            'Brn_No' => 'required',
            'Sup_No' => 'required',
            'Sup_Refno' => 'sometimes',
            'Cstm_POBox' => 'sometimes',
            'Cstm_ZipCode' => 'sometimes',
            'SupCtg_No' => 'sometimes',
            'Cntry_No' => 'sometimes',
            'Sup_NmEn' => 'required',
            'Sup_NmAr' => 'required',
            'Sup_Adr' => 'sometimes',
            'Sup_Rsp' => 'sometimes',
            'Sup_Othr' => 'sometimes',
            'Curncy_No' => 'sometimes',
            'Sup_Email' => 'sometimes',
            'Sup_Tel1' => 'sometimes',
            'Sup_Tel2' => 'sometimes',
            'Mobile' => 'sometimes',
            'Sup_Fax' => 'sometimes',
            'Acc_No' => 'sometimes',
            'Credit_Value' => 'sometimes',
            'Credit_Days' => 'sometimes',
            'Fbal_Db' => 'sometimes',
            'Fbal_CR' => 'sometimes',
            'TradeOffer' => 'sometimes',
            'CR11' => 'sometimes',
            'CR12' => 'sometimes',
            'CR13' => 'sometimes',
            'CR14' => 'sometimes',
            'CR15' => 'sometimes',
            'CR16' => 'sometimes',
            'CR17' => 'sometimes',
            'CR18' => 'sometimes',
            'CR19' => 'sometimes',
            'CR20' => 'sometimes',
            'CR21' => 'sometimes',
            'CR22' => 'sometimes',

            'DB11' => 'sometimes',
            'DB12' => 'sometimes',
            'DB13' => 'sometimes',
            'DB14' => 'sometimes',
            'DB15' => 'sometimes',
            'DB16' => 'sometimes',
            'DB17' => 'sometimes',
            'DB18' => 'sometimes',
            'DB19' => 'sometimes',
            'DB20' => 'sometimes',
            'DB21' => 'sometimes',
            'DB22' => 'sometimes',
            'CBal' => 'sometimes',
            'Updt_Date' => 'sometimes',
            'User_ID' => 'sometimes',
            'Tax_No' => 'sometimes',
            'Opn_Date' => 'sometimes',
            'Opn_Time' => 'sometimes',


            'Cntct_Prsn1' => 'sometimes',
            'Cntct_Prsn2' => 'sometimes',
            'Cntct_Prsn3' => 'sometimes',
            'Cntct_Prsn4' => 'sometimes',
            'Cntct_Prsn5' => 'sometimes',

            'TitL1' => 'sometimes',
            'TitL2' => 'sometimes',
            'TitL3' => 'sometimes',
            'TitL4' => 'sometimes',
            'TitL5' => 'sometimes',

            'Mobile1' => 'sometimes',
            'Mobile2' => 'sometimes',
            'Mobile3' => 'sometimes',
            'Mobile4' => 'sometimes',
            'Mobile5' => 'sometimes',

            'Email1' => 'sometimes',
            'Email2' => 'sometimes',
            'Email3' => 'sometimes',
            'Email4' => 'sometimes',
            'Email5' => 'sometimes',

            'Linv_No' => 'sometimes',
            'Linv_Dt' => 'sometimes',
            'Linv_Net' => 'sometimes',
            'LRcpt_No' => 'sometimes',
            'LRcpt_Dt' => 'sometimes',
            'LRcpt_Db' => 'sometimes',
            'Sup_Active' => 'sometimes',
            'note' => 'sometimes',

        ],[],[
//            'name_ar' => trans('admin.arabic_name'),
//            'name_en' => trans('admin.english_name'),
//            'addriss' => trans('admin.addriss'),

        ]);
        $supplier = MtsSuplir::findOrFail($id);
        $supplier->update($data);
        return redirect(aurl('suppliers'))->with(session()->flash('message',trans('admin.success_update')));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $supplier = MtsSuplir::where('ID_No',$id);
        $supplier->delete();
        return redirect(aurl('suppliers'));
    }

    public function createSupNo(Request $request){
        if($request->ajax()){
            $last_no = 0;
            if(count(MtsSuplir::all()) == 0){
//                return 'first';
                //no records
                $last_no = $request->Brn_No * 10000;
            }else{
                $last_cstm = MtsSuplir::where('Brn_No',  $request->Brn_No)->orderBy('Sup_No', 'desc')->first();
                if($last_cstm == null){
//                    return 'else first';
                    $last_no = $request->Brn_No * 10000;
                }
                else{
//                    return 'else second';
                    $last_no = $last_cstm->Cstm_No;
                }
            }
            return $last_no + 1;
        }
    }

    ///////////Reports//////////

    public function supplier_report()
    {
        $mainCompany = MainCompany::pluck('Cmp_Nm'.ucfirst(session('lang')), 'Cmp_No');
        return $data =  view('admin.basic_reports.supplier.supplier_report',compact('mainCompany'))->render();

    }
    public function get_mainbranches(Request $request)
    {

        if($request->ajax())
        {
            $mainCompany =  $request->mainCompany;
            $MainBranch = MainBranch::where('Cmp_No',$mainCompany)->get(['Brn_No','Brn_Nm'.ucfirst(session('lang'))]);
            return $data =  view('admin.basic_reports.supplier.ajax.get_mainbranches',compact('mainCompany','MainBranch'))->render();


        }

    }



    public function sup_report_select(Request $request)
    {
//        dd($request->all());
        if($request->ajax())

        {
            $mainCompany = $request->mainCompany;
            $myradio = $request->value;
            $active = $request->active;
            $notactive = $request->notactive;
            if($myradio =='country')
            {
                $country = country::get();

                return $data = view('admin.basic_reports.supplier.ajax.sup_report_select',compact('active','notactive','country','myradio','mainCompany'))->render();

            }elseif ( $myradio == 'bransh')
            {
                $MainBranch = MainBranch::where('Cmp_No',$mainCompany)->get(['Brn_No','Brn_Nm'.ucfirst(session('lang'))]);
                return $data = view('admin.basic_reports.supplier.ajax.sup_report_select',compact('active','notactive','myradio','MainBranch','mainCompany'))->render();

            }
            elseif ( $myradio == 'Currency')
            {

                $currency = AstCurncy::get();
                return $data = view('admin.basic_reports.supplier.ajax.sup_report_select',compact('active','notactive','currency','myradio','mainCompany'))->render();


            }else if($myradio == 'AstSalesman')
            {
                $AstSalesman = AstSalesman::get();
                return $data = view('admin.basic_reports.supplier.ajax.sup_report_select',compact('active','notactive','AstSalesman','myradio','MainBranch','mainCompany'))->render();



            }else if($myradio == 'AstMarket')
            {
                $AstMarket = AstMarket::get();
                return $data = view('admin.basic_reports.supplier.ajax.sup_report_select',compact('active','notactive','AstMarket','myradio','MainBranch','mainCompany'))->render();



            }else if($myradio == 'ActivityTypes')
            {
                $ActivityTypes = AstNutrbusn::get();
                return $data = view('admin.basic_reports.supplier.ajax.sup_report_select',compact('active','notactive','ActivityTypes','myradio','mainCompany'))->render();

            }else if($myradio == 'Astsupctg')
            {
                $Astsupctg = Astsupctg::get();
                return $data = view('admin.basic_reports.supplier.ajax.sup_report_select',compact('active','notactive','Astsupctg','myradio','mainCompany'))->render();

            }


//



        }
    }

    public function sup_report_print(Request $request)
    {
//        dd($request->all());
//        dd($request->all());
        if($request->ajax())
        {
            $mainCompany = $request->mainCompany;
            $myradio = $request->myradio;
            $selecd_input = $request->selecd_input;
            $active = $request->active;
            $notactive = $request->notactive;
            return $data=  view('admin.basic_reports.supplier.ajax.sup_report_print',compact('active','notactive','selecd_input','myradio','mainCompany'))->render();

        }
    }
    public function sup_report_pdf(Request $request)
    {
//        dd($request->all());
//        dd('hkh');
//dd($request->myradio);
//dd($request->selecd_input);
            $name = $request->myradio;
            $value = $request->selecd_input;

            if ($name == 'bransh') {
                if ($request->active == 1 && $request->notactive == null){
                    $MtsSuplir = MtsSuplir::where('Brn_No',$value)->where('Cmp_No' , $request->mainCompany)->where('Sup_Active',$request->active)->get();
                }elseif ($request->active == null && $request->notactive == 0){
                    $MtsSuplir = MtsSuplir::where('Brn_No',$value)->where('Cmp_No' , $request->mainCompany)->where('Sup_Active',$request->notactive)->get();
                }elseif ($request->active == 1 && $request->notactive == 0){
                    $MtsSuplir = MtsSuplir::where('Brn_No',$value)->where('Cmp_No' , $request->mainCompany)->get();
                }
    //
            }
            if ($name == 'AstSalesman') {
                if ($request->active == 1 && $request->notactive == null){
                    $MtsSuplir = MtsSuplir::where('Slm_No',$value)->where('Cmp_No' , $request->mainCompany)->where('Sup_Active',$request->active)->get();
                }elseif ($request->active == null && $request->notactive == 0){
                    $MtsSuplir = MtsSuplir::where('Slm_No',$value)->where('Cmp_No' , $request->mainCompany)->where('Sup_Active',$request->notactive)->get();
                }elseif ($request->active == 1 && $request->notactive == 0){
                    $MtsSuplir = MtsSuplir::where('Slm_No',$value)->where('Cmp_No' , $request->mainCompany)->get();
                }


            }
            if ($name == 'ActivityTypes') {
                if ($request->active == 1 && $request->notactive == null){
                    $MtsSuplir = MtsSuplir::where('Nutr_No',$value)->where('Cmp_No' , $request->mainCompany)->where('Sup_Active',$request->active)->get();
                }elseif ($request->active == null && $request->notactive == 0){
                    $MtsSuplir = MtsSuplir::where('Nutr_No',$value)->where('Cmp_No' , $request->mainCompany)->where('Sup_Active',$request->notactive)->get();
                }elseif ($request->active == 1 && $request->notactive == 0){
                    $MtsSuplir = MtsSuplir::where('Nutr_No',$value)->where('Cmp_No' , $request->mainCompany)->get();
                }
            }

            if ($name == 'ActivityTypes') {
                if ($request->active == 1 && $request->notactive == null){
                    $MtsSuplir = MtsSuplir::where('Cstm_Ctg',$value)->where('Cmp_No' , $request->mainCompany)->where('Sup_Active',$request->active)->get();
                }elseif ($request->active == null && $request->notactive == 0){
                    $MtsSuplir = MtsSuplir::where('Cstm_Ctg',$value)->where('Cmp_No' , $request->mainCompany)->where('Sup_Active',$request->notactive)->get();
                }elseif ($request->active == 1 && $request->notactive == 0){
                    $MtsSuplir = MtsSuplir::where('Cstm_Ctg',$value)->where('Cmp_No' , $request->mainCompany)->get();
                }
            }

            if ($name == 'country') {
                if ($request->active == 1 && $request->notactive == null){
                    $MtsSuplir = MtsSuplir::where('Cntry_No',$value)->where('Cmp_No' , $request->mainCompany)->where('Sup_Active',$request->active)->get();
                }elseif ($request->active == null && $request->notactive == 0){
                    $MtsSuplir = MtsSuplir::where('Cntry_No',$value)->where('Cmp_No' , $request->mainCompany)->where('Sup_Active',$request->notactive)->get();
                }elseif ($request->active == 1 && $request->notactive == 0){
                    $MtsSuplir = MtsSuplir::where('Cntry_No',$value)->where('Cmp_No' , $request->mainCompany)->get();
                }
            }

            if ($name == 'city') {

                if ($request->active == 1 && $request->notactive == null){
                    $MtsSuplir = MtsSuplir::where('City_No',$value)->where('Cmp_No' , $request->mainCompany)->where('Sup_Active',$request->active)->get();
                }elseif ($request->active == null && $request->notactive == 0){
                    $MtsSuplir = MtsSuplir::where('City_No',$value)->where('Cmp_No' , $request->mainCompany)->where('Sup_Active',$request->notactive)->get();
                }elseif ($request->active == 1 && $request->notactive == 0){
                    $MtsSuplir = MtsSuplir::where('City_No',$value)->where('Cmp_No' , $request->mainCompany)->get();
                }

            }

            if ($name == 'Currency') {

                if ($request->active == 1 && $request->notactive == null){
                    $MtsSuplir = MtsSuplir::where('Curncy_No',$value)->where('Cmp_No' , $request->mainCompany)->where('Sup_Active',$request->active)->get();
                }elseif ($request->active == null && $request->notactive == 0){
                    $MtsSuplir = MtsSuplir::where('Curncy_No',$value)->where('Cmp_No' , $request->mainCompany)->where('Sup_Active',$request->notactive)->get();
                }elseif ($request->active == 1 && $request->notactive == 0){
                    $MtsSuplir = MtsSuplir::where('Curncy_No',$value)->where('Cmp_No' , $request->mainCompany)->get();
                }
            }

            if ($name == 'MtsChartAc') {
                if ($request->active == 1 && $request->notactive == null){
                    $MtsSuplir = MtsSuplir::where('Acc_No',$value)->where('Cmp_No' , $request->mainCompany)->where('Sup_Active',$request->active)->get();
                }elseif ($request->active == null && $request->notactive == 0){
                    $MtsSuplir = MtsSuplir::where('Acc_No',$value)->where('Cmp_No' , $request->mainCompany)->where('Sup_Active',$request->notactive)->get();
                }elseif ($request->active == 1 && $request->notactive == 0){
                    $MtsSuplir = MtsSuplir::where('Acc_No',$value)->where('Cmp_No' , $request->mainCompany)->get();
                }

            }

            if ($name == 'AstMarket') {
                if ($request->active == 1 && $request->notactive == null){
                    $MtsSuplir = MtsSuplir::where('Mrkt_No',$value)->where('Cmp_No' , $request->mainCompany)->where('Sup_Active',$request->active)->get();
                }elseif ($request->active == null && $request->notactive == 0){
                    $MtsSuplir = MtsSuplir::where('Mrkt_No',$value)->where('Cmp_No' , $request->mainCompany)->where('Sup_Active',$request->notactive)->get();
                }elseif ($request->active == 1 && $request->notactive == 0){
                    $MtsSuplir = MtsSuplir::where('Mrkt_No',$value)->where('Cmp_No' , $request->mainCompany)->get();
                }
            }


            $config = ['instanceConfigurator' => function ($mpdf) {
                $mpdf->SetHTMLFooter('
                        <div style="font-size:10px;width:25%;float:right">Print Date: {DATE j-m-Y H:m}</div>
                        <div style="font-size:10px;width:25%;float:left;direction:ltr;text-align:left">Page {PAGENO} of {nbpg}</div>'
                );
            }];
            $pdf = Pdf::loadView('admin.basic_reports.supplier.pdf.sup', compact('MtsSuplir'), [], $config);
            return $pdf->stream();


    }


}
