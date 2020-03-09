<?php

namespace App\Http\Controllers\Admin\employees;

use App\DataTables\employeeDataTable;
use App\Models\Admin\HREmpCnt;
use App\Models\Admin\GLaccBnk;
use App\Models\Hr\LocClass;
use App\Models\Hr\pyjobs;
use App\Models\Hr\DepmCmp;
use App\Http\Controllers\Controller;
use App\Models\Admin\MainCompany;
use App\Models\Admin\MtsChartAc;
use App\Models\Admin\Projectmfs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Up;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(employeeDataTable $driver)
    {
        return $driver->render('admin.employees.index',['title'=>trans('admin.employees')]);
    }


    public function create()
    {
        $companies = MainCompany::get();
        $accounts = MtsChartAc::where('Acc_Typ', 4)->get();
        $dep = LocClass::get();
        $pyjobs = pyjobs::get();
        $depmCmp = DepmCmp::get();
        $flags = GLaccBnk::all();
        // مسموح بظهور البنوك 
        $banks = [];
        foreach ($flags as $flag) {
            if ($flag->Bank_No == 1) {
                array_push($banks, $flag);
            }
        }
        //$projects = Projectmfs::where('Level_Status', 0)->get();
        $last = HREmpCnt::orderBy('ID_No', 'DESC')->latest()->first(); //latest record
//        dd($last);
        if(!empty($last) || $last || $last < 0){
            $last = $last->Emp_No +1;
        }else{
            $last =  1;
        }

        return view('admin.employees.create', compact('companies','accounts', 'last', 'dep', 'pyjobs', 'depmCmp', 'projects', 'banks', 'flags'),['title'=> trans('admin.Create_new_employees')]);
    }

    public function getProjects(Request $request)
    {
        $projects = Projectmfs::where('Cmp_No', $request->Cmp_No)->where('Level_Status', 0)->get();
        return view('admin.employees.get_projects', compact('projects'));
    }

    public function getProjectsChild(Request $request)
    {
        $prj_no = $request->Prj_No;
        if($request->ajax()){
            $project_child = Projectmfs::where('Prj_Parnt', $prj_no)->get();
            return view('admin.employees.get_childs', compact('project_child'));
        }

    }

    public function store(Request $request)
    {
//        dd($request->all());
        $data = $this->validate($request, [
            'Cmp_No'    => 'required',
            'Emp_Type'  => 'sometimes',
            'Emp_No'    => 'sometimes',
            'SubCmp_No' => 'sometimes',
            'Emp_SubNo' => 'sometimes',
            'Depm_No'   => 'sometimes',
            'Job_Stu'   => 'sometimes',
            'Job_No'    => 'sometimes',
            'Job_Date'  => 'sometimes',
            'Shift_Type' => 'sometimes',
            'Salary_Class_No' => 'sometimes',
            'Huspym_No' => 'sometimes',
            'HusTyp_No' => 'sometimes',
            'Gender'    => 'sometimes',
            'Specl_Need' => 'sometimes',
            'Specl_NeedTyp' => 'sometimes',
            'Cntry_No'  => 'sometimes',
            'Pymnt_No'  => 'sometimes',
            'Cnt_Period'=> 'sometimes',
            'Bsc_Salary'=> 'sometimes',
            'Hous_Alw'  => 'sometimes',
            'Emp_NmAr'  => 'required',
            'Emp_NmEn'  => 'required',
            'Trnsp_Alw' => 'sometimes',
            'Food_Alw' => 'sometimes',
            'Other_Alw' => 'sometimes',
            'Add_Alw' => 'sometimes',
            'ALw1' => 'sometimes',
            'ALw2' => 'sometimes',
            'ALw3' => 'sometimes',
            'ALw4' => 'sometimes',
            'ALw5' => 'sometimes',
            'Gross_Salary'  => 'sometimes',
            'Wrk_Hour'      => 'sometimes',
            'Wrk_CostHour'  => 'sometimes',
            'Total_Wrk_CostHour' => 'sometimes',
            'Wrk_OvrTime'   => 'sometimes',
            'OvrTime_Rate'  => 'sometimes',
            'OvrTime_HR1'   => 'sometimes',
            'OvrTime_HR2'   => 'sometimes',
            'OvrTime_HR3'   => 'sometimes',
            'Lunch_hour'    => 'sometimes',
            'Cnt_Stdt'      => 'sometimes',
            'Cnt_StdtHij'   => 'sometimes',
            'Cnt_Endt'      => 'sometimes',
            'Cnt_EndtHij'   => 'sometimes',
            'Cnt_Nwdt'      => 'sometimes',
            'Cnt_NwdtHij'   => 'sometimes',
            'Start_Date'    => 'sometimes',
            'Start_DateHij' => 'sometimes',
            'Dection_ExpireDt'=> 'sometimes',
            'Bouns_Prct'    => 'sometimes',
            'Start_Paid'    => 'sometimes',
            'Start_UnPaid'  => 'sometimes',
            'Fbal_Db'       => 'sometimes',
            'Fbal_CR'       => 'sometimes',
            'Acc_NoDb1'     => 'sometimes',
            'Prj_No'        => 'sometimes',
            'PjLoc_No'      => 'sometimes',
            'Tkt_No2'       => 'sometimes',
            'Tkt_Class2'    => 'sometimes',
            'Tkt_Sector2'   => 'sometimes',
            'Tkt_No'        => 'sometimes',
        ],
        [
            'Cmp_No'   => trans('admin.Cmp_No'),
            'Emp_NmAr' => trans('admin.arabic_name'),
            'Emp_NmEn' => trans('admin.english_name'),
            'Emp_No'   => trans('admin.numberr'),
        ]);

        if($request->Wrk_OvrTime){
            $data['Wrk_OvrTime'] = $request->Wrk_OvrTime;
        }else{
            $data['Wrk_OvrTime'] = 0;
        }
        HREmpCnt::create($data);
        return redirect(aurl('employees'))->with(session()->flash('message',trans('admin.success_add')));

//        return view('admin.employees.index')->with(session()->flash('message',trans('admin.success_add')));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $hr = HREmpCnt::findOrFail($id);
        $companies = MainCompany::get();
        $accounts = MtsChartAc::where('Acc_Typ', 4)->get();
        $dep = LocClass::get();
        $pyjobs = pyjobs::get();
        $depmCmp = DepmCmp::get();
        $flags = GLaccBnk::all();
        // مسموح بظهور البنوك 
        $banks = [];
        foreach ($flags as $flag) {
            if ($flag->Bank_No == 1) {
                array_push($banks, $flag);
            }
        }
        return view('admin.employees.show', compact('hr', 'companies', 'accounts', 'dep', 'pyjobs', 'depmCmp', 'banks'),['title'=> trans('admin.show_employee')]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $hr = HREmpCnt::findOrFail($id);
        $companies = MainCompany::get();
        $accounts = MtsChartAc::where('Acc_Typ', 4)->get();
        $dep = LocClass::get();
        $pyjobs = pyjobs::get();
        $depmCmp = DepmCmp::get();
        $flags = GLaccBnk::all();
        // مسموح بظهور البنوك 
        $banks = [];
        foreach ($flags as $flag) {
            if ($flag->Bank_No == 1) {
                array_push($banks, $flag);
            }
        }

        return view('admin.employees.edit', compact('hr', 'companies', 'accounts', 'dep', 'pyjobs', 'depmCmp', 'banks'),['title'=> trans('admin.edit_employee')]);
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
        $data = $this->validate($request, [
            'Cmp_No'    => 'required',
            'Emp_Type'  => 'sometimes',
            'Emp_No'    => 'sometimes',
            'SubCmp_No' => 'sometimes',
            'Emp_SubNo' => 'sometimes',
            'Depm_No'   => 'sometimes',
            'Job_Stu'   => 'sometimes',
            'Job_No'    => 'sometimes',
            'Job_Date'  => 'sometimes',
            'Shift_Type' => 'sometimes',
            'Salary_Class_No' => 'sometimes',
            'Huspym_No' => 'sometimes',
            'HusTyp_No' => 'sometimes',
            'Gender'    => 'sometimes',
            'Specl_Need' => 'sometimes',
            'Specl_NeedTyp' => 'sometimes',
            'Cntry_No'  => 'sometimes',
            'Pymnt_No'  => 'sometimes',
            'Cnt_Period'=> 'sometimes',
            'Bsc_Salary'=> 'sometimes',
            'Hous_Alw'  => 'sometimes',
            'Emp_NmAr'  => 'required',
            'Emp_NmEn'  => 'required',
            'Trnsp_Alw' => 'sometimes',
            'Food_Alw' => 'sometimes',
            'Other_Alw' => 'sometimes',
            'Add_Alw' => 'sometimes',
            'ALw1' => 'sometimes',
            'ALw2' => 'sometimes',
            'ALw3' => 'sometimes',
            'ALw4' => 'sometimes',
            'ALw5' => 'sometimes',
            'Gross_Salary'  => 'sometimes',
            'Wrk_Hour'      => 'sometimes',
            'Wrk_CostHour'  => 'sometimes',
            'Total_Wrk_CostHour' => 'sometimes',
            'Wrk_OvrTime'   => 'sometimes',
            'OvrTime_Rate'  => 'sometimes',
            'OvrTime_HR1'   => 'sometimes',
            'OvrTime_HR2'   => 'sometimes',
            'OvrTime_HR3'   => 'sometimes',
            'Lunch_hour'    => 'sometimes',
            'Cnt_Stdt'      => 'sometimes',
            'Cnt_StdtHij'   => 'sometimes',
            'Cnt_Endt'      => 'sometimes',
            'Cnt_EndtHij'   => 'sometimes',
            'Cnt_Nwdt'      => 'sometimes',
            'Cnt_NwdtHij'   => 'sometimes',
            'Start_Date'    => 'sometimes',
            'Start_DateHij' => 'sometimes',
            'Dection_ExpireDt'=> 'sometimes',
            'Bouns_Prct'    => 'sometimes',
            'Start_Paid'    => 'sometimes',
            'Start_UnPaid'  => 'sometimes',
            'Fbal_Db'       => 'sometimes',
            'Fbal_CR'       => 'sometimes',
            'Acc_NoDb1'     => 'sometimes',
            'Prj_No'        => 'sometimes',
            'PjLoc_No'      => 'sometimes',
            'Tkt_No2'       => 'sometimes',
            'Tkt_Class2'    => 'sometimes',
            'Tkt_Sector2'   => 'sometimes',
            'Tkt_No'        => 'sometimes',
        ],
            [
                'Cmp_No'   => trans('admin.Cmp_No'),
                'Emp_NmAr' => trans('admin.arabic_name'),
                'Emp_NmEn' => trans('admin.english_name')
            ]);
        $hr = HREmpCnt::findOrFail($id);
        if($request->Wrk_OvrTime){
            $data['Wrk_OvrTime'] = $request->Wrk_OvrTime;
        }else{
            $data['Wrk_OvrTime'] = 0;
        }
        $hr->update($data);
        return redirect(aurl('employees'))->with(session()->flash('message',trans('admin.success_update')));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hr = HREmpCnt::findOrFail($id);
        $hr->delete();
        return redirect(aurl('employees'));
    }
}
