<?php

namespace App\Http\Controllers\Admin\City;

use App\city;
use App\country;
use App\DataTables\CityDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Up;

class CitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CityDataTable $city)
    {
        return $city->render('admin.cities.index',['title'=>trans('admin.cities')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = country::pluck('country_name_'.session('lang'),'id');
        return view('admin.cities.create',['title'=> trans('admin.create_new_city'),'countries'=>$countries]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,city $city)
    {
        $data = $this->validate($request,[
            'city_name_ar' => 'required',
            'city_name_en' => 'required',
            'country_id' => 'required'
        ],[],[
            'city_name_ar' => trans('admin.arabic_name'),
            'city_name_en' => trans('admin.english_name'),
            'country_id' => trans('admin.country')
        ]);
        $city->create($data);
        return redirect(aurl('cities'))->with(session()->flash('message',trans('admin.success_add')));

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
        $city = city::findOrFail($id);
        $countries = country::pluck('country_name_'.session('lang'),'id');
        return view('admin.cities.edit',['title'=> trans('admin.edit_city') ,'city'=>$city,'countries'=>$countries]);
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
            'city_name_ar' => 'required',
                'city_name_en' => 'required',
                'country_id' => 'required'
            ],[],[
            'city_name_ar' => trans('admin.arabic_name'),
            'city_name_en' => trans('admin.english_name'),
            'country_id' => trans('admin.country')
        ]);
        $city = city::findOrFail($id);
        $city->update($data);
        return redirect(aurl('cities'))->with(session()->flash('message',trans('admin.success_update')));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $city = city::findOrFail($id);
        $city->delete();
        return redirect(aurl('cities'));
    }
}
