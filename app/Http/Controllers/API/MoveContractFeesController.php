<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\applicants_company;
use DB;
use PDF;

class MoveContractFeesController extends Controller
{
    public function MoveContractFees(request $request)
    {
        $data = $request->all();
        return route('ContractFeesPDF',$data);
        // \DB::table('applicants_company')->update(array('branch_id' => 1));
    }

    public function MoveContractFeesPDF(Request $request)
    {
        $branch = $request->branche_id;
        $from = $request->from;
        $to = $request->to;
        // $data = $request;
        // $applicantsCompany = applicants_company::where('branch','=',1)->get(['branch_id']);
        $ContractFees = applicants_company::where('branch_id',$branch)->whereBetween('agreement_date', [$from, $to])->where('move_number','!=',null)->orderby('agreement_date')->with('companies')->with('applicants')->get([
            'applicants_id','companies_id','agreement_date','move_number','contract_value','contract_percent','percent_total','contract_total','price','price_else','company_fees'
        ]);
        // dd(count($ContractFees));
        $config = ['instanceConfigurator' => function($mpdf) {
            $mpdf->SetHTMLFooter('
                <div style="font-size:10px;width:25%;float:right">Print Date: {DATE j-m-Y H:m}</div>
                <div style="font-size:10px;width:25%;float:left;direction:ltr;text-align:left">Page {PAGENO} of {nbpg}</div>'
            );
        }];
        // dd($config);
        // $pdf = PDF::loadView('admin.progress.pdf.ContractReport');
        $pdf = PDF::loadView('admin.progress.pdf.ContractReport', compact('ContractFees','from','to'),[],['format' => 'A4'], $config);
        // return route('MoveContractFeesPDF',$help);
        return $pdf->stream();
        // return view('admin.progress.pdf.ContractReport',$pdf);
    }
}
