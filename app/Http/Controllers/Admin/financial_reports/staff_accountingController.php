<?php

namespace App\Http\Controllers\admin\financial_reports;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class staff_accountingController extends Controller
{
    public function staff_accounting()
    {
        return view('admin.financial_reports.staff_accounting.staff_accounting');

    }
    public function staff_account_statement()
    {

        return view('admin.financial_reports.staff_accounting.report.account_statement');

    }
    public function staff_trial_balance()
    {

        return view('admin.financial_reports.staff_accounting.report.trial_balance');

    }
    public function staff_daily_restriction()
    {

        return view('admin.financial_reports.staff_accounting.report.daily_restriction');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
