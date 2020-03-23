<?php

namespace App\Http\Controllers\Hr\settings;

use Illuminate\Http\Request;
use App\Models\Hr\HREmpDependents;
use App\Models\Hr\HrEmpmfs;
use App\Models\Hr\country;
use App\Models\Hr\Pyjobs;
use App\Models\Hr\HrAstPorts;
use App\Models\Hr\HRMainCmpnam;
use App\DataTables\Hr\DependentsDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\DependentRequest;


class DependentsController extends Controller
{

    public function index(DependentsDataTable $dataTable)
    {
        return $dataTable->render('hr.settings.dependents.index');
    }


    public function create()
    {
        $last   = HREmpDependents::orderBy('ID_No', 'DESC')->latest()->first(); //latest record
        if(!empty($last) || $last || $last < 0){
            $last = $last->Host_No +1;
        }else{
            $last =  1;
        }

        $companies = HRMainCmpnam::get();   // الشركات
        $countries = country::get();        //الدول
        $jobs      = Pyjobs::get();              // الوظائف
        $job_gov   = Pyjobs::where('job_gov', 1)->get(); //تاشيرة القدوم
        $ports     = HrAstPorts::get();        // منافذ الدخول والمغادره



        return view('hr.settings.dependents.create', compact('companies', 'last', 'countries', 'jobs', 'job_gov','ports'));
    }



    public function store(DependentRequest $request)
    {
        $validated = $request->validated();
        ////// concatenate name
        if($request->Host_NmAr1 Or $request->Host_NmAr2 Or $request->Host_NmAr3 Or $request->Host_NmAr4){
            $validated['Host_NmAr'] = $request->Host_NmAr1 .' '. $request->Host_NmAr2 .' '. $request->Host_NmAr3 .' '. $request->Host_NmAr4;
        }
        if($request->Host_NmEn1 Or $request->Host_NmEn2 Or $request->Host_NmEn3 Or $request->Host_NmEn4){
            $validated['Host_NmEn'] = $request->Host_NmEn1 .' '. $request->Host_NmEn2 .' '. $request->Host_NmEn3 .' '. $request->Host_NmEn4;
        }


        if(isset($validated['Photo'])){   //upload image
            $validated['Photo'] = $this->upload($validated['Photo']);
        }
        else{
            //if there is no image to upload -> it will be here an img by default
            $validated['Photo'] = 'public/hr/files/dependents/defImg.jpg';
        }
        HREmpDependents::create($validated);

        return redirect()->route('dependents.index')->with(session()->flash('message',trans('hr.add_success')));

    }

    public function upload($file)
    {
        $extension = $file->getClientOriginalExtension(); //2
        $sha1      = sha1($file->getClientOriginalName()); //hash name of file //3
        $filename  = date('Y-m-d-h-i-s').".".$sha1.".".$extension; //finally name
        $path      = 'public/hr/files/dependents/';
        $file->move($path, $filename); //step 1

        return 'public/hr/files/dependents/'.$filename;
    }


    // ـــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــ
    public function show($ID_No)
    {
        $dependent = HREmpDependents::findOrFail($ID_No);
        $last      = HREmpDependents::orderBy('ID_No', 'DESC')->latest()->first(); //latest record
        if(!empty($last) || $last || $last < 0){
            $last = $last->Host_No +1;
        }else{
            $last =  1;
        }

        $companies = HRMainCmpnam::get();   // الشركات
        $countries = country::get();        //الدول
        $jobs      = Pyjobs::get();              // الوظائف
        $job_gov   = Pyjobs::where('job_gov', 1)->get(); //تاشيرة القدوم
        $ports     = HrAstPorts::get();        // منافذ الدخول والمغادره

        return view('hr.settings.dependents.show', compact('dependent', 'last', 'companies', 'countries', 'jobs', 'job_gov', 'ports'));
    }



    public function edit($ID_No)
    {
        $dependent = HREmpDependents::findOrFail($ID_No);
        $last      = HREmpDependents::orderBy('ID_No', 'DESC')->latest()->first(); //latest record
        if(!empty($last) || $last || $last < 0){
            $last = $last->Host_No +1;
        }else{
            $last =  1;
        }

        $companies = HRMainCmpnam::get();   // الشركات
        $countries = country::get();        //الدول
        $jobs      = Pyjobs::get();              // الوظائف
        $job_gov   = Pyjobs::where('job_gov', 1)->get(); //تاشيرة القدوم
        $ports     = HrAstPorts::get();        // منافذ الدخول والمغادره

        return view('hr.settings.dependents.edit', compact('dependent','companies', 'last', 'countries', 'jobs', 'job_gov','ports'));
    }



    public function update(DependentRequest $request, $ID_No)
    {
        $validated = $request->validated();
        $dependent = HREmpDependents::findOrFail($ID_No);

        ////// concatenate name
        if($request->Host_NmAr1 Or $request->Host_NmAr2 Or $request->Host_NmAr3 Or $request->Host_NmAr4){
            $validated['Host_NmAr'] = $request->Host_NmAr1 .' '. $request->Host_NmAr2 .' '. $request->Host_NmAr3 .' '. $request->Host_NmAr4;
        }
        if($request->Host_NmEn1 Or $request->Host_NmEn2 Or $request->Host_NmEn3 Or $request->Host_NmEn4){
            $validated['Host_NmEn'] = $request->Host_NmEn1 .' '. $request->Host_NmEn2 .' '. $request->Host_NmEn3 .' '. $request->Host_NmEn4;
        }


        if(isset($validated['Photo'])){ //upload image
            $validated['Photo'] = $this->upload($validated['Photo']);
        }

        $dependent->update($validated);

        return redirect()->route('dependents.index')->with(session()->flash('message',trans('hr.update_success')));
    }




    public function destroy($ID_No)
    {
        $dependent = HREmpDependents::findOrFail($ID_No);
        $dependent->delete();
        return  redirect()->route('dependents.index')->with(session()->flash('message', trans('hr.delete_success')));
    }

    // ــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــ

    public function getEmployeess(Request $request)
    {
        $employees = HrEmpmfs::where('Cmp_No', $request->Cmp_No)->get();   // الموظفين
        return view('hr.settings.dependents.get_employees', compact('employees'));

    }

    public function passportNo(Request $request)
    {
        if($request->ajax()){
            $passportNo = HrEmpmfs::where('Emp_No', $request->Emp_No)->pluck('Pasprt_No');
            return response()->json($passportNo);
        }
    }
}
