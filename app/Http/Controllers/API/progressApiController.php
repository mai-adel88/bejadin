<?php

namespace App\Http\Controllers\Api;

use App\applicants_company;
use App\applicants_requests;
use App\Company;
use App\CompanyContact;
use App\country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class progressApiController extends Controller
{
    public function __construct(){
        $this->middleware('auth:api');
    }
    public function companies(){
        $companies = Company::where('status',2)->get();
        return response()->json($companies);
    }
    public function applicants_requests(){
        $applicantsRequests = applicants_requests::with('job','jobSpec')->where('status',1)->get();
        return response()->json($applicantsRequests);
    }
    public function applicants(){
        $applicants_company = applicants_company::with('applicants','companies')->where('status',1)->get();
        return response()->json($applicants_company);
    }
    public function contacts(){
        $contacts = CompanyContact::all();
        return response()->json($contacts);
    }
    public function countries(){
        $countries = country::all();
        return response()->json($countries);
    }
}
