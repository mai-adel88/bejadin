<?php

namespace App\Http\Controllers\Hr\employees_data;
use App\DataTables\Hr\PyjobsDataTable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hr\Pyjobs;

class PyjobsController extends Controller
{
    public function index(PyjobsDataTable $dataTable)
    {
        return $dataTable->render('hr.pyjobs.index');
    }



    public function create()
    {
        //create job NO.
        $last = Pyjobs::orderBy('ID_No', 'DESC')->latest()->first(); //latest record
        if(!empty($last) || $last || $last < 0){
            $last = $last->Job_No +1;
        }else{
            $last =  1;
        }
        return view('hr.pyjobs.create', compact('last'));
    }



    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'Job_No'    => 'sometimes',
            'Job_NmAr'  => 'required',
            'Job_NmEn'  => 'required',
            'Job_Typ'   => 'sometimes',
            'job_cmpny' => 'sometimes',
            'job_gov'   => 'sometimes',
            'job_desc'  => 'sometimes',
            'job_tech'  => 'sometimes',

        ],
        [
            'Job_NmAr' => trans('admin.arabic_name'),
            'Job_NmEn' => trans('admin.english_name')
        ]
        );
        
        Pyjobs::create($data);
        return redirect()->route('pyjobs.index')->with(session()->flash('message',trans('hr.add_success')));
    }



    public function show($id)
    {
        $job = Pyjobs::findOrFail($id);
        return view('hr.pyjobs.show', compact('job'),['title'=> trans('hr.show_job')]);
    }



    public function edit($ID_No)
    {
        $job = Pyjobs::findOrFail($ID_No);
        return view('hr.pyjobs.edit', compact('job'));
    }



    public function update(Request $request, $ID_No)
    {
        // dd($request->all());
        $data = $this->validate($request, [
            'Job_No'    => 'sometimes',
            'Job_NmAr'  => 'required',
            'Job_NmEn'  => 'required',
            'Job_Typ'   => 'sometimes',
            'job_cmpny' => 'sometimes',
            'job_gov'   => 'sometimes',
            'job_desc'  => 'sometimes',
            'job_tech'  => 'sometimes'
        ],
            [
                'Job_NmAr' => trans('admin.arabic_name'),
                'Job_NmEn' => trans('admin.english_name')
            ]);
        
        $job = Pyjobs::findOrFail($ID_No);
        
            $checkboxarr = [
                'job_cmpny' ,    // الوظيفه بالشركه
                'job_gov',      //الوظيفه بالحكومه
                'job_desc' ,  
                'job_tech',    
            ];
            foreach($checkboxarr as $checkval){
                if(!array_key_exists($checkval, $data)){
                    $job->{$checkval} = '0';
                    $job->save();
                }
            }

        $job->update($data);
        return redirect()->route('pyjobs.index')->with(session()->flash('message',trans('hr.update_success')));

    }


    
    public function destroy($ID_No)
    {
        $job = Pyjobs::findOrFail($ID_No);
        $job->delete();
        return redirect()->route('pyjobs.index')->with(session()->flash('message', trans('admin.delete_success')));
    }


}
