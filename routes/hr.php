<?php

use Illuminate\Support\Facades\Config;


Route::group(['namespace' => 'Hr', 'prefix'=>'hr'], function (){

    Config::set('auth.defines','hr');

    Route::get('login','HrAuth@login')->name('hrLogin');
    Route::post('hr-login','HrAuth@dologin')->name('hrDoLogin')->middleware('guest');

    Route::get('lang/{lang}',function ($lang){
        session()->has('lang')?session()->forget('lang'):'';
        $lang == 'ar' ? session()->put('lang','ar') : session()->put('lang','en');
        return back();
    });
    Route::group(['middleware' => 'auth:hr'],function (){
        // Dashboard
        Route::get('dashboard','HrDashboardController@home')->name('hr.home');
        Route::any('logout','HrAuth@logout')->name('hrLogout');

        Route::resource('hrs','HrController');
        Route::delete('hrs/{id}','HrController@destroy');

        // permission & role
        Route::resource('HrPermissions','roles\PermissionController');
        Route::resource('HrRoles','roles\RoleController');
        Route::resource('HrPermission_role','roles\permission_roles');

        // settings for control panel

        Route::group(['namespace' => 'settings'], function (){

            Route::resource('mainCompany', 'MainCompanyController');
            Route::resource('nationality', 'NationalityController');
            Route::resource('placeLicence', 'PlaceLicenceController');
            Route::resource('entryDeparturePorts', 'EntryAndDeparturePortsController');
            Route::resource('bankPaymentData', 'BankPaymentDataController');
            Route::resource('houseTypeClass', 'HouseTypeClassController');
            Route::resource('companyLicencePlace', 'CompanyLicencePlaceController');
            Route::resource('companyLicenceType', 'CompanyLicenceTypeController');
            Route::resource('companyLicenceProviders', 'CompanyLicenceProvidersController');
            Route::resource('hrcountries', 'HrCountryController');
            // departments
            Route::resource('hrdepartments', 'HrDepartmentsController');
            Route::get('createdepNo', 'HrDepartmentsController@createdepNo')->name('createdepNo');
            Route::get('editdepNo', 'HrDepartmentsController@editdepNo')->name('editdepNo');
            //الادارات وجهات العمل
            Route::view('/departmentLoc_data', 'hr.pages.department_loaction')->name('departmentLoc.pages');
            Route::resource('departmentLoc', 'HrDprtmntLoctnController');
            Route::post('departmentLoc/initChartDepLoc','HrDprtmntLoctnController@initChartDepLoc')->name('initChartDepLoc');
            Route::post('departmentLoc/getDepartments','HrDprtmntLoctnController@getDepartments')->name('getDepartments');
            Route::post('departmentLoc/createNewDepNo','HrDprtmntLoctnController@createNewDepNo')->name('createNewDepNo');
            Route::post('departmentLoc/getDepLocEditBlade','HrDprtmntLoctnController@getDepLocEditBlade')->name('getDepLocEditBlade');

            // العناوين
            Route::resource('address', 'AddressController');
            Route::get('getemployeeaddressData', 'AddressController@getemployeeaddressData')->name('getemployeeaddressData');

            Route::get('get-employees', 'AddressController@getEmployee')->name('get-employees');
            Route::get('get-employee-data', 'AddressController@getEmployeeData')->name('get-employee-data');

            //المرافقين
            Route::resource('dependents', 'DependentsController');
            Route::get('getemployeess', 'DependentsController@getEmployeess')->name('getEmployeess');
            Route::get('passportNo', 'DependentsController@passportNo')->name('passportNo');

            //الاجازات
            Route::resource('emphlds', 'EmphldController');
            Route::get('getData', 'EmphldController@getData')->name('getData');
            Route::get('getdepartmenthlds', 'EmphldController@getdepartmenthlds')->name('getdepartmenthlds');
            Route::get('getJob', 'EmphldController@getJob')->name('getJob');
            Route::get('getSalaryhlds', 'EmphldController@getSalaryhlds')->name('getSalaryhlds');

            // الرواتب
            Route::view('/salaries_menu', 'hr.pages.salaries_menu')->name('salaries_menu');


        });

        Route::group(['namespace' => 'employees_data'], function (){
            /***hr routes***/
           // employee data
           Route::resource('employeeData', 'EmployeesDataController');
           Route::get('getdepartment', 'EmployeesDataController@getdepartment')->name('getdepartment');
           Route::get('createEmpSubNo', 'EmployeesDataController@createEmpSubNo')->name('createEmpSubNo');
           Route::get('hrhijri', 'EmployeesDataController@convertToDateToHijri')->name('hrhijri');
           Route::resource('pyjobs', 'PyjobsController');
           Route::view('/emp_data', 'hr.pages.emp_data_page')->name('emp_data');
            // attachments المرفقات
            Route::resource('attachments', 'AttachmentsController');
            Route::get('getemployees', 'AttachmentsController@getemployees')->name('getemployees');
            Route::get('getemployeeType', 'AttachmentsController@getemployeeType')->name('getemployeeType');
       });


    });


});
