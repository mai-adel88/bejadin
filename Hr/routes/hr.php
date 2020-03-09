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

        });
    });


});
