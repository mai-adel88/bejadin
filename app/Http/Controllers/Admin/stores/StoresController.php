<?php

namespace App\Http\Controllers\Admin\stores;

use App\DataTables\StoresDataTable;
use App\Models\Admin\MainBranch;
use App\Models\Admin\PjbranchDlv;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class StoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param StoresDataTable $dataTable
     * @return Response
     */
    public function index(StoresDataTable $dataTable)
    {
        return $dataTable->render('admin.stores.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $lastStore = PjbranchDlv::latest()->first();
        $branches = MainBranch::all();
        return view('admin.stores.create', compact(['branches', 'lastStore']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $validation = $this->validate($request,[
            'Dlv_Stor' => 'required',
            'Brn_No' => 'required',
            'Dlv_NmAr' => 'required',
            'Dlv_NmEn' => 'sometimes',
        ],[], [
            'Dlv_Stor' => trans('admin.number'),
            'Brn_No' => trans('admin.Brn_No'),
            'Dlv_NmAr' => trans('admin.name_ar'),
            'Dlv_NmEn' => trans('admin.name_en'),
        ]);

        PjbranchDlv::create($request->all());
        return redirect()->route('stores.index')->with(session()->flash('message',trans('admin.success_add')));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
<<<<<<< HEAD


        $admin = PjbranchDlv::findOrfail($id);
        $lastStore = $admin->Dlv_Stor;

        $branches = MainBranch::pluck('Brn_NmAr','Brn_No');

          $title =trans('admin.edit_store');

        return view('admin.stores.edit', compact(['admin', 'title','branches','lastStore']));
=======
        $store = PjbranchDlv::findOrFail($id);
        $branches = MainBranch::all();

        return view('admin.stores.edit', compact(['branches', 'store']));
>>>>>>> 5558cfca9acd8c2bc1580cc16a04b8f8baf9dad7

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
<<<<<<< HEAD
        $admin = PjbranchDlv::findOrfail($id);
        $admin->update($request->all());
        return redirect(aurl('stores'));

=======
        $store = PjbranchDlv::findOrFail($id);
        $validation = $this->validate($request,[
            'Dlv_Stor' => 'required',
            'Brn_No' => 'required',
            'Dlv_NmAr' => 'required',
            'Dlv_NmEn' => 'sometimes',
        ],[], [
            'Dlv_Stor' => trans('admin.number'),
            'Brn_No' => trans('admin.Brn_No'),
            'Dlv_NmAr' => trans('admin.name_ar'),
            'Dlv_NmEn' => trans('admin.name_en'),
        ]);

        $store->update($validation);
         return redirect()->route('stores.index')->with(session()->flash('message', trans('admin.success_update')));
>>>>>>> 5558cfca9acd8c2bc1580cc16a04b8f8baf9dad7
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($ID_No)
    {
<<<<<<< HEAD
        $item = PjbranchDlv::findOrfail($ID_No);

        $item->delete();
        return redirect(aurl('stores'));
=======
        $store = PjbranchDlv::findOrFail($id);
        $store->delete();
        return redirect()->route('stores.index')->with(session()->flash('message', trans('admin.success_deleted')));
>>>>>>> 5558cfca9acd8c2bc1580cc16a04b8f8baf9dad7

    }
}
