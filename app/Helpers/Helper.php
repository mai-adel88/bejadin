<?php


use App\Models\Admin\GLjrnTrs;
use App\Models\Admin\MtsCostcntr;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Admin\MtsChartAc;
use App\Models\Admin\Projectmfs;

if (!function_exists('makeNumber2Text')){
    function makeNumber2Text($numberValue){

        $textResult = ''; // so i can use .=
        $numberValue = "$numberValue";

        if($numberValue[0] == '-'){
            $textResult .= 'سالب ';
            $numberValue = substr($numberValue,1);
        }

        $numberValue = (int) $numberValue;
        $def = array(    "0" => 'صفر',
            "1" => 'واحد',
            "2" => 'اثنان',
            "3" => 'ثلاث',
            "4" => 'اربع',
            "5" => 'خمس',
            "6" => 'ست',
            "7" => 'سبع',
            "8" => 'ثمان',
            "9" => 'تسع',
            "10" => 'عشر',
            "11" => 'أحد عشر',
            "12" => 'اثنا عشر',
            "100" => 'مائة',
            "200" => 'مئتان',
            "1000" => 'ألف',
            "2000" => 'ألفين',
            "1000000" => 'مليون',
            "2000000" => 'مليونان');

        // check for defind values
        if(isset($def[$numberValue])) {
            // checking for numbers from 2 to 10 :reson = 2 to 10 uses 'ة' at the end
            if($numberValue < 11 && $numberValue > 2){
                if ($numberValue == 8 )
                    $textResult .= $def[$numberValue].'ية';
                else
                    $textResult .= $def[$numberValue].'ة';
            }
            else{
                // the rest of the defined numbers
                $textResult .= $def[$numberValue];
            }
        }
        else{
            $tensCheck = $numberValue%10;
            $numberValue = "$numberValue";

            for($x = strlen($numberValue); $x > 0; $x--){
                $places[$x] = $numberValue[strlen($numberValue)-$x];
            }

            switch(count($places)){
                case 2: // 2 numbers
                case 1: // or 1 number
                    {
                        if ($places[1] == 8 )
                            $textResult .= ($places[1] != 0) ? $def[$places[1]].(($places[1] > 2 || $places[2] == 1) ? 'ية' : '').(($places[2] != 1) ? ' و' : ' ') : '';
                        else

                            $textResult .= ($places[1] != 0) ? $def[$places[1]].(($places[1] > 2 || $places[2] == 1) ? 'ة' : '').(($places[2] != 1) ? ' و' : ' ') : '';
                        $textResult .= (($places[2] > 2) ? $def[$places[2]].'ون' : $def[10].(($places[2] != 2) ? '' : 'ون'));
                    }
                    break;
                case 3: // 3 numbers
                    {
                        $lastTwo = (int) $places[2].$places[1];
                        $textResult .= ($places[3] > 2) ? $def[$places[3]].' '.$def[100] : $def[(int) $places[3]."00"];
                        if($lastTwo != 0){
                            $textResult .= ' و'.makeNumber2Text($lastTwo);
                        }
                    }
                    break;
                case 4: // 4 numbrs
                    {
                        $lastThree = (int) $places[3].$places[2].$places[1];
                        $textResult .= ($places[4] > 2) ? $def[$places[4]].'ة الاف' : $def[(int) $places[4]."000"];
                        if($lastThree != 0){
                            $textResult .= ' و'.makeNumber2Text($lastThree);
                        }
                    }
                    break;
                case 5: // 5 numbers
                    {
                        $lastThree = (int) $places[3].$places[2].$places[1];
                        $textResult .= makeNumber2Text((int) $places[5].$places[4]).((((int) $places[5].$places[4]) != 10) ? ' الفاً' : ' الاف');
                        if($lastThree != 0){
                            $textResult .= ' و'.makeNumber2Text($lastThree);
                        }
                    }
                    break;
                case 6: // 6 numbers
                    {
                        $lastThree = (int) $places[3].$places[2].$places[1];
                        $textResult .= makeNumber2Text((int) $places[6].$places[5].$places[4]).((((int) $places[5].$places[4]) != 10) ? ' الفاً' : ' الاف');
                        if($lastThree != 0){
                            $textResult .= ' و'.makeNumber2Text($lastThree);
                        }
                    }
                    break;
                case 7: // 7 numbers 1 mill
                    {
                        $textResult .= ($places[7] > 2) ? $def[$places[7]].' ملايين' : $def[(int) $places[7]."000000"];
                        $textResult .= ' و';
                        $textResult .= makeNumber2Text((int) $places[6].$places[5].$places[4].$places[3].$places[2].$places[1]);
                    }
                    break;
                case 8: // 8 numbers 10 mill
                case 9: // 9 numbers 100 mill
                    {
                        $places[9] = (isset($places[9])) ? $places[9] : '';
                        $firstThree = (int) $places[9].$places[8].$places[7];
                        $textResult .=     makeNumber2Text($firstThree);
                        $textResult .=    ($firstThree < 11) ? ' ملايين ' : ' مليونا ';
                        if(((int) $places[6].$places[5].$places[4].$places[3].$places[2].$places[1]) != 0){
                            $textResult .= ' و';
                            $textResult .=    makeNumber2Text((int) $places[6].$places[5].$places[4].$places[3].$places[2].$places[1]);
                        }
                    }
                    break;
                default:
                {
                    $textResult = 'هذا رقم كبير .. ';
                }
            }

        }
        return $textResult;
    }
}
if (!function_exists('hr')){
    function hr(){
        return auth()->guard('hr');
    }
}
if (!function_exists('hrUrl')){
    function hrUrl($value = null){
        return url('hr/'.$value);
    }
}
//////جهات العمل HR
if (!function_exists('load_depLoc')){
    function load_depLoc($select = null , $cc_hide = null, $Cmp_No){

        $departments = \App\Models\Hr\HrDprtmntLoctn::where('Cmp_No', $Cmp_No)->get(['DepmLoc_Nm'.ucfirst(session('lang')), 'Parnt_DepmLoc', 'DepmLoc_No', 'ID_No']);

        $dep_arr = [];
        foreach($departments as $department){
            $list_arr = [];
            $list_arr['icon'] = '';
            $list_arr['li_attr'] = '';
            $list_arr['a_attr'] = '';
            $list_arr['children'] = [];
            if ($select !== null and $select == $department->DepmLoc_No){
                $list_arr['state'] = [
                    'opened'=>true,
                    'selected'=>true,
                    'disabled'=>false
                ];
            }
            if ($cc_hide !== null and $cc_hide == $department->DepmLoc_No){
                $list_arr['state'] = [
                    'opened'=>false,
                    'selected'=>false,
                    'disabled'=>true
                ];
            }

            $levelType = \App\Models\Hr\HrDprtmntLoctn::where('DepmLoc_No',$department->DepmLoc_No)->first()->Level_No;
            // $Operation = \App\Models\Hr\HrDprtmntLoctn::where('DepmLoc_No',$department->DepmLoc_No)->first()->Acc_Typ ? \App\Enums\AccountType::getDescription($department->Acc_Typ) : null;
            $cc = \App\Models\Hr\HrDprtmntLoctn::where('DepmLoc_No',$department->DepmLoc_No)->first()->CostCntr_Flag ? '( '.trans('admin.with_cc').' )' : null;
            $code = \App\Models\Hr\HrDprtmntLoctn::where('DepmLoc_No',$department->DepmLoc_No)->first()->DepmLoc_No;
            $list_arr['id'] = $department->DepmLoc_No;

            if( $department->Parnt_Acc !== null){
                if($department->Parnt_Acc == 0){
                    $department->Parnt_Acc = '#';
                    $list_arr['parent'] = $department->Parnt_Acc;
                }
                else{
                    $list_arr['parent'] = $department->Parnt_Acc;
                }
            }

            $list_arr['text'] = $department->{'DepmLoc_Nm'.ucfirst(session('lang'))} .' '.'( '.$code.' )'.'  '.$levelType.' '.$cc;
            array_push($dep_arr,$list_arr);

        }
        return json_encode($dep_arr,JSON_UNESCAPED_UNICODE);
    }
}
if (!function_exists('active_menu')){
    function active_menu($link = null) {
//        users:admin/i
        if ($link == Request::path()){
            return ['menu-open','display:block','active'];
        }else{
            return ['','', ''];
        }

//        if (preg_match('/'.$link.'/i',Request::segment(2))){
//            return ['menu-open','display:block','active'];
//        }else{
//            return ['','', ''];
//        }
    }
}
if (!function_exists('getcontacts')){
    function getcontacts($id = null) {
        return \App\CompanyContact::where('company_id',$id)->get();
    }
}
if (!function_exists('getapplicants')){
    function getapplicants($job_spec_id = null,$job_id = null,$experiences = null,$degree = null,$grade = null) {
//        users:admin/i
        return \App\Applicant::where('job_spec_id',$job_spec_id)->where('job_id',$job_id)->where('experience','>=',$experiences)->where('degree',$degree)->where('applicant_status','!=',1)->where('grade','>=',$grade)->get();
    }
}
if (!function_exists('calcevaluation')){
    function calcevaluation($applicant_id = null) {
        $qexists = \Illuminate\Support\Facades\DB::table('applicants_questions')->where('applicants_id',$applicant_id)->exists();
        $eexists =\Illuminate\Support\Facades\DB::table('applicants_evaluation')->where('applicants_id',$applicant_id)->exists();
        $applicant_questions = null;
        $applicants_evaluation = null;
        if ($qexists){
            $applicant_questions = \Illuminate\Support\Facades\DB::table('applicants_questions')->where('applicants_id',$applicant_id)->sum('result');
        }
        if ($eexists){
            $applicants_evaluation = \Illuminate\Support\Facades\DB::table('applicants_evaluation')->where('applicants_id',$applicant_id)->sum('result');
        }
        return ($applicant_questions + $applicants_evaluation) / 10;
    }
}
if (!function_exists('getquestions')){
    function getquestions($applicant_id = null,$question_id = null){
        return \Illuminate\Support\Facades\DB::table('applicants_questions')->where('applicants_id',$applicant_id)->where('questions_id',$question_id)->exists();
    }
}
if (!function_exists('getsign')){
    function getsign($applicant_id = null,$requests_id = null,$companyies_id = null){
        $sign = [];
        $paper = \App\papers::where('applicants_id',$applicant_id)->first();
        $applicant_companies = \App\applicants_company::where('companies_id',$companyies_id)->where('applicants_id',$applicant_id)->where('applicants_requests_id',$requests_id)->first();
        $applicantcompanies = \App\applicants_company::where('companies_id',$companyies_id)->where('applicants_id',$applicant_id)->where('applicants_requests_id',$requests_id);
        $sign[0] = \App\applicants_company::where('companies_id',$companyies_id)->where('applicants_id',$applicant_id)->where('applicants_requests_id',$requests_id)->where('date',null)->where('schedules',null)->where('contacts_id',null)->where('salary',null)->where('countries_id',null)->exists();
        $sign[1] = \Illuminate\Support\Facades\DB::table('applicants_questions')->where('applicants_id',$applicant_id)->exists();
        $sign[2] = \App\papers::where('applicants_id',$applicant_id)->where('visa',null)->where('licence',null)->where('graduation',null)->where('medical',null)->where('experience',null)->exists();
        $sign[3] = \App\applicants_company::where('companies_id',$companyies_id)->where('applicants_id',$applicant_id)->where('applicants_requests_id',$requests_id)->where('flight_number',null)->where('airline',null)->where('departure_date',null)->where('arrival_date',null)->where('departure_time',null)->where('arrival_time',null)->where('airport_departure',null)->where('airport_arrival',null)->exists();
        $sign[4] = \App\applicants_company::where('companies_id',$companyies_id)->where('applicants_id',$applicant_id)->where('applicants_requests_id',$requests_id)->where('agreement_date',null)->where('price',null)->where('price_else',null)->where('company_fees',null)->exists();

        return $sign;
    }
}
if (!function_exists('firstdatelaccount')){
    function firstdatelaccount($from = null,$relation = null,$operations = null) {
        $limitations = \App\limitations::whereNotIn('limitationsType_id',[12])->whereDate('created_at','<',$from)->pluck('id')->toArray();
        return \Illuminate\Support\Facades\DB::table('limitations_type')->whereIn('limitations_id',$limitations)->where('relation_id',$relation)->where('operation_id',$operations);
    }
}
if (!function_exists('firstdateraccount')){
    function firstdateraccount($maincompany= null,$MainBranch= null,$operations = null,$Acc_No= null,$from = null) {


        return \App\Models\Admin\GLjrnTrs::where('Cmp_No',$maincompany)->where('Brn_No',$MainBranch)->where('Ac_Ty',$operations)
            ->where('Tr_Dt','<', date('Y-m-d 00:00:00',strtotime($from)))
            ->where(function ($q) use($Acc_No) {
                $q->Where('Acc_No', $Acc_No)->orWhere('Sysub_Account',$Acc_No);
            });



    }
}
if (!function_exists('getlang')){
    function getlang($id = null) {
//        users:admin/i
        return \App\Language::where('applicant_id',$id)->first();
    }
}
if (!function_exists('getContact')){
    function getContact($id = null) {
//        users:admin/i
        return \App\Contact::where('company_id',$id)->first();
    }
}
if (!function_exists('getdepartemnt')){
    function getdepartemnt($id = null) {
        return \App\Department::where('id',$id)->first();
    }
}
if (!function_exists('getpjitmmsfl')){
    function getpjitmmsfl($id = null,$month = null,$year = null) {
        return \App\pjitmmsfl::where('tree_id',$id)->where('type','=','1')->where('month',$month)->where('year',$year)->first();
    }
}
if (!function_exists('getpjitmmsflcc')){
    function getpjitmmsflcc($id = null,$month = null,$year = null) {
        return \App\pjitmmsfl::where('cc_id',$id)->where('type','=','2')->where('month',$month)->where('year',$year)->first();
    }
}
if (!function_exists('expulsion_transaction')){
    function expulsion_transaction($id = null,$debtor = null,$creditor = null,$from = null,$to = null) {
        $department = \App\Department::where('id',$id)->first();
        $depbala = \App\pjitmmsfl::where('type','1')->where('tree_id',$department->id)->where('month','>=',date('n',strtotime($from)))->where('month','<=',date('n',strtotime($to)))->where('year',date('Y',strtotime($from)))->where('year',date('Y',strtotime($to)))->first();
        if($department->parent_id != null){
            $parent = \App\Department::where('id',$department->parent_id)->first();
            $depbalaexist = \App\pjitmmsfl::where('type','1')->where('tree_id',$department->parent_id)->where('month','>=',date('n',strtotime($from)))->where('month','<=',date('n',strtotime($to)))->where('year',date('Y',strtotime($from)))->where('year',date('Y',strtotime($to)))->exists();
            if($depbalaexist){
                $depbala2 = \App\pjitmmsfl::where('type','1')->where('tree_id',$department->parent_id)->where('month','>=',date('n',strtotime($from)))->where('month','<=',date('n',strtotime($to)))->where('year',date('Y',strtotime($from)))->where('year',date('Y',strtotime($to)))->first();
                \App\pjitmmsfl::where('type','1')->where('tree_id',$department->parent_id)->where('month','>=',date('n',strtotime($from)))->where('month','<=',date('n',strtotime($to)))->where('year',date('Y',strtotime($from)))->where('year',date('Y',strtotime($to)))->update(['creditor'=> \Illuminate\Support\Facades\DB::raw('creditor + '.$creditor),'debtor'=> \Illuminate\Support\Facades\DB::raw('debtor + '.$debtor)]);
            }elseif(!$depbalaexist){
                \App\pjitmmsfl::create(['debtor'=> $debtor,'creditor'=> $creditor,'tree_id'=>$department->parent_id,'month'=>date('n',strtotime($from)),'year'=>date('Y',strtotime($from)),'type'=>'1']);
            }
        }else{
            return '';
        }
        return expulsion_transaction($department->parent_id,$debtor,$creditor,$from,$to);
    }
}
if (!function_exists('expulsion_cc_transaction')){
    function expulsion_cc_transaction($id = null,$debtor = null,$creditor = null,$from = null,$to = null) {
        $glcc = \App\glcc::where('id',$id)->first();
        $depbala = \App\pjitmmsfl::where('type','2')->where('cc_id',$glcc->id)->where('month','>=',date('n',strtotime($from)))->where('month','<=',date('n',strtotime($to)))->where('year',date('Y',strtotime($from)))->where('year',date('Y',strtotime($to)))->first();
        if($glcc->parent_id != null){
            $parent = \App\Department::where('id',$glcc->parent_id)->first();
            $depbalaexist = \App\pjitmmsfl::where('type','2')->where('cc_id',$glcc->parent_id)->where('month','>=',date('n',strtotime($from)))->where('month','<=',date('n',strtotime($to)))->where('year',date('Y',strtotime($from)))->where('year',date('Y',strtotime($to)))->exists();
            if($depbalaexist){
                $depbala2 = \App\pjitmmsfl::where('type','2')->where('cc_id',$glcc->parent_id)->where('month','>=',date('n',strtotime($from)))->where('month','<=',date('n',strtotime($to)))->where('year',date('Y',strtotime($from)))->where('year',date('Y',strtotime($to)))->first();
                \App\pjitmmsfl::where('type','2')->where('cc_id',$glcc->parent_id)->where('month','>=',date('n',strtotime($from)))->where('month','<=',date('n',strtotime($to)))->where('year',date('Y',strtotime($from)))->where('year',date('Y',strtotime($to)))->update(['creditor'=> \Illuminate\Support\Facades\DB::raw('creditor + '.$creditor),'debtor'=> \Illuminate\Support\Facades\DB::raw('debtor + '.$debtor)]);
            }elseif(!$depbalaexist){
                \App\pjitmmsfl::create(['debtor'=> $debtor,'creditor'=> $creditor,'cc_id'=>$glcc->parent_id,'month'=>date('n',strtotime($from)),'year'=>date('Y',strtotime($from)),'type'=>'1']);
            }
        }else{
            return '';
        }
        return expulsion_cc_transaction($glcc->parent_id,$debtor,$creditor,$from,$to);
    }
}
if (!function_exists('getSitioPadre')){
    function getSitioPadre($id = null,$debtor = null,$creditor = null,$date = null) {
        $department = \App\Department::where('id',$id)->first();
        $pjitmmsflexists = \App\pjitmmsfl::where('tree_id',$id)->where('month',date('n',strtotime($date)))->where('year',date('Y',strtotime($date)))->exists();
        $depbala = \App\pjitmmsfl::where('tree_id',$id)->where('month',date('n',strtotime($date)))->where('year',date('Y',strtotime($date)))->first();
//        \App\Department::where('id',$department->id)->update(['estimite' => $department->creditor - $department->debtor]);
        if($pjitmmsflexists){
            \App\pjitmmsfl::where('tree_id',$id)->where('month',date('n',strtotime($date)))->where('year',date('Y',strtotime($date)))->update(['current_balance' => $depbala->creditor - $depbala->debtor]);
        }
        if($department->parent_id !=  null){
            $parent = \App\Department::where('id',$department->parent_id)->first();
//            \App\Department::where('id',$department->parent_id)->update(['estimite' => $parent->creditor - $parent->debtor]);
            $parentexists = \App\pjitmmsfl::where('tree_id',$department->parent_id)->exists();
            if($parentexists){
                $depbala2 = \App\pjitmmsfl::where('tree_id',$department->parent_id)->first();
                \App\pjitmmsfl::where('tree_id',$department->parent_id)->update(['current_balance' => $depbala2->creditor - $depbala2->debtor]);
            }else{
                \App\pjitmmsfl::create(['debtor'=> $debtor,'creditor'=> $creditor,'tree_id'=>$department->parent_id,'month'=>date('n',strtotime($date)),'year'=>date('Y',strtotime($date)),'type'=>'1']);
                $depbala2 = \App\pjitmmsfl::where('tree_id',$department->parent_id)->first();
                \App\pjitmmsfl::where('tree_id',$department->parent_id)->update(['current_balance' => $depbala2->creditor - $depbala2->debtor]);
            }
            if ($parent->debtor != null){
//                \App\Department::where('id',$department->parent_id)->update(['debtor'=> \Illuminate\Support\Facades\DB::raw('debtor + '.$debtor)]);
                if($parentexists){
                    \App\pjitmmsfl::where('tree_id',$department->parent_id)->update(['debtor'=> \Illuminate\Support\Facades\DB::raw('debtor + '.$debtor)]);
                }
            }else{
                \App\pjitmmsfl::where('tree_id',$department->parent_id)->update(['debtor'=> $debtor]);
                $parent->debtor = $debtor;
                $parent->save();
            }
            if($parent->creditor != null){
                if($parentexists){
                    \App\pjitmmsfl::where('tree_id',$department->parent_id)->update(['creditor'=> \Illuminate\Support\Facades\DB::raw('creditor + '.$creditor)]);
                }
//                \App\Department::where('id',$department->parent_id)->update(['creditor'=> \Illuminate\Support\Facades\DB::raw('creditor + '.$creditor)]);
            }else{
                \App\pjitmmsfl::where('tree_id',$department->parent_id)->update(['creditor'=> $creditor]);
                $parent->creditor = $creditor;
                $parent->save();
            }
        }else{
            return '';
        }
        return getSitioPadre($department->parent_id,$debtor,$creditor,$date);
    }
}
if (!function_exists('getSitiocc')){
    function getSitiocc($id = null,$debtor = null,$creditor = null,$date = null) {
        $glcc = \App\glcc::where('id',$id)->first();
        $pjitmmsflexists = \App\pjitmmsfl::where('cc_id',$id)->where('month',date('n',strtotime($date)))->where('year',date('Y',strtotime($date)))->exists();
        \App\glcc::where('id',$glcc->id)->update(['estimite' => $glcc->creditor - $glcc->debtor]);
        $glccbala = \App\pjitmmsfl::where('cc_id',$id)->where('month',date('n',strtotime($date)))->where('year',date('Y',strtotime($date)))->first();
        if($pjitmmsflexists){
            \App\pjitmmsfl::where('cc_id',$id)->where('month',date('n',strtotime($date)))->where('year',date('Y',strtotime($date)))->update(['current_balance' => $glccbala->creditor - $glccbala->debtor]);
        }
        if($glcc->parent_id !=  null){
            $parent = \App\glcc::where('id',$glcc->parent_id)->first();
            \App\glcc::where('id',$glcc->parent_id)->update(['estimite' => $parent->creditor - $parent->debtor]);
            $parentexists = \App\pjitmmsfl::where('cc_id',$glcc->parent_id)->exists();
            if($parentexists){
                $glccbala2 = \App\pjitmmsfl::where('cc_id',$glcc->parent_id)->first();
                \App\pjitmmsfl::where('cc_id',$glcc->parent_id)->update(['current_balance' => $glccbala2->creditor - $glccbala2->debtor]);
            }else{
                \App\pjitmmsfl::create(['debtor'=> $debtor,'creditor'=> $creditor,'cc_id'=>$glcc->parent_id,'month'=>date('n',strtotime($date)),'year'=>date('Y',strtotime($date)),'type'=>'2']);
                $glccbala2 = \App\pjitmmsfl::where('cc_id',$glcc->parent_id)->first();
                \App\pjitmmsfl::where('cc_id',$glcc->parent_id)->update(['current_balance' => $glccbala2->creditor - $glccbala2->debtor]);
            }
            if ($parent->debtor != null){
                \App\glcc::where('id',$glcc->parent_id)->update(['debtor'=> \Illuminate\Support\Facades\DB::raw('debtor + '.$debtor)]);
                if($parentexists){
                    \App\pjitmmsfl::where('cc_id',$glcc->parent_id)->update(['debtor'=> \Illuminate\Support\Facades\DB::raw('debtor + '.$debtor)]);
                }
            }else{
                \App\pjitmmsfl::where('cc_id',$glcc->parent_id)->update(['debtor'=> $debtor]);
                $parent->debtor = $debtor;
                $parent->save();
            }
            if($parent->creditor != null){
                \App\glcc::where('id',$glcc->parent_id)->update(['creditor'=> \Illuminate\Support\Facades\DB::raw('creditor + '.$creditor)]);
                if($parentexists){
                    \App\pjitmmsfl::where('cc_id',$glcc->parent_id)->update(['creditor'=> \Illuminate\Support\Facades\DB::raw('creditor + '.$creditor)]);
                }
            }else{
                \App\pjitmmsfl::where('cc_id',$glcc->parent_id)->update(['creditor'=> $creditor]);
                $parent->creditor = $creditor;
                $parent->save();
            }
        }else{
            return '';
        }
        return getSitiocc($glcc->parent_id,$debtor,$creditor,$date);
    }
}
if (!function_exists('generateBarcodeNumber')){
    function generateBarcodeNumber() {
        $number = mt_rand(100000000, mt_getrandmax()); // better than rand()

        // call the same function if the barcode exists already
        if (barcodeNumberExists($number)) {
            return generateBarcodeNumber();
        }

        // otherwise, it's valid and can be used
        return $number;
    }

    function barcodeNumberExists($number) {
        // query the database and return a boolean
        // for instance, it might look like this in Laravel
        return \App\receipts::where('invoice_id',$number)->exists();
    }
}
if (!function_exists('checkIdLimitation')){
    function checkIdLimitation($id = null) {
        $exists = \App\limitations::where('limitationsType_id',$id)->orderBy('limitationId', 'desc')->exists();
        if ($exists){
            $count = \App\limitations::where('limitationsType_id',$id)->orderBy('limitationId', 'desc')->first();
            $maxValue = $count->limitationId;
            return $maxValue + 1;
        }else{
            return 1;
        }
    }
}
if (!function_exists('checkIdReceipts')){
    function checkIdReceipts($id = null) {
        $exists = \App\receipts::where('receiptsType_id', $id)->orderBy('receiptId', 'desc')->exists();
        if ($exists) {
            $count = \App\receipts::where('receiptsType_id', $id)->orderBy('receiptId', 'desc')->first();
            $maxValue = $count->receiptId;
            return $maxValue + 1;
        }else{
            return 1;
        }
    }
}
if (!function_exists('limitationReceiptsid')){
    function limitationReceiptsid($id = null) {
        return \App\limitationReceipts::where('id', $id)->first()['limitationReceiptsId'];

    }
}
if (!function_exists('generateBarcodeNumber2')){
    function generateBarcodeNumber2() {
        $number = mt_rand(100000000, mt_getrandmax()); // better than rand()

        // call the same function if the barcode exists already
        if (barcodeNumberExists($number)) {
            return generateBarcodeNumber2();
        }

        // otherwise, it's valid and can be used
        return $number;
    }

    function barcodeNumberExists2($number) {
        // query the database and return a boolean
        // for instance, it might look like this in Laravel
        return \App\limitations::where('invoice_id',$number)->exists();
    }
}
if (!function_exists('receiptsTypes')){
    function receiptsTypes($id = null) {
        return \App\receiptsType::where('receipts_id',$id)->get(); // better than rand()
        // otherwise, it's valid and can be used
    }

}
if (!function_exists('limitationsTypes')){
    function limitationsTypes($id = null) {
        return \App\limitationsType::where('limitations_id',$id)->get(); // better than rand()
        // otherwise, it's valid and can be used
    }

}

if (!function_exists('setting')){
    function setting($value = null){
        return \App\setting::orderBy('id','desc')->first();
    }
}

if (!function_exists('slider')){
    function slider($value = null){
        return \App\Slider::all();
    }
}

if (!function_exists('about')){
    function about($value = null){
        return \App\AboutPage::where('id','=',1)->first();
    }
}

if (!function_exists('service')){
    function service($value = null){
        return \App\ServicePage::all();
    }
}

if (!function_exists('interview')){
    function interview($value = null){
        return \App\InterviewPage::all();
    }
}

if (!function_exists('paper')){
    function paper($value = null){
        return \App\PaperPage::all();
    }
}

if (!function_exists('blog')){
    function blog($value = null){
        return \App\blog::all();
    }
}

if (!function_exists('aurl')){
    function aurl($value = null){
        return url('admin/'.$value);
    }
}
if (!function_exists('admin')){
    function admin(){
        return auth()->guard('admin');
    }
}
if (!function_exists('admin_2')){
    function admin_2(){
        return auth()->guard('admin_2');
    }
}
if (!function_exists('getbus')){
    function getbus($id = null){
        return \App\bus::where('id','=',$id)->first();
    }
}
if (!function_exists('LimitationData')){
    function LimitationData($id = null,$date = null,$branch = null,$limitationsType_id = null){
        return \App\limitations::where('id',$id)->whereDate('created_at','=',$date)->where('branche_id',$branch)->where('limitationsType_id',$limitationsType_id)->first();
    }
}
if (!function_exists('getsubscriper')){
    function getsubscriper($id = null){
        return \App\subscription::where('id','=',$id)->first();
    }
}
if (!function_exists('getExcerpt')){
    function getExcerpt($str, $startPos=null, $maxLength=null) {
        if(strlen($str) > $maxLength) {
            $excerpt   = substr($str, $startPos, $maxLength-3);
            $lastSpace = strrpos($excerpt, ' ');
            $excerpt   = substr($excerpt, 0, $lastSpace);
            $excerpt  .= '...';
        } else {
            $excerpt = $str;
        }

        return $excerpt;
    }
}
if (!function_exists('getdriver')){
    function getdriver($id = null){
        return \App\drivers::where('id','=',$id)->first();
    }
}
if (!function_exists('state')){
    function state($id = null){
        return \App\state::where('id','=',$id)->first();
    }
}
if (!function_exists('seating')){
    function seating($id = null,$date = null){
        return \App\book::where('transport_id',$id)->where('date',$date)->count();
    }
}
if (!function_exists('getschedule')){
    function getschedule($id = null){
        return \App\schedule::where('id','=',$id)->first();
    }
}
if (!function_exists('load_dep')){
    function load_dep($select = null,$dep_hide = null, $Cmp_No){

        $departments = MtsChartAc::where('Cmp_No', $Cmp_No)->get(['Acc_Nm'.ucfirst(session('lang')), 'Parnt_Acc', 'Acc_No', 'ID_No']);

        $dep_arr = [];
        foreach($departments as $department){
            $list_arr = [];
            $list_arr['icon'] = '';
            $list_arr['li_attr'] = '';
            $list_arr['a_attr'] = '';
            $list_arr['children'] = [];
            if ($select !== null and $select == $department->Acc_No){
                $list_arr['state'] = [
                    'opened'=>true,
                    'selected'=>true,
                    'disabled'=>false
                ];
            }
            if ($dep_hide !== null and $dep_hide == $department->Acc_No){
                $list_arr['state'] = [
                    'opened'=>false,
                    'selected'=>false,
                    'disabled'=>true
                ];
            }

            $levelType = MtsChartAc::where('Acc_No',$department->Acc_No)->first()->Level_No;
            $Operation = MtsChartAc::where('Acc_No',$department->Acc_No)->first()->Acc_Typ ? \App\Enums\AccountType::getDescription($department->Acc_Typ) : null;
            $cc = MtsChartAc::where('Acc_No',$department->Acc_No)->first()->CostCntr_Flag ? '( '.trans('admin.with_cc').' )' : null;
            $code = MtsChartAc::where('Acc_No',$department->Acc_No)->first()->Acc_No;
            $list_arr['id'] = $department->Acc_No;

            if( $department->Parnt_Acc !== null){
                if($department->Parnt_Acc == 0){
                    $department->Parnt_Acc = '#';
                    $list_arr['parent'] = $department->Parnt_Acc;
                }
                else{
                    $list_arr['parent'] = $department->Parnt_Acc;
                }
            }

            $list_arr['text'] = $department->{'Acc_Nm'.ucfirst(session('lang'))} .' '.'( '.$code.' )'.' '.$Operation.' '.$levelType.' '.$cc;
            array_push($dep_arr,$list_arr);

        }
        return json_encode($dep_arr,JSON_UNESCAPED_UNICODE);
    }
}

if (!function_exists('load_prj')){
    function load_prj($select = null,$dep_hide = null, $Cmp_No){


        $projects = Projectmfs::where('Cmp_No', $Cmp_No)->get(['Prj_Nm'.ucfirst(session('lang')), 'Prj_Parnt', 'Prj_No', 'ID_No']);

        $dep_arr = [];
        foreach($projects as $project){
            $list_arr = [];
            $list_arr['icon'] = '';
            $list_arr['li_attr'] = '';
            $list_arr['a_attr'] = '';
            $list_arr['children'] = [];
            if ($select !== null and $select == $project->Prj_No){
                $list_arr['state'] = [
                    'opened'=>true,
                    'selected'=>true,
                    'disabled'=>false
                ];
            }
            if ($dep_hide !== null and $dep_hide == $project->Prj_No){
                $list_arr['state'] = [
                    'opened'=>false,
                    'selected'=>false,
                    'disabled'=>true
                ];
            }

            $levelType = Projectmfs::where('Prj_No',$project->Prj_No)->first()->Level_No;
            $Operation = Projectmfs::where('Prj_No',$project->Prj_No)->first()->Prj_Status ? \App\Enums\PrjStatus::getDescription($project->Prj_Status) : null;
            $cc = Projectmfs::where('Prj_No',$project->Prj_No)->first()->CostCntr_Flag ? '( '.trans('admin.with_cc').' )' : null;
            $code = Projectmfs::where('Prj_No',$project->Prj_No)->first()->Prj_No;
            $list_arr['id'] = $project->Prj_No;

            if( $project->Prj_Parnt !== null){
                if($project->Prj_Parnt == 0){
                    $project->Prj_Parnt = '#';
                    $list_arr['parent'] = $project->Prj_Parnt;
                }
                else{
                    $list_arr['parent'] = $project->Prj_Parnt;
                }
            }

            $list_arr['text'] = $project->{'Prj_Nm'.ucfirst(session('lang'))} .' '.'( '.$code.' )'.' '.$Operation.' '.$levelType.' '.$cc;
            array_push($dep_arr,$list_arr);

        }
        return json_encode($dep_arr,JSON_UNESCAPED_UNICODE);
    }
}



if (!function_exists('lang')){
    function lang(){
        if (session()->has('lang')){
            return session('lang');
        }else{
            session()->put('lang',setting()['main_lang']);
            return setting()['main_lang'];
        }
    }
}

if (!function_exists('direction')){
    function direction(){
        if (session()->has('lang')){
            if(session('lang') == 'ar'){
                return 'rtl';
            }else{
                return 'ltr';
            }
        }else{
            return 'ltr';
        }
    }
}

if (!function_exists('session_lang')){
    function session_lang($var1 = null,$var2 = null){
        if(session('lang')=='en')
        {
            return $var1;
        }else{
            return $var2;
        }
    }
}

if(!function_exists('validate_image')) {
    function validate_image($ext = null)
    {
        if ($ext === null) {
            return 'image|mimes:jpg,jpeg,png,gif,bmp';
        } else {
            return 'image|mimes:' . $ext;
        }
    }
}

if(!function_exists('sumallcc')) {
    function sumallcc($id = null,$from = null,$to = null,$sum = null,$sign = null,$sign2 = null)
    {

        $value = [];
        $departments = MtsCostcntr::findOrFail($id);

        $pros = [];
        $products = [];
        $categories = $departments->children;

        while(count($categories) > 0){
            $nextCategories = [];
            foreach ($categories as $category) {
                $products = array_merge($products, $category->children->all());
                $nextCategories = array_merge($nextCategories, $category->children->all());
            }
            $categories = $nextCategories;
        }

        $pro = new Illuminate\Database\Eloquent\Collection($products); //Illuminate\Database\Eloquent\Collection

        $pros = $departments->children->pluck('id');
        $plucks = $pro->pluck('id');
        $values = $pros->concat($plucks);

        $depart = \App\glcc::where('type','1')->whereIn('id',$values)->pluck('id');


        $value1 = \App\limitationsType::whereIn('cc_id',$depart)->whereHas('limitations', function($query) use ($from,$to,$sign,$sign2){
            $query->whereDate('created_at', $sign, $from)->whereDate('created_at', '<=', $to);
        })->sum($sum);

        $value2 = \App\receiptsType::whereIn('cc_id',$depart)->whereHas('receipts' , function($query) use ($from,$to,$sign,$sign2){
            $query->whereDate('created_at', $sign, $from)->whereDate('created_at', '<=', $to);
        })->sum($sum);

        return $value1 + $value2;
    }
}
if(!function_exists('sumallcc2')) {
    function sumallcc2($id = null,$from = null,$to = null,$sum = null,$sign = null,$sign2 = null)
    {
        $value = [];
        $departments = \App\glcc::findOrFail($id);
        $pros = [];
        $products = [];
        $categories = $departments->children;
        while(count($categories) > 0){
            $nextCategories = [];
            foreach ($categories as $category) {
                $products = array_merge($products, $category->children->all());
                $nextCategories = array_merge($nextCategories, $category->children->all());
            }
            $categories = $nextCategories;
        }
        $pro = new Illuminate\Database\Eloquent\Collection($products); //Illuminate\Database\Eloquent\Collection
        $pros = $departments->children->pluck('id');
        $plucks = $pro->pluck('id');
        $values = $pros->concat($plucks);

        $depart = \App\glcc::where('type','1')->whereIn('id',$values)->pluck('id');
        $value1 = \App\limitationsType::whereIn('cc_id',$depart)->whereHas('limitations', function($query) use ($from,$to,$sign,$sign2){
            $query->whereDate('created_at', $sign, $from);
        })->sum($sum);
        $value2 = \App\receiptsType::whereIn('cc_id',$depart)->whereHas('receipts' , function($query) use ($from,$to,$sign,$sign2){
            $query->whereDate('created_at', $sign, $from);
        })->sum($sum);
        return $value1 + $value2;
    }
}
if(!function_exists('allcc')) {
    function allcc($id = null,$from = null,$to = null,$sum = null,$sign = null,$sign2 = null)
    {
        $value1 = \App\limitationsType::where('cc_id',$id)->whereHas('limitations', function($query) use ($from,$to,$sign,$sign2){
            $query->whereDate('created_at', $sign, $from)->whereDate('created_at', '<=', $to);
        })->sum($sum);
        $value2 = \App\receiptsType::where('cc_id',$id)->whereHas('receipts' , function($query) use ($from,$to,$sign,$sign2){
            $query->whereDate('created_at', $sign, $from)->whereDate('created_at', '<=', $to);
        })->sum($sum);
        return $value1 + $value2;
    }
}
if(!function_exists('allcc2')) {
    function allcc2($id = null,$from = null,$to = null,$sum = null,$sign = null,$sign2 = null)
    {
        $value1 = \App\limitationsType::where('cc_id',$id)->whereHas('limitations', function($query) use ($from,$to,$sign,$sign2){
            $query->whereDate('created_at', $sign, $from);
        })->sum($sum);
        $value2 = \App\receiptsType::where('cc_id',$id)->whereHas('receipts' , function($query) use ($from,$to,$sign,$sign2){
            $query->whereDate('created_at', $sign, $from);
        })->sum($sum);
        return $value1 + $value2;
    }
}
if(!function_exists('sumall')) {
    function sumall($id = null,$operations = null,$from = null,$to = null,$sum = null,$sign = null,$sign2 = null)
    {
        if ($operations != null){
            $value1 = \App\limitationsType::where('relation_id',$id)->where('operation_id',$operations)->whereHas('limitations' , function($query) use ($from,$to,$sign,$sign2){
                $query->whereDate('created_at', $sign, $from)->whereDate('created_at', '<=', $to);
            })->sum($sum);
            $value2 = \App\receiptsType::where('relation_id',$id)->where('operation_id',$operations)->whereHas('receipts' , function($query) use ($from,$to,$sign,$sign2){
                $query->whereDate('created_at', $sign, $from)->whereDate('created_at', '<=', $to);
            })->sum($sum);
            return $value1 + $value2;
        }else{
            $value1 = \App\limitationsType::where('tree_id',$id)->whereHas('limitations', function($query) use ($from,$to,$sign,$sign2){
                $query->whereDate('created_at', $sign, $from)->whereDate('created_at', '<=', $to);
            })->sum($sum);
            $value2 = \App\receiptsType::where('tree_id',$id)->whereHas('receipts' , function($query) use ($from,$to,$sign,$sign2){
                $query->whereDate('created_at', $sign, $from)->whereDate('created_at', '<=', $to);
            })->sum($sum);
            $value3 = \App\receiptsData::where('tree_id',$id)->whereHas('receipts' , function($query) use ($from,$to,$sign,$sign2){
                $query->whereDate('created_at', $sign, $from)->whereDate('created_at', '<=', $to);
            })->sum($sum);
            return $value1 + $value2 + $value3;
        }
    }
}
if(!function_exists('sumall2')) {
    function sumall2($id = null,$operations = null,$from = null,$to = null,$sum = null,$sign = null,$sign2 = null)
    {
        if ($operations != null){
            $value1 = \App\limitationsType::where('relation_id',$id)->where('operation_id',$operations)->whereHas('limitations' , function($query) use ($from,$to,$sign,$sign2){
                $query->whereDate('created_at', $sign, $from);
            })->sum($sum);
            $value2 = \App\receiptsType::where('relation_id',$id)->where('operation_id',$operations)->whereHas('receipts' , function($query) use ($from,$to,$sign,$sign2){
                $query->whereDate('created_at', $sign, $from);
            })->sum($sum);
            return $value1 + $value2;
        }else{
            $value1 = \App\limitationsType::where('tree_id',$id)->whereHas('limitations', function($query) use ($from,$to,$sign,$sign2){
                $query->whereDate('created_at', $sign, $from);
            })->sum($sum);
            $value2 = \App\receiptsType::where('tree_id',$id)->whereHas('receipts' , function($query) use ($from,$to,$sign,$sign2){
                $query->whereDate('created_at', $sign, $from);
            })->sum($sum);
            $value3 = \App\receiptsData::where('tree_id',$id)->whereHas('receipts' , function($query) use ($from,$to,$sign,$sign2){
                $query->whereDate('created_at', $sign, $from);
            })->sum($sum);
            return $value1 + $value2 + $value3;
        }
    }
}

if(!function_exists('alldepartmenttrial')) {
    function alldepartmenttrial($Cmp_No = null,$from = null,$to = null,$sum = null,$sign = null)
    {

        $value1 = \App\Models\Admin\GLjrnTrs::where('Cmp_No',$Cmp_No)
            ->whereDate('created_at',$sign,$from)->whereDate('created_at','<=',$to)->sum($sum);


        return $value1 ;
    }
}
if(!function_exists('BalanceFirstPeriod_department')) {
    function BalanceFirstPeriod_department($Cmp_No = null,$Sysub_Account= Null,$From = null,$to = null,$sum = null,$sign = null)
    {

        $GLjrnTrs = GLjrnTrs::where('Cmp_No',$Cmp_No)->where('Ac_Ty',1)

            ->where('Tr_Dt','<=', date('Y-m-d 00:00:00',strtotime($From)))
            ->where(function ($q) use($Acc_No) {
                $q->whereIn('Acc_No', $Acc_No)->orWhereIn('Sysub_Account',$Acc_No);
            })->groupBy(['Acc_No', 'Sysub_Account'])
            ->get();
        $value1 = \App\Models\Admin\GLjrnTrs::where('Cmp_No',$Cmp_No)
            ->where('Sysub_Account',$Sysub_Account)
            ->where('Tr_Dt','<', date('Y-m-d 00:00:00',strtotime($From)))


            ->sum($sum);

        return $value1 ;



    }
}
if(!function_exists('balancefirstperiod')) {
    function balancefirstperiod($Cmp_No = null,$Sysub_Account= Null,$From = null,$to = null,$sum = null,$sign = null)
    {

        $value1 = \App\Models\Admin\GLjrnTrs::where('Cmp_No',$Cmp_No)
            ->where('Sysub_Account',$Sysub_Account)
            ->where('Tr_Dt','<', date('Y-m-d 00:00:00',strtotime($From)))


            ->sum($sum);

        return $value1 ;



    }
}

if(!function_exists('balance')) {
    function balance($Cmp_No = null,$Sysub_Account= Null,$From = null,$to = null,$sum = null,$sign = null)
    {
        $value1 = \App\Models\Admin\GLjrnTrs::where('Cmp_No',$Cmp_No)
           ->where('Sysub_Account',$Sysub_Account)
            ->where('Tr_Dt',$sign, date('Y-m-d 00:00:00',strtotime($From)))
            ->where('Tr_Dt','<=', date('Y-m-d 00:00:00',strtotime($to)))

            ->sum($sum);

        return $value1 ;
    }
}
if(!function_exists('alldepartmenttrial2')) {
    function alldepartmenttrial2($id = null,$from = null,$to = null,$sum = null,$sign = null)
    {
        $value1 = \App\limitationsType::where('tree_id',$id)->whereHas('limitations',function ($query) use ($from,$to,$sign){
            $query->whereDate('created_at',$sign,$from);
        })->sum($sum);
        $value2 = \App\receiptsType::where('tree_id',$id)->whereHas('receipts',function ($query) use ($from,$to,$sign){
            $query->whereDate('created_at',$sign,$from);
        })->sum($sum);
        $value3 = \App\receiptsData::where('tree_id',$id)->whereHas('receipts',function ($query) use ($from,$to,$sign){
            $query->whereDate('created_at',$sign,$from);
        })->sum($sum);
        return $value1 + $value2 + $value3;
    }
}
if(!function_exists('alldepartmenttrial2')) {
    function alldepartmenttrial2($id = null,$from = null,$to = null,$sum = null,$sign = null)
    {
        $depart = \App\Department::where('type','1')->whereIn('id',$values)->pluck('id');
//        dd(\App\limitationsType::whereIn('tree_id',$depart)->whereHas('limitations')->sum('debtor'));
        $value1 = \App\limitationsType::whereIn('tree_id',$depart)->whereHas('limitations', function($query) use ($from,$to,$sign){
            $query->whereDate('created_at', $sign, $from)->whereDate('created_at', '<=', $to);
        })->sum($sum);
        $value2 = \App\receiptsType::whereIn('tree_id',$depart)->whereHas('receipts', function($query) use ($from,$to,$sign){
            $query->whereDate('created_at', $sign, $from)->whereDate('created_at', '<=', $to);
        })->sum($sum);
        $value3 = \App\receiptsData::whereIn('tree_id',$depart)->whereHas('receipts', function($query) use ($from,$to,$sign){
            $query->whereDate('created_at', $sign, $from)->whereDate('created_at', '<=', $to);
        })->sum($sum);

        return $value1 + $value2 + $value3;

    }
}










if(!function_exists('departmentsum')) {
    function balanceDepartment($id = null,$from = null,$to = null,$sum = null,$sign = null)
    {


        $value1 = \App\limitationsType::whereIn('tree_id',$departments)->whereHas('limitations', function($query) use ($from,$to,$sign){
            $query->whereDate('created_at', '<=', $to);
            $query->whereDate('created_at', $sign, $from);
        })->sum($sum);


        return $value1 ;


    }

}



if (!function_exists('load_cc')){
    function load_cc($select = null , $cc_hide = null, $Cmp_No){

        $departments = \App\Models\Admin\MtsCostcntr::where('Cmp_No', $Cmp_No)->get(['Costcntr_Nm'.ucfirst(session('lang')), 'Parnt_Acc', 'Costcntr_No', 'ID_No']);

        $dep_arr = [];
        foreach($departments as $department){
            $list_arr = [];
            $list_arr['icon'] = '';
            $list_arr['li_attr'] = '';
            $list_arr['a_attr'] = '';
            $list_arr['children'] = [];
            if ($select !== null and $select == $department->Acc_No){
                $list_arr['state'] = [
                    'opened'=>true,
                    'selected'=>true,
                    'disabled'=>false
                ];
            }
            if ($cc_hide !== null and $cc_hide == $department->Acc_No){
                $list_arr['state'] = [
                    'opened'=>false,
                    'selected'=>false,
                    'disabled'=>true
                ];
            }

            $levelType = \App\Models\Admin\MtsCostcntr::where('Costcntr_No',$department->Costcntr_No)->first()->Level_No;
            $Operation = \App\Models\Admin\MtsCostcntr::where('Costcntr_No',$department->Costcntr_No)->first()->Acc_Typ ? \App\Enums\AccountType::getDescription($department->Acc_Typ) : null;
            $cc = \App\Models\Admin\MtsCostcntr::where('Costcntr_No',$department->Costcntr_No)->first()->CostCntr_Flag ? '( '.trans('admin.with_cc').' )' : null;
            $code = \App\Models\Admin\MtsCostcntr::where('Costcntr_No',$department->Costcntr_No)->first()->Costcntr_No;
            $list_arr['id'] = $department->Costcntr_No;

            if( $department->Parnt_Acc !== null){
                if($department->Parnt_Acc == 0){
                    $department->Parnt_Acc = '#';
                    $list_arr['parent'] = $department->Parnt_Acc;
                }
                else{
                    $list_arr['parent'] = $department->Parnt_Acc;
                }
            }

            $list_arr['text'] = $department->{'Costcntr_Nm'.ucfirst(session('lang'))} .' '.'( '.$code.' )'.' '.$Operation.' '.$levelType.' '.$cc;
            array_push($dep_arr,$list_arr);

        }
        return json_encode($dep_arr,JSON_UNESCAPED_UNICODE);
    }
}

if (!function_exists('load_item')){
        function load_item($select = null , $item_hide = null, $Cmp_No ,$Actvty_No){

            $items = \App\Models\Admin\MtsItmmfs::where('Cmp_No', $Cmp_No)->where('Actvty_No' , $Actvty_No)->get(['Itm_Nm'.ucfirst(session('lang')), 'Itm_Parnt', 'Itm_No', 'ID_No']);

            $item_arr = [];
            foreach($items as $item){
                $list_arr = [];
                $list_arr['icon'] = '';
                $list_arr['li_attr'] = '';
                $list_arr['a_attr'] = '';
                $list_arr['children'] = [];
                if ($select !== null and $select == $item->Itm_Parnt){
                    $list_arr['state'] = [
                        'opened'=>true,
                        'selected'=>true,
                        'disabled'=>false
                    ];
                }
                if ($item_hide !== null and $item_hide == $item->Itm_No){
                    $list_arr['state'] = [
                        'opened'=>false,
                        'selected'=>false,
                        'disabled'=>true
                    ];
                }

                $itemGet = \App\Models\Admin\MtsItmmfs::where('Itm_No',$item->Itm_No)->first();
                $levelType = $itemGet->Level_No;
                $code = $itemGet->Itm_No;
                $list_arr['id'] = $item->Itm_No;

                if($item->Itm_Parnt  == null){
                    $item->Itm_Parnt = '#';
                    $list_arr['parent'] = $item->Itm_Parnt;
                }
                else{
                    $list_arr['parent'] = $item->Itm_Parnt;
                }

                $list_arr['text'] = $item->{'Itm_Nm'.ucfirst(session('lang'))}.' '.'( '.$code.' )'.' '.$levelType;
                array_push($item_arr,$list_arr);

            }
            return json_encode($item_arr,JSON_UNESCAPED_UNICODE);
        }

}

if(!function_exists('Fbalance')) {
    function Fbalance($Cmp_No = null,$Acc_No= Null,$from = null,$to = null,$sum = null,$sign = null)
    {
        $mtschartac = MtsChartAc::where('Cmp_No',$Cmp_No)->where('Clsacc_No3', $Acc_No)->pluck('Acc_No');

        $value1 = GLjrnTrs::where('Cmp_No',$Cmp_No)->where('Ac_Ty',1)
            ->where('Tr_Dt','<', date('Y-m-d 00:00:00',strtotime($from)))
            ->whereIn('Acc_No',$mtschartac)
            ->where('Ln_No',1)->sum($sum);

        $value2 = GLjrnTrs::where('Cmp_No',$Cmp_No)->where('Ac_Ty',1)
            ->where('Tr_Dt','<', date('Y-m-d 00:00:00',strtotime($from)))
            ->whereIn('Sysub_Account',$mtschartac)
            ->where('Ln_No','>',1)->sum($sum);


       return $value1  +$value2;
//            + $value2;
    }
}

//for Customer
if(!function_exists('FbalanceCust')) {
    function FbalanceCust($Cmp_No = null,$Acc_No= Null,$from = null,$to = null,$sum = null,$sign = null)
    {
//        dd($Cmp_No,$Acc_No,$from,$sum);
        $value1 = GLjrnTrs::where('Cmp_No',$Cmp_No)->where('Ac_Ty',2)
            ->where('Tr_Dt','<', date('Y-m-d 00:00:00',strtotime($from)))
            ->where('Acc_No',$Acc_No)
            ->where('Ln_No',1)->sum($sum);

        $value2 = GLjrnTrs::where('Cmp_No',$Cmp_No)->where('Ac_Ty',2)
            ->where('Tr_Dt','<', date('Y-m-d 00:00:00',strtotime($from)))
            ->where('Sysub_Account',$Acc_No)
            ->where('Ln_No','>',1)->sum($sum);
//@dd($value2);


        return $value1  +$value2;
//            + $value2;
    }
}
//for supplier
if(!function_exists('FbalanceSup')) {
    function FbalanceSup($Cmp_No = null,$Acc_No= Null,$from = null,$to = null,$sum = null,$sign = null)
    {
//        dd($Cmp_No,$Acc_No,$from,$sum);
        $value1 = GLjrnTrs::where('Cmp_No',$Cmp_No)->where('Ac_Ty',3)
            ->where('Tr_Dt','<', date('Y-m-d 00:00:00',strtotime($from)))
            ->where('Acc_No',$Acc_No)
            ->where('Ln_No',1)->sum($sum);

        $value2 = GLjrnTrs::where('Cmp_No',$Cmp_No)->where('Ac_Ty',3)
            ->where('Tr_Dt','<', date('Y-m-d 00:00:00',strtotime($from)))
            ->where('Sysub_Account',$Acc_No)
            ->where('Ln_No','>',1)->sum($sum);
//@dd($value2);


        return $value1  +$value2;
//            + $value2;
    }
}

if(!function_exists('getTrans')) {
    function getTrans($Cmp_No = null,$Acc_No= Null,$from = null,$to = null,$sum = null,$sign = null)
    {
//        dd($Cmp_No,$Acc_No,$from,$sum);
        $value1 = GLjrnTrs::where('Cmp_No',$Cmp_No)->where('Ac_Ty',1)
            ->where('Tr_Dt','>=', date('Y-m-d 00:00:00',strtotime($from)))
            ->where('Tr_Dt','<=', date('Y-m-d 00:00:00',strtotime($to)))
            ->where('Acc_No',$Acc_No)
            ->where('Ln_No',1)->sum($sum);

        $value2 = GLjrnTrs::where('Cmp_No',$Cmp_No)->where('Ac_Ty',1)
            ->where('Tr_Dt','>=', date('Y-m-d 00:00:00',strtotime($from)))
            ->where('Tr_Dt','<=', date('Y-m-d 00:00:00',strtotime($to)))
            ->where('Sysub_Account',$Acc_No)
            ->where('Ln_No','>',1)->sum($sum);
//@dd($value2);


       return $value1  +$value2;
//            + $value2;
    }
}
//for cc
if(!function_exists('getTransCC')) {
    function getTransCC($Cmp_No = null,$Acc_No= Null,$from = null,$to = null,$sum = null,$sign = null)
    {
//        dd($Cmp_No,$Acc_No,$from,$sum);
        $mtschartac = MtsChartAc::where('Cmp_No',$Cmp_No)->where('Clsacc_No3', $Acc_No)->pluck('Acc_No');

            $value1 = GLjrnTrs::where('Cmp_No',$Cmp_No)
                ->where('Tr_Dt','>=', date('Y-m-d 00:00:00',strtotime($from)))
                ->where('Tr_Dt','<=', date('Y-m-d 00:00:00',strtotime($to)))
                ->whereIn('Acc_No',$mtschartac)
                ->where('Ln_No',1)->sum($sum);

            $value2 = GLjrnTrs::where('Cmp_No',$Cmp_No)
                ->where('Tr_Dt','>=', date('Y-m-d 00:00:00',strtotime($from)))
                ->where('Tr_Dt','<=', date('Y-m-d 00:00:00',strtotime($to)))
                ->whereIn('Sysub_Account',$mtschartac)
                ->where('Ln_No','>',1)->sum($sum);
            return $value1  +$value2;

    }
}
//for cc without movements
if(!function_exists('getNoTrans')) {
    function getNoTrans($Cmp_No = null,$Acc_No = null,$from = null,$to = null,$sum = null,$sign = null)
    {
//        dd($Cmp_No,$Acc_No,$from,$sum);
        $mtschartac = MtsChartAc::where('Cmp_No',$Cmp_No)->where('Clsacc_No3', $Acc_No )->pluck('Acc_No');
//        dd($mtschartac);
        $value1 = GLjrnTrs::where('Cmp_No',$Cmp_No)
            ->where('Tr_Dt','>=', date('Y-m-d 00:00:00',strtotime($from)))
            ->where('Tr_Dt','<=', date('Y-m-d 00:00:00',strtotime($to)))
            ->whereIn('Acc_No', $mtschartac)
            ->where('Ln_No',1)->sum($sum);
//dd($value1);
        $value2 = GLjrnTrs::where('Cmp_No',$Cmp_No)
            ->where('Tr_Dt','>=', date('Y-m-d 00:00:00',strtotime($from)))
            ->where('Tr_Dt','<=', date('Y-m-d 00:00:00',strtotime($to)))
            ->whereIn('Sysub_Account',$mtschartac)
            ->where('Ln_No','>',1)->sum($sum);
//        dd($value2);
        return $value1  +$value2;

    }
}
//for customer
if(!function_exists('getTransCust')) {
    function getTransCust($Cmp_No = null,$Acc_No= Null,$from = null,$to = null,$sum = null,$sign = null)
    {
        //dd($Cmp_No,$Acc_No,$from,$sum);
        $value1 = GLjrnTrs::where('Cmp_No',$Cmp_No)->where('Ac_Ty',2)
            ->where('Tr_Dt','>=', date('Y-m-d 00:00:00',strtotime($from)))
            ->where('Tr_Dt','<=', date('Y-m-d 00:00:00',strtotime($to)))
            ->where('Acc_No',$Acc_No)
            ->where('Ln_No','>',1)->sum($sum);
        $value2 = GLjrnTrs::where('Cmp_No',$Cmp_No)->where('Ac_Ty',2)
            ->where('Tr_Dt','>=', date('Y-m-d 00:00:00',strtotime($from)))
            ->where('Tr_Dt','<=', date('Y-m-d 00:00:00',strtotime($to)))
            ->where('Ln_No',1)->sum($sum);

        //  return $value1;
        return $value1  +$value2;

    }
}

//for supplier
if(!function_exists('getTransSup')) {
    function getTransSup($Cmp_No = null,$Acc_No= Null,$from = null,$to = null,$sum = null,$sign = null)
    {
//        dd($Cmp_No,$Acc_No,$from,$sum);
        $value1 = GLjrnTrs::where('Cmp_No',$Cmp_No)->where('Ac_Ty',3)
            ->where('Tr_Dt','>=', date('Y-m-d 00:00:00',strtotime($from)))
            ->where('Tr_Dt','<=', date('Y-m-d 00:00:00',strtotime($to)))
            ->where('Acc_No',$Acc_No)
            ->where('Ln_No',1)->sum($sum);

        $value2 = GLjrnTrs::where('Cmp_No',$Cmp_No)->where('Ac_Ty',3)
            ->where('Tr_Dt','>=', date('Y-m-d 00:00:00',strtotime($from)))
            ->where('Tr_Dt','<=', date('Y-m-d 00:00:00',strtotime($to)))

            ->where('Sysub_Account',$Acc_No)
            ->where('Ln_No','>',1)->sum($sum);
//@dd($value2);


        return $value1  +$value2;
//            + $value2;
    }
}
if(!function_exists('levelFbalance')) {
    function levelFbalance($Cmp_No = null,$Acc_No= Null,$from = null,$to = null,$sum = null,$sign = null)
    {
//        dd($Cmp_No,$Acc_No,$from,$sum);
        $value1 = GLjrnTrs::where('Cmp_No',$Cmp_No)->where('Ac_Ty',1)
            ->where('Tr_Dt','<', date('Y-m-d 00:00:00',strtotime($from)))
            ->where('Acc_No',$Acc_No)
            ->where('Ln_No',1)->sum($sum);

        $value2 = GLjrnTrs::where('Cmp_No',$Cmp_No)->where('Ac_Ty',1)
            ->where('Tr_Dt','<', date('Y-m-d 00:00:00',strtotime($from)))
            ->where('Sysub_Account',$Acc_No)
            ->where('Ln_No','>',1)->sum($sum);

        return $value1  +$value2;
//            + $value2;
    }
}
if(!function_exists('allFbalance')) {
    function allFbalance($ID_No = null,$Cmp_No = null,$Acc_No = null,$from = null,$to = null,$sum = null,$sign = null)
    {
        $value = [];

        $departments = MtsChartAc::findOrFail($ID_No);

        $pros = [];
        $products = [];
        $categories = $departments->children;

        while(count($categories) > 0){
            $nextCategories = [];
            foreach ($categories as $category) {
                $products = array_merge($products, $category->children->all());
                $nextCategories = array_merge($nextCategories, $category->children->all());
            }
            $categories = $nextCategories;
        }
        $pro = new Illuminate\Database\Eloquent\Collection($products); //Illuminate\Database\Eloquent\Collection


//            0
        $pro = new Collection($products); //Illuminate\Database\Eloquent\Collection
        $pros = $departments->children->pluck('Acc_No');
        $plucks = $pro->pluck('Acc_No');
        $values = $pros->concat($plucks);


        $value1 = GLjrnTrs::where('Cmp_No',$Cmp_No)->where('Ac_Ty',1)
            ->where('Tr_Dt','<', date('Y-m-d 00:00:00',strtotime($from)))
            ->whereIn('Acc_No',$values)
            ->where('Ln_No',1)
            ->sum($sum);
        $value2 = GLjrnTrs::where('Cmp_No',$Cmp_No)->where('Ac_Ty',1)
            ->where('Tr_Dt','<', date('Y-m-d 00:00:00',strtotime($from)))
            ->whereIn('Sysub_Account',$values)
            ->where('Ln_No','>',1)
            ->sum($sum);
//        dd($value2);

        return $value1 + $value2;


    }
}
if(!function_exists('all_getTrans')) {
    function all_getTrans($ID_No = null,$Cmp_No = null,$Acc_No = null,$from = null,$to = null,$sum = null,$sign = null)
    {
//       @dd($sum);
        $value = [];
        $departments = MtsChartAc::findOrFail($ID_No);

        $pros = [];
        $products = [];
        $categories = $departments->children;
        while(count($categories) > 0){
            $nextCategories = [];
            foreach ($categories as $category) {
                $products = array_merge($products, $category->children->all());
                $nextCategories = array_merge($nextCategories, $category->children->all());
            }
            $categories = $nextCategories;
        }
        $pro = new Illuminate\Database\Eloquent\Collection($products); //Illuminate\Database\Eloquent\Collection
        $pros = $departments->children->pluck('Acc_No');
        $plucks = $pro->pluck('Acc_No');
        $values = $pros->concat($plucks);



        $value1 = GLjrnTrs::where('Cmp_No',$Cmp_No)->where('Ac_Ty',1)
            ->where('Tr_Dt','>=', date('Y-m-d 00:00:00',strtotime($from)))
            ->where('Tr_Dt','<=', date('Y-m-d 00:00:00',strtotime($to)))


            ->whereIn('Acc_No',$values)
            ->where('Ln_No',1)
            ->sum($sum);
        $value2 = GLjrnTrs::where('Cmp_No',$Cmp_No)->where('Ac_Ty',1)
            ->where('Tr_Dt','>=', date('Y-m-d 00:00:00',strtotime($from)))
            ->where('Tr_Dt','<=', date('Y-m-d 00:00:00',strtotime($to)))

            ->whereIn('Sysub_Account',$values)
            ->where('Ln_No','>',1)
            ->sum($sum);



        return $value1  +$value2;




    }
}

if(!function_exists('cc_level_AllFbalance')) {
    function cc_level_AllFbalance($ID_No = null,$Cmp_No = null,$Costcntr_No = null,$from = null,$to = null,$sum = null,$sign = null)
    {
        $value = [];

        $departments = MtsCostcntr::findOrFail($ID_No);

        $pros = [];
        $products = [];
        $categories = $departments->children;

        while(count($categories) > 0){
            $nextCategories = [];
            foreach ($categories as $category) {
                $products = array_merge($products, $category->children->all());
                $nextCategories = array_merge($nextCategories, $category->children->all());
            }
            $categories = $nextCategories;
        }
        $pro = new Illuminate\Database\Eloquent\Collection($products); //Illuminate\Database\Eloquent\Collection


        $pro = new Collection($products); //Illuminate\Database\Eloquent\Collection

        $pros = $departments->children->pluck('Costcntr_No');

        $plucks = $pro->pluck('Costcntr_No');
        $values = $pros->concat($plucks);
        $mtschartac = MtsChartAc::where('Cmp_No',$Cmp_No)->whereIn('Clsacc_No3', $values )->pluck('Acc_No');

        $value1 = GLjrnTrs::where('Cmp_No',$Cmp_No)
            ->where('Tr_Dt','<', date('Y-m-d 00:00:00',strtotime($from)))
            ->whereIn('Acc_No', $mtschartac)
            ->where('Ln_No',1)->sum($sum);

        $value2 = GLjrnTrs::where('Cmp_No',$Cmp_No)
            ->where('Tr_Dt','<', date('Y-m-d 00:00:00',strtotime($from)))
            ->whereIn('Sysub_Account',$mtschartac)
            ->where('Ln_No','>',1)->sum($sum);

//        dd($value2);
        return $value1 + $value2;


    }
}
if(!function_exists('cc_level_OneFbalance')) {
    function cc_level_OneFbalance($ID_No = null,$Cmp_No = null,$Costcntr_No= Null,$from = null,$to = null,$sum = null,$sign = null)
    {
        $mtschartac = MtsChartAc::where('Cmp_No',$Cmp_No)->where('Clsacc_No3', $Costcntr_No )->pluck('Acc_No');

        $value1 = GLjrnTrs::where('Cmp_No',$Cmp_No)
            ->where('Tr_Dt','<', date('Y-m-d 00:00:00',strtotime($from)))
            ->whereIn('Acc_No',$mtschartac)
            ->where('Ln_No',1)->sum($sum);

        $value2 = GLjrnTrs::where('Cmp_No',$Cmp_No)
            ->where('Tr_Dt','<', date('Y-m-d 00:00:00',strtotime($from)))
            ->whereIn('Sysub_Account',$mtschartac)
            ->where('Ln_No','>',1)->sum($sum);

        return $value1  +$value2;
//            + $value2;
    }
}

if(!function_exists('cc_level_AllGetTrans')) {
    function cc_level_AllGetTrans($ID_No = null,$Cmp_No = null,$Costcntr_No = null,$from = null,$to = null,$sum = null,$sign = null)
    {

        $value = [];
        $departments = MtsCostcntr::findOrFail($ID_No);

        $pros = [];
        $products = [];
        $categories = $departments->children;
        while(count($categories) > 0){
            $nextCategories = [];
            foreach ($categories as $category) {
                $products = array_merge($products, $category->children->all());
                $nextCategories = array_merge($nextCategories, $category->children->all());
            }
            $categories = $nextCategories;
        }
        $pro = new Illuminate\Database\Eloquent\Collection($products); //Illuminate\Database\Eloquent\Collection
        $pros = $departments->children->pluck('Costcntr_No');
        $plucks = $pro->pluck('Costcntr_No');
        $values = $pros->concat($plucks);

        $mtschartac = MtsChartAc::where('Cmp_No',$Cmp_No)->whereIn('Clsacc_No3', $values )->pluck('Acc_No');

        $value1 = GLjrnTrs::where('Cmp_No',$Cmp_No)
            ->where('Tr_Dt','>=', date('Y-m-d 00:00:00',strtotime($from)))
            ->where('Tr_Dt','<=', date('Y-m-d 00:00:00',strtotime($to)))

            ->whereIn('Acc_No', $mtschartac)
            ->where('Ln_No',1)->sum($sum);

        $value2 = GLjrnTrs::where('Cmp_No',$Cmp_No)

            ->where('Tr_Dt','>=', date('Y-m-d 00:00:00',strtotime($from)))
            ->where('Tr_Dt','<=', date('Y-m-d 00:00:00',strtotime($to)))
            ->whereIn('Sysub_Account',$mtschartac)
            ->where('Ln_No','>',1)->sum($sum);




        return $value1  +$value2;




    }
}
if(!function_exists('cc_level_OneGetTrans')) {
    function cc_level_OneGetTrans($ID_No = null,$Cmp_No = null,$Costcntr_No= Null,$from = null,$to = null,$sum = null,$sign = null)
    {
        $mtschartac = MtsChartAc::where('Cmp_No',$Cmp_No)->where('Clsacc_No3', $Costcntr_No )->pluck('Acc_No');

        $value1 = GLjrnTrs::where('Cmp_No',$Cmp_No)
            ->where('Tr_Dt','>=', date('Y-m-d 00:00:00',strtotime($from)))
            ->where('Tr_Dt','<=', date('Y-m-d 00:00:00',strtotime($to)))
            ->whereIn('Acc_No',$mtschartac)
            ->where('Ln_No',1)->sum($sum);

        $value2 = GLjrnTrs::where('Cmp_No',$Cmp_No)
            ->where('Tr_Dt','>=', date('Y-m-d 00:00:00',strtotime($from)))
            ->where('Tr_Dt','<=', date('Y-m-d 00:00:00',strtotime($to)))
            ->whereIn('Sysub_Account',$mtschartac)
            ->where('Ln_No','>',1)->sum($sum);

        return $value1  + $value2;
//            + $value2;
    }
}
if(!function_exists('alldepartmenttrial')) {
    function alldepartmenttrial($Cmp_No = null,$Acc_No=null,$from=null,$to=null,$sum=null,$sign=null)
    {
        $value1 = GLjrnTrs::where('Cmp_No',$Cmp_No)->where('Ac_Ty',1)
            ->where('Tr_Dt','>=', date('Y-m-d 00:00:00',strtotime($from)))
            ->where('Tr_Dt','<=', date('Y-m-d 00:00:00',strtotime($to)))

            ->where('Acc_No',$Acc_No)
            ->where('Ln_No',1)->sum($sum);

        $value2 = GLjrnTrs::where('Cmp_No',$Cmp_No)->where('Ac_Ty',1)
            ->where('Tr_Dt','>=', date('Y-m-d 00:00:00',strtotime($from)))
            ->where('Tr_Dt','<=', date('Y-m-d 00:00:00',strtotime($to)))
            ->where('Sysub_Account',$Acc_No)
            ->where('Ln_No','>',1)->sum($sum);
//@dd($value2);


        return $value1  +$value2;


    }
}
if(!function_exists('CC_Trial_Balance_Fbalance')) {
    function CC_Trial_Balance_Fbalance($ID_No = null,$Cmp_No = null,$Acc_No = null,$from = null,$to = null,$sum = null,$sign = null)
    {
        $value = [];

        $departments = MtsCostcntr::findOrFail($ID_No);

        $pros = [];
        $products = [];
        $categories = $departments->children;

        while(count($categories) > 0){
            $nextCategories = [];
            foreach ($categories as $category) {
                $products = array_merge($products, $category->children->all());
                $nextCategories = array_merge($nextCategories, $category->children->all());
            }
            $categories = $nextCategories;
        }
        $pro = new Illuminate\Database\Eloquent\Collection($products); //Illuminate\Database\Eloquent\Collection


//            0
        $pro = new Collection($products); //Illuminate\Database\Eloquent\Collection
        $pros = $departments->children->pluck('Costcntr_No');
        $plucks = $pro->pluck('Costcntr_No');
        $values = $pros->concat($plucks);
        $departments = MtsChartAc::where('Cmp_No', $Cmp_No)->whereIn('Clsacc_No3', $values)->pluck('Acc_No');


        $value1 = GLjrnTrs::where('Cmp_No',$Cmp_No)
            ->where('Tr_Dt','<', date('Y-m-d 00:00:00',strtotime($from)))
            ->whereIn('Acc_No',$departments)
            ->where('Ln_No',1)
            ->sum($sum);
        $value2 = GLjrnTrs::where('Cmp_No',$Cmp_No)
            ->where('Tr_Dt','<', date('Y-m-d 00:00:00',strtotime($from)))
            ->whereIn('Sysub_Account',$departments)
            ->where('Ln_No','>',1)
            ->sum($sum);


        return $value1 + $value2;


    }
}
if(!function_exists('CC_Trial_Balance_One_Fbalance')) {
    function CC_Trial_Balance_One_Fbalance($ID_No = null,$Cmp_No = null,$Acc_No = null,$from = null,$to = null,$sum = null,$sign = null)
    {
        $value = [];
        $cc = MtsCostcntr::findOrFail($ID_No)->Costcntr_No;

        $departments = MtsChartAc::where('Cmp_No', $Cmp_No)->where('Clsacc_No3', $cc)->pluck('Acc_No');



        $value1 = GLjrnTrs::where('Cmp_No',$Cmp_No)
            ->where('Tr_Dt','<', date('Y-m-d 00:00:00',strtotime($from)))
            ->whereIn('Acc_No',$departments)
            ->where('Ln_No',1)
            ->sum($sum);
        $value2 = GLjrnTrs::where('Cmp_No',$Cmp_No)
            ->where('Tr_Dt','<', date('Y-m-d 00:00:00',strtotime($from)))
            ->whereIn('Sysub_Account',$departments)
            ->where('Ln_No','>',1)
            ->sum($sum);


        return $value1 + $value2;


    }
}
if(!function_exists('CC_Trial_Balance_getTrans')) {
    function CC_Trial_Balance_getTrans($ID_No = null,$Cmp_No = null,$Acc_No = null,$from = null,$to = null,$sum = null,$sign = null)
    {
        $value = [];

        $departments = MtsCostcntr::findOrFail($ID_No);

        $pros = [];
        $products = [];
        $categories = $departments->children;

        while(count($categories) > 0){
            $nextCategories = [];
            foreach ($categories as $category) {
                $products = array_merge($products, $category->children->all());
                $nextCategories = array_merge($nextCategories, $category->children->all());
            }
            $categories = $nextCategories;
        }
        $pro = new Illuminate\Database\Eloquent\Collection($products); //Illuminate\Database\Eloquent\Collection


//            0
        $pro = new Collection($products); //Illuminate\Database\Eloquent\Collection
        $pros = $departments->children->pluck('Costcntr_No');
        $plucks = $pro->pluck('Costcntr_No');
        $values = $pros->concat($plucks);
        $departments = MtsChartAc::where('Cmp_No', $Cmp_No)->whereIn('Clsacc_No3', $values)->pluck('Acc_No');


        $value1 = GLjrnTrs::where('Cmp_No',$Cmp_No)
            ->where('Tr_Dt','>=', date('Y-m-d 00:00:00',strtotime($from)))
            ->where('Tr_Dt','<=', date('Y-m-d 00:00:00',strtotime($to)))
            ->whereIn('Acc_No',$departments)
            ->where('Ln_No',1)
            ->sum($sum);
        $value2 = GLjrnTrs::where('Cmp_No',$Cmp_No)
            ->where('Tr_Dt','>=', date('Y-m-d 00:00:00',strtotime($from)))
            ->where('Tr_Dt','<=', date('Y-m-d 00:00:00',strtotime($to)))
            ->whereIn('Sysub_Account',$departments)
            ->where('Ln_No','>',1)
            ->sum($sum);


        return $value1 + $value2;


    }
}
if(!function_exists('CC_Trial_Balance_One_gettrans')) {
    function CC_Trial_Balance_One_gettrans($ID_No = null,$Cmp_No = null,$Acc_No = null,$from = null,$to = null,$sum = null,$sign = null)
    {
        $value = [];

        $cc = MtsCostcntr::findOrFail($ID_No)->Costcntr_No;
        $departments = MtsChartAc::where('Cmp_No', $Cmp_No)->where('Clsacc_No3', $cc)->pluck('Acc_No');


        $value1 = GLjrnTrs::where('Cmp_No',$Cmp_No)
            ->where('Tr_Dt','>=', date('Y-m-d 00:00:00',strtotime($from)))
            ->where('Tr_Dt','<=', date('Y-m-d 00:00:00',strtotime($to)))
            ->whereIn('Acc_No',$departments)
            ->where('Ln_No',1)
            ->sum($sum);
        $value2 = GLjrnTrs::where('Cmp_No',$Cmp_No)
            ->where('Tr_Dt','>=', date('Y-m-d 00:00:00',strtotime($from)))
            ->where('Tr_Dt','<=', date('Y-m-d 00:00:00',strtotime($to)))
            ->whereIn('Sysub_Account',$departments)
            ->where('Ln_No','>',1)
            ->sum($sum);


        return $value1 + $value2;


    }
}
