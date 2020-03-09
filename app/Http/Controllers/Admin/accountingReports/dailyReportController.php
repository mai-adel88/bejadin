<?php

namespace App\Http\Controllers\Admin\accountingReports;

use App\Branches;
use App\drivers;
use App\limitationReceipts;
use App\limitations;
use App\limitationsType;
use App\operation;
use App\receipts;
use App\receiptsData;
use App\receiptsType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class dailyReportController extends Controller
{
    public function index(){
        $operations = operation::whereIn('receipt',[1,2])->pluck('name_'.session('lang'),'id');
        $branches = Branches::pluck('name_'.session('lang'),'id');
        $limitationReceipts = limitationReceipts::pluck('name_'.session('lang'),'id');
        $title = trans('admin.daily_report');
        return view('admin.accountingReports.index',compact('title','operations','branches','limitationReceipts'));
    }
    public function show(Request $request)
    {
        if($request->ajax()){
            $operations = $request->operations;
            $branches = $request->branches;
            $type = $request->type;
            $kind = $request->kind;
            if($operations != null && $type != null && $kind != null && $branches != null){
                $contents = view('admin.accountingReports.show', ['kind'=>$kind])->render();
                return $contents;
            }
        }
    }
    public function details(Request $request)
    {
        if($request->ajax()){
            $operations = $request->operations;
            $branches = Branches::where('id',$request->branches)->first();
            $type = limitationReceipts::where('id',$request->type)->first();
            $kind = $request->kind;
            $to = $request->to;
            $from = $request->from;
            if ($kind == 0){
                if($from != null && $to != null){
                    if ($type->type == 0){
                        $hasTask = DB::table('receipts')->where('branche_id',$request->branches)->where('receiptsType_id',$request->type)->whereDate('created_at','>=', $from)->whereDate('created_at','<=',$to)->exists();

                        $contents = view('admin.accountingReports.details', ['kind'=>$kind,'operations'=>$operations,'branches'=>$request->branches,'type'=>$request->type,'from'=>$from,'to'=>$to,'hasTask'=>$hasTask]);
                        return $contents;
                    }
                    elseif ($type->type == 1 || $type->type == 2){

                        $hasTask = DB::table('limitations')->where('branche_id',$request->branches)->where('limitationsType_id',$request->type)->whereDate('created_at','>=', $from)->whereDate('created_at','<=',$to)->exists();
                        $contents = view('admin.accountingReports.detailsLimitations', ['kind'=>$kind,'operations'=>$operations,'branches'=>$request->branches,'type'=>$request->type,'from'=>$from,'to'=>$to,'hasTask'=>$hasTask])->render();
                        return $contents;
                    }
                }
            }

            if ($kind == 1){
                if($from != null && $to != null){
                    if ($type->type == 0){
                        $hasTask = DB::table('receipts')->where('branche_id',$request->branches)->where('receiptsType_id',$request->type)->where('receiptId', '>=', $from)->where('receiptId', '<=', $to)->exists();

                        $contents = view('admin.accountingReports.details', ['kind'=>$kind,'operations'=>$operations,'branches'=>$request->branches,'type'=>$request->type,'from'=>$from,'to'=>$to,'hasTask'=>$hasTask])->render();
                        return $contents;
                    }
                    if ($type->type == 1 || $type->type == 2){
                        $hasTask = DB::table('limitations')->where('branche_id',$request->branches)->where('limitationsType_id',$request->type)->where('receiptId', '>=', $from)->where('receiptId', '<=', $to)->exists();
                        $contents = view('admin.accountingReports.detailsLimitations', ['kind'=>$kind,'operations'=>$operations,'branches'=>$request->branches,'type'=>$request->type,'from'=>$from,'to'=>$to,'hasTask'=>$hasTask])->render();
                        return $contents;
                    }
                }
            }
        }
    }

    public function pdf(Request $request) {
        $operations = $request->operations;
        $from = $request->from;
        $to = $request->to;
        $kind = $request->kind;
        $branches = $request->branches;
        $type = $request->type;
        $typeLimitationReceipts = limitationReceipts::where('id',$request->type)->first();
//        dd($to, $from);
        if ($kind == 0){
            if ($typeLimitationReceipts->type == 0) {
                $receiptsWithDate = receipts::whereHas('receipts_type',function($query) use ($operations){
                    $query->where('operation_id',$operations);
                })->where('branche_id',$branches)->where('receiptsType_id',$request->type)->whereDate('created_at', '>=', $from)->whereDate('created_at', '<=', $to)->orderBy('created_at')
                    ->get()->groupBy(function ($val) {
                        return Carbon::parse($val->created_at)->format('Y-m-d');
                    });
                $config = ['instanceConfigurator' => function($mpdf) {
                    $mpdf->SetHTMLFooter('
                        <div style="font-size:10px;width:25%;float:right">Print Date: {DATE j-m-Y H:m}</div>
                        <div style="font-size:10px;width:25%;float:left;direction:ltr;text-align:left">Page {PAGENO} of {nbpg}</div>'
                    );
                }];
                $pdf = PDF::loadView('admin.accountingReports.pdf.report',compact('receiptsWithDate','operations','typeLimitationReceipts', 'to', 'from'), [] , $config);
                return $pdf->stream();
            }
            if ($typeLimitationReceipts->type == 1 || $typeLimitationReceipts->type == 2){
                $limitationsTypeInvoice = limitations::whereHas('limitations_type',function($query) use ($operations){
                    $query->where('operation_id',$operations);
                })->where('branche_id',$branches)->where('limitationsType_id',$request->type)->whereDate('created_at','>=', $from)->whereDate('created_at','<=', $to)->orderBy('created_at')
                    ->get()->groupBy(function ($val) {
                        return Carbon::parse($val->created_at)->format('Y-m-d');
                    });

                $config = ['instanceConfigurator' => function($mpdf) {
                    $mpdf->SetHTMLFooter('
                        <div style="font-size:10px;width:25%;float:right">Print Date: {DATE j-m-Y H:m}</div>
                        <div style="font-size:10px;width:25%;float:left;direction:ltr;text-align:left">Page {PAGENO} of {nbpg}</div>'
                    );
                }];
                $pdf = PDF::loadView('admin.accountingReports.pdf.LimitationReport', compact('limitationsTypeInvoice', 'limitationsAll', 'operations','branches','type','typeLimitationReceipts', 'to', 'from'), [] , $config);
                return $pdf->stream();
            }
        }
//        dd($to, $from);
        if ($kind == 1){
            if ($typeLimitationReceipts->type == 0) {
                $receiptsWithDate = receipts::whereHas('receipts_type',function($query) use ($operations){
                    $query->where('operation_id',$operations);
                })->where('branche_id',$branches)->where('receiptsType_id',$request->type)->where('receiptId', '>=', $from)->where('receiptId', '<=', $to)->orderBy('receiptId')
                    ->get()->groupBy(function ($val) {
                        return Carbon::parse($val->created_at)->format('Y-m-d');
                    });
                $config = ['instanceConfigurator' => function($mpdf) {
                    $mpdf->SetHTMLFooter('
                        <div style="font-size:10px;width:25%;float:right">Print Date: {DATE j-m-Y H:m}</div>
                        <div style="font-size:10px;width:25%;float:left;direction:ltr;text-align:left">Page {PAGENO} of {nbpg}</div>'
                    );
                }];
                $pdf = PDF::loadView('admin.accountingReports.pdf.report',compact('receiptsWithDate','operations','typeLimitationReceipts', 'to', 'from'), [] , $config);
                return $pdf->stream();
            }
            if ($typeLimitationReceipts->type == 1 || $typeLimitationReceipts->type == 2){
                $limitationsTypeInvoice = limitations::whereHas('limitations_type',function($query) use ($operations){
                    $query->where('operation_id',$operations);
                })->where('branche_id',$branches)->where('limitationsType_id',$request->type)->where('limitationId','>=', $from)->where('limitationId','<=', $to)->orderBy('limitationId')
                    ->get()->groupBy(function ($val) {
                        return Carbon::parse($val->created_at)->format('Y-m-d');
                    });
                $config = ['instanceConfigurator' => function($mpdf) {
                    $mpdf->SetHTMLFooter('
                            <div style="font-size:10px;width:25%;float:right">Print Date: {DATE j-m-Y H:m}</div>
                        <div style="font-size:10px;width:25%;float:left;direction:ltr;text-align:left">Page {PAGENO} of {nbpg}</div>'
                    );
                }];
                $pdf = PDF::loadView('admin.accountingReports.pdf.LimitationReport', compact('limitationsTypeInvoice', 'limitationsAll', 'operations','branches','type','typeLimitationReceipts', 'to', 'from'), [] , $config);
                return $pdf->stream();
            }
        }
    }
}
