<?php

namespace App\Http\Controllers\Admin\ProjectsSites;

use App\levels;
use App\ProjectsSites;
use App\glcc;
use App\Project;
use App\DataTables\ProjectsSitesDataTable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ProjectsSitesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ProjectsSitesDataTable $ProjectsSites)
    {
        return $ProjectsSites->render('admin.ProjectsSites.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $project = Project::all()->pluck('name_'.session('lang'), 'id');
        $glcc = glcc::where('level_id',8)->pluck('name_'.session('lang'),'id');
        return view('admin.ProjectsSites.create',compact('glcc','project'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,glcc $glcc)
    {
        $data = $this->validate($request,[
            'project_id' => 'required',
            'name_ar' => 'required',
            'name_en' => 'required',
            'cc_id' => 'sometimes',
            'contract_number' => 'required',
            'phone_number' => 'required',
            'email' => 'required|email',
            'responsible_person' => 'required',
            'warehouse' => 'required',
            'project_title' => 'required',
        ],[],[
            'name_ar' => 'Arbic name',
            'name_en' => 'English name',
            'contract_number' => 'Contract number',
            'phone_number' => 'Phone number',
            'email' => 'Email',
            'esponsible_person' => 'Responsible person',
            'warehouse' => 'Warehouse',
            'project_title' => 'Project title',
        ]);
        $project = Project::findOrFail($data['project_id']);
        $ccs = $glcc->create([
            'name_ar'=>$data['name_ar'],
            'name_en'=>$data['name_en'],
            'parent_id'=>$project->cc_id,
            'levelType'=>2,
            'type'=>'1',

        ]);
        $parent =  glcc::where('id',$ccs->parent_id)->first();
        $level_id = levels::where('type',$ccs->levelType)->where('id',$parent->level_id + 1)->first()->id;
        $code = DB::table('glccs')->where('parent_id',$ccs->parent_id)->where('levelType',$ccs->levelType)->max('code');
        DB::table('glccs')->where('id', $ccs->id)->update(['code' => $code + 1, 'level_id' => $level_id]);
        ProjectsSites::create($data);

        return redirect(route('ProjectsSites.index'))->with(session()->flash('message','Project Site is added successfully'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ProjectsSites = ProjectsSites::findOrFail($id);
        $project = Project::where('id', $ProjectsSites->project_id)->get();
        $glcc = glcc::where('level_id',$ProjectsSites->cc_id)->pluck('name_'.session('lang'),'id');
        return view('admin.ProjectsSites.show',compact('ProjectsSites','project','glcc'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ProjectsSites = ProjectsSites::findOrFail($id);
        $project = Project::all()->pluck('name_'.session('lang'), 'id');
        $glcc = glcc::where('level_id',$ProjectsSites->cc_id)->pluck('name_'.session('lang'),'id');
        return view('admin.ProjectsSites.edit',compact('ProjectsSites','project','glcc'));
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
            'project_id' => 'required',
            'name_ar' => 'required',
            'name_en' => 'required',
            'cc_id' => 'sometimes',
            'contract_number' => 'required',
            'phone_number' => 'required',
            'email' => 'required|email',
            'responsible_person' => 'required',
            'warehouse' => 'required',
            'project_title' => 'required',
        ],[],[
            'project_id' => 'Project name',
            'name_ar' => 'Arbic name',
            'name_en' => 'English name',
            'contract_number' => 'Contract number',
            'phone_number' => 'Phone number',
            'email' => 'Email',
            'esponsible_person' => 'Responsible person',
            'warehouse' => 'Warehouse',
            'project_title' => 'Project title',
        ]);
        $ProjectsSites = ProjectsSites::findOrFail($id);
        $ProjectsSites->update($data);
        return redirect(route('ProjectsSites.index'))->with(session()->flash('message','Project site is update successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ProjectsSites = ProjectsSites::findOrFail($id);
        $ProjectsSites->delete();
        return back();
    }
}
