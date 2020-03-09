<?php

namespace App\Http\Controllers\Admin\Project;

use App\Department;
use App\glcc;
use App\levels;
use App\Project;
use App\employee;
use App\DataTables\ProjectDataTable;
use App\subscription;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ProjectDataTable $project)
    {
        return $project->render('admin.projects.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subscribers = subscription::all()->pluck('name_'.session('lang'), 'id');
        $glcc = glcc::where('level_id',8)->pluck('name_'.session('lang'),'id');
        $tree = Department::where('operation_id',3)->pluck('dep_name_'.session('lang'),'id');
//        return ($employee);
        return view('admin.projects.create',compact('subscribers','glcc','tree'));
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
            'name_ar' => 'required',
            'name_en' => 'required',
            'contract_number' => 'sometimes',
            'phone_number' => 'sometimes',
            'fax_number' => 'sometimes',
            'email' => 'required|email',
            'responsible_person' => 'required',
            'warehouse' => 'sometimes',
            'subscriber_id' => 'required',
            'project_title' => 'sometimes',
            'cc_id' => 'required',
            'tree_id' => 'required',
        ],[],[
            'name_ar' => 'Arbic name',
            'name_en' => 'English name',
            'contract_number' => 'Contract number',
            'phone_number' => 'Phone number',
            'fax_number' => 'Fax number',
            'email' => 'Email',
            'esponsible_person' => 'Responsible person',
            'warehouse' => 'Warehouse',
            'subscriber_id' => 'Subscriber name',
            'roject_title' => 'Project title',
        ]);
        $project = new Project();
        $project->name_ar = $request->name_ar;
        $project->name_en = $request->name_en;
        $project->contract_number = $request->contract_number;
        $project->phone_number = $request->phone_number;
        $project->fax_number = $request->fax_number;
        $project->email = $request->email;
        $project->responsible_person = $request->responsible_person;
        $project->warehouse = $request->warehouse;
        $project->subscriber_id = $request->subscriber_id;
        $project->project_title = $request->project_title;
        $project->tree_id = $request->tree_id;
        $ccs = $glcc->create([
            'name_ar'=>$request->name_ar,
            'name_en'=>$request->name_en,
            'parent_id'=>$request->cc_id,
            'levelType'=>2,
            'type'=>'0',

        ]);

        if($ccs->parent_id == null){
            $count = count(\Illuminate\Support\Facades\DB::table('glccs')->where('parent_id',null)->get());
            $level_id = levels::where('type',2)->where('levelId',1)->first()->id;
            DB::table('glccs')->where('id',$ccs->id)->update(['code' => $count,'level_id'=>$level_id]);
        }else{

            $parent =  glcc::where('id',$ccs->parent_id)->first();
            if ($parent->levelType != $ccs->levelType){
                $ccs->delete();
                return back()->with(session()->flash('error',trans('admin.cannot_add_branche')));
            }else{
                $count = count(DB::table('glccs')->where('parent_id',$ccs->parent_id)->where('levelType',$ccs->levelType)->get())-1;
                if (levels::where('type',$ccs->levelType)->where('id',$parent->level_id + 1)->exists()){
                    $level_id = levels::where('type',$ccs->levelType)->where('id',$parent->level_id + 1)->first()->id;
                    $code = DB::table('glccs')->where('parent_id',$ccs->parent_id)->where('levelType',$ccs->levelType)->max('code');
//                        there here an issue may be from table or from model
                    $i = substr($code + 1, -3,1);
                    if (substr($code + 1, -3) == $i.'00') {
                        $ccs->delete();
                        return back()->with(session()->flash('error', trans('admin.cannot_add')));
                    } else {
                        $project->cc_id = $ccs->id;
                        if ($count == null){
                            $code_first = substr(glcc::where('id',$ccs->parent_id)->where('levelType',$ccs->levelType)->first()->code, 0,1);
                            DB::table('glccs')->where('id',$ccs->id)->update(['code' => (($code_first.substr($code,1)).'01') ,'level_id'=>$level_id]);
                        }else{
                            $co = DB::table('glccs')->where('parent_id',$ccs->parent_id)->where('levelType',$ccs->levelType)->max('code');
                            DB::table('glccs')->where('id', $ccs->id)->update(['code' => $co + 1, 'level_id' => $level_id]);
                        }
                        $ccs1 = $glcc->create([
                            'name_ar'=>'ايرادات '.$request->name_ar,
                            'name_en'=>'ايرادات '.$request->name_en,
                            'parent_id'=>$ccs->id,
                            'levelType'=>2,
                            'type'=>'1',
                        ]);
                        $ccs2 = $glcc->create([
                            'name_ar'=>'مصروفات '.$request->name_ar,
                            'name_en'=>'مصروفات '.$request->name_en,
                            'parent_id'=>$ccs->id,
                            'levelType'=>2,
                            'type'=>'1',
                        ]);
                        $parent1 =  glcc::where('id',$ccs1->parent_id)->first();
                        $level_id1 = levels::where('type',$ccs1->levelType)->where('id',$parent1->level_id + 1)->first()->id;
                        $code1 = DB::table('glccs')->where('id',$ccs1->parent_id)->where('levelType',$ccs1->levelType)->max('code');
                        $code_first1 = substr(glcc::where('id',$ccs1->parent_id)->where('levelType',$ccs1->levelType)->first()->code, 0,1);
                        DB::table('glccs')->where('id',$ccs1->id)->update(['code' => (($code_first1.substr($code1,1)).'01') ,'level_id'=>$level_id1]);


                        $parent2 =  glcc::where('id',$ccs2->parent_id)->first();
                        $level_id2 = levels::where('type',$ccs2->levelType)->where('id',$parent2->level_id + 1)->first()->id;
                        $code2 = DB::table('glccs')->where('parent_id',$ccs2->parent_id)->where('levelType',$ccs2->levelType)->max('code');
                        DB::table('glccs')->where('id', $ccs2->id)->update(['code' => $code2 + 1, 'level_id' => $level_id2]);
                    }
                }else{
                    $ccs->delete();
                    return back()->with(session()->flash('error',trans('admin.cannot_add')));
                }
            }
            DB::table('glccs')->where('id',$ccs->id)->update(['type' => '0']);
        }
        $project->save();
        return redirect(route('projects.index'))->with(session()->flash('message','Project is added successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $Project
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = Project::findOrFail($id);
        return view('admin.projects.show',compact('project'));
        // return view('admin.employees.show',['title'=> trans('employee') ,'employee'=>$employee]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $Project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $Project)
    {
        $project = request('project');
        $subscribers = subscription::all()->pluck('name_'.session('lang'), 'id');
        // dd($project);
        // $Project = Project::findOrFail($id);
        return view('admin.projects.edit',compact('project','subscribers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $Project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $Project)
    {
        $data = $this->validate($request,[
            'name_ar' => 'required',
            'name_en' => 'required',
            'contract_number' => 'sometimes',
            'phone_number' => 'sometimes',
            'fax_number' => 'sometimes',
            'email' => 'required|email',
            'responsible_person' => 'required',
            'warehouse' => 'sometimes',
            'subscriber_id' => 'required',
            'project_title' => 'required',
            'tree_id' => 'sometimes',
        ],[],[
            'name_ar' => 'Arbic name',
            'name_en' => 'English name',
            'contract_number' => 'Contract number',
            'phone_number' => 'Phone number',
            'fax_number' => 'Fax number',
            'email' => 'Email',
            'esponsible_person' => 'Responsible person',
            'warehouse' => 'Warehouse',
            'subscriber_id' => 'Subscriber name',
            'roject_title' => 'Project title',
        ]);
        $project = request('project');
        $Project->update($data);
        return redirect(route('projects.index'))->with(session()->flash('message','Project is update successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $Project
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $Project = Project::findOrFail($id);
         $Project->delete();
         return back();
    }
}
