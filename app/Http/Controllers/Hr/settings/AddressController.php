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

    public function store(Request $request)
    {
        // validate input

        // $data=$this->validate($request,[
        //     'Cmp_No'        => 'required',
        //     'Emp_No'        => 'required',
        //     //  داخل المملكة
        //     'Emp_City'=>'required|exists:cities,id',
        //     'Stat_No'=>'sometimes',
        //     'Emp_Phon'=>'digits_between:7,20',
        //     'Emp_Mobile'=>'digits_between:7,20',
        //     'Emp_Street'=>'sometimes',
        //     'RefPerson_Nm'=>'sometimes',
        //     'RefPerson_Mobile'=>'digits_between:7,20',
        //     'E_Email'=>'email',
        //     // خارج المملكة
        //     'Cntry_No'=>'exists:countries,id',
        //     'Phon_Cntry'=>'sometimes',
        //     'Emp_Adrs'=>'sometimes',
        //     'Name_Nerst'=>'sometimes',
        //     'Phon_nerst'=>'sometimes',
        //     'Adrs_Nerst'=>'sometimes',
        //     'Notes'=>'sometimes',
        // ],[],[

        // ]);
        $data=$this->validate($request,[
            'Cmp_No'        => 'required',
            'Emp_No'        => 'required',
            //  داخل المملكة
            'Emp_City'=>'required',
            'Stat_No'=>'sometimes',
            'Emp_Phon'=>'sometimes',
            'Emp_Mobile'=>'sometimes',
            'Emp_Street'=>'sometimes',
            'RefPerson_Nm'=>'sometimes',
            'RefPerson_Mobile'=>'sometimes',
            'E_Email'=>'sometimes',
            // خارج المملكة
            'Cntry_No'=>'sometimes',
            'Phon_Cntry'=>'sometimes',
            'Emp_Adrs'=>'sometimes',
            'Name_Nerst'=>'sometimes',
            'Phon_nerst'=>'sometimes',
            'Adrs_Nerst'=>'sometimes',
            'Notes'=>'sometimes',
        ],[],[
            'Cmp_No' => trans('admin.Cmp_No'),
            'Emp_No' => trans('admin.Emp_No'),
            'Emp_City' => trans('hr.Emp_City'),
        ]);
        $emp_data = HREmpadr::where('Emp_No', $request->Emp_No)->first();
        
        if($emp_data == null){
            HREmpadr::create($data);
            return redirect()->route('address.index')->with(session()->flash('message',trans('hr.add_success')));
        }else{
            $emp_data->update($data);
            return redirect()->route('address.index')->with(session()->flash('message',trans('hr.update_success')));
        }   
    }

    public function show($ID_No)
    {
        $emp_data = HREmpadr::findOrFail($ID_No);
        $employees = HrEmpmfs::get();
        $companies=HRMainCmpnam::all();
        $cities=city::all();
        $countries=country::all();
        return view('hr.settings.addresses.show', compact(['companies','employees','emp_data','cities','countries']));
    }
    public function edit($ID_No)
    {
        $emp_data = HREmpadr::findOrFail($ID_No);
        $employees = HrEmpmfs::get();
        $companies=HRMainCmpnam::all();
        $cities=city::all();
        $countries=country::all();
        return view('hr.settings.addresses.edit', compact(['companies','employees','emp_data','cities','countries']));
    }

    public function update(Request $request, $ID_No){
        $data = $this->validate($request,[
            'Cmp_No'        => 'required',
            'Emp_No'        => 'required',
            //  داخل المملكة
            'Emp_City'=>'required',
            'Stat_No'=>'sometimes',
            'Emp_Phon'=>'sometimes',
            'Emp_Mobile'=>'sometimes',
            'Emp_Street'=>'sometimes',
            'RefPerson_Nm'=>'sometimes',
            'RefPerson_Mobile'=>'sometimes',
            'E_Email'=>'sometimes',
            // خارج المملكة
            'Cntry_No'=>'sometimes',
            'Phon_Cntry'=>'sometimes',
            'Emp_Adrs'=>'sometimes',
            'Name_Nerst'=>'sometimes',
            'Phon_nerst'=>'sometimes',
            'Adrs_Nerst'=>'sometimes',
            'Notes'=>'sometimes',
        ],[],[
            'Cmp_No' => trans('admin.Cmp_No'),
            'Emp_No' => trans('admin.Emp_No'),
            'Emp_City' => trans('hr.Emp_City'),
        ]);
        // get the id of a given record 
        $emp_data = HREmpadr::findOrFail($ID_No);
        // if select another employee [if change the employee]
        if($emp_data->Emp_No != $request->Emp_No){
            $emp_data = HREmpadr::where('Emp_No', $request->Emp_No)->first();
            $emp_data->update($data);
            return redirect()->route('address.index')->with(session()->flash('message',trans('hr.update_success')));
        }else{
            $emp_data->update($data);
            return redirect()->route('address.index')->with(session()->flash('message',trans('hr.update_success')));
        }
    }

    public function destroy($ID_No){
        $emp_data = HREmpadr::findOrFail($ID_No);
        $emp_data->delete();
        return redirect()->route('address.index')->with(session()->flash('message',trans('he.delete_success')));
    }

    // ajax to get employee address data 
    public function getemployeeaddressData(Request $request){
        if($request->ajax()){
            $emp_data = HREmpadr::where('Emp_No', $request->Emp_No)->first();
            $countries = country::get();        //الدول
            $cities = city::get(); 
            if($emp_data != null){
                return view('hr.settings.addresses.get_employee_data', compact(['emp_data','countries','cities']));
            }else{
                return view('hr.settings.addresses.default_add_form', compact(['emp_data','countries','cities']));
            }
        }
    }


}
