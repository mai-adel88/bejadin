<?php

namespace App\Http\Controllers\Admin\limitations;

use App\DataTables\LimitationTypeDataTable;
use App\Models\Admin\GLAstJrntyp;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class LimitationTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param LimitationTypeDataTable $dataTable
     * @return Response
     */
    public function index(LimitationTypeDataTable $dataTable)
    {
        return $dataTable->render('admin.limitations.limitation_type.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.limitations.limitation_type.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'Jr_Ty' => 'required|integer',
            'Jrty_NmAr' => 'required',
            'Jrty_NmEn' => 'required',
        ], [], [
            'Jr_Ty' => trans('admin.Jr_Ty_no'),
            'Jrty_NmAr' => trans('admin.Jrty_NmAr'),
            'Jrty_NmEn' => trans('admin.Jrty_NmEn'),
        ]);

        GLAstJrntyp::create($data);
        return  redirect()->route('limitationType.index')->with(session()->flash('message', trans('admin.save_success')));

    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function show(Request $request, $id)
    {
        if($request->ajax()){
            $jrType = GLAstJrntyp::findOrFail($id);
            if($jrType != null){
                if ($jrType->active == 0){
                    GLAstJrntyp::where('ID_NO', $request->ID_NO)->update(['active' => '1']);
                    GLAstJrntyp::where('ID_NO', $request->ID_NO)->update(['active' => '1']);
                    return response()->json(['status' => 1,'message' => trans('admin.active_jr')]);
                } else {
                    GLAstJrntyp::where('ID_NO', $request->ID_NO)->update(['active' => '0']);
                    GLAstJrntyp::where('ID_NO', $request->Class_ID)->update(['active' => '0']);
                    return response()->json(['status' => 1,'message' => trans('admin.non_active_jr')]);
                }
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $jrType = GLAstJrntyp::findOrFail($id);
        return view('admin.limitations.limitation_type.edit', compact(['jrType']));

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
        $jrType = GLAstJrntyp::findOrFail($id);

        $data = $this->validate($request, [
            'Jrty_NmAr' => 'required',
            'Jrty_NmEn' => 'required',
        ], [], [
            'Jrty_NmAr' => trans('admin.Jrty_NmAr'),
            'Jrty_NmEn' => trans('admin.Jrty_NmEn'),
        ]);

        $jrType->update($data);
        return  redirect()->route('limitationType.index')->with(session()->flash('message', trans('admin.save_success')));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
