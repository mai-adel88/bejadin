<?php

namespace App\Http\Controllers\Hr\settings;

use App\DataTables\Hr\BankPaymentDataDataTable;
use App\Models\Hr\HrPybnkAcc;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BankPaymentDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param BankPaymentDataDataTable $dataTable
     * @return void
     */
    public function index(BankPaymentDataDataTable $dataTable)
    {
        return $dataTable->render('hr.settings.bank_payment_data.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return  view('hr.settings.bank_payment_data.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validate($request, [
            "Bnk_No" => 'required',
            "Bnk_NmAr" => 'required',
            "Bnk_NmEn" => 'sometimes',
            "Bnk_Acc" => 'required',

        ], [], [
            "Bnk_No" => trans('hr.bank_number'),
            "Bnk_NmAr" => trans('hr.bank_name_ar'),
            "Bnk_NmEn" => trans('hr.bank_name_ar'),
            "Bnk_Acc" => trans('hr.Bnk_Acc'),
        ]);


        HrPybnkAcc::create($data);

        return redirect()->route('bankPaymentData.index')->with(session()->flash('message',trans('hr.add_success')));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($ID_NO)
    {
        $HrPybnkAcc = HrPybnkAcc::findOrFail($ID_NO);
        return  view('hr.settings.bank_payment_data.show', compact(['HrPybnkAcc']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($ID_NO)
    {
        $HrPybnkAcc = HrPybnkAcc::findOrFail($ID_NO);
        return  view('hr.settings.bank_payment_data.edit', compact(['HrPybnkAcc']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $ID_NO)
    {
        $HrPybnkAcc = HrPybnkAcc::findOrFail($ID_NO);
        $data = $this->validate($request, [
           
            "Bnk_NmAr" => 'required',
            "Bnk_NmEn" => 'sometimes',
            "Bnk_Acc" => 'required',
        ], [], [
            
            "Bnk_NmAr" => trans('hr.bank_name_ar'),
            "Bnk_NmEn" => trans('hr.bank_name_ar'),
            "Bnk_Acc" => trans('hr.Bnk_Acc'),
        ]);
        $HrPybnkAcc->update($data);
        return redirect()->route('bankPaymentData.index')->with(session()->flash('message',trans('hr.update_success')));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($ID_NO)
    {
        $HrPybnkAcc = HrPybnkAcc::findOrFail($ID_NO);
        $HrPybnkAcc->delete();
        return redirect()->route('bankPaymentData.index')->with(session()->flash('message',trans('hr.delete_success')));
    }
}
