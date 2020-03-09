<?php

namespace App\Http\Controllers\Admin\Astsupctg;

use App\Http\Controllers\Controller;
use App\DataTables\astsupctgDataTable;
use App\Models\Admin\Astsupctg;
use Illuminate\Http\Request;

class AstsupctgController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(astsupctgDataTable $astsupctg)
    {
        return $astsupctg->render('admin.astsupctg.index',['title'=>trans('admin.Classification_suppliers')]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.astsupctg.create',['title'=> trans('admin.AddClassification_suppliers')]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request ,Astsupctg $astsupctg)
    {
        $ast = $astsupctg->orderBy('Supctg_No', 'DESC')->pluck('Supctg_No')->first();

        if ($ast > 0){
            $Supctg_No = $ast + 1 ;
        }else{
            $Supctg_No = 1;
        }
        $data = $this->validate($request,[
            'Supctg_Nmar' => 'required',
            'Supctg_Nmen' => 'required',
        ],[],[
            'Supctg_Nmar' => trans('admin.Supctg_Nmar'),
            'Supctg_Nmen' => trans('admin.Supctg_Nmen'),

       ]);

        $astsupctg->create([
            'Supctg_Nmar' => $request->Supctg_Nmar,
            'Supctg_Nmen' => $request->Supctg_Nmen,
            'Supctg_No' => $Supctg_No,

        ]);
        return redirect(aurl('astsupctg'))->with(session()->flash('message',trans('admin.success_add')));


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
        $astsupctg = Astsupctg::where('ID_No',$id)->first();
        return view('admin.astsupctg.edit',['title'=> trans('admin.EditClassification_suppliers'),'astsupctg'=>$astsupctg,]);
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
            'Supctg_Nmar' => 'required',
            'Supctg_Nmen' => 'required',
        ],[],[
            'Supctg_Nmar' => trans('admin.Supctg_Nmar'),
            'Supctg_Nmen' => trans('admin.Supctg_Nmen'),

        ]);

        $astsupctg = Astsupctg::findOrFail($id);
        $astsupctg->update([
            'Supctg_Nmar' => $request->Supctg_Nmar,
            'Supctg_Nmen' => $request->Supctg_Nmen,
        ]);
        return redirect(aurl('astsupctg'))->with(session()->flash('message',trans('admin.success_edit')));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Astsupctg = Astsupctg::where('ID_No',$id);
        $Astsupctg->delete();
        return redirect(aurl('astsupctg'));
    }
}
