<?php

namespace App\Http\Controllers\Admin\Contractors;

use DB;
use App\Department;
use App\Contractors;
use App\ContractorType;
use App\country;
use App\responsiblePerson;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\ContractorDataTable;

class ContractorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ContractorDataTable $contractor)
    {
        // dd(app()->getLocale());
        // return Session::all();
        return $contractor->render('admin.contractors.index');
    }

    public function contractortype()
    {
        return view('admin.contractor_type');
    }

    public function contractortypeadd(request $request)
    {
        $data = $this->validate($request,[
            'name_ar' => 'required|min:3',
            'name_en' => 'required|min:3'
        ]);
        ContractorType::create($data);
        return back()->with(session()->flash('message','Contractor is Add successfully'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ContractorType = ContractorType::all()->pluck('name_'.session('lang'), 'id');
        $country = country::all()->pluck('country_name_'.session('lang'), 'id');
        $departments = Department::where('operation_id',10)->where('type','1')->pluck('dep_name_'.session('lang'),'id');
        return view('admin.contractors.create',compact('ContractorType','country','departments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return request('id');
        $this->validate($request,[
            'name_ar' => 'required',
            'name_en' => 'required',
            'tree_id' => 'required',
            'contractor_type_id' => 'required',
            'address' => 'required',
            'country_id' => 'required',
            'currency' => 'required',
            'credit_limit' => 'required',
            'account_number' => 'required',
            'debtor' => 'required',
            'creditor' => 'required',
            'responsible_people' => 'sometimes',
            'email' => 'sometimes',
            'phone1' => 'sometimes',
            'phone2' => 'sometimes',
            'mobile' => 'sometimes',
        ]);

        $data = [
            'name_ar' => request('name_ar'),
            'name_en' => request('name_en'),
            'tree_id' => request('tree_id'),
            'contractor_type_id' => request('contractor_type_id'),
            'address' => request('address'),
            'country_id' => request('country_id'),
            'currency' => request('currency'),
            'credit_limit' => request('credit_limit'),
            'account_number' => request('account_number'),
            'debtor' => request('debtor'),
            'creditor' => request('creditor'),
        ];

        Contractors::create($data);
        $data3 = request()->input('responsible_people');
        $data2 = count($data3);
        for ($i=0; $i < $data2; $i++) {
            if (request()->input('responsible_people')[$i] != null) {
                $responsible_people = $request->input('responsible_people');
                $email = $request->input('email');
                $phone1 = $request->input('phone1');
                $phone2 = $request->input('phone2');
                $mobile = $request->input('mobile');
                $contractor_name = DB::select('select id from contractors where name_ar = ?', [request('name_ar')]);
                // print_r($contract_name[0]->id);
                $lastValue = last($contractor_name);
                $contractor_id = $lastValue->id;
                $add = [
                    'responsible_people' => $responsible_people[$i],
                    'email' => $email[$i],
                    'phone1' => $phone1[$i],
                    'phone2' => $phone2[$i],
                    'mobile' => $mobile[$i],
                    'contractor_name' => $contractor_id
                ];
                // return $add;
                responsiblePerson::create($add);
                // $contract->update($data);
                // DB::table('responsible_people')->insert($add);
            }
            if (request()->input('responsible_people')[$i] == null) {
                request()->input('responsible_people')[$i] = '';
            }
        }

        return redirect(aurl('contractors'))->with(session()->flash('message','Contractor is added successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $project = request('project');
//        $employee = employee::pluck('name_ar','id');
//        return ($employee);
        // dd($project);
        $contractor = Contractors::findOrFail($id);
        $responsiblePerson = responsiblePerson::where('contractor_name', $id)->get();
        // return $responsiblePerson;
        // $Project = Project::findOrFail($id);
        return view('admin.contractors.show',compact('contractor','responsiblePerson'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $responsiblePerson = responsiblePerson::where('contractor_name', $id)->get();
        $contractortype = ContractorType::all()->pluck('name_'.session('lang'), 'id');
        $country = country::all()->pluck('country_name_'.session('lang'), 'id');
        // dd($project);
        $contractor = Contractors::findOrFail($id);
        return view('admin.contractors.edit',compact('contractor','contractortype','country','responsiblePerson'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // return request($id);
        $this->validate($request,[
            'name_ar' => 'required',
            'name_en' => 'required',
            'tree_id' => 'required',
            'contractor_type_id' => 'required',
            'address' => 'required',
            'country_id' => 'required',
            'currency' => 'required',
            'credit_limit' => 'required',
            'account_number' => 'required',
            'debtor' => 'required',
            'creditor' => 'required',
            'responsible_people' => 'sometimes',
            'email' => 'sometimes',
            'phone1' => 'sometimes',
            'phone2' => 'sometimes',
            'mobile' => 'sometimes',
        ]);
        $data = [
            'name_ar' => request('name_ar'),
            'name_en' => request('name_en'),
            'tree_id' => request('tree_id'),
            'contractor_type_id' => request('contractor_type_id'),
            'address' => request('address'),
            'country_id' => request('country_id'),
            'currency' => request('currency'),
            'credit_limit' => request('credit_limit'),
            'account_number' => request('account_number'),
            'debtor' => request('debtor'),
            'creditor' => request('creditor'),
        ];

        $contractor = Contractors::findOrFail($id);
        $contractor->update($data);

        $responsiblePerson = responsiblePerson::where('contractor_name', $id)->get();
        $data2 = count($responsiblePerson);
        $response = request()->input('responsible_people');
        $responsecount = count($response);

        for ($i=0; $i < $data2; $i++) {
            if (request()->input('responsible_people')[$i] != null) {
                $responsible_people = $request->input('responsible_people');
                $email = $request->input('email');
                $phone1 = $request->input('phone1');
                $phone2 = $request->input('phone2');
                $mobile = $request->input('mobile');
                $update = [
                    'responsible_people' => $responsible_people[$i],
                    'email' => $email[$i],
                    'phone1' => $phone1[$i],
                    'phone2' => $phone2[$i],
                    'mobile' => $mobile[$i]
                ];
                $responsible = responsiblePerson::where('contractor_name', $id)->get();
                $responsible[$i]->update($update);

            }
            if (request()->input('responsible_people')[$i] == null) {
                request()->input('responsible_people')[$i] = '';
            }
        }
        for ($x=$i; $x < $responsecount; $x++) {
            // dd(request()->input('responsible_people')[$x]);
            if (request()->input('responsible_people')[$x] != null) {
                $responsible_people = $request->input('responsible_people');
                $email = $request->input('email');
                $phone1 = $request->input('phone1');
                $phone2 = $request->input('phone2');
                $mobile = $request->input('mobile');
                $contractor_name = DB::select('select id from contractors where name_ar = ?', [request('name_ar')]);
                $lastValue = last($contractor_name);
                $contractor_id = $lastValue->id;

                $add = [
                    'responsible_people' => $responsible_people[$x],
                    'email' => $email[$x],
                    'phone1' => $phone1[$x],
                    'phone2' => $phone2[$x],
                    'mobile' => $mobile[$x],
                    'contractor_name' => $contractor_id
                ];
                // return $add;
                responsiblePerson::create($add);
            }
            if (request()->input('responsible_people')[$x] == null) {
                request()->input('responsible_people')[$x] = '';
            }

        }
        return redirect(route('contractors.index'))->with(session()->flash('message','Contractor is update successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contractor = contractors::findOrFail(request('id'));
        $contractor->delete();
        return back();
    }
    public function resposible($id)
    {
        // return request()->all();
        $Person = responsiblePerson::findOrFail($id);
        // return $Person;

        $Person->delete();
        return back();
    }
}
