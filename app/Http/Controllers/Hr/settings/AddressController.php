<?php

namespace App\Http\Controllers\Hr\settings;
use App\city;
use App\country;
use App\DataTables\Hr\AddressDataTable;

use App\Models\Admin\MainCompany;
use App\Models\Hr\DepmCmp;
use App\Models\Hr\HrDprtmntLoctn;
use App\Models\Hr\HREmpadr;
use App\Models\Hr\HrEmpmfs;
use App\Models\Hr\HRMainCmpnam;
use App\Models\Hr\Pyjobs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AddressController extends Controller
{
    public function index(AddressDataTable $dataTable)
    {
        return $dataTable->render('hr.settings.addresses.index');
    }
    public function create(){

        $cities=city::all();
        $countries=country::all();
        $companies=HRMainCmpnam::all();
        $employees=HrEmpmfs::all();
        return view('hr.settings.addresses.create', compact('cities','countries','companies','employees'));
    }

    public function getEmployee(Request $request)
    {
        if($request->ajax()){
            $employees = HrEmpmfs::where('Cmp_No',  $request->Cmp_No)->get();
            return view('hr.settings.addresses.getEmployees', compact('employees'));
        }
    }
    public function store(Request $request)
    {
        // validate input

        $this->validate($request,[
            'name'=>'required',
        ]);

        // create new company

        $address=HREmpadr::create($request->all());
        $address->save();

        flash()->success('success');

        return redirect(route('address.index'));
    }


}
