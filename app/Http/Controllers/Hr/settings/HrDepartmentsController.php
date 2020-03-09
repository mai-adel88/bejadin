<?php

namespace App\Http\Controllers\Hr\settings;

use App\Models\Hr\DepmCmp; // الاقسام
use App\Models\Hr\HRMainCmpnam; // الشركات
use App\DataTables\Hr\HrDepartmentDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Up;

class HrDepartmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(HrDepartmentDataTable $dataTable)
    {
        return $dataTable->render('hr.settings.departments.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = HRMainCmpnam::get(); // الشركات
        return view('hr.settings.departments.create',['title'=> trans('hr.department_create'),'companies'=>$companies]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validate($request,[
            'Cmp_No' => 'required',
            'Depm_Main' => 'sometimes',
            'Depm_NmAr' => 'required',
            'Depm_NmEn' => 'sometimes',
        ],[],[
            'Cmp_No' => trans('admin.Cmp_No'),
            'Depm_Main' => trans('admin.Depm_Main'),
            'Depm_NmAr' => trans('admin.Depm_NmAr'),
            'Depm_NmEn' => trans('admin.Depm_NmEn'),
        ]);
        DepmCmp::create($data);
        return redirect()->route('hrdepartments.index')->with(session()->flash('message',trans('admin.success_add')));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($ID_No)
    {
        $companies = HRMainCmpnam::get(); // الشركات
        $department = DepmCmp::findOrFail($ID_No);
        return view('hr.settings.departments.show',compact('department','companies'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($ID_No)
    {
        
        $department = DepmCmp::findOrFail($ID_No);
        $companies = HRMainCmpnam::get(); // الشركات
        return view('hr.settings.departments.edit',compact('department','companies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $ID_No)
    {
        
        $data = $this->validate($request,[
            'Cmp_No' => 'sometimes',
            'Depm_Main' => 'sometimes',
            'Depm_NmAr' => 'sometimes',
            'Depm_NmEn' => 'sometimes',
        ],[],[
            'Cmp_No' => trans('admin.Cmp_No'),
            'Depm_Main' => trans('admin.Depm_Main'),
            'Depm_NmAr' => trans('admin.Depm_NmAr'),
            'Depm_NmEn' => trans('admin.Depm_NmEn'),
        ]);
        
        $department = DepmCmp::findOrFail($ID_No);
        // dd($data);
        $department->update($data);
        return redirect()->route('hrdepartments.index')->with(session()->flash('message',trans('admin.success_update')));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($ID_No)
    {
        $department = DepmCmp::findOrFail($ID_No);
        $department->delete();
        return redirect()->route('hrdepartments.index')->with(session()->flash('message',trans('hr.delete_success')));
    }

    // create department number
    public function createdepNo(Request $request){

        if($request->ajax()){
            $last_no = 0;
            
            if(count(DepmCmp::all()) == 0){
//                return 'first';
                //no records
                // dd('ddj');
                $last_no = $request->Cmp_No;
                return $last_no . 1;
            }else{
                // dd('djdjd');
                $last_cstm = DepmCmp::where('Cmp_No',  $request->Cmp_No)->orderBy('Depm_Main', 'desc')->first();
                // dd($last_cstm);
                if($last_cstm == null){
                    // dd('last_cstm');
//                    return 'else first';
                    $last_no = $request->Cmp_No . 1;
                    return $last_no;
                }
                else{
//                    return 'else second';
// dd('else');
                    $last_no = $last_cstm->Depm_Main;
                    return $last_no + 1;
                }
            }
            
        }

    }
    // create department number
    public function editdepNo(Request $request){

        if($request->ajax()){
            $last_no = 0;
            
            $last_cstm = DepmCmp::where('Cmp_No',  $request->Cmp_No)->orderBy('Depm_Main', 'desc')->first();
            // dd($last_cstm);
            if($last_cstm == null){
                // dd('last_cstm');
//                    return 'else first';
                $last_no = $request->Cmp_No . 1;
                return $last_no;
            }
            else{
//                    return 'else second';
// dd('else');
                $last_no = $last_cstm->Depm_Main;
                return $last_no;
            }
            
        }

    }
}
