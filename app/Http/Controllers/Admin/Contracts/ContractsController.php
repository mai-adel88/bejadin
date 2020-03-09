<?php

namespace App\Http\Controllers\Admin\Contracts;

use App\Contractors;
use App\Branches;
use App\Project;
use App\contracts;
use App\ContractorType;
use App\subscription;
use App\DataTables\ContractsDataTable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContractsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ContractsDataTable $contracts)
    {
        return $contracts->render('admin.contracts.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $branches = Branches::all()->pluck('name_'.session('lang'), 'id');
        $project = Project::all()->pluck('name_'.session('lang'), 'id');
        $contractors = Contractors::all()->pluck('name_'.session('lang'), 'id');
        $subscription = subscription::all()->pluck('name_'.session('lang'), 'id');
        return view('admin.contracts.create',compact('branches','project','contractors','subscription'));
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
            'section_id' => 'required',
            'date' => 'required',
            'higri_date' => 'required',
            'project_id' => 'required',
            'contractor_id' => 'required',
            'Contract_reference' => 'required',
            'contract_number' => 'required',
            'subscriber_id' => 'required',
            'statement_ar' => 'required',
            'statement_en' => 'required',
            'contract_date' => 'required',
            'contract_start' => 'required',
            'contract_end' => 'required',
            'contract_period' => 'required',
            'implementation_start' => 'required',
            'implementation_end' => 'required',
            'warranty_start' => 'required',
            'warranty_end' => 'required',
            'employees_number' => 'required',
            'employee_hour_work' => 'required',
            'months_number' => 'required',
            'monthly_payment' => 'required',
            'contract_value' => 'required',
            'estimated_value' => 'required',
            'deviation_value' => 'required',
            'downpayment' => 'required',
            'warranty_expenses' => 'required',
            'insurance_value' => 'required',
            'contract_value_customer' => 'required',
            'subcontracts_value' => 'required',
            'total_payments' => 'required',
            'current_balance' => 'required',
        ]);
        contracts::create($data);
        return redirect(aurl('contracts'))->with(session()->flash('message','Contract is added successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(contracts $request ,$id)
    {
        $contract = contracts::findOrFail($id);
        $branches = Branches::where('id',$contract->section_id)->get()->first();
        $project = Project::where('id', $contract->project_id)->get();
        $contractors = Contractors::where('id', $contract->contractor_id)->get();
        $subscription = subscription::where('id', $contract->subscriber_id)->get();
        return view('admin.contracts.show',compact('contract','branches','project','contractors','subscription'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contract = contracts::findOrFail($id);
        $branches = Branches::all()->pluck('name_'.session('lang'), 'id');
        $project = Project::all()->pluck('name_'.session('lang'), 'id');
        $contractors = Contractors::all()->pluck('name_'.session('lang'), 'id');
        $subscription = subscription::all()->pluck('name_'.session('lang'), 'id');
        return view('admin.Contracts.edit',compact('contract','branches','project','contractors','subscription'));
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
        $data = $this->validate($request,[
            'section_id' => 'required',
            'date' => 'required',
            'higri_date' => 'required',
            'project_id' => 'required',
            'contractor_id' => 'required',
            'Contract_reference' => 'required',
            'contract_number' => 'required',
            'subscriber_id' => 'required',
            'statement_ar' => 'required',
            'statement_en' => 'required',
            'contract_date' => 'required',
            'contract_start' => 'required',
            'contract_end' => 'required',
            'contract_period' => 'required',
            'implementation_start' => 'required',
            'implementation_end' => 'required',
            'warranty_start' => 'required',
            'warranty_end' => 'required',
            'employees_number' => 'required',
            'employee_hour_work' => 'required',
            'months_number' => 'required',
            'monthly_payment' => 'required',
            'contract_value' => 'required',
            'estimated_value' => 'required',
            'deviation_value' => 'required',
            'downpayment' => 'required',
            'warranty_expenses' => 'required',
            'insurance_value' => 'required',
            'contract_value_customer' => 'required',
            'subcontracts_value' => 'required',
            'total_payments' => 'required',
            'current_balance' => 'required',
        ]);
        $contract = contracts::findOrFail($id);
        $contract->update($data);
        return redirect(route('contracts.index'))->with(session()->flash('message','Contract is update successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contract = contracts::findOrFail($id);
        $contract->delete();
        return back();
    }
}
