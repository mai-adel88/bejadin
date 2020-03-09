<?php

namespace App\Http\Controllers\Admin\report;

use App\Branches;
use App\DatabaseStorageModel;
use App\subscription;
use App\subtransport;
use Illuminate\Http\Request;
use niklasravnsborg\LaravelPdf\Facades\Pdf;
use App\Http\Controllers\Controller;

class PremiumController extends Controller
{
    public function index(Branches $branches)
    {
        if (auth()->guard('admin')->user()->branches_id == $branches->first()->id) {
        $data = DatabaseStorageModel::get()->groupBy('relation_id');

        $config = ['instanceConfigurator' => function($mpdf) {
            $mpdf->SetHTMLFooter('
            <div style="font-size:10px;width:25%;float:right">Print Date: {DATE j-m-Y H:m}</div>
            <div style="font-size:10px;width:25%;float:left;direction:ltr;text-align:left">Page {PAGENO} of {nbpg}</div>'
            );
        }];
        return view('admin.reports.premium_reports',compact('data'));

//            foreach ($subs as $sub){
//            $sub->subtransport;
//
//            $subtransports = $sub->subtransport;
//                foreach ($subtransports as $subtransport){
//                    $carts = DatabaseStorageModel::where('relation_id',$sub->id)->where('trans_id',$subtransport->id)->get();
//                    foreach($carts as $cart){
//                        if ($cart->payment != $subtransport->price){
//                            $subscriptions = subscription::where('id',$cart->relation_id)->get();
//                        }
//                    };
//                }
//            }
        }else{
            $data = DatabaseStorageModel::get()->groupBy('relation_id');

            $config = ['instanceConfigurator' => function($mpdf) {
                $mpdf->SetHTMLFooter('
            <div style="font-size:10px;width:25%;float:right">Print Date: {DATE j-m-Y H:m}</div>
            <div style="font-size:10px;width:25%;float:left;direction:ltr;text-align:left">Page {PAGENO} of {nbpg}</div>'
                );
            }];
            return view('admin.reports.premium_reports',compact('data'));
        }
    }
}
