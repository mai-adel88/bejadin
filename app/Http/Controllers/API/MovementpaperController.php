<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Applicant;
use App\applicants_company;
use App\Company;
use App\Branches;
use App\BusinessOwnersInterviews;
use App\receiptsType;
use Storage;
use Up;
use PDF;

class MovementpaperController extends Controller
{
    public function datacontractorreport(request $request){
        $data = $request->all();
        // return($data);
        return route('allcontractordata',$data);
    }
    public function allcontractordata(request $request){
        // $data = $request->all();
        $branch = $request->branche_id;
        $applicant = $request->applicant_id;
        $applicants = Applicant::where('id',$applicant)->with('jobSpec')->first();

        // dd(BusinessOwnersInterviews::where('branche_id',$branch)->where('applicant_id',$applicant)->with('applicantCompany')->first());
        if (BusinessOwnersInterviews::where('branche_id',$branch)->where('applicant_id',$applicant)->first() != null) {
            $businessInterviews = BusinessOwnersInterviews::where('branche_id',$branch)->where('applicant_id',$applicant)->first();
            // return($businessInterviews);
            $status = [];
            if ($businessInterviews->passport && $businessInterviews->certificate && $businessInterviews->ex_certificates && $businessInterviews->fash_and_metaphor && $businessInterviews->representations && $businessInterviews->data_degrees && $businessInterviews->disclaimer && $businessInterviews->driving_license == 1) {
                array_push($status, $businessInterviews['status_paper'] = 'تم');
            }else{
                array_push($status, $businessInterviews['status_paper'] = 'لم يتم');
            }
            if ($businessInterviews->send_attache && $businessInterviews->issued_university && $businessInterviews->university_attache && $businessInterviews->ward_attache == 1) {
                array_push($status, $businessInterviews['status_cultural'] = 'تم');
                // return ;
            }else{
                array_push($status, $businessInterviews['status_cultural'] = 'لم يتم');
            }
            if ($businessInterviews->net && $businessInterviews->fingerprint && $businessInterviews->medical_examination && $businessInterviews->laboratories == 1) {
                array_push($status, $businessInterviews['status_medical'] = 'تم');
                // return ;
            }else{
                array_push($status, $businessInterviews['status_medical'] = 'لم يتم');
            }
            if ($businessInterviews->consulate && $businessInterviews->visa_on_site && $businessInterviews->visa_approved == 1) {
                array_push($status, $businessInterviews['status_visa'] = 'تم');
                // return ;
            }else{
                array_push($status, $businessInterviews['status_visa'] = 'لم يتم');
            }
            if ($businessInterviews->consular_contract && $businessInterviews->man_power == 1) {
                array_push($status, $businessInterviews['status_contract'] = 'تم');
                // return ;
            }else{
                array_push($status, $businessInterviews['status_contract'] = 'لم يتم');
            }
            if ($businessInterviews->delivery_date != null) {
                array_push($status, $businessInterviews['status_passport'] = 'تم');
                // return ;
            }else{
                array_push($status, $businessInterviews['status_passport'] = 'لم يتم');
            }
            if ($businessInterviews->date_travel && $businessInterviews->Port_takeoff && $businessInterviews->takeoff_time && $businessInterviews->date_arrival && $businessInterviews->port_access && $businessInterviews->arrival_time && $businessInterviews->imagetravel != null) {
                array_push($status, $businessInterviews['status_travelone'] = 'تم');
                // return ;
            }else{
                array_push($status, $businessInterviews['status_travelone'] = 'لم يتم');
            }
        } else {
            $businessInterviews = null;
        }

        if (applicants_company::where('applicants_id',$applicant)->first() != null) {
            $applicantCompany = applicants_company::where('applicants_id',$applicant)->first();
        } else {
            $applicantCompany = null;
        }


        // return([$businessInterviews,$applicantCompany,$applicants]);
        $config = ['instanceConfigurator' => function($mpdf) {
            $mpdf->SetHTMLFooter('
                <div style="font-size:10px;width:25%;float:right">Print Date: {DATE j-m-Y H:m}</div>
                <div style="font-size:10px;width:25%;float:left;direction:ltr;text-align:left">Page {PAGENO} of {nbpg}</div>'
            );
        }];
        // return($config);
        $pdf = PDF::loadView('admin.BusinessOwnersInterviews.pdf.ContractorReport', compact('businessInterviews','applicants','applicantCompany'),[],['format' => 'A4'], $config);
        return $pdf->stream();
        // return route('allcontractordata',$data);
    }
    public function databusinesspost(request $request){
        $data = $request->all();
        // dd($data);
        return route('allbusinessdata',$data);
    }
    public function allbusinessdata(request $request){
        $branch = $request->branche_id;
        $kind = $request->kindreport;
        $from = $request->from;
        $to = $request->to;
        // $businessInterviews = BusinessOwnersInterviews::where('branche_id',$branch)->whereBetween('datepaper', [$from, $to]);
        switch ($kind) {
            case 1:
                $businessInterviews = BusinessOwnersInterviews::where('branche_id',$branch)->whereBetween('datepaper', [$from, $to])->orderby('datepaper');
                $kindofbusiness = $businessInterviews->with('applicant')->with('company')->get([
                    'applicant_id','branche_id','company_id','datepaper','move_number','passport','certificate','fash_and_metaphor'
                    ,'representations','data_degrees','ex_certificates','disclaimer','driving_license'
                ]);

                // return($kindofbusiness);
                $status = [];
                $allkindofbusiness = [];
                for ($i=0; $i < count($kindofbusiness); $i++) {
                    if ($kindofbusiness[$i]->passport && $kindofbusiness[$i]->certificate && $kindofbusiness[$i]->ex_certificates && $kindofbusiness[$i]->fash_and_metaphor && $kindofbusiness[$i]->representations && $kindofbusiness[$i]->data_degrees && $kindofbusiness[$i]->disclaimer && $kindofbusiness[$i]->driving_license == 1) {
                        array_push($status, ['status' => 'تم']);
                        $collection = collect($kindofbusiness[$i]);
                        $merged = $collection->merge($status[$i]);
                        array_push($allkindofbusiness, $merged);
                    }else{
                        array_push($status, ['status' => 'لم يتم']);
                        $collection = collect($kindofbusiness[$i]);
                        $merged = $collection->merge($status[$i]);
                        array_push($allkindofbusiness, $merged);
                    }
                }
                // return $allkindofbusiness;
                $config = ['instanceConfigurator' => function($mpdf) {
                    $mpdf->SetHTMLFooter('
                        <div style="font-size:10px;width:25%;float:right">Print Date: {DATE j-m-Y H:m}</div>
                        <div style="font-size:10px;width:25%;float:left;direction:ltr;text-align:left">Page {PAGENO} of {nbpg}</div>'
                    );
                }];
                // return($config);
                $pdf = PDF::loadView('admin.BusinessOwnersInterviews.pdf.PaperReport', compact('allkindofbusiness','from','to'),[],['format' => 'A4'], $config);
                return $pdf->stream();
                // return $allkindofbusiness;
                break;
            case 2:
                $businessInterviews = BusinessOwnersInterviews::where('branche_id',$branch)->whereBetween('datecultural', [$from, $to])->orderby('datecultural');
                $kindofbusiness = $businessInterviews->with('applicant')->with('company')->get([
                    'applicant_id','branche_id','company_id','datecultural','move_number','send_attache','issued_university','university_attache'
                    ,'ward_attache'
                ]);
                $status = [];
                $allkindofbusiness = [];
                for ($i=0; $i < count($kindofbusiness); $i++) {
                    if ($kindofbusiness[$i]->send_attache && $kindofbusiness[$i]->issued_university && $kindofbusiness[$i]->university_attache && $kindofbusiness[$i]->ward_attache == 1) {
                        array_push($status, ['status' => 'تم']);
                        $collection = collect($kindofbusiness[$i]);
                        $merged = $collection->merge($status[$i]);
                        array_push($allkindofbusiness, $merged);
                        // return ;
                    }else{
                        array_push($status, ['status' => 'لم يتم']);
                        $collection = collect($kindofbusiness[$i]);
                        $merged = $collection->merge($status[$i]);
                        array_push($allkindofbusiness, $merged);
                    }
                }
                $config = ['instanceConfigurator' => function($mpdf) {
                    $mpdf->SetHTMLFooter('
                        <div dir="ltr" style="text-align: right">{DATE j-m-Y H:m}</div>
                        <div dir="ltr" style="text-align: center">{PAGENO} of {nbpg}</div>'
                    );
                }];
                // return($config);
                $pdf = PDF::loadView('admin.BusinessOwnersInterviews.pdf.CulturalReport', compact('allkindofbusiness','from','to'),[],['format' => 'A4'],$config);
                return $pdf->stream();
                // return $allkindofbusiness;
                break;
            case 3:
                $businessInterviews = BusinessOwnersInterviews::where('branche_id',$branch)->whereBetween('datemedical', [$from, $to])->orderby('datemedical');
                $kindofbusiness = $businessInterviews->with('applicant')->with('company')->get([
                    'applicant_id','branche_id','company_id','datemedical','move_number','net','fingerprint','medical_examination'
                    ,'laboratories'
                ]);
                $status = [];
                $allkindofbusiness = [];
                for ($i=0; $i < count($kindofbusiness); $i++) {
                    if ($kindofbusiness[$i]->net && $kindofbusiness[$i]->fingerprint && $kindofbusiness[$i]->medical_examination && $kindofbusiness[$i]->laboratories == 1) {
                        array_push($status, ['status' => 'تم']);
                        $collection = collect($kindofbusiness[$i]);
                        $merged = $collection->merge($status[$i]);
                        array_push($allkindofbusiness, $merged);
                        // return ;
                    }else{
                        array_push($status, ['status' => 'لم يتم']);
                        $collection = collect($kindofbusiness[$i]);
                        $merged = $collection->merge($status[$i]);
                        array_push($allkindofbusiness, $merged);
                    }
                }
                $config = ['instanceConfigurator' => function($mpdf) {
                    $mpdf->SetHTMLFooter('
                        <div style="font-size:10px;width:25%;float:right">Print Date: {DATE j-m-Y H:m}</div>
                        <div style="font-size:10px;width:25%;float:left;direction:ltr;text-align:left">Page {PAGENO} of {nbpg}</div>'
                    );
                }];
                // return($config);
                $pdf = PDF::loadView('admin.BusinessOwnersInterviews.pdf.MedicalReport', compact('allkindofbusiness','from','to'),[],['format' => 'A4'], $config);
                return $pdf->stream();
                // return $allkindofbusiness;
                break;
            case 4:
                $businessInterviews = BusinessOwnersInterviews::where('branche_id',$branch)->whereBetween('datevisa', [$from, $to])->orderby('datevisa');
                $kindofbusiness = $businessInterviews->with('applicant')->with('company')->get([
                    'applicant_id','branche_id','company_id','datevisa','move_number','consulate','visa_on_site','visa_approved'
                ]);
                $status = [];
                $allkindofbusiness = [];
                for ($i=0; $i < count($kindofbusiness); $i++) {
                    if ($kindofbusiness[$i]->consulate && $kindofbusiness[$i]->visa_on_site && $kindofbusiness[$i]->visa_approved == 1) {
                        array_push($status, ['status' => 'تم']);
                        $collection = collect($kindofbusiness[$i]);
                        $merged = $collection->merge($status[$i]);
                        array_push($allkindofbusiness, $merged);
                        // return ;
                    }else{
                        array_push($status, ['status' => 'لم يتم']);
                        $collection = collect($kindofbusiness[$i]);
                        $merged = $collection->merge($status[$i]);
                        array_push($allkindofbusiness, $merged);
                    }
                }
                $config = ['instanceConfigurator' => function($mpdf) {
                    $mpdf->SetHTMLFooter('
                        <div style="font-size:10px;width:25%;float:right">Print Date: {DATE j-m-Y H:m}</div>
                        <div style="font-size:10px;width:25%;float:left;direction:ltr;text-align:left">Page {PAGENO} of {nbpg}</div>'
                    );
                }];
                // return($config);
                $pdf = PDF::loadView('admin.BusinessOwnersInterviews.pdf.VisaReport', compact('allkindofbusiness','from','to'),[],['format' => 'A4'], $config);
                return $pdf->stream();
                // return $allkindofbusiness;
                break;
            case 5:
                $businessInterviews = BusinessOwnersInterviews::where('branche_id',$branch)->whereBetween('datecontract', [$from, $to])->orderby('datecontract');
                $kindofbusiness = $businessInterviews->with('applicant')->with('company')->get([
                    'applicant_id','branche_id','company_id','datecontract','move_number','consular_contract','man_power'
                ]);
                $status = [];
                $allkindofbusiness = [];
                for ($i=0; $i < count($kindofbusiness); $i++) {
                    if ($kindofbusiness[$i]->consular_contract && $kindofbusiness[$i]->man_power == 1) {
                        array_push($status, ['status' => 'تم']);
                        $collection = collect($kindofbusiness[$i]);
                        $merged = $collection->merge($status[$i]);
                        array_push($allkindofbusiness, $merged);
                        // return ;
                    }else{
                        array_push($status, ['status' => 'لم يتم']);
                        $collection = collect($kindofbusiness[$i]);
                        $merged = $collection->merge($status[$i]);
                        array_push($allkindofbusiness, $merged);
                    }
                }
                $config = ['instanceConfigurator' => function($mpdf) {
                    $mpdf->SetHTMLFooter('
                        <div style="font-size:10px;width:25%;float:right">Print Date: {DATE j-m-Y H:m}</div>
                        <div style="font-size:10px;width:25%;float:left;direction:ltr;text-align:left">Page {PAGENO} of {nbpg}</div>'
                    );
                }];
                // return($config);
                $pdf = PDF::loadView('admin.BusinessOwnersInterviews.pdf.ContractReport', compact('allkindofbusiness','from','to'),[],['format' => 'A4'], $config);
                return $pdf->stream();
                // return $allkindofbusiness;
                break;
            case 6:
                $businessInterviews = BusinessOwnersInterviews::where('branche_id',$branch)->whereBetween('datepassport', [$from, $to])->orderby('datepassport');
                $kindofbusiness = $businessInterviews->with('applicant')->with('company')->get([
                    'applicant_id','branche_id','company_id','datepassport','move_number','delivery_date'
                ]);
                $status = [];
                $allkindofbusiness = [];
                for ($i=0; $i < count($kindofbusiness); $i++) {
                    if ($kindofbusiness[$i]->delivery_date != null) {
                        array_push($status, ['status' => 'تم']);
                        $collection = collect($kindofbusiness[$i]);
                        $merged = $collection->merge($status[$i]);
                        array_push($allkindofbusiness, $merged);
                        // return ;
                    }else{
                        array_push($status, ['status' => 'لم يتم']);
                        $collection = collect($kindofbusiness[$i]);
                        $merged = $collection->merge($status[$i]);
                        array_push($allkindofbusiness, $merged);
                    }
                }
                $config = ['instanceConfigurator' => function($mpdf) {
                    $mpdf->SetHTMLFooter('
                        <div style="font-size:10px;width:25%;float:right">Print Date: {DATE j-m-Y H:m}</div>
                        <div style="font-size:10px;width:25%;float:left;direction:ltr;text-align:left">Page {PAGENO} of {nbpg}</div>'
                    );
                }];
                // return($config);
                $pdf = PDF::loadView('admin.BusinessOwnersInterviews.pdf.PassportReport', compact('allkindofbusiness','from','to'),[],['format' => 'A4'], $config);
                return $pdf->stream();
                break;
            case 7:
                $businessInterviews = BusinessOwnersInterviews::where('branche_id',$branch)->whereBetween('datetravelone', [$from, $to])->orderby('datetravelone');
                $kindofbusiness = $businessInterviews->with('applicant')->with('company')->get([
                    'applicant_id','branche_id','company_id','datetravelone','move_number','date_travel','Port_takeoff'
                    ,'takeoff_time','date_arrival','port_access','arrival_time','imagetravel'
                ]);
                $status = [];
                $allkindofbusiness = [];
                for ($i=0; $i < count($kindofbusiness); $i++) {
                    if ($kindofbusiness[$i]->date_travel && $kindofbusiness[$i]->Port_takeoff && $kindofbusiness[$i]->takeoff_time && $kindofbusiness[$i]->date_arrival && $kindofbusiness[$i]->port_access && $kindofbusiness[$i]->arrival_time && $kindofbusiness[$i]->imagetravel != null) {
                        array_push($status, ['status' => 'تم']);
                        $collection = collect($kindofbusiness[$i]);
                        $merged = $collection->merge($status[$i]);
                        array_push($allkindofbusiness, $merged);
                        // return ;
                    }else{
                        array_push($status, ['status' => 'لم يتم']);
                        $collection = collect($kindofbusiness[$i]);
                        $merged = $collection->merge($status[$i]);
                        array_push($allkindofbusiness, $merged);
                    }
                }
                $config = ['instanceConfigurator' => function($mpdf) {
                    $mpdf->SetHTMLFooter('
                        <div style="font-size:10px;width:25%;float:right">Print Date: {DATE j-m-Y H:m}</div>
                        <div style="font-size:10px;width:25%;float:left;direction:ltr;text-align:left">Page {PAGENO} of {nbpg}</div>'
                    );
                }];
                // return($config);
                $pdf = PDF::loadView('admin.BusinessOwnersInterviews.pdf.TravelReport', compact('allkindofbusiness','from','to'),[],['format' => 'A4'], $config);
                return $pdf->stream();
                // return $allkindofbusiness;
                break;

            default:
                return 'noun';
                break;
        }
        return($businessInterviews);
        return route('allbusinessdata',$data);
    }
    public function getapplicants(){
        // $applicantcompany = applicants_company::get(['applicants_id']);
        // $applicant = Applicant::whereIn('id',$applicantcompany)->get();
        $applicant =  Applicant::join('applicants_company', 'applicants.id', '=', 'applicants_company.applicants_id')->where('Candidate_case',1)->pluck('applicants.name_ar','applicants.id');
        // dd($applicant);
        return response()->json([$applicant]);
    }
    public function getcompanies($id){
        $applicantcompany = applicants_company::where('applicants_id',$id)->get(['companies_id']);
        // return ($applicantcompany);
        $companies = Company::whereIn('id',$applicantcompany)->get();
        // return $companies;
        return response()->json([$companies]);
    }
    public function getbranches(){
        $branches = Branches::all();
        return response()->json([$branches]);
    }
    public function postdatapaper(request $request){
        // dd($request);
        $data = $this->validate($request,[
            'applicant_id' => 'required',
            'branche_id' => 'required',
            'company_id' => 'required',
            'datepaper' => 'sometimes',
            'move_number' => 'sometimes',
            // 'move_number_paper' => 'sometimes',
            'passport' => 'sometimes',
            'date_passport' => 'sometimes',
            'certificate' => 'sometimes',
            'date_certificate' => 'sometimes',
            'fash_and_metaphor' => 'sometimes',
            'date_fash_and_metaphor' => 'sometimes',
            'representations' => 'sometimes',
            'date_representations' => 'sometimes',
            'data_degrees' => 'sometimes',
            'date_data_degrees' => 'sometimes',
            'ex_certificates' => 'sometimes',
            'date_ex_certificates' => 'sometimes',
            'disclaimer' => 'sometimes',
            'date_disclaimer' => 'sometimes',
            'driving_license' => 'sometimes',
            'date_driving_license' => 'sometimes',
        ]);
        // return($data);
        $applicant = BusinessOwnersInterviews::where('applicant_id', '=', $request->applicant_id)->where('company_id', '=', $request->company_id)->first();
        // dd($applicant);
        if ($applicant) {
            // dd($applicant);
            $applicant->update($data);
        }else {
            // dd($applicant);
            BusinessOwnersInterviews::create($data);
        }
    }
    public function postdatacultural(request $request){
        // dd($request);
        $data = $this->validate($request,[
            'applicant_id' => 'required',
            'branche_id' => 'required',
            'company_id' => 'required',
            'datecultural' => 'sometimes',
            'move_number' => 'sometimes',
            // 'move_number_paper' => 'sometimes',
            'send_attache' => 'sometimes',
            'date_send_attache' => 'sometimes',
            'issued_university' => 'sometimes',
            'date_issued_university' => 'sometimes',
            'university_attache' => 'sometimes',
            'date_university_attache' => 'sometimes',
            'ward_attache' => 'sometimes',
            'date_ward_attache' => 'sometimes',
        ]);
        // return($data);
        $applicant = BusinessOwnersInterviews::where('applicant_id', '=', $request->applicant_id)->where('company_id', '=', $request->company_id)->first();
        // dd($applicant);
        if ($applicant) {
            // dd($applicant);
            $applicant->update($data);
        }else {
            // dd($applicant);
            BusinessOwnersInterviews::create($data);
        }
    }
    public function postdatamedical(request $request){
        // dd($request);
        $data = $this->validate($request,[
            'applicant_id' => 'required',
            'branche_id' => 'required',
            'company_id' => 'required',
            'datemedical' => 'sometimes',
            'move_number' => 'sometimes',
            // 'move_number_medical' => 'sometimes',
            'net' => 'sometimes',
            'date_net' => 'sometimes',
            'fingerprint' => 'sometimes',
            'date_fingerprint' => 'sometimes',
            'medical_examination' => 'sometimes',
            'date_medical_examination' => 'sometimes',
            'laboratories' => 'sometimes',
            'date_laboratories' => 'sometimes',
        ]);
        // return($data);
        $applicant = BusinessOwnersInterviews::where('applicant_id', '=', $request->applicant_id)->where('company_id', '=', $request->company_id)->first();
        // dd($applicant);
        if ($applicant) {
            // dd($applicant);
            $applicant->update($data);
        }else {
            // dd($applicant);
            BusinessOwnersInterviews::create($data);
        }
    }
    public function postdatavisa(request $request){
        // dd($request);
        $data = $this->validate($request,[
            'applicant_id' => 'required',
            'branche_id' => 'required',
            'company_id' => 'required',
            'datevisa' => 'sometimes',
            'move_number' => 'sometimes',
            // 'move_number_visa' => 'sometimes',
            'consulate' => 'sometimes',
            'date_consulate' => 'sometimes',
            'visa_on_site' => 'sometimes',
            'date_visa_on_site' => 'sometimes',
            'visa_approved' => 'sometimes',
            'date_visa_approved' => 'sometimes',
        ]);
        // return($data);
        $applicant = BusinessOwnersInterviews::where('applicant_id', '=', $request->applicant_id)->where('company_id', '=', $request->company_id)->first();
        // dd($applicant);
        if ($applicant) {
            // dd($applicant);
            $applicant->update($data);
        }else {
            // dd($applicant);
            BusinessOwnersInterviews::create($data);
        }
    }
    public function postdatacontract(request $request){
        // dd($request);
        $data = $this->validate($request,[
            'applicant_id' => 'required',
            'branche_id' => 'required',
            'company_id' => 'required',
            'datecontract' => 'sometimes',
            'move_number' => 'sometimes',
            // 'move_number_contract' => 'sometimes',
            'consular_contract' => 'sometimes',
            'date_consular_contract' => 'sometimes',
            'man_power' => 'sometimes',
            'date_man_power' => 'sometimes',
        ]);
        // return($data);
        $applicant = BusinessOwnersInterviews::where('applicant_id', '=', $request->applicant_id)->where('company_id', '=', $request->company_id)->first();
        // dd($applicant);
        if ($applicant) {
            // dd($applicant);
            $applicant->update($data);
        }else {
            // dd($applicant);
            BusinessOwnersInterviews::create($data);
        }
    }
    public function postdatapassport(request $request){
        // dd($request);
        $data = $this->validate($request,[
            'applicant_id' => 'required',
            'branche_id' => 'required',
            'company_id' => 'required',
            'datepassport' => 'sometimes',
            'move_number' => 'sometimes',
            // 'move_number_passport' => 'sometimes',
            // 'contract_value' => 'sometimes',
            // 'value_of_fees' => 'sometimes',
            // 'payee' => 'sometimes',
            'delivery_date' => 'sometimes',
        ]);
        // return($data);
        $applicant = BusinessOwnersInterviews::where('applicant_id', '=', $request->applicant_id)->where('company_id', '=', $request->company_id)->first();
        // dd($applicant);
        if ($applicant) {
            // dd($applicant);
            $applicant->update($data);
        }else {
            // dd($applicant);
            BusinessOwnersInterviews::create($data);
        }
    }
    public function postdatatravelimage($applicant,$company,$image){
        $applicant = BusinessOwnersInterviews::where('applicant_id', '=', $applicant)->where('company_id', '=', $company)->first();
        // $exists = Storage::exists('/businessTravel/'.$applicant->imagetravel);

        $applicant->update([
            'imagetravel' => $applicant->imagetravel
        ]);
        return 'true';

    }
    public function postdatatravelnewimage(request $request,$applicant,$company){
        // return $request->imagetravel;
        // return (request()->file('imagetravel'));
        // if ($request->hasFile('imagetravel')) {
            // $file = request()->file('imagetravel');
            // // return($file);
            // $name = $file->getClientOriginalName();
            // $extension = $file->getClientOriginalExtension();
            // $storagePath = $request->imagetravel->storeAs(public_path('businessTravel'),'image_'.time().'.'.$extension);
            // $storageName = basename($storagePath);
            // $location = base_path('storage/public/'.$applicant->imagetravel);
            // $storagePath  = Storage::disk('public')->getDriver()->getAdapter()->getPathPrefix();
            // $path = Storage::disk('local')->getAdapter()->applyPathPrefix($filename);
            // $path = Storage::disk('businessTravel')->path($applicant->imagetravel);
            // $storagePathfile = $request->imagetravel->storeAs('businessTravel','image_6'.time().'.'.$extension);
            // return request()->file('imagetravel')->store('businessTravel');
            $applicant = BusinessOwnersInterviews::where('applicant_id', '=', $applicant)->where('company_id', '=', $company)->first();

//            if ($applicant->imagetravel != null) {
//                $file_path = public_path().'/storage/businessTravel/'.$applicant->imagetravel;
//
//                unlink($file_path);
//            }
            if ($applicant) {
                // Storage::delete($exists);
                $file = request()->file('imagetravel');
                $name = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $storagePath = $request->imagetravel->storeAs('businessTravel','image_'.time().'.'.$extension);
                $storageName = basename($storagePath);
                $applicant->update([
                    'imagetravel' => $storageName
                ]);
            }else {
                $file = request()->file('imagetravel');
                $name = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $storagePath = $request->imagetravel->storeAs('businessTravel','image_'.time().'.'.$extension);
                $storageName = basename($storagePath);
                BusinessOwnersInterviews::create([
                    'imagetravel' => $storageName
                ]);
            }
        // }
    }
    public function postdatatravel(request $request){
        // return ($request);
        $data = $this->validate($request,[
            'applicant_id' => 'required',
            'branche_id' => 'required',
            'company_id' => 'required',
            'datetravelone' => 'sometimes',
            'move_number' => 'sometimes',
            // 'move_number_travel' => 'sometimes',
            'date_travel' => 'sometimes',
            'Port_takeoff' => 'sometimes',
            'takeoff_time' => 'sometimes',
            'date_arrival' => 'sometimes',
            'port_access' => 'sometimes',
            'arrival_time' => 'sometimes',
            // 'imagetravel' => 'sometimes',
        ]);
        // return($data);
        $applicant = BusinessOwnersInterviews::where('applicant_id', '=', $request->applicant_id)->where('company_id', '=', $request->company_id)->first();
        // dd($applicant);
        if ($applicant) {
            // dd($applicant);
                $applicant->update($data);
                // return $storageName;
            // }
        }else {
            BusinessOwnersInterviews::create($data);
        }
    }
    public function getdatarecoverypaper($branch,$applicant,$company){
        $applicantdata = BusinessOwnersInterviews::where('branche_id',$branch)->where('applicant_id', '=', $applicant)->where('company_id', '=', $company)->get([
            'applicant_id','branche_id','company_id','passport','date_passport','certificate','date_certificate','fash_and_metaphor','date_fash_and_metaphor',
            'representations','date_representations','data_degrees','date_data_degrees','ex_certificates','date_ex_certificates','disclaimer','date_disclaimer',
            'driving_license','date_driving_license','datepaper','move_number'
        ])->first();
        if ($applicantdata) {
            return response()->json([$applicantdata]);
        } else {
            $applicantNumRow = BusinessOwnersInterviews::orderby('move_number','desc')->first()['move_number'];
            $applicantNumRow = $applicantNumRow ? $applicantNumRow + 1 : ($branch * 100000) + 1 ;
            // return $applicantNumRow;
            return response()->json(['',$applicantNumRow]);
        }
    }
    public function getdatarecoverycultural($branch,$applicant,$company){
        $applicantdata = BusinessOwnersInterviews::where('branche_id',$branch)->where('applicant_id', $applicant)->where('company_id', $company)->get([
            'applicant_id','branche_id','company_id','send_attache','date_send_attache','issued_university','date_issued_university','university_attache','date_university_attache',
            'ward_attache','date_ward_attache','datecultural','move_number'
        ])->first();
        if ($applicantdata) {
            return response()->json([$applicantdata]);
        } else {
            $applicantNumRow = BusinessOwnersInterviews::orderby('move_number','desc')->first()['move_number'];
            $applicantNumRow = $applicantNumRow ? $applicantNumRow + 1 : ($branch * 100000) + 1 ;
            // return($applicantNumRow);
            return response()->json(['',$applicantNumRow]);
        }
    }
    public function getdatarecoverymedical($branch,$applicant,$company){
        $applicantdata = BusinessOwnersInterviews::where('branche_id',$branch)->where('applicant_id', '=', $applicant)->where('company_id', '=', $company)->get([
            'applicant_id','branche_id','company_id','net','date_net','fingerprint','date_fingerprint','medical_examination','date_medical_examination',
            'laboratories','date_laboratories','datemedical','move_number'
        ])->first();
        if ($applicantdata) {
            return response()->json([$applicantdata]);
        } else {
            $applicantNumRow = BusinessOwnersInterviews::orderby('move_number','desc')->first()['move_number'];
            $applicantNumRow = $applicantNumRow ? $applicantNumRow + 1 : ($branch * 100000) + 1 ;
            // return $applicantNumRow;
            return response()->json(['',$applicantNumRow]);
        }
    }
    public function getdatarecoveryvisa($branch,$applicant,$company){
        $applicantdata = BusinessOwnersInterviews::where('branche_id',$branch)->where('applicant_id', '=', $applicant)->where('company_id', '=', $company)->get([
            'applicant_id','branche_id','company_id','consulate','date_consulate','visa_on_site','date_visa_on_site','visa_approved','date_visa_approved','datevisa'
            ,'move_number'
        ])->first();
        if ($applicantdata) {
            return response()->json([$applicantdata]);
        } else {
            $applicantNumRow = BusinessOwnersInterviews::orderby('move_number','desc')->first()['move_number'];
            $applicantNumRow = $applicantNumRow ? $applicantNumRow + 1 : ($branch * 100000) + 1 ;
            // return $applicantNumRow;
            return response()->json(['',$applicantNumRow]);
        }
    }
    public function getdatarecoverycontract($branch,$applicant,$company){
        $applicantdata = BusinessOwnersInterviews::where('branche_id',$branch)->where('applicant_id', '=', $applicant)->where('company_id', '=', $company)->get([
            'applicant_id','branche_id','company_id','consular_contract','date_consular_contract','man_power','date_man_power','datecontract','move_number'
        ])->first();
        if ($applicantdata) {
            return response()->json([$applicantdata]);
        } else {
            $applicantNumRow = BusinessOwnersInterviews::orderby('move_number','desc')->first()['move_number'];
            $applicantNumRow = $applicantNumRow ? $applicantNumRow + 1 : ($branch * 100000) + 1 ;
            // return $applicantNumRow;
            return response()->json(['',$applicantNumRow]);
        }
    }
    public function getdatarecoverypassport($branch,$applicant,$company){
        // dd($applicant);
        // $applicantdata = BusinessOwnersInterviews::where('applicant_id', '=', $applicant)->where('company_id', '=', $company)->get([
        //     'applicant_id','branche_id','company_id','contract_value','value_of_fees','payee','delivery_date','datepassport','move_number'
        // ])->first();
        $applicantdata = BusinessOwnersInterviews::where('branche_id',$branch)->where('applicant_id', '=', $applicant)->where('company_id', '=', $company)->get([
            'applicant_id','branche_id','company_id','delivery_date','datepassport','move_number'
        ])->first();
        $applicantCompany = applicants_company::where('applicants_id',$applicant)->where('companies_id',$company)->get(['contract_value','company_fees']);
        $applicantCC = Applicant::where('id',$applicant)->get(['cc_id']);
        $receptCreditor = receiptsType::where('tree_id',232)->where('operation_id',4)->where('cc_id',$applicantCC[0]->cc_id)->get(['creditor']);
        // $countcreditor = array_merge($receptCreditor);
        // return($countcreditor);
        if ($applicantdata) {
            return response()->json([$applicantdata,$applicantCompany,$receptCreditor]);
        } else {
            $applicantNumRow = BusinessOwnersInterviews::orderby('move_number','desc')->first()['move_number'];
            $applicantNumRow = $applicantNumRow ? $applicantNumRow + 1 : ($branch * 100000) + 1 ;
            // return $applicantNumRow;
            return response()->json(['',$applicantNumRow]);
        }
    }
    public function getdatarecoverytravel($branch,$applicant,$company){
        $applicantdata = BusinessOwnersInterviews::where('branche_id',$branch)->where('applicant_id', '=', $applicant)->where('company_id', '=', $company)->get([
            'applicant_id','branche_id','company_id','date_travel','Port_takeoff','takeoff_time','date_arrival','port_access','arrival_time','datetravelone','move_number','imagetravel'
        ])->first();
        if ($applicantdata) {
            return response()->json([$applicantdata]);
        } else {
            $applicantNumRow = BusinessOwnersInterviews::orderby('move_number','desc')->first()['move_number'];
            $applicantNumRow = $applicantNumRow ? $applicantNumRow + 1 : ($branch * 100000) + 1 ;
            // return $applicantNumRow;
            return response()->json(['',$applicantNumRow]);
        }
    }
}
