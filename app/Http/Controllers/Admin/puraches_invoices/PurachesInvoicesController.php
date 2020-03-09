<?php

namespace App\Http\Controllers\Admin\puraches_invoices;

use App\DataTables\PurachesInvoicesDataTable;
use App\Models\Admin\ActivityTypes;
use App\Models\Admin\AstSalesman;
use App\Models\Admin\InvLoddtl;
use App\Models\Admin\InvLodhdr;
use App\Models\Admin\MainBranch;
use App\Models\Admin\MainCompany;
use App\Models\Admin\MtsItmfsunit;
use App\Models\Admin\MtsItmmfs;
use App\Models\Admin\PjbranchDlv;
use App\Models\Admin\Units;
use App\Models\Admin\AstCurncy;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use niklasravnsborg\LaravelPdf\Facades\Pdf;
use function GuzzleHttp\Promise\all;

class PurachesInvoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param salesInvoicesDataTable $table
     * @return Response
     */
    public function index(PurachesInvoicesDataTable $table)
    {

        return $table->render('admin.purchases_invoices.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return Response
     */
    public function create(Request $request)
    {
        $last = InvLodhdr::latest()->first();
        if(session('Cmp_No') == -1){
            $branches = MainBranch::with('stores')->get();
            $companies = MainCompany::all();
            $activity = ActivityTypes::all();
        }
        else {
            $branches = MainBranch::where('Cmp_No', session('Cmp_No'))->with('stores')->get();
            $companies = MainCompany::where('Cmp_No', session('Cmp_No'))->get();
            $activity = ActivityTypereturnItemInfos::where('Cmp_No', session('Cmp_No'))->get();
        }

        $items = MtsItmmfs::where('Itm_Parnt', '!=', null)->get();
        $units = Units::all();
        $currencies = AstCurncy::all();

        return view('admin.purchases_invoices.create', compact(['currencies','branches', 'companies', 'activity', 'last', 'items', 'units']));
    }

    public function store(Request $request)
    {
       
        if ($request->ajax() && $request->requestType == 'createHeader'){
            $validation = Validator::make($request->all(), [
                'Cmp_No' => 'required',
                'Actvty_No' => 'required',
                'Brn_No' => 'required',
                'Slm_No' => 'sometimes',
                'Cstm_No' => 'required',
                'Dlv_Stor' => 'required',
                'Doc_Dt' => 'required',
                'Doc_DtAr' => 'required',
                'Doc_No' => 'required',
                'SubCstm_Filno' => 'required',
                'Pym_No' => 'required',
                'Reftyp_No' => 'sometimes',
                'Ref_No' => 'sometimes',
                'Credit_Days' => 'required',
                'Pym_Dt' => 'required',
                'Tax_Allow' => 'sometimes',
                'Notes' => 'required',
                'Notes1' => 'sometimes',
                'Doc_Ty' => 'sometimes',
                'FcTot_Sal' => 'sometimes',
                'Curncy_No' => 'sometimes',
                'ExchangeRate' => 'sometimes',

            ],[], [
                'Cmp_No' => trans('admin.na_Comp'),
                'Actvty_No' => trans('admin.activity'),
                'Brn_No' => trans('admin.Brn_No'),
                'Slm_No' => trans('admin.Slm_No'),
                'Cstm_No' => trans('admin.Cstm_No'),
                'Dlv_Stor' => trans('admin.Dlv_Stor'),
                'Doc_Dt' => trans('admin.Doc_Dt'),
                'Doc_DtAr' => trans('admin.Doc_DtAr'),
                'Doc_No' => trans('admin.Doc_No'),
                'SubCstm_Filno' => trans('admin.SubCstm_Filno'),
                'Pym_No' => trans('admin.Pym_No'),
                'Reftyp_No' => trans('admin.Reftyp_No'),
                'Ref_No' => trans('admin.Ref_No'),
                'Credit_Days' => trans('admin.Credit_Days'),
                'Pym_Dt' => trans('admin.Pym_Dt'),
                'Notes' => trans('admin.notes'),
                'Doc_Ty' => trans('admin.Doc_Ty'),
            ]);

            dd($request->all());
            if ($validation->fails()){
                return  response()->json(['status' => 0, 'message' => $validation->getMessageBag()->first()]);
            } else {
                $header = InvLodhdr::where('Doc_No', $request->Doc_No)->first();
                if($header == null){
                    InvLodhdr::create($request->all());
                } else {
                    $header->update($request->all());
                    if (!$request->has(['Tax_Allow'])){
                        $header->update(['Tax_Allow' => null]);
                    }
                }
                return  response()->json(['status' => 1, 'message' => trans('admin.save_success')]);
            }
        }
    }

    public function createPurchaseNewLine(Request $request)
    {
        if ($request->ajax()){
            $validation = Validator::make($request->all(), [
                'Ln_No' => 'required',
                'Cmp_No' => 'required',
                'Actvty_No' => 'required',
                'Brn_No' => 'required',
                'Slm_No' => 'sometimes',
                'Cstm_No' => 'required',
                'Dlv_Stor' => 'required',
                'Titm_Sal' => 'required',
                'Pym_No' => 'required',
                'Reftyp_No' => 'sometimes',
                'AfterDiscount' => 'sometimes',
                'Ref_No' => 'sometimes',
                'Doc_No' => 'required',
                'Doc_Dt' => 'required',
                'Doc_DtAr' => 'required',
                'Itm_No' => 'required',
                'Unit_No' => 'required',
                'Loc_No' => 'sometimes',
                'Qty' => 'required',
                'Itm_Pur' => 'required',
                'Exp_Date' => 'sometimes',
                'Batch_No' => 'sometimes',
                'Disc1_Prct' => 'sometimes',
                'Disc1_Val' => 'sometimes',
                'Taxp_ExtraDtl' => 'sometimes',
                'Taxv_ExtraDtl' => 'sometimes',
                'Tot_Sal' => 'sometimes',
                'Tot_Disc' => 'sometimes',
                'Tot_Prct' => 'sometimes',
                'Tot_ODisc' => 'sometimes',
                'Tot_OPrct' => 'sometimes',
                'Taxp_ExtraHdr' => 'sometimes',
                'Taxv_ExtraHdr' => 'sometimes',
                'Net' => 'sometimes',
                'Doc_Ty' => 'sometimes',
                'Curncy_No' => 'sometimes',
                'ExchangeRate' => 'sometimes',
            ],[], [
                'Cmp_No' => trans('admin.na_Comp'),
                'Actvty_No' => trans('admin.activity'),
                'Brn_No' => trans('admin.Brn_No'),
                'Slm_No' => trans('admin.Slm_No'),
                'Cstm_No' => trans('admin.Cstm_No'),
                'Dlv_Stor' => trans('admin.Dlv_Stor'),
                'Pym_No' => trans('admin.Pym_No'),
                'Reftyp_No' => trans('admin.Reftyp_No'),
                'Ref_No' => trans('admin.Ref_No'),
                'Doc_No' => trans('admin.Doc_No'),
                'Doc_Dt' => trans('admin.Doc_Dt'),
                'Doc_DtAr' => trans('admin.Doc_DtAr'),
                'Itm_No' => trans('admin.item_no'),
                'Unit_No' => trans('admin.unit_no'),
                'Qty' => trans('admin.Qty'),
                'Itm_Pur' => trans('admin.Itm_Pur'),
                'Exp_Date' => trans('admin.Exp_Date'),
                'Batch_No' => trans('admin.Batch_No'),
                'Doc_Ty' => trans('admin.Doc_Ty'),
            ]);

            if ($validation->fails()){
                return  response()->json(['status' => 0, 'message' => $validation->getMessageBag()->first()]);
            } else {
                $detail = InvLoddtl::where('Ln_No', $request->Ln_No)->where('Doc_No', $request->Doc_No)->first();
                if($detail == null){
                    InvLoddtl::create($request->all());
                } else {
                    $detail->update($request->all());
                }

                $header = InvLodhdr::where('Doc_No', $request->Doc_No)->first();

                $header->update($request->all());

                $header->update(['status' => 1]);

                return  response()->json(['status' => 1, 'message' => trans('admin.save_success')]);

            }
        }
    }



    public function edit($id)
    {
        $header = InvLodhdr::with('details', 'customer', 'branch', 'company', 'store')->where('Doc_No', $id)->where('Doc_Ty',2)->firstOrFail();
        $items = MtsItmmfs::where('Itm_Parnt', '!=', null)->get();
        $units = Units::all();
        $currencies = AstCurncy::all();
        return view('admin.purchases_invoices.edit', compact(['currencies','header', 'items', 'units']));

    }

    public function destroy($id)
    {
        
        $header = InvLodhdr::where('Doc_No', $id)->firstOrFail();
        foreach ($header->details as $detail) {
            $detail->delete();
        }
        $header->update([
            'status' => 0,
            'Tot_Sal' => 0,
            'AfterDiscount' => 0,
            'Tot_Disc' => 0,
            'Taxv_ExtraHdr' => 0,
            'Net' => 0,
            'Tot_ODisc' => 0,
            'Tot_Prct' => 0,
            'Tot_OPrct' => 0,

        ]);

        return redirect()->route('purchasesInvoices.index')->with(session()->flash('message', trans('admin.success_deleted')));




    }
    public function purchasesInvoices_print($id)
    {

        $invoices = InvLoddtl::with('header')->where('Doc_No', $id)->where('Doc_ty',2)->get();


        $config = ['instanceConfigurator' => function($mpdf) {
            $mpdf->SetHTMLFooter('
                    <div dir="ltr" style="text-align: right">{DATE j-m-Y H:m}</div>
                    <div dir="ltr" style="text-align: center">{PAGENO} of {nbpg}</div>'
            );
        }];

        $pdf = PDF::loadView('admin.purchases_invoices.pdf.report', compact('invoices'),[],['format' => 'A5-L'], $config);

        return $pdf->stream();


    }

    public function getPurchaseActivityCustomer(Request $request)
    {
        if ($request->ajax()){
            if ($request->Cmp_No){
                $company = MainCompany::where('Cmp_No', $request->Cmp_No)->first();
                return response()->json([
                    'activity_id' => $company->activity->Actvty_No,
                    'activity_name' => $company->activity->{'Name_'.ucfirst(session('lang'))},
                    'customers' => $company->customers,
                    'branches' => $company->branches,
                ]);
            } elseif($request->Brn_No){
                $stores = PjbranchDlv::where('Brn_No', $request->Brn_No)->get();
                $salesMan = AstSalesman::where('Brn_No', $request->Brn_No)->get();
                return response()->json([
                    'stores' => $stores,
                    'salesMan' => $salesMan,
                ]);
            }
        }

    }

   
    public function returnPurchasesCountOfDays(Request $request)
    {
        if ($request->ajax()){
            if($request->DateEn || $request->daysNo){
                $daysToSec = strtotime($request->DateEn)+($request->daysNo*24*60*60);
                $daysToDate = date('Y-m-d', $daysToSec);
                return response()->json(['date' => $daysToDate]);
            }

        }
    }
     // returnPurchasesExchangeRate
    // public function returnPurchasesExchangeRate(Request $request)
    // {
    //     if ($request->ajax()){
    //         if($request->Curncy_No){
    //             $Curncy_No = $request->Curncy_No;
    //             return response()->json(['Exchange' => $Curncy_No]);
    //         }
    //     }
    // }

    public function createNewPuracheseRow(Request $request)
    {
        if ($request->ajax()){
            $items = MtsItmmfs::where('Itm_Parnt', '!=', null)->get();
            $units = Units::all();
            $row = $request->rowNo;
            return view('admin.purchases_invoices.create_new_row', compact(['items', 'units', 'row']));
        }
    }


    public function returnPurchaseItemInfo(Request $request)
    {
        if ($request->ajax() && $request->Itm_No){
            $item = MtsItmmfs::where('Itm_No', $request->Itm_No)->first();
            if ($item != null){

                $unitNo = $item->units->pluck('Unit_No');
                $units = Units::whereIn('Unit_No', $unitNo)->get();
                return response()->json([
                    'units' => $units,
                    'price' => $item->Itm_Pur,
                    'quantity' => $item->MaxQty_SaL,
                ]);
            }
        }
    }

    public function returnPurchaseUnitPrice(Request $request)
    {
        if ($request->ajax() && ($request->Itm_No && $request->Unit_No)){
            $unit = MtsItmfsunit::where('Itm_No', $request->Itm_No)->where('Unit_No', $request->Unit_No)->first();
            if ($unit != null){
                return response()->json([
                    'price' => $unit->Unit_Pur,
                ]);
            }
        }
    }

    public function deletePurchaseLine(Request $request)
    {
//        return response()->json(['status' => 1]);
        $line = InvLoddtl::where('Ln_No', $request->Ln_No)->first();
        if ($line != null){
            $line->delete();
            $header = InvLodhdr::where('Doc_No', $request->Doc_No)->first();
            if ($header != null){
                $header->update([
                    'Tot_Pur' => $header->Tot_Pur - $request->lineTotal,
                    'status' => count($header->details) == 0 ? 0 : 1
                ]);
            }
            return response()->json(['status' => 1]);
        }
    }
}
