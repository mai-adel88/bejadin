<?php

namespace App\Http\Controllers\Admin\State;

use App\DataTables\StateDataTable;
use App\state;
use App\city;
use App\country;
use App\DataTables\CityDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Up;

class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(StateDataTable $state)
    {
        return $state->render('admin.state.index',['title'=>trans('admin.state')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(request()->ajax()){
            if(request()->has('country_id')){
                $city = city::where('country_id',request('country_id'))->pluck('city_name_'.session('lang'),'id');
                $select = request()->has('select')?request('select'):'';
                return \Form::select('city_id', $city,$select, array_merge(['class' => 'form-control city_id','placeholder'=>'select ...']));
            }
        }

        $country = country::pluck('country_name_'.session('lang'),'id');
        return view('admin.state.create',['title'=> trans('admin.create_new_state'),'country'=>$country]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,state $state)
    {
        $data = $this->validate($request,[
            'state_name_ar' => 'required',
            'state_name_en' => 'required',
            'city_id' => 'required',
            'country_id' => 'required'
        ],[],[
            'state_name_ar' => trans('admin.arabic_name'),
            'state_name_en' => trans('admin.english_name'),
            'city_id' => trans('admin.city'),
            'country_id' => trans('admin.country')
        ]);
        $state->create($data);
        return redirect(aurl('state'))->with(session()->flash('message',trans('admin.success_add')));

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
        $state = state::findOrFail($id);
        $city = city::pluck('city_name_'.session('lang'),'id');
        $country = country::pluck('country_name_'.session('lang'),'id');
        return view('admin.state.edit',['title'=> trans('admin.edit_state') ,'city'=>$city,'state'=>$state,'country'=>$country]);
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
            'state_name_ar' => 'required',
            'state_name_en' => 'required',
            'city_id' => 'required',
            'country_id' => 'required'
        ],[],[
            'state_name_ar' => trans('admin.arabic_name'),
            'state_name_en' => trans('admin.english_name'),
            'city_id' => trans('admin.city'),
            'country_id' => trans('admin.country')
        ]);
        $state = state::findOrFail($id);
        $state->update($data);
        return redirect(aurl('state'))->with(session()->flash('message',trans('admin.success_update')));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $state = state::findOrFail($id);
        $state->delete();
        return redirect(aurl('state'));
    }
}
