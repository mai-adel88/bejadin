<?php

namespace App\Http\Controllers\Hr\settings;

use App\Models\Hr\HrDprtmntLoctn;
use App\Models\Hr\HRMainCmpnam;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HrDprtmntLoctnController extends Controller
{
    
    public function index()
    {
        $chart = HrDprtmntLoctn::get(['DepmLoc_Nm'.ucfirst(session('lang'))]);
        if(count($chart) > 0){
            if(session('Cmp_No') == -1){
                $cmps = HRMainCmpnam::get(['Cmp_Nm'.ucfirst(session('lang')), 'Cmp_No']);
            }
            else{
                $cmps = HRMainCmpnam::where('Cmp_No', session('Cmp_No'))->get(['Cmp_Nm'.ucfirst(session('lang')), 'Cmp_No'])->first();
            }

            $chart_item = HrDprtmntLoctn::first();
            return view('hr.settings.department_Location.index', ['title' => trans('hr.dep_loc'), 'cmps' => $cmps, 'chart_item'=>$chart_item]);
        }
        else{
            if(session('Cmp_No') == -1){
                $cmps = HRMainCmpnam::get(['Cmp_Nm'.ucfirst(session('lang')), 'Cmp_No']);
            }
            else{
                $cmps = HRMainCmpnam::where('Cmp_No', session('Cmp_No'))->get(['Cmp_Nm'.ucfirst(session('lang')), 'Cmp_No'])->first();
            }

            $Depm_No = $this->createDepNo(0);
            return view('hr.settings.department_Location.init_chart', compact('chart', 'cmps','Depm_No'));
    
        }
    }   

    //create new createDepNo
    public function createDepNo($Parnt_DepmLoc){
        //////رئيسي//////
        if($Parnt_DepmLoc == 0){  
            $chart = HrDprtmntLoctn::where('Parnt_DepmLoc', 0)->orderBy('DepmLoc_No', 'desc')->get(['DepmLoc_No'])->first();
            if($chart){
                $DepmLoc_No = $chart->DepmLoc_No + 1;
                return $DepmLoc_No;
            }
            else{
                $DepmLoc_No = 1;
                return $DepmLoc_No;
            }
        }
        ////// فرعي //////
        else{
            $parent = HrDprtmntLoctn::where('DepmLoc_No', $Parnt_DepmLoc)->first();
            if(count($parent->children) > 0){
                $max = HrDprtmntLoctn::where('Parnt_DepmLoc', $parent->DepmLoc_No)
                    ->where('Cmp_No', session('Chart_Cmp_No'))
                    ->orderBy('DepmLoc_No', 'desc')->get(['DepmLoc_No'])->first();
                return $max->DepmLoc_No + 1;
            }
            else{
                $DepmLoc_No = (int)$Parnt_DepmLoc.'01';
                return $DepmLoc_No;
            }

        }
    }


    public function getDepartments(Request $request){
        if($request->ajax()){
            session(['Chart_Cmp_No' => $request->Cmp_No]);
            $tree = load_depLoc('Parnt_DepmLoc', null, $request->Cmp_No);
            return $tree;
        }
    }

    public function initChartDepLoc(){
        if(session('Cmp_No') == -1){
            $cmps = HRMainCmpnam::get(['Cmp_Nm'.ucfirst(session('lang')), 'Cmp_No']);
        }
        else{
            $cmps = HRMainCmpnam::where('Cmp_No', session('Cmp_No'))->get(['Cmp_Nm'.ucfirst(session('lang')), 'Cmp_No'])->first();
        }
        $DepmLoc_No = $this->createDepNo(0);
        return view('hr.settings.department_Location.create_main_chart', ['title' => trans('hr.dep_loc')
            , 'cmps' => $cmps, 'DepmLoc_No' => $DepmLoc_No]);
    }

    ////// Double click on tree to create new child /////// 
    public function createNewDepNo(Request $request){
        if($request->ajax()){
            if($request->parent){
                $parent = HrDprtmntLoctn::where('DepmLoc_No', $request->parent)->get(['DepmLoc_No', 'Cmp_No', 'Level_No'])->first();
                $cmps = HRMainCmpnam::where('Cmp_No', $parent->Cmp_No)->get(['Cmp_No', 'Cmp_Nm'.ucfirst(session('lang'))])->first();
                $chart = HrDprtmntLoctn::get(['DepmLoc_Nm'.ucfirst(session('lang')), 'DepmLoc_No']);
                $DepmLoc_No = $this->createDepNo($parent->DepmLoc_No);
                return view('hr.settings.department_Location.create', ['title' => trans('hr.dep_loc'),
                    'parent' => $parent, 'cmps' => $cmps, 'chart' => $chart, 'DepmLoc_No' =>  $DepmLoc_No,
                     ]);
            }

        }
    }
    

    
    public function store(Request $request)
    {
        if($request->Level_Status == 0){
            $data = $this->validate($request,[
                'Cmp_No'       => 'required',
                'DepmLoc_NmAr' => 'required',
                'DepmLoc_NmEn' => 'required',
            ],[],[
                'Cmp_No'       => trans('admin.cmp_no'),
                'DepmLoc_NmAr' => trans('admin.arabic_name'),
                'DepmLoc_NmEn' => trans('admin.english_name'),
            ]);

            $chart = new HrDprtmntLoctn;
            $chart->Cmp_No = $request->Cmp_No;
            $chart->DepmLoc_NmAr = $request->DepmLoc_NmAr;
            $chart->DepmLoc_NmEn = $request->DepmLoc_NmEn;
            $chart->Level_No = 1;
            $chart->Parnt_DepmLoc = 0;
            $chart->Level_Status = 0;
            $chart->Ownr_No = $request->Ownr_No;
            $chart->DepmLoc_Actv = 1;
            $chart->Level_Status = 0;
            $chart->DepmLoc_No = $this->createDepNo($chart->Parnt_DepmLoc);
            $chart->save();
            return redirect()->route('departmentLoc.index')->with(session()->flash('message',trans('admin.success_add')));
        }
        else if($request->Level_Status == 1){
            $data = $this->validate($request,[
                'Cmp_No'       => 'required',
                'DepmLoc_NmAr' => 'required',
                'DepmLoc_NmEn' => 'required',

            ],[],[
                'Cmp_No'       => trans('admin.cmp_no'),
                'DepmLoc_NmAr' => trans('admin.arabic_name'),
                'DepmLoc_NmEn' => trans('admin.english_name'),
            ]);

            // return $request;
            $chart = new HrDprtmntLoctn;
            $chart->Cmp_No = $request->Cmp_No;
            $chart->DepmLoc_NmAr = $request->DepmLoc_NmAr;
            $chart->DepmLoc_NmEn = $request->DepmLoc_NmEn;
            $chart->Level_Status = $request->Level_Status;
            $parent = HrDprtmntLoctn::where('DepmLoc_No', $request->Parnt_DepmLoc)->get(['Level_No'])->first();
            $chart->Level_No = $parent->Level_No + 1;
            // dd($parent->Level_No );
            $chart->Parnt_DepmLoc = $request->Parnt_DepmLoc;
            // $chart->Costcntr_No = $this->createAccNo($chart->Parnt_Acc);
            $chart->DepmLoc_No = $request->DepmLoc_No;
            $chart->save();
            $parent_level = HrDprtmntLoctn::where('DepmLoc_No', $request->Parnt_DepmLoc)->first();
            if($parent_level){
                $parent_level->Level_Status = 0;
                $parent_level->save();
            }
            return redirect()->route('departmentLoc.index')->with(session()->flash('message',trans('admin.success_add')));
        }
    }

    public function getDepLocEditBlade(Request $request){
        if($request->ajax()){
            if(session('Cmp_No') == -1){
                $cmps = HRMainCmpnam::get(['Cmp_Nm'.ucfirst(session('lang')), 'Cmp_No']);
            }
            else{
                $cmps = HRMainCmpnam::where('Cmp_No', session('Cmp_No'))->get(['Cmp_Nm'.ucfirst(session('lang')), 'Cmp_No']);
            }
            $chart = HrDprtmntLoctn::get(['DepmLoc_Nm'.ucfirst(session('lang')), 'DepmLoc_No']);
            $chart_item =HrDprtmntLoctn::where('DepmLoc_No', $request->DepmLoc_No)
                ->where('Cmp_No', session('Chart_Cmp_No'))
                ->first();
            return view('hr.settings.department_Location.edit', ['title' => trans('hr.dep_loc'),
                'chart' => $chart, 'cmps' => $cmps, 'chart_item' => $chart_item,
                ]);
        }
    }



    public function update(Request $request, $id)
    {

        $chart = HrDprtmntLoctn::where('DepmLoc_No', $id)->where('Cmp_No', session('Chart_Cmp_No'))->first();
        if($chart->Level_Status == 0){

            $data = $this->validate($request,[
                'Cmp_No' => 'required',
                'DepmLoc_NmAr' => 'required',
                'DepmLoc_NmEn' => 'sometimes',
            ],[],[
                'Cmp_No' => trans('admin.cmp_no'),
                'DepmLoc_NmAr' => trans('admin.arabic_name'),
                'DepmLoc_NmEn' => trans('admin.english_name'),
            ]);

            $chart->Cmp_No = $request->Cmp_No;
            $chart->DepmLoc_NmAr = $request->DepmLoc_NmAr;
            $chart->DepmLoc_NmEn = $request->DepmLoc_NmEn;
            $chart->DepmLoc_No = $request->DepmLoc_No;
            $chart->save();
            return redirect()->route('departmentLoc.index')->with(session()->flash('message',trans('admin.success_update')));
        }
        else{
            $data = $this->validate($request,[
                'Cmp_No' => 'required',
                'DepmLoc_NmAr' => 'required',
                'DepmLoc_NmEn' => 'sometimes',

            ],[],[
                'Cmp_No' => trans('admin.cmp_no'),
                'DepmLoc_NmAr' => trans('admin.arabic_name'),
                'DepmLoc_NmEn' => trans('admin.english_name'),

            ]);

            $chart->Cmp_No = $request->Cmp_No;
            $chart->DepmLoc_NmAr = $request->DepmLoc_NmAr;
            $chart->DepmLoc_NmEn = $request->DepmLoc_NmEn;
            $chart->save();

            return redirect()->route('departmentLoc.index')->with(session()->flash('message',trans('admin.success_update')));
        }
    }

    


    public function destroy($id)
    {
        $chart = HrDprtmntLoctn::where('DepmLoc_No', $id)->first();
        if(count($chart->children) > 0){
            return back()->with(session()->flash('error',trans('admin.chart_has_children')));
        }
        else{
            $chart->delete();
            return redirect()->route('departmentLoc.index')->with(session()->flash('message',trans('admin.success_deleted')));
        }
    }
}
