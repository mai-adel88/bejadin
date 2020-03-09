<?php

namespace App\Http\Controllers\admin\Project_contract;

use App\employee;
use App\Branches;
use App\Project;
use App\projectcontract;
use App\subscription;
use App\DataTables\ProjectContractDataTable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class projectcontractcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ProjectContractDataTable $projectcontract)
    {
        return $projectcontract->render('admin.project_contract.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Branches = Branches::all()->pluck('name_'.session('lang'), 'id');
        $subscription = subscription::all()->pluck('name_'.session('lang'), 'id');
        $Projects = Project::all()->pluck('name_'.session('lang'), 'id');
        return view('admin.project_contract.create',compact('Branches','subscription','Projects'));

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
            'branche_id' => 'required',
            'project_id' => 'required',

            'date_hijri' => 'sometimes',
            'date' => 'sometimes',
            'note' => 'sometimes',
            'note_en' => 'sometimes',

            'Date_contract' => 'sometimes',
            'beginning_contract' => 'sometimes',
            'End_contract' => 'sometimes',
            'period_contract' => 'sometimes',

            'start_implementation' => 'sometimes',
            'end_implementation' => 'sometimes',
            'start_warranty' => 'sometimes',
            'end_warranty' => 'sometimes',


            'number_employees' => 'sometimes',
            'Hour_employee' => 'sometimes',
            'number_months' => 'sometimes',
            'monthly_payment' => 'sometimes',


            'revenue_measurement' => 'sometimes',
            'expenses_measurement' => 'sometimes',
            'cost_limit' => 'sometimes',
            'actual_cost' => 'sometimes',

            'Estimated_value' => 'sometimes',
            'contract_value' => 'sometimes',
            'deviation_value' => 'sometimes',

            'Bank_guarantee_number' => 'sometimes',
            'warranty_history' => 'sometimes',
            'amount_guarantee' => 'sometimes',



            'warranty_issued' => 'sometimes',
            'warranty_issued_en' => 'sometimes',




            'comprehensive_insurance' => 'sometimes',
            'contractor_insurance' => 'sometimes',
            'reference_retirement' => 'sometimes',
            'subscriber_id' => 'sometimes',

            'management_expenses_percentage' => 'sometimes',
            'management_expenses' => 'sometimes',
            'department_expenses_percentage' => 'sometimes',
            'department_expenses' => 'sometimes',

            'warranty_period_percentage' => 'sometimes',
            'warranty_period' => 'sometimes',
            'financial_expenses_percentage' => 'sometimes',
            'financial_expenses' => 'sometimes',

            'subtotal_percentage' => 'sometimes',
            'subtotal' => 'sometimes',
            'net_deviation_percentage' => 'sometimes',
            'net_deviation' => 'sometimes',

            'total_collection' => 'sometimes',
            'current_balance' => 'sometimes',


        ],[],[
            'branche_id' => 'Branche',
            'subscriber_id' => 'subscriber ',

        ]);



        projectcontract::Create($data);


        return redirect(aurl('project_contract'))->with(session()->flash('message','Contract\'s Project is added successfully'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $projectcontract = projectcontract::findORfail($id);
        $branches = Branches::where('id',$projectcontract->branche_id)->get()->first();
        $project = Project::where('id', $projectcontract->project_id)->get();
        $subscription = subscription::where('id', $projectcontract->subscriber_id)->get();
        return view('admin.project_contract.show',compact('projectcontract','subscription','branches','project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)


    {
        $projectcontract = projectcontract::findORfail($id);
        $Branches = Branches::all()->pluck('name_'.session('lang'), 'id');
        $subscription = subscription::all()->pluck('name_'.session('lang'), 'id');
        $Projects = Project::all()->pluck('name_'.session('lang'), 'id');
        return view('admin.project_contract.edit',compact('Branches','subscription','Projects','projectcontract'));

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
            'branche_id' => 'sometimes',
            'project_id' => 'sometimes',

            'date_hijri' => 'sometimes',
            'date' => 'sometimes',
            'note' => 'sometimes',
            'note_en' => 'sometimes',

            'Date_contract' => 'sometimes',
            'beginning_contract' => 'sometimes',
            'End_contract' => 'sometimes',
            'period_contract' => 'sometimes',

            'start_implementation' => 'sometimes',
            'end_implementation' => 'sometimes',
            'start_warranty' => 'sometimes',
            'end_warranty' => 'sometimes',


            'number_employees' => 'sometimes',
            'Hour_employee' => 'sometimes',
            'number_months' => 'sometimes',
            'monthly_payment' => 'sometimes',


            'revenue_measurement' => 'sometimes',
            'expenses_measurement' => 'sometimes',
            'cost_limit' => 'sometimes',
            'actual_cost' => 'sometimes',

            'Estimated_value' => 'sometimes',
            'contract_value' => 'sometimes',
            'deviation_value' => 'sometimes',

            'Bank_guarantee_number' => 'sometimes',
            'warranty_history' => 'sometimes',
            'amount_guarantee' => 'sometimes',



            'warranty_issued' => 'sometimes',
            'warranty_issued_en' => 'sometimes',




            'comprehensive_insurance' => 'sometimes',
            'contractor_insurance' => 'sometimes',
            'reference_retirement' => 'sometimes',
            'subscriber_id' => 'sometimes',

            'management_expenses_percentage' => 'sometimes',
            'management_expenses' => 'sometimes',
            'department_expenses_percentage' => 'sometimes',
            'department_expenses' => 'sometimes',

            'warranty_period_percentage' => 'sometimes',
            'warranty_period' => 'sometimes',
            'financial_expenses_percentage' => 'sometimes',
            'financial_expenses' => 'sometimes',

            'subtotal_percentage' => 'sometimes',
            'subtotal' => 'sometimes',
            'net_deviation_percentage' => 'sometimes',
            'net_deviation' => 'sometimes',

            'total_collection' => 'sometimes',
            'current_balance' => 'sometimes',

        ],[],[
            'name_ar' => 'Arbic name',
            'name_en' => 'English name',
            'contract_number' => 'Contract number',
            'phone_number' => 'Phone number',
            'fax_number' => 'Fax number',
            'email' => 'Email',
            'esponsible_person' => 'Responsible person',
            'warehouse' => 'Warehouse',
            'revenue' => 'Revenue',
            'expenses' => 'Expenses',
            'subscriber_id' => 'Subscriber name',
            'roject_title' => 'Project title',
        ]);
        $projectcontract = projectcontract::findOrFail($id);
        $projectcontract->update($data);

        return redirect(aurl('project_contract'))->with(session()->flash('message','update is Done'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Project = projectcontract::findOrFail($id);
        $Project->delete();
        return back();
    }
}
