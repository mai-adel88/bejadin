<?php

namespace App\Http\Controllers\Admin\Cc;

use App\Branches;
use App\glcc;
use App\levels;
use App\limitations;
use App\limitationsType;
use App\pjitmmsfl;
use App\receipts;
use App\receiptsType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class ReportController extends Controller
{
    public function motioncc(){
        $title = trans('admin.motion_detection_center_cost');

        $glcc = glcc::where('type','1')->pluck('name_'.session('lang'),'id');
        return view('admin.cc.reports.index',compact('title','glcc'));
    }
    public function show(Request $request){
        if($request->ajax()) {
            $glcc = $request->glcc;
            $contents = view('admin.cc.reports.show', compact('glcc'))->render();
            return $contents;
        }
    }
    public function details(Request $request){
        $glcc = $request->glcc;
        $from = $request->from;
        $to = $request->to;
        $hasTask = limitations::whereDate('created_at','>=',$from)->whereDate('created_at','<=',$to)->whereHas('limitations_type',function ($query) use ($glcc){
            $query->where('cc_id',$glcc);
        })->exists();
        $hasTask1 = receipts::whereDate('created_at','>=',$from)->whereDate('created_at','<=',$to)->whereHas('receipts_type',function ($query) use ($glcc){
            $query->where('cc_id',$glcc);
        })->exists();
        $contents = view('admin.cc.reports.details',compact('glcc', 'from', 'to', 'hasTask', 'hasTask1'))->render();
        return $contents;
    }

    //below this comment edited by Ibrahim El Monier

    public function pdf(Request $request) {
            $glcc = $request->glcc;
            $from = $request->from;
            $to = $request->to;
            $receiptsType = receiptsType::where('cc_id', $glcc)->whereHas('receipts',function ($query) use ($from,$to){
                $query->whereDate('created_at','>=', $from)->whereDate('created_at','<=', $to);
            })->get();
            $limitationsType = limitationsType::where('cc_id', $glcc)->whereHas('limitations',function ($query) use ($from,$to){
                $query->whereDate('created_at','>=', $from)->whereDate('created_at','<=', $to);
            })->get();
            $hastask = limitationsType::where('cc_id', $glcc)->whereHas('limitations',function ($query) use ($from,$to){
                $query->whereDate('created_at','>=', $from)->whereDate('created_at','<=', $to);
            })->exists();
            $hastask2 = receiptsType::where('cc_id', $glcc)->whereHas('receipts',function ($query) use ($from,$to){
                $query->whereDate('created_at','>=', $from)->whereDate('created_at','<=', $to);
            })->exists();
            $value_merged = $limitationsType->toBase()->merge($receiptsType);
            $ccname = glcc::where('id',$glcc)->first()['name_ar'];
            $config = ['instanceConfigurator' => function($mpdf) {
                $mpdf->SetHTMLFooter('
                        <div dir="ltr" style="text-align: right">{DATE j-m-Y H:m}</div>
                        <div dir="ltr" style="text-align: center">{PAGENO} of {nbpg}</div>'
                );
            }];
            $pdf = PDF::loadView('admin.cc.reports.pdf.report', compact('value_merged','hastask','hastask2','from','to','ccname'), [], $config);
            return $pdf->stream('glcc_report.pdf');

    }
    public function checkReports(){
        $title = trans('admin.disclosure_of_balances_of_accounts_of_cost_centers');
        $branches = Branches::pluck('name_'.session('lang'),'id');
        $levels = levels::where('type',2)->pluck('levelId','id');
        return view('admin.cc.checkReports.index',compact('levels','title','branches'));
    }
    public function checkShow(Request $request){
        if($request->ajax()) {

            $level = $request->level;
            $kind = $request->kind;

            $reporttype = $request->reporttype;


            if($reporttype == 0 && $level != null )
            {


                $glcc_first = glcc::where('level_id',$level)->orderBy('code', 'ASC')->pluck('id','name_'.session('lang'))->first();

                $glcc_last = glcc::where('level_id',$level)->orderBy('code', 'desc')->pluck('id','name_'.session('lang'))->first();

                $glcc = glcc::where('level_id',$level)->pluck('name_'.session('lang'),'id');

                return view('admin.cc.checkReports.show_1', compact('level','glcc','glcc_first','glcc_last'));
            }else if($reporttype == 1 && $kind != null)
            {
                //individual    total_cc

                switch ($kind) {
                    case '0':
//total
                        $levels = levels::where('type',2)->pluck('id','levelId');
                        $level_last = levels::where('type',2)->pluck('id')->last();


                        $glcc_first = glcc::where('level_id',$level_last)->pluck('id','name_'.session('lang'))->first();

                        $glcc_last = glcc::where('level_id',$level_last)->pluck('id','name_'.session('lang'))->last();

                        $glcc = glcc::where('level_id',$level_last)->pluck('name_'.session('lang'),'id');

                        return view('admin.cc.checkReports.show', compact('level','glcc','glcc_first','glcc_last'));
                        break;
                    case '1':
//balance
                        $levels = levels::where('type',2)->pluck('id','levelId');

                        $level_last = levels::where('type',2)->pluck('id')->last();


                        $glcc_first = glcc::where('level_id',$level_last)->pluck('id','name_'.session('lang'))->first();

                        $glcc_last = glcc::where('level_id',$level_last)->pluck('id','name_'.session('lang'))->last();

                        $glcc = glcc::where('level_id',$level_last)->pluck('name_'.session('lang'),'id');
                        return view('admin.cc.checkReports.show', compact('level','glcc','glcc_first','glcc_last'));



                        break;
                    case '2':
//no_balance
                        $levels = levels::where('type',2)->pluck('id','levelId');
                        $level_last = levels::where('type',2)->pluck('id')->last();


                        $glcc_first = glcc::where('level_id',$level_last)->pluck('id','name_'.session('lang'))->first();

                        $glcc_last = glcc::where('level_id',$level_last)->pluck('id','name_'.session('lang'))->last();

                        $glcc = glcc::where('level_id',$level_last)->pluck('name_'.session('lang'),'id');
                        return view('admin.cc.checkReports.show', compact('level','glcc','glcc_first','glcc_last'));


                        break;

                    default:
                        $levels = levels::where('type',2)->pluck('id','levelId');
                        $level_last = levels::where('type',2)->pluck('id')->last();


                        $glcc_first = glcc::where('level_id',$level_last)->pluck('id','name_'.session('lang'))->first();

                        $glcc_last = glcc::where('level_id',$level_last)->pluck('id','name_'.session('lang'))->last();

                        $glcc = glcc::where('level_id',$level_last)->pluck('name_'.session('lang'),'id');
                        return view('admin.cc.checkReports.show', compact('level','glcc','glcc_first','glcc_last'));



                }




            }



        }
    }

    public function checkDetails(Request $request){

        if($request->ajax()) {

            $from = $request->from;
            $to = $request->to;

            $fromtree = $request->fromtree;
            $totree = $request->totree;
            $level = $request->level;
            $reporttype = $request->reporttype;
            $kind = $request->kind;


            if ($from != null && $to != null && $fromtree != null && $totree != null && $kind != null){
                $contents = view('admin.cc.checkReports.details',compact('from','to','fromtree','totree','level','reporttype','kind'))->render();
                return $contents;
            }

        }
    }
    public function print(Request $request){


        $from = $request->from;
        $to = $request->to;
        $fromtree = $request->fromtree;
        $totree = $request->totree;
        $level = $request->level;
        $reporttype = $request->reporttype;
        $kind = $request->kind;

        if ($from != null && $to != null && $fromtree != null && $totree != null){

            if($reporttype == 0 && $level != null)
            {
                switch ($kind){
                    case '0';
//        total
                        $glcc = glcc::where('id','>=',$fromtree)->where('id','<=',$totree)->where('level_id',$level)->orderBy('code', 'ASC')->get();
                        $config = ['instanceConfigurator' => function($mpdf) {
                            $mpdf->SetHTMLFooter('
                    <div style="font-size:10px;width:25%;float:right">Print Date: {DATE j-m-Y H:m}</div>
                    <div style="font-size:10px;width:25%;float:left;direction:ltr;text-align:left">Page {PAGENO} of {nbpg}</div>'
                            );
                        }];
                        $pdf = PDF::loadView('admin.cc.reports.pdf.level_1', ['glcc'=>$glcc,'from'=>$from,'to'=>$to], [] , $config);
                        return $pdf->stream();

                        break;
                    case '1';

//cc_move
                        $glcc = glcc::where('id','>=',$fromtree)->where('id','<=',$totree)->where('level_id',$level)->orderBy('code', 'ASC')->get();


                        $config = ['instanceConfigurator' => function($mpdf) {
                            $mpdf->SetHTMLFooter('
                    <div style="font-size:10px;width:25%;float:right">Print Date: {DATE j-m-Y H:m}</div>
                    <div style="font-size:10px;width:25%;float:left;direction:ltr;text-align:left">Page {PAGENO} of {nbpg}</div>'
                            );
                        }];
                        $pdf = PDF::loadView('admin.cc.reports.pdf.level_2', ['glcc'=>$glcc,'from'=>$from,'to'=>$to], [] , $config);

                        return $pdf->stream();
                        break;
                    case '2';
                        // no_move
                        $glcc = glcc::where('id','>=',$fromtree)->where('id','<=',$totree)->where('level_id',$level)->orderBy('code', 'ASC')->get();


                        $config = ['instanceConfigurator' => function($mpdf) {
                            $mpdf->SetHTMLFooter('
                    <div style="font-size:10px;width:25%;float:right">Print Date: {DATE j-m-Y H:m}</div>
                    <div style="font-size:10px;width:25%;float:left;direction:ltr;text-align:left">Page {PAGENO} of {nbpg}</div>'
                            );
                        }];
                        $pdf = PDF::loadView('admin.cc.reports.pdf.level_3', ['glcc'=>$glcc,'from'=>$from,'to'=>$to], [] , $config);
                        return $pdf->stream();
                        break;
                    case '4';
//            $departments = Department::orderBy('code')->where('id', '>=', $fromtree)->where('id', '<=', $totree)->where('level_id',$level)->get();
                        $glcc = glcc::where('id','>=',$fromtree)->where('id','<=',$totree)->where('level_id',$level)->orderBy('code', 'ASC')->get();
                        $config = ['instanceConfigurator' => function($mpdf) {
                            $mpdf->SetHTMLFooter('
                    <div style="font-size:10px;width:25%;float:right">Print Date: {DATE j-m-Y H:m}</div>
                    <div style="font-size:10px;width:25%;float:left;direction:ltr;text-align:left">Page {PAGENO} of {nbpg}</div>'
                            );
                        }];
                        $pdf = PDF::loadView('admin.cc.reports.pdf.level_4', ['glcc'=>$glcc,'from'=>$from,'to'=>$to], [] , $config);
                        return $pdf->stream();
                    case '5';
                        $glcc = glcc::where('id','>=',$fromtree)->where('id','<=',$totree)->where('level_id',$level)->orderBy('code', 'ASC')->get();

                        $config = ['instanceConfigurator' => function($mpdf) {
                            $mpdf->SetHTMLFooter('
                    <div style="font-size:10px;width:25%;float:right">Print Date: {DATE j-m-Y H:m}</div>
                    <div style="font-size:10px;width:25%;float:left;direction:ltr;text-align:left">Page {PAGENO} of {nbpg}</div>'
                            );
                        }];
                        $pdf = PDF::loadView('admin.cc.reports.pdf.level_5', ['glcc'=>$glcc,'from'=>$from,'to'=>$to], [] , $config);
                        return $pdf->stream();
                        break;
                }


            }else if($reporttype == 1)
            {


                switch ($kind) {
                    case '0';

// total
                        $parent_id =glcc::groupBy('parent_id')->pluck('parent_id');
                        $id =glcc::pluck('id');
                        $diff = $id->diff($parent_id);



                        $glcc = glcc::where('id','>=',$fromtree)->where('id','<=',$totree)
                            ->whereIn('id',$diff)->orderBy('code', 'ASC')->get();

                        $config = ['instanceConfigurator' => function($mpdf) {
                            $mpdf->SetHTMLFooter('
                     <div dir="ltr" style="text-align: right">{DATE j-m-Y H:m}</div>
                     <div dir="ltr" style="text-align: center">{PAGENO} of {nbpg}</div>'
                            );
                        }];
                        $pdf = PDF::loadView('admin.cc.reports.pdf.cc_total', compact('glcc','from','to','fromtree','totree'), [], $config);
                        return $pdf->stream('glcc_report.pdf');

                        break;
                    case '1';
// cc_move

                        $parent_id =glcc::groupBy('parent_id')->pluck('parent_id');

                        $id =glcc::pluck('id');
                        $diff = $id->diff($parent_id);



                        $glcc = glcc::where('id','>=',$fromtree)->where('id','<=',$totree)
                            ->whereIn('id',$diff)->orderBy('code', 'ASC')->get();

                        $config = ['instanceConfigurator' => function($mpdf) {
                            $mpdf->SetHTMLFooter('
                     <div dir="ltr" style="text-align: right">{DATE j-m-Y H:m}</div>
                     <div dir="ltr" style="text-align: center">{PAGENO} of {nbpg}</div>'
                            );
                        }];
                        $pdf = PDF::loadView('admin.cc.reports.pdf.cc_balance', compact('glcc','from','to','fromtree','totree'), [], $config);
                        return $pdf->stream('glcc_report.pdf');
                        break;
                    case '2';
//        cc_no_move

                        $parent_id =glcc::groupBy('parent_id')->pluck('parent_id');

                        $id =glcc::pluck('id');
                        $diff = $id->diff($parent_id);



                        $glcc = glcc::where('id','>=',$fromtree)->where('id','<=',$totree)
                            ->whereIn('id',$diff)->orderBy('code', 'ASC')->get();


//            $parent_id =glcc::groupBy('parent_id')->pluck('parent_id');
//            $id =glcc::pluck('id');
//            $diff = $id->diff($parent_id);
//
//
//            $value_0 = \App\limitationsType::where('cc_id','!=',null)->whereHas('limitations',function ($q)use($to,$from){
//
//                $q->whereDate('created_at','>=',$from);
//                $q->whereDate('created_at','<=',$to);
//            })->pluck('cc_id');
//            $value_1 = \App\receiptsType::where('cc_id','!=',null)->whereHas('receipts',function ($q)use($to,$from){
//
//                $q->whereDate('created_at','>=',$from);
//                $q->whereDate('created_at','<=',$to);
//            })->pluck('cc_id');
//
//            $value2 = array_merge($value_1->toArray(), $value_0->toArray());
//
//            $glcc = glcc::where('id','>=',$fromtree)->where('id','<=',$totree)
//                ->whereIn('id',$diff)->get();


                        $config = ['instanceConfigurator' => function($mpdf) {
                            $mpdf->SetHTMLFooter('
                     <div dir="ltr" style="text-align: right">{DATE j-m-Y H:m}</div>
                     <div dir="ltr" style="text-align: center">{PAGENO} of {nbpg}</div>'
                            );
                        }];
                        $pdf = PDF::loadView('admin.cc.reports.pdf.cc_no_balance', compact('glcc','from','to','fromtree','totree'), [], $config);
                        return $pdf->stream('glcc_report.pdf');
                        break;
                    case '4';
//cc_dept
//            $value_0 = limitationsType::where('creditor','=',0)->where('debtor','!=',0)->where('cc_id','!=',null)->whereHas('limitations',function ($query) use ($from,$to){
//                $query->where('created_at', '>=', $from);
//                $query->where('created_at', '<=', $to);
//            })->pluck('cc_id');
//
//            $value_1 = receiptsType::where('creditor','=',0)->where('debtor','!=',0)->where('cc_id','!=',null)->whereHas('receipts',function ($query) use ($from,$to){
//                $query->where('created_at', '>=', $from);
//                $query->where('created_at', '<=', $to);
//            })->pluck('cc_id');
//
//            $value2 = array_merge($value_1->toArray(), $value_0->toArray());


                        $parent_id =glcc::groupBy('parent_id')->pluck('parent_id');
                        $id =glcc::pluck('id');


                        $diff = $id->diff($parent_id);
                        $glcc = glcc::where('id','>=',$fromtree)->where('id','<=',$totree)
                            ->whereIn('id',$diff)->get();









                        $config = ['instanceConfigurator' => function($mpdf) {
                            $mpdf->SetHTMLFooter('
                     <div dir="ltr" style="text-align: right">{DATE j-m-Y H:m}</div>
                     <div dir="ltr" style="text-align: center">{PAGENO} of {nbpg}</div>'
                            );
                        }];
                        $pdf = PDF::loadView('admin.cc.reports.pdf.cc_debtor', compact('glcc','from','to','fromtree','totree'), [], $config);
                        return $pdf->stream('glcc_report.pdf');
                        break;
                    case '5';


                        $value_0 = receiptsType::where('creditor','!=',0)->where('debtor','=',0)->where('cc_id','!=',null)->whereHas('receipts',function ($query) use ($from,$to){
                            $query->where('created_at', '>=', $from);
                            $query->where('created_at', '<=', $to);
                        })->pluck('cc_id');
                        $value_1 = limitationsType::where('creditor','!=',0)->where('debtor','=',0)->where('cc_id','!=',null)->whereHas('limitations',function ($query) use ($from,$to){
                            $query->where('created_at', '>=', $from);
                            $query->where('created_at', '<=', $to);
                        })->pluck('cc_id');
                        $value2 = [];
                        $value2 = array_merge($value_1->toArray(), $value_0->toArray());

                        $parent_id =glcc::groupBy('parent_id')->pluck('parent_id');

                        $id =glcc::pluck('id');

                        $diff = $id->diff($parent_id);

                        $glcc = glcc::where('id','>=',$fromtree)->where('id','<=',$totree)
                            ->whereIn('id',$diff)->get();


                        $config = ['instanceConfigurator' => function($mpdf) {
                            $mpdf->SetHTMLFooter('
                     <div dir="ltr" style="text-align: right">{DATE j-m-Y H:m}</div>
                     <div dir="ltr" style="text-align: center">{PAGENO} of {nbpg}</div>'
                            );
                        }];
                        $pdf = PDF::loadView('admin.cc.reports.pdf.cc_credior', compact('glcc','from','to','fromtree','totree'), [], $config);
                        return $pdf->stream('glcc_report.pdf');

                        break;
                }




            }


        }

    }



    public function CCpublicbalance(){
        $title = trans('admin.trial_balance_cc');
        $glcc = glcc::where('type','0')->pluck('name_'.session('lang'),'id');

        return view('admin.cc.PublicBalance.index',compact('title','glcc'));
    }
}
