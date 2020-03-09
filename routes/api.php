<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(['prefix'=>'admin'],function () {
    Route::get('/limitations', 'API\LimitationController@index');
    Route::get('/limitations/{id}/edit', 'API\LimitationController@edit');
    Route::put('/limitations/{id}', 'API\LimitationController@update');
    Route::get('/operations/{id}', 'API\LimitationController@operations');
    Route::get('/limitationnum/{id}', 'API\LimitationController@limitationnum');
    Route::post('/limitations/store', 'API\LimitationController@store');
    Route::get('/getcc/{id?}/{operations?}', 'API\LimitationController@getcc');
    Route::get('/getccname/{id?}', 'API\LimitationController@getccname');


    Route::get('/openingentry', 'API\openingentryController@index');
    Route::post('/openingentry/store', 'API\openingentryController@store');


    Route::get('/receipts', 'API\receiptsController@index');
    Route::get('/receipts/{id}/edit', 'API\receiptsController@edit');
    Route::put('/receipts/{id}', 'API\receiptsController@update');
    Route::get('/receiptnum/{id}', 'API\receiptsController@receiptnum');
    Route::get('/roperations/{id}', 'API\receiptsController@roperations');
    Route::get('/rgetcc/{id?}/{operations?}', 'API\receiptsController@rgetcc');
    Route::get('/rgetccname/{id?}', 'API\receiptsController@rgetccname');
    Route::post('/receipts/store', 'API\receiptsController@store');



// ---------------------

Route::get('companies','Api\progressApiController@companies');
Route::get('applicantsRequests','Api\progressApiController@applicants_requests');
Route::get('applicants','Api\progressApiController@applicants');
Route::get('contacts','Api\progressApiController@contacts');
Route::get('countries','Api\progressApiController@countries');


    Route::get('/limitations', 'API\LimitationController@index');
    Route::get('/limitations/daily', 'API\LimitationController@daily');
    Route::get('/limitations/debt', 'API\LimitationController@debt');
    Route::get('/limitations/cred', 'API\LimitationController@cred');
    Route::get('/limitations/{id}/edit', 'API\LimitationController@edit');
    Route::put('/limitations/{id}', 'API\LimitationController@update');
    Route::get('/operations/{id}', 'API\LimitationController@operations');
    Route::get('/limitationnum/{id}', 'API\LimitationController@limitationnum');
    Route::post('/limitations/store', 'API\LimitationController@store');
    Route::get('/getcc/{id?}/{operations?}', 'API\LimitationController@getcc');
    Route::get('/getccname/{id?}', 'API\LimitationController@getccname');


    Route::get('/openingentry', 'API\openingentryController@index');
    Route::post('/openingentry/store', 'API\openingentryController@store');


    Route::get('/receipts', 'API\receiptsController@index');
    Route::get('/receipts/catch', 'API\receiptsController@catch');
    Route::get('/receipts/caching', 'API\receiptsController@caching');
    Route::get('/receipts/{id}/edit', 'API\receiptsController@edit');
    Route::put('/receipts/{id}', 'API\receiptsController@update');
    Route::get('/receiptnum/{id}', 'API\receiptsController@receiptnum');
    Route::get('/roperations/{id}', 'API\receiptsController@roperations');
    Route::get('/rgetcc/{id?}/{operations?}', 'API\receiptsController@rgetcc');
    Route::get('/rgetccname/{id?}', 'API\receiptsController@rgetccname');
    Route::post('/receipts/store', 'API\receiptsController@store');


    Route::get('getapplicant','Api\searchController@index');
    Route::get('search','Api\searchController@search');
    Route::get('applicantmovement','Api\MovementpaperController@getapplicants');
    Route::get('companiesmovement/{id}','Api\MovementpaperController@getcompanies');
    Route::get('branches','Api\MovementpaperController@getbranches');
    Route::post('datapaperpost','Api\MovementpaperController@postdatapaper');
    Route::post('dataculturalpost','Api\MovementpaperController@postdatacultural');
    Route::post('datamedicalpost','Api\MovementpaperController@postdatamedical');
    Route::post('datavisapost','Api\MovementpaperController@postdatavisa');
    Route::post('datacontractpost','Api\MovementpaperController@postdatacontract');
    Route::post('datapassportpost','Api\MovementpaperController@postdatapassport');
    Route::post('datatravelpost','Api\MovementpaperController@postdatatravel');
    Route::post('datatravelpostimage/{applicant}/{company}/{image}','Api\MovementpaperController@postdatatravelimage');
    Route::post('datatravelpostnewimage/{applicant}/{company}','Api\MovementpaperController@postdatatravelnewimage');
    Route::get('datarecoverypaper/{branch}/{applicant}/{company}','Api\MovementpaperController@getdatarecoverypaper');
    Route::get('datarecoverycultural/{branch}/{applicant}/{company}','Api\MovementpaperController@getdatarecoverycultural');
    Route::get('datarecoverymedical/{branch}/{applicant}/{company}','Api\MovementpaperController@getdatarecoverymedical');
    Route::get('datarecoveryvisa/{branch}/{applicant}/{company}','Api\MovementpaperController@getdatarecoveryvisa');
    Route::get('datarecoverycontract/{branch}/{applicant}/{company}','Api\MovementpaperController@getdatarecoverycontract');
    Route::get('datarecoverypassport/{branch}/{applicant}/{company}','Api\MovementpaperController@getdatarecoverypassport');
    Route::get('datarecoverytravel/{branch}/{applicant}/{company}','Api\MovementpaperController@getdatarecoverytravel');

    Route::post('MoveContractFees','Api\MoveContractFeesController@MoveContractFees');
    Route::post('databusinesspost','Api\MovementpaperController@databusinesspost');
    Route::post('datacontractorreport','Api\MovementpaperController@datacontractorreport');
});
