<?php

namespace App\Http\Controllers\Admin\accountingReports;

use App\Contractors;
use App\Department;
use App\employee;
use App\limitations;
use App\limitationsType;
use App\Project;
use App\receipts;
use App\receiptsData;
use App\receiptsType;
use App\subscription;
use App\supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class trialBalanceController extends Controller
{
    public function index(){

        $title = trans('admin.trial_balance');
        return view('admin.accountingReports.trialBalance.index',compact('title'));
    }
    public function show(Request $request)
    {
        if($request->ajax()){
            $reporttype = $request->reporttype;
            $kind = $request->kind;
            $from = $request->from;
            $to = $request->to;
            $operations = $request->operations;
            if ($reporttype == 1){
                $level = $request->level;
            }else{
                $level = null;
            }
            $mfrom = date('n', strtotime($request->from));
            $mto = date('n', strtotime($request->to));
            $yfrom = date('Y', strtotime($request->from));
            $yto = date('Y', strtotime($request->to));
            if($reporttype != null && $kind != null && $operations != null && ($level != null || $level == null)){
                switch ($operations){
                    case '4';
                switch ($reporttype){
                    case '0';
                        switch ($kind){
                            default;
                                $departments = Department::where('type','1')->pluck('dep_name_'.session('lang'),'id');
                                $departments2 = Department::where('type','1')->pluck('id');
                                $contents = view('admin.accountingReports.trialBalance.show', ['fromtree'=>$departments2->first(), 'totree'=>$departments2->last(),'departments'=>$departments,'kind'=>$kind])->render();
                                return $contents;
                        }
                        break;
                    case '1';
                        switch ($kind){
                            default;
                                $departments = Department::where('level_id',$level)->pluck('dep_name_'.session('lang'),'id');
                                $contents = view('admin.accountingReports.trialBalance.show', ['level'=>$level,'fromtree'=>$departments->first(),'departments'=>$departments, 'totree'=>$departments->last(),'kind'=>$kind,'operations'=>$operations])->render();
                                return $contents;

                        }
                        break;
                }
                        break;
                    default;
                switch ($reporttype){
                    case '0';
                        switch($operations){
                            case '1';
                                $operation = supplier::all();
                                $departments = supplier::pluck('name_'.session('lang'),'id');
                                break;
                            case '2';
                                $operation = subscription::all();
                                $departments = subscription::pluck('name_'.session('lang'),'id');

                                break;
                            case '3';
                                $operation = Project::all();
                                $departments = Project::pluck('name_'.session('lang'),'id');

                                break;
                            case '5';
                                $operation = employee::all();
                                $departments = employee::pluck('name_'.session('lang'),'id');

                                break;
                            case '10';
                                $operation = Contractors::all();
                                $departments = Contractors::pluck('name_'.session('lang'),'id');

                                break;

                        }
                        $contents = view('admin.accountingReports.trialBalance.show2', ['kind'=>$kind,'fromtree'=>$operation->first(),'totree'=>$operation->last(),'departments'=>$departments,'operations'=>$operations])->render();
                        return $contents;
                        break;

                    }
                }
            }
        }
    }

    public function details(Request $request)
    {
        if($request->ajax()){
            $fromtree = $request->fromtree;
            $totree = $request->totree;
            $from = $request->from;
            $to = $request->to;
            $level = $request->level;
            $kind = $request->kind;
            $operations = $request->operations;
            if ($from && $to){
                $contents = view('admin.accountingReports.trialBalance.details', ['level'=>$level,'fromtree'=>$fromtree, 'totree'=>$totree,'from'=>$from,'to'=>$to,'kind'=>$kind,'operations'=>$operations])->render();
                return $contents;
            }
        }
    }
    public function details2(Request $request)
    {
        if($request->ajax()){
            $fromtree = $request->fromtree;
            $totree = $request->totree;
            $from = $request->from;
            $to = $request->to;
            $kind = $request->kind;
            $operations = $request->operations;
            $contents = view('admin.accountingReports.trialBalance.details2', ['fromtree'=>$fromtree, 'totree'=>$totree,'from'=>$from,'to'=>$to,'kind'=>$kind,'operations'=>$operations])->render();
            return $contents;
        }
    }

    public function pdf(Request $request) {
        $from = $request->from;
        $to = $request->to;
        $level = $request->level;
        $fromtree = $request->fromtree;
        $reporttype = $request->reporttype;
        $kind = $request->kind;
        $totree = $request->totree;
        $operation = $request->operations;
        if($fromtree != null && $totree != null){
            $mfrom = date('n', strtotime($request->from));
            $mto = date('n', strtotime($request->to));
            $yfrom = date('Y', strtotime($request->from));
            $yto = date('Y', strtotime($request->to));
            if ($level){
                switch ($kind){
                    case '0';

                        $departments = Department::orderBy('code')->where('id', '>=', $fromtree)->where('id', '<=', $totree)->where('level_id',$level)->get();
                        $config = ['instanceConfigurator' => function($mpdf) {
                            $mpdf->SetHTMLFooter('
                    <div style="font-size:10px;width:25%;float:right">Print Date: {DATE j-m-Y H:m}</div>
                    <div style="font-size:10px;width:25%;float:left;direction:ltr;text-align:left">Page {PAGENO} of {nbpg}</div>'
                            );
                        }];
                        $pdf = PDF::loadView('admin.accountingReports.trialBalance.pdf.level', ['departments'=>$departments,'from'=>$from,'to'=>$to], [] , $config);
                        return $pdf->stream();

                        break;
                    case '1';
                        $departments = Department::orderBy('code')->where('id', '>=', $fromtree)->where('id', '<=', $totree)->where('level_id',$level)->get();

                        $config = ['instanceConfigurator' => function($mpdf) {
                            $mpdf->SetHTMLFooter('
                    <div style="font-size:10px;width:25%;float:right">Print Date: {DATE j-m-Y H:m}</div>
                    <div style="font-size:10px;width:25%;float:left;direction:ltr;text-align:left">Page {PAGENO} of {nbpg}</div>'
                            );
                        }];
                        $pdf = PDF::loadView('admin.accountingReports.trialBalance.pdf.level2', ['departments'=>$departments,'from'=>$from,'to'=>$to], [] , $config);
                        return $pdf->stream();
                        break;
                    case '2';
                        $departments = Department::orderBy('code')->where('level_id',$level)->where('id', '>=', $fromtree)->where('id', '<=', $totree)
                            ->get();

                        $config = ['instanceConfigurator' => function($mpdf) {
                            $mpdf->SetHTMLFooter('
                    <div style="font-size:10px;width:25%;float:right">Print Date: {DATE j-m-Y H:m}</div>
                    <div style="font-size:10px;width:25%;float:left;direction:ltr;text-align:left">Page {PAGENO} of {nbpg}</div>'
                            );
                        }];
                        $pdf = PDF::loadView('admin.accountingReports.trialBalance.pdf.level3', ['departments'=>$departments,'from'=>$from,'to'=>$to], [] , $config);
                        return $pdf->stream();
                        break;
                    case '3';
                        $departments = Department::orderBy('code')->where('id', '>=', $fromtree)->where('id', '<=', $totree)->where('level_id',$level)->get();

                        $config = ['instanceConfigurator' => function($mpdf) {
                            $mpdf->SetHTMLFooter('
                    <div style="font-size:10px;width:25%;float:right">Print Date: {DATE j-m-Y H:m}</div>
                    <div style="font-size:10px;width:25%;float:left;direction:ltr;text-align:left">Page {PAGENO} of {nbpg}</div>'
                            );
                        }];
                        $pdf = PDF::loadView('admin.accountingReports.trialBalance.pdf.level4', ['departments'=>$departments,'from'=>$from,'to'=>$to], [] , $config);
                        return $pdf->stream();
                    case '4';
                        $departments = Department::orderBy('code')->where('id', '>=', $fromtree)->where('id', '<=', $totree)->where('level_id',$level)->get();

                        $config = ['instanceConfigurator' => function($mpdf) {
                            $mpdf->SetHTMLFooter('
                    <div style="font-size:10px;width:25%;float:right">Print Date: {DATE j-m-Y H:m}</div>
                    <div style="font-size:10px;width:25%;float:left;direction:ltr;text-align:left">Page {PAGENO} of {nbpg}</div>'
                            );
                        }];
                        $pdf = PDF::loadView('admin.accountingReports.trialBalance.pdf.level5', ['departments'=>$departments,'from'=>$from,'to'=>$to], [] , $config);
                        return $pdf->stream();
                        break;
                }
            }else{
                switch ($kind) {
                    case '0';
                        $departments = Department::orderBy('code')->where('id', '>=', $fromtree)->where('id', '<=', $totree)->where('type', '1')
                            ->with(['limitations_type'=>function ($query) use ($from,$to) {
                            $query->whereHas('limitations',function ($q) use ($from,$to){
                                $q->where('created_at', '>=', $from);
                                $q->where('created_at', '<=', $to);
                            });
                        }])->with(['receipts_type'=>function ($query) use ($from,$to) {
                            $query->whereHas('receipts', function ($q) use ($from, $to) {
                                $q->where('created_at', '>=', $from);
                                $q->where('created_at', '<=', $to);
                            });
                        }])->with(['receiptsData'=>function ($query) use ($from,$to) {
                            $query->whereHas('receipts', function ($q) use ($from, $to) {
                                $q->where('created_at', '>=', $from);
                                $q->where('created_at', '<=', $to);
                            });
                        }])->get();
                    break;
                    case '1';
                        $value1 = limitationsType::whereHas('limitations',function ($query) use ($from,$to){
                            $query->where('created_at', '>=', $from);
                            $query->where('created_at', '<=', $to);
                        })->pluck('tree_id');
                        $value2 = receiptsType::whereHas('receipts',function ($query) use ($from,$to){
                            $query->where('created_at', '>=', $from);
                            $query->where('created_at', '<=', $to);
                        })->pluck('tree_id');
                        $value3 = receiptsData::whereHas('receipts',function ($query) use ($from,$to){
                            $query->where('created_at', '>=', $from);
                            $query->where('created_at', '<=', $to);
                        })->pluck('tree_id');
                        $value = $value1->concat($value2)->concat($value3);
                        $departments = Department::orderBy('code')->where('id', '>=', $fromtree)->where('id', '<=', $totree)->where('type','=', '1')
                            ->with(['limitations_type'=>function ($query) use ($from,$to) {
                                $query->whereHas('limitations',function ($q) use ($from,$to){
                                    $q->where('created_at', '>=', $from);
                                    $q->where('created_at', '<=', $to);
                                });
                            }])->with(['receipts_type'=>function ($query) use ($from,$to) {
                                $query->whereHas('receipts', function ($q) use ($from, $to) {
                                    $q->where('created_at', '>=', $from);
                                    $q->where('created_at', '<=', $to);
                                });
                            }])->with(['receiptsData'=>function ($query) use ($from,$to) {
                                $query->whereHas('receipts', function ($q) use ($from, $to) {
                                    $q->where('created_at', '>=', $from);
                                    $q->where('created_at', '<=', $to);
                                });
                            }])->where('type','=', '1')->whereIn('id',$value)->get();
                    break;
                    case '2';
                        $value1 = limitationsType::whereHas('limitations',function ($query) use ($from,$to){
                            $query->where('created_at', '>=', $from);
                            $query->where('created_at', '<=', $to);
                        })->pluck('tree_id');
                        $value2 = receiptsType::whereHas('receipts',function ($query) use ($from,$to){
                            $query->where('created_at', '>=', $from);
                            $query->where('created_at', '<=', $to);
                        })->pluck('tree_id');
                        $value3 = receiptsData::whereHas('receipts',function ($query) use ($from,$to){
                            $query->where('created_at', '>=', $from);
                            $query->where('created_at', '<=', $to);
                        })->pluck('tree_id');
                        $value = $value1->concat($value2)->concat($value3);
                        $departments = Department::orderBy('code')->where('id', '>=', $fromtree)->where('id', '<=', $totree)->where('type','=', '1')->whereNotIn('id',$value)->get();
//                        $departments = Department::orderBy('code')->where('type', '1')->doesnthave('limitations_type')->doesnthave('receipts_type')->doesnthave('receiptsData')->get();
                    break;
                    case '3';
                        $value1 = limitationsType::where('creditor','=',0)->where('debtor','!=',0)->whereHas('limitations',function ($query) use ($from,$to){
                            $query->where('created_at', '>=', $from);
                            $query->where('created_at', '<=', $to);
                        })->pluck('tree_id');
                        $value2 = receiptsType::where('creditor','=',0)->where('debtor','!=',0)->whereHas('receipts',function ($query) use ($from,$to){
                            $query->where('created_at', '>=', $from);
                            $query->where('created_at', '<=', $to);
                        })->pluck('tree_id');
                        $value3 = receiptsData::where('creditor','=',0)->where('debtor','!=',0)->whereHas('receipts',function ($query) use ($from,$to){
                            $query->where('created_at', '>=', $from);
                            $query->where('created_at', '<=', $to);
                        })->pluck('tree_id');
                        $value = $value1->concat($value2)->concat($value3);
                        $departments = Department::orderBy('code')->where('type', '1')
                            ->with(['limitations_type'=>function ($query) use ($from,$to) {
                                $query->where('creditor','=',0)->where('debtor','!=',0);
                                $query->whereHas('limitations',function ($q) use ($from,$to){
                                    $q->where('created_at', '>=', $from);
                                    $q->where('created_at', '<=', $to);
                                });
                            }])->with(['receipts_type'=>function ($query) use ($from,$to) {
                                $query->where('creditor','=',0)->where('debtor','!=',0);
                                $query->whereHas('receipts', function ($q) use ($from, $to) {
                                    $q->where('created_at', '>=', $from);
                                    $q->where('created_at', '<=', $to);
                                });
                            }])->with(['receiptsData'=>function ($query) use ($from,$to) {
                                $query->where('creditor','=',0)->where('debtor','!=',0);
                                $query->whereHas('receipts', function ($q) use ($from, $to) {
                                    $q->where('created_at', '>=', $from);
                                    $q->where('created_at', '<=', $to);
                                });
                            }])->where('type', '1')->whereIn('id',$value)->get();
                        $config = ['instanceConfigurator' => function($mpdf) {
                            $mpdf->SetHTMLFooter('
                                    <div style="font-size:10px;width:25%;float:right">Print Date: {DATE j-m-Y H:m}</div>
                                    <div style="font-size:10px;width:25%;float:left;direction:ltr;text-align:left">Page {PAGENO} of {nbpg}</div>'
                            );
                        }];
                        $pdf = PDF::loadView('admin.accountingReports.trialBalance.pdf.reportdebtor', ['departments'=>$departments,'from'=>$from,'to'=>$to], [] , $config);
                        return $pdf->stream();
                    break;
                    case '4';

                        $value1 = limitationsType::whereHas('limitations',function ($query) use ($from,$to){
                            $query->where('created_at', '>=', $from);
                            $query->where('created_at', '<=', $to);
                        })->where('creditor','!=',0)->where('debtor','=',0)->where('tree_id', '>=', $fromtree)->where('tree_id', '<=', $totree)->pluck('tree_id');
                        $value2 = receiptsType::whereHas('receipts',function ($query) use ($from,$to){
                            $query->where('created_at', '>=', $from);
                            $query->where('created_at', '<=', $to);
                        })->where('creditor','!=',0)->where('debtor','=',0)->where('tree_id', '>=', $fromtree)->where('tree_id', '<=', $totree)->pluck('tree_id');
                        $value3 = receiptsData::whereHas('receipts',function ($query) use ($from,$to){
                            $query->where('created_at', '>=', $from);
                            $query->where('created_at', '<=', $to);
                        })->where('creditor','!=',0)->where('debtor','=',0)->where('tree_id', '>=', $fromtree)->where('tree_id', '<=', $totree)->pluck('tree_id');
                        $value = $value1->concat($value2)->concat($value3);
                        $departments = Department::orderBy('code')->where('type', '1')
                            ->with(['limitations_type'=>function ($query) use ($from,$to,$fromtree,$totree) {
                                $query->whereHas('limitations',function ($q) use ($from,$to){
                                    $q->where('created_at', '>=', $from);
                                    $q->where('created_at', '<=', $to);
                                });
                                $query->where('creditor','!=',0)->where('debtor','=',0)->where('tree_id', '>=', $fromtree)->where('tree_id', '<=', $totree);
                            }])->with(['receipts_type'=>function ($query) use ($from,$to,$fromtree,$totree) {
                                $query->whereHas('receipts', function ($q) use ($from, $to) {
                                    $q->where('created_at', '>=', $from);
                                    $q->where('created_at', '<=', $to);
                                });
                                $query->where('creditor','!=',0)->where('debtor','=',0)->where('tree_id', '>=', $fromtree)->where('tree_id', '<=', $totree);
                            }])->with(['receiptsData'=>function ($query) use ($from,$to,$fromtree,$totree) {
                                $query->whereHas('receipts', function ($q) use ($from, $to) {
                                    $q->where('created_at', '>=', $from);
                                    $q->where('created_at', '<=', $to);
                                });
                                $query->where('creditor','!=',0)->where('debtor','=',0)->where('tree_id', '>=', $fromtree)->where('tree_id', '<=', $totree);
                            }])->where('type', '1')->whereIn('id',$value)->get();
                                $config = ['instanceConfigurator' => function($mpdf) {
                                    $mpdf->SetHTMLFooter('
                                    <div style="font-size:10px;width:25%;float:right">Print Date: {DATE j-m-Y H:m}</div>
                                    <div style="font-size:10px;width:25%;float:left;direction:ltr;text-align:left">Page {PAGENO} of {nbpg}</div>'
                                    );
                                }];
                                $pdf = PDF::loadView('admin.accountingReports.trialBalance.pdf.reportcreditor', ['departments'=>$departments,'from'=>$from,'to'=>$to], [] , $config);
                                return $pdf->stream();
                    break;
                }

                $config = ['instanceConfigurator' => function($mpdf) {
                    $mpdf->SetHTMLFooter('
                    <div style="font-size:10px;width:25%;float:right">Print Date: {DATE j-m-Y H:m}</div>
                    <div style="font-size:10px;width:25%;float:left;direction:ltr;text-align:left">Page {PAGENO} of {nbpg}</div>'
                    );
                }];
                $pdf = PDF::loadView('admin.accountingReports.trialBalance.pdf.report', ['departments'=>$departments,'from'=>$from,'to'=>$to], [] , $config);
                return $pdf->stream();
            }

        }
    }


    public function pdf2(Request $request) {
        $from = $request->from;
        $to = $request->to;
        $fromtree = $request->fromtree;
        $totree = $request->totree;
        $level = $request->level;
        $reporttype = $request->reporttype;
        $kind = $request->kind;
        $operation = $request->operations;
        if($from != null && $to != null){
            switch ($kind) {
                case '0';
                    $departments = Department::where('type','1')->where('operation_id',$operation)->get();
                    $config = ['instanceConfigurator' => function($mpdf) {
                        $mpdf->SetHTMLFooter('
                    <div style="font-size:10px;width:25%;float:right">Print Date: {DATE j-m-Y H:m}</div>
                    <div style="font-size:10px;width:25%;float:left;direction:ltr;text-align:left">Page {PAGENO} of {nbpg}</div>'
                        );
                    }];
                    $pdf = PDF::loadView('admin.accountingReports.trialBalance.pdf.employee', ['from'=>$from,'to'=>$to,'fromtree'=>$fromtree,'totree'=>$totree,'operation'=>$operation,'departments'=>$departments], [] , $config);
                    return $pdf->stream();
                break;
                case '1';
                    $departments = Department::where('type','1')->where('operation_id',$operation)->get();
                    $config = ['instanceConfigurator' => function($mpdf) {
                        $mpdf->SetHTMLFooter('
                    <div style="font-size:10px;width:25%;float:right">Print Date: {DATE j-m-Y H:m}</div>
                    <div style="font-size:10px;width:25%;float:left;direction:ltr;text-align:left">Page {PAGENO} of {nbpg}</div>'
                        );
                    }];
                    $pdf = PDF::loadView('admin.accountingReports.trialBalance.pdf.employee2', ['from'=>$from,'to'=>$to,'fromtree'=>$fromtree,'totree'=>$totree,'operation'=>$operation,'departments'=>$departments], [] , $config);
                    return $pdf->stream();
                break;
                case '2';
                    $departments = Department::where('type','1')->where('operation_id',$operation)->get();
                    $config = ['instanceConfigurator' => function($mpdf) {
                        $mpdf->SetHTMLFooter('
                    <div style="font-size:10px;width:25%;float:right">Print Date: {DATE j-m-Y H:m}</div>
                    <div style="font-size:10px;width:25%;float:left;direction:ltr;text-align:left">Page {PAGENO} of {nbpg}</div>'
                        );
                    }];
                    $pdf = PDF::loadView('admin.accountingReports.trialBalance.pdf.employee3', ['from'=>$from,'to'=>$to,'fromtree'=>$fromtree,'totree'=>$totree,'operation'=>$operation,'departments'=>$departments], [] , $config);
                    return $pdf->stream();
                break;
                case '3';
                    $departments = Department::where('type','1')->where('operation_id',$operation)->get();
                    $config = ['instanceConfigurator' => function($mpdf) {
                        $mpdf->SetHTMLFooter('
                    <div style="font-size:10px;width:25%;float:right">Print Date: {DATE j-m-Y H:m}</div>
                    <div style="font-size:10px;width:25%;float:left;direction:ltr;text-align:left">Page {PAGENO} of {nbpg}</div>'
                        );
                    }];
                    $pdf = PDF::loadView('admin.accountingReports.trialBalance.pdf.employee4', ['from'=>$from,'to'=>$to,'fromtree'=>$fromtree,'totree'=>$totree,'operation'=>$operation,'departments'=>$departments], [] , $config);
                    return $pdf->stream();
                break;
                case '4';
                    $departments = Department::where('type','1')->where('operation_id',$operation)->get();
                    $config = ['instanceConfigurator' => function($mpdf) {
                        $mpdf->SetHTMLFooter('
                    <div style="font-size:10px;width:25%;float:right">Print Date: {DATE j-m-Y H:m}</div>
                    <div style="font-size:10px;width:25%;float:left;direction:ltr;text-align:left">Page {PAGENO} of {nbpg}</div>'
                        );
                    }];
                    $pdf = PDF::loadView('admin.accountingReports.trialBalance.pdf.employee5', ['from'=>$from,'to'=>$to,'fromtree'=>$fromtree,'totree'=>$totree,'operation'=>$operation,'departments'=>$departments], [] , $config);
                    return $pdf->stream();
                break;
            }
        }

    }
}
