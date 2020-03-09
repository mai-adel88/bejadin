<?php

namespace App\Http\Controllers\Admin\accountingReports;

use App\Branches;
use App\Contractors;
use App\Department;
use App\drivers;
use App\employee;
use App\limitationReceipts;
use App\limitations;
use App\limitationsType;
use App\operation;
use App\Project;
use App\receipts;
use App\receiptsData;
use App\receiptsType;
use App\subscription;
use App\supplier;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class accountStatementController extends Controller
{
    public function index(){
        $operations = operation::whereIn('receipt',[1,2])->pluck('name_'.session('lang'),'id');
        $branches = Branches::pluck('name_'.session('lang'),'id');
        $title = trans('admin.account_statement');
        return view('admin.accountingReports.accountStatement.index',compact('title','operations','branches'));
    }
    public function show(Request $request)
    {
        if($request->ajax()){
            $operations = $request->operations;
            $operation = operation::where('id',$operations)->first();
            $branches = $request->branches;
            if($operations != null && $branches != null){
                if ($operation->id == 4){
                    $tree = Department::where('type', '1')->pluck('dep_name_'.session('lang'),'id');
                }elseif ($operation->id == 1){
                    $tree = supplier::pluck('name_'.session('lang'),'id');
                }elseif ($operation->id == 2){
                    $tree = subscription::pluck('name_'.session('lang'),'id');
                }elseif ($operation->id == 3){
                    $tree = Project::pluck('name_'.session('lang'),'id');
                }elseif ($operation->id == 5){
                    $tree = employee::pluck('name_'.session('lang'),'id');
                }elseif ($operation->id == 10){
                    $tree = Contractors::pluck('name_'.session('lang'),'id');
                }
                $contents = view('admin.accountingReports.accountStatement.show', ['operations'=>$operations,'operation'=>$operation,'tree'=>$tree])->render();
                return $contents;
            }
        }
    }
    public function details(Request $request)
    {
        if($request->ajax()){
            $operations = $request->operations;
//            $branches = Branches::where('id',$request->branches)->first();
            $branches = $request->branches;
            $to = $request->to;
            $from = $request->from;
            $fromtree = $request->fromtree;
            $totree = $request->totree;
            if($from != null && $to != null && $fromtree != null && $totree != null){
                if ($operations == 5){
                    $suppliers = DB::table('employees')->where('id', '>=', $fromtree)->where('id', '<=', $totree)->pluck('id')->toArray();
                    $receipts_id = receipts::where('branche_id',$branches)->whereDate('created_at', '>=', $from)->whereDate('created_at', '<=', $to)->pluck('id');
                    $limitations_id = limitations::whereDate('created_at', '>=', $from)->whereDate('created_at', '<=', $to)->where('branche_id',$branches)->pluck('id');
                    $hasTask = receiptsType::where('operation_id',$operations)->whereIn('relation_id',$suppliers)->whereIn('receipts_id',$receipts_id)->exists();
                    $hasTask2 = limitationsType::where('operation_id',$operations)->whereIn('relation_id',$suppliers)->whereIn('limitations_id',$limitations_id)->exists();
                }elseif ($operations == 1){
                    $suppliers = DB::table('suppliers')->where('id', '>=', $fromtree)->where('id', '<=', $totree)->pluck('id')->toArray();
                    $receipts_id = receipts::where('branche_id',$branches)->whereDate('created_at', '>=', $from)->whereDate('created_at', '<=', $to)->pluck('id');
                    $limitations_id = limitations::whereDate('created_at', '>=', $from)->whereDate('created_at', '<=', $to)->where('branche_id',$branches)->pluck('id');
                    $hasTask = receiptsType::where('operation_id',$operations)->whereIn('relation_id',$suppliers)->whereIn('receipts_id',$receipts_id)->exists();
                    $hasTask2 = limitationsType::where('operation_id',$operations)->whereIn('relation_id',$suppliers)->whereIn('limitations_id',$limitations_id)->exists();

                }elseif ($operations == 2){
                    $suppliers = DB::table('subscriptions')->where('id', '>=', $fromtree)->where('id', '<=', $totree)->pluck('id')->toArray();
                    $receipts_id = receipts::where('branche_id',$branches)->whereDate('created_at', '>=', $from)->whereDate('created_at', '<=', $to)->pluck('id');
                    $limitations_id = limitations::whereDate('created_at', '>=', $from)->whereDate('created_at', '<=', $to)->where('branche_id',$branches)->pluck('id');
                    $hasTask = receiptsType::where('operation_id',$operations)->whereIn('relation_id',$suppliers)->whereIn('receipts_id',$receipts_id)->exists();
                    $hasTask2 = limitationsType::where('operation_id',$operations)->whereIn('relation_id',$suppliers)->whereIn('limitations_id',$limitations_id)->exists();

                }elseif ($operations == 4){
                    $depart = Department::where('id', '>=', $fromtree)->where('id', '<=', $totree)->pluck('id')->toArray();
//                    $Rtypes = receiptsType::where('operation_id',$operations)->whereIn('tree_id',$depart)->whereIn('receipts_id',$receipts_id)->exists();
//                    $Ltypes = limitationsType::whereIn('tree_id',$depart)->whereIn('limitations_id',$limitations_id)->exists();
                    $receipts_id = receipts::where('branche_id',$branches)->whereDate('created_at', '>=', $from)->whereDate('created_at', '<=', $to)
                        ->whereHas('receipts_type',function ($query) use ($operations,$depart,$fromtree,$totree){
                            $query->where('tree_id', '>=', $fromtree)->where('tree_id', '<=', $totree);
                        })
                        ->pluck('id');
                    $limitations_id = limitations::whereDate('created_at', '>=', $from)->whereDate('created_at', '<=', $to)
                        ->whereHas('limitations_type',function ($query) use ($operations,$depart,$fromtree,$totree){
                            $query->where('tree_id', '>=', $fromtree)->where('tree_id', '<=', $totree);
                        })
                        ->pluck('id');
                    $hasTask = receiptsType::where('operation_id',$operations)->whereIn('tree_id',$depart)->whereIn('receipts_id',$receipts_id)->exists();
                    $hasTask2 = limitationsType::whereIn('tree_id',$depart)->whereIn('limitations_id',$limitations_id)->exists();
                }elseif ($operations == 3){
                    $suppliers = DB::table('projects')->where('id', '>=', $fromtree)->where('id', '<=', $totree)->pluck('id')->toArray();
                    $receipts_id = receipts::where('branche_id',$branches)->whereDate('created_at', '>=', $from)->whereDate('created_at', '<=', $to)->pluck('id');
                    $limitations_id = limitations::whereDate('created_at', '>=', $from)->whereDate('created_at', '<=', $to)->where('branche_id',$branches)->pluck('id');
                    $hasTask = receiptsType::where('operation_id',$operations)->whereIn('relation_id',$suppliers)->whereIn('receipts_id',$receipts_id)->exists();
                    $hasTask2 = limitationsType::where('operation_id',$operations)->whereIn('relation_id',$suppliers)->whereIn('limitations_id',$limitations_id)->exists();
                }elseif ($operations == 10){
                    $suppliers = DB::table('contractors')->where('id', '>=', $fromtree)->where('id', '<=', $totree)->pluck('id')->toArray();
                    $receipts_id = receipts::where('branche_id',$branches)->whereDate('created_at', '>=', $from)->whereDate('created_at', '<=', $to)->pluck('id');
                    $limitations_id = limitations::whereDate('created_at', '>=', $from)->whereDate('created_at', '<=', $to)->where('branche_id',$branches)->pluck('id');
                    $hasTask = receiptsType::where('operation_id',$operations)->whereIn('relation_id',$suppliers)->whereIn('receipts_id',$receipts_id)->exists();
                    $hasTask2 = limitationsType::where('operation_id',$operations)->whereIn('relation_id',$suppliers)->whereIn('limitations_id',$limitations_id)->exists();
                }
                $contents = view('admin.accountingReports.accountStatement.details', ['operations'=>$operations,'branches'=>$branches,'from'=>$from,'to'=>$to,'fromtree'=>$fromtree,'totree'=>$totree, 'hasTask' => $hasTask, 'hasTask2' => $hasTask2])->render();
                return $contents;
            }
        }
    }

    public function pdf(Request $request) {

        $branches = Branches::where('id',$request->branches)->first();
        $to = $request->to;
        $from = $request->from;
        $fromtree = $request->fromtree;
        $totree = $request->totree;
        $operations = $request->operations;
        $operation = operation::where('id',$operations)->first();
        if ($operations == 5){
            $drivers = employee::where('id', '>=', $fromtree)->where('id', '<=', $totree)->pluck('id')->toArray();
            $persons = employee::where('id', '>=', $fromtree)->where('id', '<=', $totree)->get();
            $openingEntry = limitations::whereDate('created_at', '>=', $from)->whereDate('created_at', '<=', $to)->where('limitationsType_id', 12)->where('branche_id',$branches->id)->whereYear('created_at', '=', date('Y',strtotime($from)))->pluck('id')->toArray();
            $limitations_id = limitations::whereDate('created_at', '>=', $from)->whereDate('created_at', '<=', $to)->whereNotIn('limitationsType_id',[12])->where('branche_id',$branches->id)->orderBy('limitationsType_id', 'ASC')->pluck('id');
            $receipts_id = receipts::where('branche_id',$branches->id)->whereDate('created_at', '>=', $from)->whereDate('created_at', '<=', $to)->pluck('id');
            $receiptsType = receiptsType::whereIn('receipts_id',$receipts_id)->whereIn('relation_id',$drivers)->where('operation_id',$operations)->get();
            $limitationsType = limitationsType::whereIn('limitations_id',$limitations_id)->whereIn('relation_id',$drivers)->where('operation_id',$operations)->get();
            $openingEntryType = limitationsType::whereIn('limitations_id',$openingEntry)->whereIn('relation_id',$drivers)->where('operation_id',$operations)->get();
            $value_merged = $openingEntryType->toBase()->merge($limitationsType)->sortByDesc('status');
            $person_merged =$persons->toBase()->merge($value_merged)->sortByDesc('status');
            $merged = $person_merged->toBase()->merge($receiptsType)->sortBy('created_at');
//            dd($merged);
            $data = $merged->groupBy(function($date) {
                return session_lang($date->name_en,$date->name_ar);
            });

        }elseif ($operations == 1){
            $suppliers = supplier::where('id', '>=', $fromtree)->where('id', '<=', $totree)->pluck('id')->toArray();
            $persons = supplier::where('id', '>=', $fromtree)->where('id', '<=', $totree)->get();
            $openingEntry = limitations::whereDate('created_at', '>=', $from)->whereDate('created_at', '<=', $to)->where('limitationsType_id', 12)->where('branche_id',$branches->id)->pluck('id');
            $limitations_id = limitations::whereDate('created_at', '>=', $from)->whereDate('created_at', '<=', $to)->whereNotIn('limitationsType_id',[12])->where('branche_id',$branches->id)->orderBy('limitationsType_id', 'ASC')->pluck('id');
            $receipts_id = receipts::where('branche_id',$branches->id)->whereDate('created_at', '>=', $from)->whereDate('created_at', '<=', $to)->pluck('id');
            $receiptsType = receiptsType::whereIn('receipts_id',$receipts_id)->whereIn('relation_id',$suppliers)->where('operation_id',$operations)->get();
            $limitationsType = limitationsType::whereIn('limitations_id',$limitations_id)->whereIn('relation_id',$suppliers)->where('operation_id',$operations)->get();
            $openingEntryType = limitationsType::whereIn('limitations_id',$openingEntry)->whereIn('relation_id',$suppliers)->where('operation_id',$operations)->get();
            $value_merged = $openingEntryType->toBase()->merge($limitationsType)->sortByDesc('status');
            $person_merged =$persons->toBase()->merge($value_merged)->sortByDesc('status');
            $merged = $person_merged->toBase()->merge($receiptsType)->sortBy('created_at');
//            dd($merged);
            $data = $merged->groupBy(function($date) {
                return session_lang($date->name_en,$date->name_ar);
            });

        }elseif ($operations == 2){
            $subscribers = subscription::where('id', '>=', $fromtree)->where('id', '<=', $totree)->pluck('id')->toArray();
            $persons = subscription::where('id', '>=', $fromtree)->where('id', '<=', $totree)->get();
            $openingEntry = limitations::whereDate('created_at', '>=', $from)->whereDate('created_at', '<=', $to)->where('limitationsType_id', 12)->where('branche_id',$branches->id)->pluck('id');
            $limitations_id = limitations::whereDate('created_at', '>=', $from)->whereDate('created_at', '<=', $to)->whereNotIn('limitationsType_id',[12])->where('branche_id',$branches->id)->orderBy('limitationsType_id', 'ASC')->pluck('id');
            $receipts_id = receipts::where('branche_id',$branches->id)->whereDate('created_at', '>=', $from)->whereDate('created_at', '<=', $to)->pluck('id');
            $receiptsType = receiptsType::whereIn('receipts_id',$receipts_id)->whereIn('relation_id',$subscribers)->where('operation_id',$operations)->get();
            $limitationsType = limitationsType::whereIn('limitations_id',$limitations_id)->whereIn('relation_id',$subscribers)->where('operation_id',$operations)->get();
            $openingEntryType = limitationsType::whereIn('limitations_id',$openingEntry)->whereIn('relation_id',$subscribers)->where('operation_id',$operations)->get();
            $value_merged = $openingEntryType->toBase()->merge($limitationsType)->sortByDesc('status');
            $person_merged =$persons->toBase()->merge($value_merged)->sortByDesc('status');
            $merged = $person_merged->toBase()->merge($receiptsType)->sortBy('created_at');
//            dd($merged);
            $data = $merged->groupBy(function($date) {
                return session_lang($date->name_en,$date->name_ar);
            });

        }elseif ($operations == 4){
           $departments = Department::where('id', '>=', $fromtree)->where('id', '<=', $totree)->pluck('id')->toArray();
            $persons = Department::where('id', '>=', $fromtree)->where('id', '<=', $totree)->orWhere('debtor','!=',0)->orWhere('creditor','!=',0)->get();
            $openingEntry = limitations::whereDate('created_at', '>=', $from)->whereDate('created_at', '<=', $to)->where('limitationsType_id', 12)->where('branche_id',$branches->id)->pluck('id');
            $limitations_id = limitations::whereDate('created_at', '>=', $from)->whereDate('created_at', '<=', $to)->whereNotIn('limitationsType_id',[12])->where('branche_id',$branches->id)->orderBy('limitationsType_id', 'ASC')->pluck('id');
            $receipts_id = receipts::where('branche_id',$branches->id)->whereDate('created_at', '>=', $from)->whereDate('created_at', '<=', $to)->pluck('id');
            $receiptsData = receiptsData::whereHas('departments',function ($query) use ($fromtree,$totree){
                $query->where('id', '>=', $fromtree)->where('id', '<=', $totree);
            })->get();
            $receiptsData = $receiptsData->map(function ($data){
                $data->name_ar = $data->departments->dep_name_ar;
                $data->name_en = $data->departments->dep_name_ar;
                return $data;
            });
            $receiptsType = receiptsType::whereIn('receipts_id',$receipts_id)->whereHas('departments',function ($query) use ($fromtree,$totree){
                $query->where('id', '>=', $fromtree)->where('id', '<=', $totree);
            })->get();
            $receiptsType = $receiptsType->toBase()->merge($receiptsData);
            $limitationsType = limitationsType::whereIn('limitations_id',$limitations_id)->whereHas('departments',function ($query) use ($fromtree,$totree){
                $query->where('id', '>=', $fromtree)->where('id', '<=', $totree);
            })->get();
            $openingEntryType = limitationsType::whereIn('limitations_id',$openingEntry)->whereHas('departments',function ($query) use ($fromtree,$totree){
                $query->where('id', '>=', $fromtree)->where('id', '<=', $totree);
            })->get();
            $value_merged = $openingEntryType->toBase()->merge($limitationsType)->sortByDesc('status');
            $merged = $value_merged->toBase()->merge($receiptsType)->sortBy('status');
//            dd($limitationsType);
            $data = $merged->groupBy(function($date) {
                return session_lang($date->name_en,$date->name_ar);
            });

        }elseif ($operations == 3){
            $projects = Project::where('id', '>=', $fromtree)->where('id', '<=', $totree)->pluck('id')->toArray();
            $persons = Project::where('id', '>=', $fromtree)->where('id', '<=', $totree)->get();
            $openingEntry = limitations::whereDate('created_at', '>=', $from)->whereDate('created_at', '<=', $to)->where('limitationsType_id', 12)->where('branche_id',$branches->id)->pluck('id');
            $limitations_id = limitations::whereDate('created_at', '>=', $from)->whereDate('created_at', '<=', $to)->whereNotIn('limitationsType_id',[12])->where('branche_id',$branches->id)->orderBy('limitationsType_id', 'ASC')->pluck('id');
            $receipts_id = receipts::where('branche_id',$branches->id)->whereDate('created_at', '>=', $from)->whereDate('created_at', '<=', $to)->pluck('id');
            $receiptsType = receiptsType::whereIn('receipts_id',$receipts_id)->whereIn('relation_id',$projects)->where('operation_id',$operations)->get();
            $limitationsType = limitationsType::whereIn('limitations_id',$limitations_id)->whereIn('relation_id',$projects)->where('operation_id',$operations)->get();
            $openingEntryType = limitationsType::whereIn('limitations_id',$openingEntry)->whereIn('relation_id',$projects)->where('operation_id',$operations)->get();
            $value_merged = $openingEntryType->toBase()->merge($limitationsType)->sortByDesc('status');
            $person_merged =$persons->toBase()->merge($value_merged)->sortByDesc('status');
            $merged = $person_merged->toBase()->merge($receiptsType)->sortBy('created_at');
//            dd($merged);
            $data = $merged->groupBy(function($date) {
                return session_lang($date->name_en,$date->name_ar);
            });

        }elseif ($operations == 10){
            $contractors = contractors::where('id', '>=', $fromtree)->where('id', '<=', $totree)->pluck('id')->toArray();
            $persons = contractors::where('id', '>=', $fromtree)->where('id', '<=', $totree)->get();
            $openingEntry = limitations::whereDate('created_at', '>=', $from)->whereDate('created_at', '<=', $to)->where('limitationsType_id', 12)->where('branche_id',$branches->id)->pluck('id');
            $limitations_id = limitations::whereDate('created_at', '>=', $from)->whereDate('created_at', '<=', $to)->whereNotIn('limitationsType_id',[12])->where('branche_id',$branches->id)->orderBy('limitationsType_id', 'ASC')->pluck('id');
            $receipts_id = receipts::where('branche_id',$branches->id)->whereDate('created_at', '>=', $from)->whereDate('created_at', '<=', $to)->pluck('id');
            $receiptsType = receiptsType::whereIn('receipts_id',$receipts_id)->whereIn('relation_id',$contractors)->where('operation_id',$operations)->get();
            $limitationsType = limitationsType::whereIn('limitations_id',$limitations_id)->whereIn('relation_id',$contractors)->where('operation_id',$operations)->get();
            $openingEntryType = limitationsType::whereIn('limitations_id',$openingEntry)->whereIn('relation_id',$contractors)->where('operation_id',$operations)->get();
            $value_merged = $openingEntryType->toBase()->merge($limitationsType)->sortByDesc('status');
            $person_merged =$persons->toBase()->merge($value_merged)->sortByDesc('status');
            $merged = $person_merged->toBase()->merge($receiptsType)->sortBy('created_at');
//            dd($merged);
            $data = $merged->groupBy(function($date) {
                return session_lang($date->name_en,$date->name_ar);
            });

        }
        if ($operations == 5 || $operations == 1 || $operations == 2 || $operations == 3 || $operations == 10){
//            dd($data);
            $config = ['instanceConfigurator' => function($mpdf) {
                $mpdf->SetHTMLFooter('
                    <div style="font-size:10px;width:25%;float:right">Print Date: {DATE j-m-Y H:m}</div>
                    <div style="font-size:10px;width:25%;float:left;direction:ltr;text-align:left">Page {PAGENO} of {nbpg}</div>'
                );
            }];
            $pdf = PDF::loadView('admin.accountingReports.accountStatement.pdf.report', ['operations'=>$operations,'operation'=>$operation,'data'=>$data,'openingEntryType'=>$openingEntryType, 'to' => $to, 'from' => $from],[],$config);
            return $pdf->stream();
        }else{
            $config = ['instanceConfigurator' => function($mpdf) {
                $mpdf->SetHTMLFooter('
                    <div style="font-size:10px;width:25%;float:right">Print Date: {DATE j-m-Y H:m}</div>
                    <div style="font-size:10px;width:25%;float:left;direction:ltr;text-align:left">Page {PAGENO} of {nbpg}</div>'
                );
            }];
            $pdf = PDF::loadView('admin.accountingReports.accountStatement.pdf.report2', ['operations'=>$operations,'operation'=>$operation,'data'=>$data,'openingEntryType'=>$openingEntryType, 'to' => $to, 'from' => $from],[],$config);
            return $pdf->stream();
        }

    }
}
