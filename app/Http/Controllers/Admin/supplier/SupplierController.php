<?php

namespace App\Http\Controllers\Admin\supplier;

use App\Branches;
use App\country;
use App\DataTables\supplierDataTable;
use App\Department;
use App\Http\Controllers\Controller;
use App\supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(supplierDataTable $supplier)
    {
        return $supplier->render('admin.supplier.index',['title'=>trans('admin.bus_supplier')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = country::pluck('country_name_'.session('lang'),'id');
        $branches = Branches::pluck('name_'.session('lang'),'id');
        $departments = Department::where('operation_id',1)->where('type','1')->pluck('dep_name_'.session('lang'),'id');
        return view('admin.supplier.create',['title'=> trans('admin.create_new_suppliers'),'countries' => $countries,'departments' => $departments,'branches' => $branches]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,supplier $supplier)
    {
        $data = $this->validate($request,[
            'name_ar' => 'required',
            'name_en' => 'required',
            'branches_id' => 'required',
            'tree_id' => 'sometimes',
            'addriss' => 'sometimes',
            'responsible' => 'sometimes',
            'email' => 'sometimes',
            'credit_limit' => 'sometimes',
            'debtor' => 'required',
            'creditor' => 'required',
            'country_id' => 'sometimes',
            'currency' => 'sometimes',
            'phone1' => 'sometimes',
            'phone2' => 'sometimes',
            'fax' => 'sometimes',
            'account_num' => 'sometimes',
            'tax_num' => 'sometimes',
        ],[],[
            'name_ar' => trans('admin.arabic_name'),
            'name_en' => trans('admin.english_name'),
            'addriss' => trans('admin.addriss'),
            'responsible' => trans('admin.responsible'),
            'email' => trans('admin.email'),
            'supplierclass' => trans('admin.supplier_class'),
            'credit_limit' => trans('admin.credit_limit'),
            'debtor' => trans('admin.debtor'),
            'creditor' => trans('admin.creditor'),
            'country_id' => trans('admin.country'),
            'currency' => trans('admin.currency'),
            'phone1' => trans('admin.phone'),
            'phone2' => trans('admin.mob'),
            'fax' => trans('admin.fax'),
            'account_num' => trans('admin.account_number'),
            'tax_num' => trans('admin.tax_number'),
        ]);
        $supplier->create($data);
        return redirect(aurl('suppliers'))->with(session()->flash('message',trans('admin.success_add')));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $branches = Branches::pluck('name_'.session('lang'),'id');
        $supplier = supplier::findOrFail($id);
        $countries = country::pluck('country_name_'.session('lang'),'id');
        $departments = Department::where('operation_id',1)->where('type','1')->pluck('dep_name_'.session('lang'),'id');
        return view('admin.supplier.edit',['title'=> trans('admin.edit_suppliers') ,'supplier'=>$supplier,'countries'=>$countries,'departments' => $departments,'branches' => $branches]);
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
            'name_ar' => 'required',
            'name_en' => 'required',
            'branches_id' => 'required',
            'tree_id' => 'sometimes',
            'addriss' => 'sometimes',
            'responsible' => 'sometimes',
            'email' => 'sometimes',
            'credit_limit' => 'sometimes',
            'debtor' => 'required',
            'creditor' => 'required',
            'country_id' => 'sometimes',
            'currency' => 'sometimes',
            'phone1' => 'sometimes',
            'phone2' => 'sometimes',
            'fax' => 'sometimes',
            'account_num' => 'sometimes',
            'tax_num' => 'sometimes',
        ],[],[
            'name_ar' => trans('admin.arabic_name'),
            'name_en' => trans('admin.english_name'),
            'addriss' => trans('admin.addriss'),
            'responsible' => trans('admin.responsible'),
            'email' => trans('admin.email'),
            'supplierclass' => trans('admin.supplier_class'),
            'credit_limit' => trans('admin.credit_limit'),
            'debtor' => trans('admin.debtor'),
            'creditor' => trans('admin.creditor'),
            'country_id' => trans('admin.country'),
            'currency' => trans('admin.currency'),
            'phone1' => trans('admin.phone'),
            'phone2' => trans('admin.mob'),
            'fax' => trans('admin.fax'),
            'account_num' => trans('admin.account_number'),
            'tax_num' => trans('admin.tax_number'),
        ]);
        $supplier = supplier::findOrFail($id);
        $supplier->update($data);
        return redirect(aurl('suppliers'))->with(session()->flash('message',trans('admin.success_update')));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $supplier = supplier::findOrFail($id);
        $supplier->delete();
        return redirect(aurl('suppliers'));
    }
}
