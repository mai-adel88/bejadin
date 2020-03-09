<?php

namespace App\Http\Controllers\API;

use App\Applicant;
use App\Enums\DegreeType;
use App\Enums\GradeType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class searchController extends Controller
{
    public function __construct(){
    $this->middleware('auth:api');
    }
    public function index(){
        $applicant = DB::table('applicants')->select('applicants.id as id','applicants.name_ar as name','jobs.name_ar as jobname','job_specifications.name_ar as job_spec','grade','status','age','experience_desc')
        ->where('status',2)
        ->rightJoin('jobs','applicants.job_id','=','jobs.id')
        ->rightJoin('job_specifications','applicants.job_spec_id','=','job_specifications.id')
        ->paginate(10);
        return $applicant;
    }
    public function search(Request $request){
        $grade = null;
        if ($request->grade == 'مقبول'){
            $grade = '0';
        }elseif ($request->grade == 'جيد'){
            $grade = '1';
        }elseif ($request->grade == 'جيد جدا'){
            $grade = '2';
        }elseif ($request->grade == 'ممتاز'){
            $grade = '3';
        }else{
            $grade = '';
        }
        $applicant = DB::table('applicants')->select('applicants.id as id','applicants.name_ar as name','jobs.name_ar as jobname','job_specifications.name_ar as job_spec','grade','status','age','experience_desc')
            ->rightJoin('jobs','applicants.job_id','=','jobs.id')
            ->rightJoin('job_specifications','applicants.job_spec_id','=','job_specifications.id')
            ->where('applicants.name_ar','LIKE','%'.$request->name.'%')
            ->where('jobs.name_ar','LIKE','%'.$request->jobs.'%')
            ->where('job_specifications.name_ar','LIKE','%'.$request->jobspec.'%')
            ->where('applicants.grade','LIKE','%'.$grade.'%')
            ->where('applicants.experience_desc','LIKE','%'.$request->experience.'%')
            ->where('status',2)
            ->paginate(10);
        return $applicant;
    }
}
