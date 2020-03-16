<?php

namespace App\Http\Controllers\Hr\settings;
use App\DataTables\Hr\AddressDataTable;

use App\Models\Hr\HrDprtmntLoctn;
use App\Models\Hr\HRMainCmpnam;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AddressController extends Controller
{
    public function index(AddressDataTable $dataTable)
    {
        return $dataTable->render('hr.settings.addresses.index');
    }
    
}
