<?php

namespace App\Http\Controllers\Admin\Department;


use App\Branches;
use App\city;
use App\country;
use App\Models\Admin\AstMarket;
use App\Models\Admin\AstNutrbusn;
use App\Models\Admin\MtsCostcntr;
use App\Models\Admin\AstSalesman;
use App\Models\Admin\Astsupctg;
use App\Models\Admin\MainBranch;
use App\Models\Admin\MTsCustomer;
use App\Project;
use App\Contractors;

use App\employee;
use App\Department;
use App\glcc;
use App\limitations;
use App\Http\Controllers\Controller;
use App\levels;
use App\limitationReceipts;
use App\limitationsType;
use App\operation;
use App\pjitmmsfl;
use App\receipts;
use App\receiptsData;
use App\receiptsType;
use App\supplier;
use App\Models\Admin\MtsChartAc;
use App\Models\Admin\MtsClosAcc;
use App\Models\Admin\MainCompany;
use App\Models\Admin\ActivityTypes;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use niklasravnsborg\LaravelPdf\Facades\Pdf;
use Up;


class DepartmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Department $department)
    {
        $chart = MtsChartAc::get(['Acc_Nm'.ucfirst(session('lang')), 'Acc_No']);
        if(count($chart) > 0){
            if(session('Cmp_No') == -1 || session('Actvty_No' == -1)){
                $cmps = MainCompany::get(['Cmp_Nm'.ucfirst(session('lang')), 'Cmp_No']);
                $acts = ActivityTypes::get(['Actvty_No', 'Name_'.ucfirst(session('lang'))]);
            }
            else{
                $cmps = MainCompany::where('Cmp_No', session('Cmp_No'))
                    ->where('Actvty_No', session('Actvty_No'))
                    ->get(['Cmp_Nm'.ucfirst(session('lang')), 'Cmp_No']);
                $acts = ActivityTypes::where('Actvty_No', session('Actvty_No'))
                    ->get(['Actvty_No', 'Name_'.ucfirst(session('lang'))]);
            }
            $chart_item = MtsChartAc::first();
            $total = $this->getTotalTransaction($chart_item);
            $children = [];
            return view('admin.departments.index', ['title' => trans('admin.Departments'),
                'cmps' => $cmps, 'chart_item' => $chart_item, 'total' => $total, 'children' => $children, 'acts' => $acts]);
        }
        else{
            if(session('Cmp_No') == -1 || session('Actvty_No' == -1)){
                $cmps = MainCompany::get(['Cmp_Nm'.ucfirst(session('lang')), 'Cmp_No']);
                $acts = ActivityTypes::get(['Actvty_No', 'Name_'.ucfirst(session('lang'))]);
            }
            else{
                $cmps = MainCompany::where('Cmp_No', session('Cmp_No'))
                    ->where('Actvty_No', session('Actvty_No'))
                    ->get(['Cmp_Nm'.ucfirst(session('lang')), 'Cmp_No'])->first();
                $acts = ActivityTypes::where('Actvty_No', session('Actvty_No'))
                    ->get(['Actvty_No', 'Name_'.ucfirst(session('lang'))]);
            }
            $Acc_No = $this->createAccNo(0);
            return view('admin.departments.init_chart', ['title' => trans('admin.Departments')
                , 'cmps' => $cmps, 'Acc_No' => $Acc_No, 'acts' => $acts]);
        }

    }
    public function department_setting()
    {
        return view('admin.general_setting.Departments.department_setting');

    }

    public function createNewAcc(Request $request){
        if($request->ajax()){
            if($request->parent){
                $parent = MtsChartAc::where('Acc_No', $request->parent)
                    ->where('Cmp_No', session('Chart_Cmp_No'))
                    ->get(['Acc_No', 'Cmp_No', 'Level_No', 'Parnt_Acc'])
                    ->first();
                $cmps = MainCompany::where('Cmp_No', $parent->Cmp_No)->get(['Cmp_No', 'Cmp_Nm'.ucfirst(session('lang'))])->first();
                $chart = MtsChartAc::get(['Acc_Nm'.ucfirst(session('lang')), 'Acc_No']);
                $balances = MtsClosAcc::where('Main_Rpt', 1)->get(['CLsacc_Nm'.ucfirst(session('lang')), 'CLsacc_No']);
                $incomes = MtsClosAcc::where('Main_Rpt', 2)->get(['CLsacc_Nm'.ucfirst(session('lang')), 'CLsacc_No']);
                $costcntrc = MtsCostcntr::where('Cmp_No', $parent->Cmp_No)->where('Level_Status',1)->get();

                $Acc_No = $this->createAccNo($parent->Acc_No);
                return view('admin.departments.create', ['title' => trans('admin.Departments'),
                    'parent' => $parent, 'cmps' => $cmps, 'chart' => $chart, 'Acc_No' =>  $Acc_No,
                    'balances' => $balances, 'incomes' => $incomes, 'costcntrc'=>$costcntrc]);
            }
            // else{
            //     return 'else';
            //     if(session('Cmp_No') == -1){
            //         $cmps = MainCompany::get(['Cmp_Nm'.ucfirst(session('lang')), 'Cmp_No']);
            //     }
            //     else{
            //         $cmps = MainCompany::where('Cmp_No', session('Cmp_No'))->get(['Cmp_Nm'.ucfirst(session('lang')), 'Cmp_No'])->first();
            //     }
            //     $chart = MtsChartAc::get(['Acc_Nm'.ucfirst(session('lang')), 'Acc_No']);
            //     $Acc_No = $this->createAccNo(0);
            //     return view('admin.departments.create', ['title' => trans('admin.Departments'),
            //                 'cmps' => $cmps, 'chart' => $chart, 'Acc_No' => $Acc_No]);
            // }
        }
    }

    public function initChartAcc(){
        if(session('Cmp_No') == -1){
            $cmps = MainCompany::get(['Cmp_Nm'.ucfirst(session('lang')), 'Cmp_No']);
        }
        else{
            $cmps = MainCompany::where('Cmp_No', session('Cmp_No'))->get(['Cmp_Nm'.ucfirst(session('lang')), 'Cmp_No'])->first();
        }
        $Acc_No = $this->createAccNo(0);
        // return view('admin.departments.create_main_chart', ['title' => trans('admin.Departments')
        //             , 'cmps' => $cmps, 'Acc_No' => $Acc_No]);
        return view('admin.departments.create_main_chart', ['title' => trans('admin.Departments')
            , 'cmps' => $cmps, 'Acc_No' => $Acc_No]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Department $department)
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Department $department)
    {
        if($request->Level_Status == 0){
            $data = $this->validate($request,[
                // 'Cmp_No' => 'required',
                'Acc_NmAr' => 'required',
                'Acc_NmEn' => 'required',
            ],[],[
                // 'Cmp_No' => trans('admin.cmp_no'),
                'Acc_NmAr' => trans('admin.arabic_name'),
                'Acc_NmEn' => trans('admin.english_name'),
            ]);

            $chart = new MtsChartAc;
            $chart->Cmp_No = session('Chart_Cmp_No');
            $chart->Acc_NmAr = $request->Acc_NmAr;
            $chart->Acc_NmEn = $request->Acc_NmEn;
            $chart->Level_Status = $request->Level_Status;
            $chart->Level_No = 1;
            $chart->Parnt_Acc = 0;
            $chart->User_Id = Auth::user()->id;
            // $chart->Acc_No = $this->createAccNo($chart->Parnt_Acc);
            $chart->Acc_No = $request->Acc_No;
            // $created_Acc_No = $this->createAccNo($chart->Parnt_Acc);
            // if($request->Acc_No == $created_Acc_No){
            //     $chart->Acc_No = $created_Acc_No;
            // }
            // else{
            //     $chart->Acc_No = $request->Acc_No;
            // }
            $chart->save();
            $chart->Acc_Dt = $chart->created_at;
            $chart->Acc_DtAr = date('Y-m-d',strtotime(\GeniusTS\HijriDate\Hijri::convertToHijri($chart->Acc_Dt)));
            $chart->Updt_Time = $chart->updated_at;
            $chart->save();
            return redirect(aurl('departments'))->with(session()->flash('message',trans('admin.success_add')));
        }
        else if($request->Level_Status == 1){
            $data = $this->validate($request,[
                // 'Cmp_No' => 'required',
                'Acc_NmAr' => 'required',
                'Acc_NmEn' => 'required',
                'Acc_Typ' => 'sometimes',
                'Level_Status' => 'required',
                'Acc_Ntr' => 'required',
            ],[],[
                // 'Cmp_No' => trans('admin.cmp_no'),
                'Acc_NmAr' => trans('admin.arabic_name'),
                'Acc_NmEn' => trans('admin.english_name'),
                'Acc_Typ' => trans('admin.account_type'),
                'Level_Status' => trans('admin.department_type'),
                'Acc_Ntr' => trans('admin.category')
            ]);

            // return $request;
            $chart = new MtsChartAc;
            $chart->Cmp_No = session('Chart_Cmp_No');
            $chart->Acc_NmAr = $request->Acc_NmAr;
            $chart->Acc_NmEn = $request->Acc_NmEn;
            $chart->Level_Status = $request->Level_Status;
            $parent = MtsChartAc::where('Acc_No', $request->Parnt_Acc)->get(['Level_No'])->first();
            $chart->Level_No = $parent->Level_No + 1;
            $chart->Parnt_Acc = $request->Parnt_Acc;
            $chart->Acc_Typ = $request->Acc_Typ;
            $chart->Clsacc_No1 = $request->Clsacc_No1;
            $chart->Clsacc_No2 = $request->Clsacc_No2;
            $chart->Clsacc_No3 = $request->Clsacc_No3;
            $chart->Acc_Actv = $request->Acc_Actv;
            $chart->Cr_Blnc = $request->Cr_Blnc;
            $chart->Acc_Ntr = $request->Acc_Ntr;
            $chart->Fbal_DB = $request->Fbal_DB;
            $chart->Fbal_CR = $request->Fbal_CR;
            $chart->User_Id = Auth::user()->id;
            // $chart->Acc_No = $this->createAccNo($chart->Parnt_Acc);
            $chart->Acc_No = $request->Acc_No;
            $chart->save();
            $chart->Acc_Dt = $chart->created_at;
            $chart->Acc_DtAr = date('Y-m-d',strtotime(\GeniusTS\HijriDate\Hijri::convertToHijri($chart->Acc_Dt)));
            $chart->Updt_Time = $chart->updated_at;
            $chart->save();
            $parent_level = MtsChartAc::where('Acc_No', $request->Parnt_Acc)->first();
            if($parent_level){
                $parent_level->Level_Status = 0;
                $parent_level->save();
            }
            return redirect(aurl('departments'))->with(session()->flash('message',trans('admin.success_add')));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
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
    }

    public function getEditBlade(Request $request)
    {

        if($request->ajax()){

            if(session('Cmp_No') == -1){

                $cmps = MainCompany::get(['Cmp_Nm'.ucfirst(session('lang')), 'Cmp_No']);
//
            }
            else{
                $cmps = MainCompany::where('Cmp_No', session('Cmp_No'))->get(['Cmp_Nm'.ucfirst(session('lang')), 'Cmp_No']);
            }

            $balances = MtsClosAcc::where('Main_Rpt', 1)->get(['CLsacc_Nm'.ucfirst(session('lang')), 'CLsacc_No']);
            $incomes = MtsClosAcc::where('Main_Rpt', 2)->get(['CLsacc_Nm'.ucfirst(session('lang')), 'CLsacc_No']);
            $chart = MtsChartAc::get(['Acc_Nm'.ucfirst(session('lang')), 'Acc_No']);
            $costcntrc = MtsCostcntr::where('Cmp_No', $cmps->Cmp_No)->get();
            $chart_item = MtsChartAc::where('Acc_No', $request->Acc_No)
                ->where('Cmp_No', session('Chart_Cmp_No'))
                ->first();
            $total = $this->getTotalTransaction($chart_item);
            return view('admin.departments.edit', ['title' => trans('admin.Departments'),
                'chart' => $chart, 'cmps' => $cmps, 'chart_item' => $chart_item, 'total' => $total,
                'balances' => $balances, 'incomes' => $incomes, 'children' => $request->children, 'costcntrc'=>$costcntrc]);
        }
    }

    public function getParentName(Request $request){
        if($request->ajax()){
            $chart =  MtsChartAc::where('Acc_No', $request->Acc_No)
                ->where('Cmp_No', session('Chart_Cmp_No'))
                ->get(['Parnt_Acc', 'Acc_No', 'Acc_Nm'.ucfirst(session('lang'))])->first();
            $parent = MtsChartAc::where('Acc_No', $chart->Parnt_Acc)
                ->where('Cmp_No', session('Chart_Cmp_No'))
                ->get(['Acc_No','Acc_Nm'.ucfirst(session('lang'))])->first();
            if($parent){
                return $parent;
            }
            else{
                return $chart;
            }
        }
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
        $chart = MtsChartAc::where('Acc_No', $id)
            ->where('Cmp_No', session('Chart_Cmp_No'))
            ->first();

        // if($chart->Level_Status == 0){
        if($chart->Level_No == 1){
            $data = $this->validate($request,[
                // 'Cmp_No' => 'required',
                'Acc_NmAr' => 'required',
                'Acc_NmEn' => 'sometimes',
            ],[],[
                // 'Cmp_No' => trans('admin.cmp_no'),
                'Acc_NmAr' => trans('admin.arabic_name'),
                'Acc_NmEn' => trans('admin.english_name'),
            ]);

            $chart->Cmp_No =  session('Chart_Cmp_No');
            $chart->Acc_NmAr = $request->Acc_NmAr;
            $chart->Acc_NmEn = $request->Acc_NmEn;
            // $chart->Acc_No = $request->Acc_No;
            // $chart->Parnt_Acc = 0;
            $chart->User_Id = Auth::user()->id;
            $chart->save();
            $chart->Acc_Dt = $chart->created_at;
            $chart->Acc_DtAr = date('Y-m-d',strtotime(\GeniusTS\HijriDate\Hijri::convertToHijri($chart->Acc_Dt)));
            $chart->Updt_Time = $chart->updated_at;
            $chart->save();

            // $children = $child = MtsChartAc::where('Acc_No', 'LIKE '.$chart->Acc_No.'%')->get(['Cmp_No']);
            // return $children;
            if($request->children){
                if(count($request->children) > 0){
                    foreach($request->children as $acc_no){
                        $child = MtsChartAc::where('Acc_No', $acc_no)->first()->update(['Cmp_No' => $request->Cmp_No]);
                    }
                }
            }
            return redirect(aurl('departments'))->with(session()->flash('message',trans('admin.success_update')));
        }
        else{
            $data = $this->validate($request,[
                // 'Cmp_No' => 'required',
                'Acc_NmAr' => 'required',
                'Acc_NmEn' => 'sometimes',
                'Acc_Typ' => 'sometimes',
                'Level_Status' => 'sometimes',
                'Acc_Ntr' => 'required',
            ],[],[
                // 'Cmp_No' => trans('admin.cmp_no'),
                'Acc_NmAr' => trans('admin.arabic_name'),
                'Acc_NmEn' => trans('admin.english_name'),
                'Acc_Typ' => trans('admin.account_type'),
                'Level_Status' => trans('admin.department_type'),
                'Acc_Ntr' => trans('admin.category')
            ]);

            // return $request->Fbal_DB;
            $chart->Cmp_No =  session('Chart_Cmp_No');
            $chart->Acc_NmAr = $request->Acc_NmAr;
            $chart->Acc_NmEn = $request->Acc_NmEn;
            // $chart->Level_Status = $request->Level_Status;
            // return $request->Parnt_Acc;
            // $parent = MtsChartAc::where('Acc_No', $request->Parnt_Acc)->get(['Level_No'])->first();
            // $chart->Level_No = $parent->Level_No + 1;
            // $chart->Parnt_Acc = $request->Parnt_Acc;
            $chart->Acc_Typ = $request->Acc_Typ;
            $chart->Clsacc_No1 = $request->Clsacc_No1;
            $chart->Clsacc_No2 = $request->Clsacc_No2;
            $chart->Clsacc_No3 = $request->Clsacc_No3;
            $chart->Acc_Actv = $request->Acc_Actv;
            $chart->Cr_Blnc = $request->Cr_Blnc;
            $chart->Acc_Ntr = $request->Acc_Ntr;
            $chart->Fbal_DB = $request->Fbal_DB;
            $chart->Fbal_CR = $request->Fbal_CR;
            $chart->User_Id = Auth::user()->id;
            $chart->save();
            $chart->Acc_Dt = $chart->created_at;
            $chart->Acc_DtAr = date('Y-m-d',strtotime(\GeniusTS\HijriDate\Hijri::convertToHijri($chart->Acc_Dt)));
            $chart->Updt_Time = $chart->updated_at;
            $chart->save();

            if($request->children){
                if(count($request->children) > 0){
                    foreach($request->children as $acc_no){
                        $child = MtsChartAc::where('Acc_No', $acc_no)->first()->update(['Cmp_No' => $request->Cmp_No]);
                    }
                }
            }

            return redirect(aurl('departments'))->with(session()->flash('message',trans('admin.success_update')));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $chart = MtsChartAc::where('Acc_No', $id)
            ->where('Cmp_No', session('Chart_Cmp_No'))
            ->first();
        $children = MtsChartAc::where('Parnt_Acc', $chart->Acc_No)
            ->where('Cmp_No', session('Chart_Cmp_No'))->get();
        if(count($children) > 0){
            return redirect(aurl('departments'))->with(session()->flash('error',trans('admin.chart_has_children')));
        }
        else{
            $chart->delete();
            return redirect(aurl('departments'))->with(session()->flash('message',trans('admin.success_deleted')));
        }
    }

    public function reports()
    {
//        $title = trans('admin.Departments_reports');
        $mainCompany = MainCompany::pluck('Cmp_Nm'.ucfirst(session('lang')), 'Cmp_No');

        return view('admin.basic_reports.Departments.dep_report',compact('mainCompany'));
    }

    public function goTree(Request $request){
        $mainCompany = MainCompany::pluck('Cmp_Nm'.ucfirst(session('lang')), 'Cmp_No');
        return view('admin.departments.reports.gotree',compact('mainCompany'));
    }

    //print tree
    public function print(Request $request)
    {
//dd($request->all());
//        $departments = sumdepartment(15);
        //$departments = MtsChartAc::orderBy('code')->get();
        $departments = MtsChartAc::where('Cmp_No' , $request->mainCompany)->orderBy('Acc_No')->get();


//        dd($departments);
        $config = ['instanceConfigurator' => function($mpdf) {
            $mpdf->SetHTMLFooter('
                    <div style="font-size:10px;width:25%;float:right">Print Date: {DATE j-m-Y H:m}</div>
                    <div style="font-size:10px;width:25%;float:left;direction:ltr;text-align:left">Page {PAGENO} of {nbpg}</div>'
            );
        }];
        $pdf = Pdf::loadView('admin.basic_reports.departments.print', compact('departments'),[], $config);
        return $pdf->stream();
    }

    public function dep_report_select(Request $request)
    {
        if($request->ajax())
        {
            $mainCompany = $request->mainCompany;
            $active = $request->active;
            $notactive = $request->notactive;
            $myradio = $request->value;
            if($myradio =='level')
            {
                $levels = MtsChartAc::where('Cmp_No', $mainCompany)->groupBy('Level_No')->pluck('Level_No');
                return $data = view('admin.basic_reports.Departments.show',compact('active','notactive','levels','myradio','mainCompany'))->render();

            }elseif ( $myradio == 'accTarseed')
            {
                $acc_tarseed = MtsChartAc::where('Cmp_No',$mainCompany)->where('Level_Status',0)->get();
                return $data = view('admin.basic_reports.Departments.show',compact('active','notactive','myradio','acc_tarseed','mainCompany'))->render();
            }
            elseif ( $myradio == 'debit')
            {
                return $data = view('admin.basic_reports.Departments.show',compact('active','notactive','myradio','mainCompany'))->render();
            }
            else if($myradio == 'parent')
            {
                return $data = view('admin.basic_reports.Departments.show',compact('active','notactive','myradio','mainCompany'))->render();
            }else if($myradio == 'chiled')
            {
                return $data = view('admin.basic_reports.Departments.show',compact('active','notactive','myradio','mainCompany'))->render();
            }
            else if($myradio == 'credit')
            {
                return $data = view('admin.basic_reports.Departments.show',compact('active','notactive','myradio','mainCompany'))->render();
            }

//
        }
    }


    public function DepReportPrint(Request $request){
        if($request->ajax())

        {
            $active = $request->active;
            $notactive = $request->notactive;
            $mainCompany = $request->mainCompany;
            $myradio = $request->myradio;
            $selecd_input = $request->selecd_input;

            return $data=  view('admin.basic_reports.Departments.ajax.DP_report_print',compact('active','notactive','selecd_input','myradio','mainCompany'))->render();

        }
    }
    public function DepReportpdf(Request $request){
        $mainCompany = $request->mainCompany;
        $myradio = $request->myradio;
        $value = $request->selecd_input;
        if($myradio == 'level') {
            $products = [];
            $products = MtsChartAc::where('Cmp_No',$mainCompany)->where('Level_No',$value)->get();
            $config = ['instanceConfigurator' => function($mpdf) {
                $mpdf->SetHTMLFooter('
            <div style="font-size:10px;width:25%;float:right">Print Date: {DATE j-m-Y H:m}</div>
                <div style="font-size:10px;width:25%;float:left;direction:ltr;text-align:left">Page {PAGENO} of {nbpg}</div>'
                );
            }];

            $pdf = PDF::loadView('admin.basic_reports.Departments.pdf.report', compact('products'), [], $config);
            return $pdf->stream();

//            while(count($departments) > 0){
//                $nextCategories = [];
//                foreach ($departments as $category) {
//                    $products = array_merge($products, $category->children->all());
//                    $nextCategories = array_merge($nextCategories, $category->children->all());
//                }
//                $departments = $nextCategories;
//            }
//@dd($products);
        }
        if($myradio == 'accTarseed') {
            $products = [];
            $departments = MtsChartAc::where('Cmp_No',$mainCompany)->where('ID_No',$value)->get();
            while(count($departments) > 0){
                $nextCategories = [];
                foreach ($departments as $category) {
                    $products = array_merge($products, $category->children->all());
                    $nextCategories = array_merge($nextCategories, $category->children->all());
                }
                $departments = $nextCategories;
            }
            $config = ['instanceConfigurator' => function($mpdf) {
                $mpdf->SetHTMLFooter('
            <div style="font-size:10px;width:25%;float:right">Print Date: {DATE j-m-Y H:m}</div>
                <div style="font-size:10px;width:25%;float:left;direction:ltr;text-align:left">Page {PAGENO} of {nbpg}</div>'
                );
            }];
            $pdf = PDF::loadView('admin.basic_reports.Departments.pdf.report2', compact('products'), [], $config);
            return $pdf->stream();

        }
        if($value == 'debit') {
            $products = [];
            $products = MtsChartAc::where('Cmp_No',$mainCompany)->whereRaw('Fbal_DB > Fbal_CR')->get();
            $config = ['instanceConfigurator' => function($mpdf) {
                $mpdf->SetHTMLFooter('
            <div style="font-size:10px;width:25%;float:right">Print Date: {DATE j-m-Y H:m}</div>
                <div style="font-size:10px;width:25%;float:left;direction:ltr;text-align:left">Page {PAGENO} of {nbpg}</div>'
                );
            }];

            $pdf = PDF::loadView('admin.basic_reports.Departments.pdf.report', compact('products'), [], $config);
            return $pdf->stream();
        }
        if($value == 'parent') {
            $products = [];
            $products = MtsChartAc::where('Cmp_No',$mainCompany)->where('Level_Status',0)->get();
            $config = ['instanceConfigurator' => function($mpdf) {
                $mpdf->SetHTMLFooter('
            <div style="font-size:10px;width:25%;float:right">Print Date: {DATE j-m-Y H:m}</div>
                <div style="font-size:10px;width:25%;float:left;direction:ltr;text-align:left">Page {PAGENO} of {nbpg}</div>'
                );
            }];

            $pdf = PDF::loadView('admin.basic_reports.Departments.pdf.report', compact('products'), [], $config);
            return $pdf->stream();
        }
        if($value == 'chiled') {
            $products = [];
            $products = MtsChartAc::where('Cmp_No',$mainCompany)->where('Level_Status',1)->get();
            $config = ['instanceConfigurator' => function($mpdf) {
                $mpdf->SetHTMLFooter('
            <div style="font-size:10px;width:25%;float:right">Print Date: {DATE j-m-Y H:m}</div>
                <div style="font-size:10px;width:25%;float:left;direction:ltr;text-align:left">Page {PAGENO} of {nbpg}</div>'
                );
            }];

            $pdf = PDF::loadView('admin.basic_reports.Departments.pdf.report', compact('products'), [], $config);
            return $pdf->stream();
        }
        if($value == 'credit') {
            $products = [];
            $products = MtsChartAc::where('Cmp_No',$mainCompany)->whereRaw('Fbal_DB < Fbal_CR')->get();
            $config = ['instanceConfigurator' => function($mpdf) {
                $mpdf->SetHTMLFooter('
            <div style="font-size:10px;width:25%;float:right">Print Date: {DATE j-m-Y H:m}</div>
                <div style="font-size:10px;width:25%;float:left;direction:ltr;text-align:left">Page {PAGENO} of {nbpg}</div>'
                );
            }];

            $pdf = PDF::loadView('admin.basic_reports.Departments.pdf.report', compact('products'), [], $config);
            return $pdf->stream();
        }


    }

//    public function DepReportpdf(Request $request)
//    {
////        dd($request->all());
//        $mainCompany = $request->mainCompany;
//        $myradio = $request->value;
//        $value = $request->selecd_input;
//        if($myradio == 'bransh')
//        {
//
//            if ($request->active == 1 && $request->notactive == null){
//                $MtsChartAc = MtsChartAc::where('Brn_No',$value)->where('Cmp_No' , $request->mainCompany)->where('Cstm_Active',$request->active)->get();
//            }elseif ($request->active == null && $request->notactive == 0){
//                $MtsChartAc = MtsChartAc::where('Brn_No',$value)->where('Cmp_No' , $request->mainCompany)->where('Cstm_Active',$request->notactive)->get();
//            }elseif ($request->active == 1 && $request->notactive == 0){
//                $MtsChartAc = MtsChartAc::where('Brn_No',$value)->where('Cmp_No' , $request->mainCompany)->get();
//            }
//
//        }if($myradio == 'accTarseed')
//    {
//
//        $parent = MtsChartAc::where('Acc_No', $Parnt_Acc)
//            ->where('Cmp_No', session('Chart_Cmp_No'))
//            ->first();
//
//    }if($myradio == 'ActivityTypes')
//    {
//
//        if ($request->active == 1 && $request->notactive == null){
//            $MtsChartAc = MtsChartAc::where('Nutr_No',$value)->where('Cmp_No' , $request->mainCompany)->where('Cstm_Active',$request->active)->get();
//        }elseif ($request->active == null && $request->notactive == 0){
//            $MtsChartAc = MtsChartAc::where('Nutr_No',$value)->where('Cmp_No' , $request->mainCompany)->where('Cstm_Active',$request->notactive)->get();
//        }elseif ($request->active == 1 && $request->notactive == 0){
//            $MtsChartAc = MtsChartAc::where('Nutr_No',$value)->where('Cmp_No' , $request->mainCompany)->get();
//        }
//
//    }
//        if($myradio == 'country')
//        {
//            if ($request->active == 1 && $request->notactive == null){
//                $MtsChartAc = MtsChartAc::where('Cntry_No',$value)->where('Cmp_No' , $request->mainCompany)->where('Cstm_Active',$request->active)->get();
//            }elseif ($request->active == null && $request->notactive == 0){
//                $MtsChartAc = MtsChartAc::where('Cntry_No',$value)->where('Cmp_No' , $request->mainCompany)->where('Cstm_Active',$request->notactive)->get();
//            }elseif ($request->active == 1 && $request->notactive == 0){
//                $MtsChartAc = MtsChartAc::where('Cntry_No',$value)->where('Cmp_No' , $request->mainCompany)->get();
//            }
//
//
//
//        }if($myradio == 'city')
//    {
//        if ($request->active == 1 && $request->notactive == null){
//            $MtsChartAc = MtsChartAc::where('City_No',$value)->where('Cmp_No' , $request->mainCompany)->where('Cstm_Active',$request->active)->get();
//        }elseif ($request->active == null && $request->notactive == 0){
//            $MtsChartAc = MtsChartAc::where('City_No',$value)->where('Cmp_No' , $request->mainCompany)->where('Cstm_Active',$request->notactive)->get();
//        }elseif ($request->active == 1 && $request->notactive == 0){
//            $MtsChartAc = MtsChartAc::where('City_No',$value)->where('Cmp_No' , $request->mainCompany)->get();
//        }
//
//    }if($myradio == 'MtsChartAc')
//    {
//
//        if ($request->active == 1 && $request->notactive == null){
//            $MtsChartAc = MtsChartAc::where('Acc_No',$value)->where('Cmp_No' , $request->mainCompany)->where('Cstm_Active',$request->active)->get();
//        }elseif ($request->active == null && $request->notactive == 0){
//            $MtsChartAc = MtsChartAc::where('Acc_No',$value)->where('Cmp_No' , $request->mainCompany)->where('Cstm_Active',$request->notactive)->get();
//        }elseif ($request->active == 1 && $request->notactive == 0){
//            $MtsChartAc = MtsChartAc::where('Acc_No',$value)->where('Cmp_No' , $request->mainCompany)->get();
//        }
//
//    }if($myradio == 'AstMarket')
//    {
//        if ($request->active == 1 && $request->notactive == null){
//            $MtsChartAc = MtsChartAc::where('Mrkt_No',$value)->where('Cmp_No' , $request->mainCompany)->where('Cstm_Active',$request->active)->get();
//        }elseif ($request->active == null && $request->notactive == 0){
//            $MtsChartAc = MtsChartAc::where('Mrkt_No',$value)->where('Cmp_No' , $request->mainCompany)->where('Cstm_Active',$request->notactive)->get();
//        }elseif ($request->active == 1 && $request->notactive == 0){
//            $MtsChartAc = MtsChartAc::where('Mrkt_No',$value)->where('Cmp_No' , $request->mainCompany)->get();
//        }
//    }
//
//        //dd($MTsCustomer[1]->delegate());
//
//        $config = ['instanceConfigurator' => function($mpdf) {
//            $mpdf->SetHTMLFooter('
//                    <div style="font-size:10px;width:25%;float:right">Print Date: {DATE j-m-Y H:m}</div>
//                    <div style="font-size:10px;width:25%;float:left;direction:ltr;text-align:left">Page {PAGENO} of {nbpg}</div>'
//            );
//        }];
//
//        $pdf = Pdf::loadView('admin.basic_reports.customer.pdf.cust', compact('MTsCustomer'),[], $config);
//        return $pdf->stream();
//    }

    public function details(Request $request)
    {
        if($request->ajax()){
            $typeRange = $request->typeRange;
            $type = $request->type;
            if ($typeRange != null){
                $contents = view('admin.departments.reports.details', compact('typeRange', 'type'))->render();
                return $contents;

            }

            if ($type != null){

                $contents = view('admin.departments.reports.details', compact('typeRange', 'type'))->render();
                return $contents;
            }
        }
    }

//    public function pdf(Request $request) {
//        $typeRange = $request->typeRange;
//        $type = $request->type;
//        $search = $request->search;
//        if ($search == 6){
//            $departments = Department::where('cc_id','!=',null)->get();
//            $config = ['instanceConfigurator' => function($mpdf) {
//                $mpdf->SetHTMLFooter('
//                    <div style="font-size:10px;width:25%;float:right">Print Date: {DATE j-m-Y H:m}</div>
//                        <div style="font-size:10px;width:25%;float:left;direction:ltr;text-align:left">Page {PAGENO} of {nbpg}</div>'
//                );
//            }];
//            $pdf = PDF::loadView('admin.departments.reports.pdf.report', compact('departments'), [], $config);
//            return $pdf->stream();
//        }
//        if ($typeRange != null){
//            $departments = Department::where('level_id',$typeRange)->get();
//            $config = ['instanceConfigurator' => function($mpdf) {
//                $mpdf->SetHTMLFooter('
//                    <div style="font-size:10px;width:25%;float:right">Print Date: {DATE j-m-Y H:m}</div>
//                        <div style="font-size:10px;width:25%;float:left;direction:ltr;text-align:left">Page {PAGENO} of {nbpg}</div>'
//                );
//            }];
//            $pdf = PDF::loadView('admin.departments.reports.pdf.report', compact('departments'), [], $config);
//            return $pdf->stream();
//        }
//        if ($type != null){
//                $products = [];
//                $departments = Department::where('id',$type)->get();
//                while(count($departments) > 0){
//                    $nextCategories = [];
//                    foreach ($departments as $category) {
//                        $products = array_merge($products, $category->children->all());
//                        $nextCategories = array_merge($nextCategories, $category->children->all());
//                    }
//                    $departments = $nextCategories;
//                }
//            $config = ['instanceConfigurator' => function($mpdf) {
//                $mpdf->SetHTMLFooter('
//                    <div style="font-size:10px;width:25%;float:right">Print Date: {DATE j-m-Y H:m}</div>
//                        <div style="font-size:10px;width:25%;float:left;direction:ltr;text-align:left">Page {PAGENO} of {nbpg}</div>'
//                );
//            }];
//            $pdf = PDF::loadView('admin.departments.reports.pdf.report', compact('products'), [], $config);
//            return $pdf->stream();
//        }
//
//            if ($search == '2'){
//                $departments = Department::where('category','0')->get();
//            }elseif ($search == '3'){
//                $departments = Department::where('category','1')->get();
//            }elseif ($search == '4'){
//                $departments = Department::where('type','0')->get();
//            }elseif ($search == '5'){
//                $departments = Department::where('type','1')->get();
//            }elseif ($search == '6'){
//                $departments = glcc::where('type','1')->get();
//                $config = ['instanceConfigurator' => function($mpdf) {
//                    $mpdf->SetHTMLFooter('
//                    <div style="font-size:10px;width:25%;float:right">Print Date: {DATE j-m-Y H:m}</div>
//                    <div style="font-size:10px;width:25%;float:left;direction:ltr;text-align:left">Page {PAGENO} of {nbpg}</div>'
//                    );
//                }];
//                $pdf = PDF::loadView('admin.departments.reports.pdf.cc', compact('departments'), [], $config);
//                return $pdf->stream();
//            }
//            $config = ['instanceConfigurator' => function($mpdf) {
//                $mpdf->SetHTMLFooter('
//                    <div style="font-size:10px;width:25%;float:right">Print Date: {DATE j-m-Y H:m}</div>
//                    <div style="font-size:10px;width:25%;float:left;direction:ltr;text-align:left">Page {PAGENO} of {nbpg}</div>'
//                );
//            }];
//            $pdf = PDF::loadView('admin.departments.reports.pdf.report', compact('departments'), [], $config);
//            return $pdf->stream();
//    }
    public function Review( )
    {
//        $operations = operation::whereIn('receipt',[1,2])->pluck('name_'.session('lang'),'id');
//        $branches = Branches::pluck('name_'.session('lang'),'id');
        $limitationReceipts = limitationReceipts::pluck('name_'.session('lang'),'id');
        $title = trans('admin.daily_report');
        return view('admin.departments.review',compact('limitationReceipts'));
    }

    public function reviewdepartment(Request $request)
    {
        $type = $request->type;
        $startdate = $request->startdate;
        $enddate = $request->enddate;

        $limitations_1 = [];
        $limitations_2 = [];
        $limitations_3 = [];

        $receipts_1 = [];
        $receipts_2 = [];
        $receipts_3= [];
//dd(dep_name_ar != name_ar);
        $limitations_1 = limitationsType::where('operation_id', '=', 4)
            ->where('limitations_type.tree_id', '=', \DB::raw('limitations_type.relation_id'))
            ->whereHas('departments', function ($qu) {

                $qu->where('dep_name_ar', '!=', \DB::raw('limitations_type.name_ar'));
            })->whereHas('limitations',
                function ($q) use ($type) {

                    $q->where('limitationsType_id', '=', $type);
                })->get();

//dd($limitations_1);

        $limitations_2 = limitationsType::where('operation_id', '=', 4)->where('limitations_type.tree_id', '!=', \DB::raw('limitations_type.relation_id'))->whereHas('limitations',
            function ($query) use ($type) {
                $query->where('limitationsType_id', '=', $type);


            })->get();


//        $limitations_2 = limitationsType::where('operation_id', '=', 4)->where('limitations_type.tree_id', '!=', \DB::raw('limitations_type.relation_id'))->whereHas('limitations',
//            function ($query) use ($type) {
//                $query->where('limitationsType_id', '=', $type);
//
//
//            })->get();

//dd(tree_id  != relation_id);


        $Errorlimitations_3 = limitationsType::whereHas('limitations',
            function ($query) use ($type) {
                $query->where('limitationsType_id', '=', $type);


            })->get();

        foreach ($Errorlimitations_3 as $one) {

            if ($one->operation_id == 1) {
                $tree = supplier::where('id', $one->relation_id)->first()['tree_id'];

                $limitations_3 = limitationsType::where('operation_id', '=', 1)->where('tree_id', '!=', $tree)->whereHas('limitations',
                    function ($query) use ($type) {
                        $query->where('limitationsType_id', '=', $type);


                    })->get();

            } elseif ($one->operation_id == 3) {
                $tree = Project::where('id', $one->relation_id)->first()['tree_id'];

                $limitations_3 = limitationsType::where('operation_id', '=', 3)->where('tree_id', '!=', $tree)->whereHas('limitations',
                    function ($query) use ($type) {
                        $query->where('limitationsType_id', '=', $type);


                    })->get();

            } elseif ($one->operation_id == 5) {
                $tree = employee::where('id', $one->relation_id)->first()['tree_id'];

                $limitations_3 = limitationsType::where('operation_id', '=', 5)->where('tree_id', '!=', $tree)->whereHas('limitations',
                    function ($query) use ($type) {
                        $query->where('limitationsType_id', '=', $type);


                    })->get();

            } elseif ($one->operation_id == 10) {
                $tree = Contractors::where('id', $one->relation_id)->first()['tree_id'];

                $limitations_3 = limitationsType::where('operation_id', '=', 10)->where('tree_id', '!=', $tree)->whereHas('limitations',
                    function ($query) use ($type) {
                        $query->where('limitationsType_id', '=', $type);


                    })->get();


            }


        }
        $receipts_1 = receiptsType::where('operation_id', '=', 4)
            ->where('receipts_type.tree_id', '!=', \DB::raw('receipts_type.relation_id'))->whereHas('receipts',
                function ($query) use ($type) {
                    $query->where('receiptsType_id', '=', $type);


                })->get();


        $receipts_2 = receiptsType::where('operation_id', '=', 4)
            ->where('receipts_type.tree_id', '=', \DB::raw('receipts_type.relation_id'))
            ->whereHas('departments', function ($qu) {

                $qu->where('dep_name_ar', '!=', \DB::raw('receipts_type.name_ar'));
            })->whereHas('receipts',
                function ($q) use ($type) {

                    $q->where('receiptsType_id', '=', $type);
                })->get();
//dd($receipts);




        $Errorreceipts_3 = receiptsType::whereHas('receipts',
            function ($query) use ($type) {
                $query->where('receiptsType_id', '=', $type);


            })->get();

        foreach ($Errorreceipts_3 as $one) {

            if ($one->operation_id == 1) {
                $tree = supplier::where('id', $one->relation_id)->first()['tree_id'];

                $receipts_3 = receiptsType::where('operation_id', '=', 1)->where('tree_id', '!=', $tree)->whereHas('receipts',
                    function ($query) use ($type) {
                        $query->where('receiptsType_id', '=', $type);


                    })->get();

            } elseif ($one->operation_id == 3) {
                $tree = Project::where('id', $one->relation_id)->first()['tree_id'];

                $receipts_3 = receiptsType::where('operation_id', '=', 3)->where('tree_id', '!=', $tree)->whereHas('receipts',
                    function ($query) use ($type) {
                        $query->where('receiptsType_id', '=', $type);


                    })->get();

            } elseif ($one->operation_id == 5) {
                $tree = employee::where('id', $one->relation_id)->first()['tree_id'];

                $receipts_3 = receiptsType::where('operation_id', '=', 5)->where('tree_id', '!=', $tree)->whereHas('receipts',
                    function ($query) use ($type) {
                        $query->where('receiptsType_id', '=', $type);


                    })->get();

            } elseif ($one->operation_id == 10) {
                $tree = Contractors::where('id', $one->relation_id)->first()['tree_id'];

                $receipts_3 = receiptsType::where('operation_id', '=', 10)->where('tree_id', '!=', $tree)->whereHas('receipts',
                    function ($query) use ($type) {
                        $query->where('receiptsType_id', '=', $type);


                    })->get();


            }


        }

        return view('admin.departments.ajax.error', compact('receipts_1','receipts_2','receipts_3', 'limitations_1', 'limitations_2', 'limitations_3'))->render();


    }

    //create new Acc_No
    public function createAccNo($Parnt_Acc){
        if($Parnt_Acc == 0){
            $chart = MtsChartAc::where('Parnt_Acc', 0)
                ->where('Cmp_No', session('Chart_Cmp_No'))
                ->orderBy('Acc_No', 'desc')->get(['Acc_No'])->first();
            if($chart){
                $Acc_No = $chart->Acc_No + 1;
                return $Acc_No;
            }
            else{
                $Acc_No = 1;
                return $Acc_No;
            }
        }
        else{
            $parent = MtsChartAc::where('Acc_No', $Parnt_Acc)
                ->where('Cmp_No', session('Chart_Cmp_No'))
                ->first();

            $max = MtsChartAc::where('Parnt_Acc', $parent->Acc_No)
                ->where('Cmp_No', session('Chart_Cmp_No'))
                ->orderBy('Acc_No', 'desc')->get(['Acc_No'])->first();
            if($max){
                return $max->Acc_No + 1;
            }
            else{
                $Acc_No = (int)$Parnt_Acc.'01';
                return $Acc_No;
            }


            // $chart = MtsChartAc::where('Parnt_Acc', $Parnt_Acc)->orderBy('Acc_No', 'desc')->get(['Acc_No'])->first();
            // if($chart){
            //     $index = explode('0', $chart->Acc_No);
            //     $counter = (int)$index[count($index)-1] + 1;
            //     $Acc_No = (int)$Parnt_Acc.'0'.$counter;
            //     return $Acc_No;
            // }
            // else{
            //     $Acc_No = (int)$Parnt_Acc.'01';
            //     return $Acc_No;
            // }
        }
    }


    public function getTotalTransaction($chart){
        // اجمالى الحركة مدين
        $total_debit = $chart->DB11 + $chart->DB12 + $chart->DB13 + $chart->DB14 + $chart->DB15 + $chart->DB16
            + $chart->DB17 + $chart->DB18 + $chart->DB19 + $chart->DB20 + $chart->DB21 + $chart->DB22;

        // اجمالى الحركه دائن
        $total_credit = $chart->CR11 + $chart->CR12 + $chart->CR13 + $chart->CR14 + $chart->CR15 + $chart->CR16
            + $chart->CR17 + $chart->CR18 + $chart->CR19 + $chart->CR20 + $chart->CR21 + $chart->CR22;

        // اجمالى الرصيد
        $total_balance = ($chart->Fbal_DB - $chart->Fbal_CR) + ($total_debit - $total_credit);

        $total[] = (object) array('total_debit' => $total_debit,
            'total_credit' => $total_credit,
            'total_balance' => $total_balance);
        return $total;
    }

    public function getTree(Request $request){
        if($request->ajax()){
            session(['Chart_Cmp_No' => $request->Cmp_No]);
            $tree = load_dep('parent_id', null, $request->Cmp_No);
            return $tree;
        }
    }
}

