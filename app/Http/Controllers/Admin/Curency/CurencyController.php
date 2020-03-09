<?php

namespace App\Http\Controllers\Admin\Curency;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\CurencyDataTable;
use App\Models\Admin\AstCurncy;
use Illuminate\Support\Facades\DB;

class CurencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CurencyDataTable $crncy)
    {
        $id = AstCurncy::where('Curncy_NmAr','=',null)->orWhere('Curncy_NmAr','=','')->pluck('ID_No');
        DB::table('astcurncy')->where('Curncy_NmEn',null)->where('Curncy_NmAr',null)->orWhere('Curncy_NmAr','=','')->delete();

        return $crncy->render('admin.curency.index',['title'=>trans('admin.curency_types')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Curncy_No = $this->createCurNo();
        return view('admin.curency.create', compact('Curncy_No'));
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
            'Curncy_No'  =>'sometimes',
            'Curncy_NmAr'=>'required',
            'Curncy_NmEn'=>'required',
            'Curncy_Rate'=>'required',
        ],[],[
            'Curncy_No'   => trans('admin.Curncy_No'),
            'Curncy_NmAr' => trans('admin.arabic_name'),
            'Curncy_NmEn' => trans('admin.subscriber_name_en'),
            'Curncy_Rate' => trans('admin.exchange_rate'),
        ]);
        $crn = AstCurncy::create($data);
        return redirect(aurl('curencies'))->with(session()->flash('message',trans('admin.success_add')));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $crn = AstCurncy::where('ID_No', $id)->first();
        return view('admin.curency.show', compact('crn'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $crn = AstCurncy::where('ID_No', $id)->first();
        return view('admin.curency.edit', compact('crn'));
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
            'Curncy_No'  =>'sometimes',
            'Curncy_NmAr'=>'required',
            'Curncy_NmEn'=>'required',
            'Curncy_Rate'=>'required',
        ],[],[
            'Curncy_No'   => trans('admin.Curncy_No'),
            'Curncy_NmAr' => trans('admin.arabic_name'),
            'Curncy_NmEn' => trans('admin.subscriber_name_en'),
            'Curncy_Rate' => trans('admin.exchange_rate'),
        ]);
        AstCurncy::where('ID_No', $id)->first()->update($data);
        return redirect(aurl('curencies'))->with(session()->flash('message',trans('admin.success_update')));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        AstCurncy::where('ID_No', $id)->first()->delete();
        return redirect(aurl('curencies'))->with(session()->flash('message',trans('admin.success_deleted')));
    }

    public function createCurNo(){
        $last_no = 0;
        $crncy = AstCurncy::orderBy('Curncy_No', 'desc')->first();
        if($crncy){
            $last_no = $crncy->Curncy_No;
        }
        else{
            $last_no = 0;
        }

        return $last_no + 1;
    }
}
