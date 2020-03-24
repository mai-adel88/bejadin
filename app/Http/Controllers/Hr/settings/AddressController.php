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
use Illuminate\Support\Facades\Validator;

class AddressController extends Controller
{
    public function index(AddressDataTable $dataTable)
    {
        // this function to display all addresses and main page of address

        return $dataTable->render('hr.settings.addresses.index');
    }
    public function create(){

        // this function to call the blade of create new address

//        $cities=city::pluck('city_name_'.session('lang'), 'id')->toArray();
        $cities=city::all();
        $countries=country::all();
        $companies=HRMainCmpnam::all();
        $employees=HrEmpmfs::all();
        return view('hr.settings.addresses.create', compact('cities','countries','companies','employees'));
    }

    public function getEmployee(Request $request)
    {
        // this function is to get list of all employee in particular company after call ajax

        if($request->ajax()){
            $employees = HrEmpmfs::where('Cmp_No',  $request->Cmp_No)->get();
            return view('hr.settings.addresses.getEmployees', compact('employees'));
        }
    }
    public function getEmployeeData(Request $request)
    {

        // this function to get employee data if he already exists in database after call ajax

        if($request->ajax()){
//            $employee = HREmpadr::where('Emp_No',  $request->Emp_No)->get()->load('city');
            $employee = HREmpadr::where('Emp_No',  $request->Emp_No)->get();



            dd($employee);




            $cities=city::all();
            $countries=country::all();
            $companies=HRMainCmpnam::all();
            $employees=HrEmpmfs::all();
            return view('hr.settings.addresses.getEmployeeData', compact('employee','cities','countries',
                                                                    'companies','employees'));
        }
    }
    public function store(Request $request)
    {
        // validate input

        $rules=[
//            داخل المملكة
            'Emp_City'=>'exists:cities,id',
            'Stat_No'=>'',
            'Emp_Phon'=>'digits_between:7,20',
            'Emp_Mobile'=>'digits_between:7,20',
            'Emp_Street'=>'',
            'RefPerson_Nm'=>'',
            'RefPerson_Mobile'=>'digits_between:7,20',
            'E_Email'=>'email',
//            خارج المملكة
            'Cntry_No'=>'exists:countries,id',
            'Phon_Cntry'=>'',
            'Emp_Adrs'=>'',
            'Name_Nerst'=>'',
            'Phon_nerst'=>'',
            'Adrs_Nerst'=>'',
            'Notes'=>'',
        ];
        $this->validate($request,$rules);

//        $client->update($request->all());


        // create new company

        $address=HREmpadr::create($request->all());
        $address->save();

//        flash()->success('success');

        return redirect(route('address.index'));
    }


}
