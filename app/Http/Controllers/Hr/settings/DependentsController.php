<?php

namespace App\Http\Controllers\Hr\settings;

use Illuminate\Http\Request;
use App\Models\Hr\HREmpDependents;
use App\Models\Hr\HrEmpmfs;
use App\Models\Hr\HRMainCmpnam;
use App\DataTables\Hr\DependentsDataTable;
use App\Http\Controllers\Controller;


class DependentsController extends Controller
{

    public function index(DependentsDataTable $dataTable)
    {
        return $dataTable->render('hr.settings.dependents.index');
    }


    public function create()
    {
        $companies = HRMainCmpnam::get();   // الشركات

        return view('hr.settings.dependents.create', compact('companies'));
    }

    public function getEmployees()
    {
        $employees = HrEmpmfs::get();   // الموظفين
        return view('hr.settings.dependents.get_employees', compact('employees'));

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
}
