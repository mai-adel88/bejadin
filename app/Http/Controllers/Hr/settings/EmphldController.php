<?php

namespace App\Http\Controllers\Hr\settings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hr\HREmphld;
use App\Models\Hr\Pyjobs;
use App\Models\Hr\HrEmpmfs;
use App\Models\Hr\HRMainCmpnam;
use App\DataTables\Hr\EmpHldDataTable;


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


    public function store(Request $request)
    {
        //
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
            $departments = HrEmpmfs::with('department')->where('Emp_No', $request->Emp_No)->get();
            // dd($departments);

            return view('hr.settings.emp_hld.getdepartmenthlds', compact('departments'));
        }
    }
}
