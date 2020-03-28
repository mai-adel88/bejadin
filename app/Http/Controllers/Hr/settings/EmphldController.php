<?php

namespace App\Http\Controllers\Hr\settings;

use App\Models\Hr\Pyjobs;
use App\Models\Hr\HrEmpmfs;
use App\Models\Hr\HREmpCnt;
use App\Models\Hr\HREmphld;
use App\Models\Hr\HRMainCmpnam;
use App\DataTables\Hr\EmpHldDataTable;

use Illuminate\Http\Request;
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

    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }


    public function getdepartmenthlds(Request $request)
    {
        if($request->ajax()){
            $departments = HrEmpmfs::where('Emp_No', $request->Emp_No)->with('department')->get();
            if($departments){
                foreach($departments as $dep){
                    $res = $dep->department->Depm_NmAr;
                }
            }

            return response()->json($res);
        }
    }

    public function getSalaryhlds(Request $request)
    {
        if($request->ajax()){
            $salary = HREmpCnt::where('Emp_No', $request->Emp_No)->pluck('Bsc_Salary');
            ;
            foreach($salary as $sal){
                $result = $sal->Bsc_Salary;
            }
            // dd($result);
            return response()->json($result);
        }
    }
}
