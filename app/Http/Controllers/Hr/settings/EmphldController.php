<?php

namespace App\Http\Controllers\Hr\settings;

use App\Models\Hr\Pyjobs;
use App\Models\Hr\HrEmpmfs;
use App\Models\Hr\HREmpCnt;
use App\Models\Hr\HREmphld;
use App\Models\Hr\HRMainCmpnam;
use App\Models\Hr\PyempHLDInc;
use App\DataTables\Hr\EmpHldDataTable;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\EmpHldRequest;


class EmphldController extends Controller
{

    public function index(EmpHldDataTable $dataTable)
    {
        return $dataTable->render('hr.settings.emp_hld.index');
    }



    public function create()
    {
        $companies = HRMainCmpnam::get();   // الشركات
        $jobs      = Pyjobs::get();              // الوظائف

        return view('hr.settings.emp_hld.create', compact('companies', 'jobs'));

    }


    public function store(EmpHldRequest $request)
    {
        $validated = $request->validated();
        $emp_data = HREmphld::where('Emp_No', $request->Emp_No)->first();
        $emp_cnt  = HREmpCnt::where('Emp_No', $request->Emp_No)->first();
        $emp_pyemp= PyempHLDInc::where('Emp_No', $request->Emp_No)->first();

        if($request->Work_Yer || $request->Increase_Days || $request->Notes){
            $pyemp = $this->validate($request, [
                'Emp_No'        => 'sometimes',
                'Work_Yer'      => 'sometimes',
                'Increase_Days' => 'sometimes',
                'Notes'         => 'sometimes',
            ]);
            if($emp_pyemp == null){
                PyempHLDInc::create($pyemp);
            }else{
                $emp_pyemp->update($pyemp);
            }
        }

        if($emp_data == null){
            HREmphld::create($validated);
            return redirect()->route('emphlds.index')->with(session()->flash('message',trans('hr.add_success')));
        }else{
            $emp_data->update($validated);
            return redirect()->route('emphlds.index')->with(session()->flash('message',trans('hr.update_success')));
        }

        if($emp_cnt == null){
            HREmpCnt::create($validated);
            return redirect()->route('emphlds.index')->with(session()->flash('message',trans('hr.add_success')));
        }else{
            $emp_cnt->update($validated);
            return redirect()->route('emphlds.index')->with(session()->flash('message',trans('hr.update_success')));
        }

    }


    public function show($ID_No, Request $request)
    {
        $emp_data = HREmphld::findOrFail($ID_No);
        $data  = HREmpCnt::where('Emp_No', $request->Emp_No)->get();
        $emp_pyemp= PyempHLDInc::where('Emp_No', $request->Emp_No)->get();

        return view('hr.settings.emp_hld.show', compact('emp_data', 'data', 'emp_pyemp'));
    }


    public function edit($ID_No)
    {
        //
    }


    public function update(EmpHldRequest $request, $ID_No)
    {
        //
    }


    public function destroy($ID_No)
    {
        $emp_data = HREmphld::findOrFail($ID_No);
        $emp_data->delete();
        return redirect()->route('emphlds.index')->with(session()->flash('message',trans('hr.delete_success')));
    }

    public function getData(Request $request)
    {
        if($request->ajax()){
            $data     = HREmpCnt::where('Emp_No', $request->Emp_No)->first();
            $emp_data = HREmphld::where('Emp_No', $request->Emp_No)->first();
            $emp_pyemp= PyempHLDInc::where('Emp_No', $request->Emp_No)->first();

            if($data != null || $emp_data != null){
                return view('hr.settings.emp_hld.getdata', compact('data', 'emp_data', 'emp_pyemp'));
            }else{
                return view('hr.settings.emp_hld.set_data', compact('data', 'emp_data', 'emp_pyemp'));
            }
        }
    }


    public function getJob(Request $request)
    {
        if($request->ajax()){
            $job_No = HrEmpmfs::where('Emp_No', $request->Emp_No)->pluck('Job_No');
            $pyjobs = Pyjobs::where('Job_No', $job_No)->first();
            if($pyjobs->Job_NmAr){
                return response()->json($pyjobs->Job_NmAr);
            }else{
                return response()->json('');
            }

        }
    }

    public function getdepartmenthlds(Request $request)
    {
        if($request->ajax()){
            $departments = HrEmpmfs::where('Emp_No', $request->Emp_No)->first();
            if($departments->Depm_No != null){
                return response()->json($departments->department->Depm_NmAr);
            }else{
                return response()->json(' ');
            }
        }
    }

    public function getSalaryhlds(Request $request)
    {
        if($request->ajax()){
            $salary = HREmpCnt::where('Emp_No', $request->Emp_No)->first();
            if($salary->Bsc_Salary != null){
                return response()->json($salary->Bsc_Salary);
            }
            else{
                return response()->json(' ');
            }

        }
    }
}
