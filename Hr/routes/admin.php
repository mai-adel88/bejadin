<?php
use Illuminate\Support\Facades\Config;

Route::get('/gate','LoginGateController@index')->name('gate');

Route::group(['prefix'=>'admin'],function (){

    Config::set('auth.defines','admin');

//    login
    Route::get('/','Admin\AdminAuth@login')->name('login');
    Route::post('adminlogin','Admin\AdminAuth@dologin');
    Route::get('forgetPassword','Admin\AdminAuth@forgetPassword');
    Route::post('forgetPassword','Admin\AdminAuth@forgetPasswordPost');
    Route::get('reset/password/{token}','Admin\AdminAuth@reset_password');
    Route::post('reset/password/{token}','Admin\AdminAuth@reset_password_post');




    Route::get('lang/{lang}',function ($lang){
        session()->has('lang')?session()->forget('lang'):'';
        $lang == 'ar' ? session()->put('lang','ar') : session()->put('lang','en');
        return back();
    });
//    admin panal
    Route::group(['middleware'=>'auth:admin'],function (){
//        laguage
//        dashboard
        Route::get('/dashboard','DashboardController@home')->name('admin.home');
        Route::post('/sendmail','DashboardController@sendmail')->name('admin.sendmail');
        Route::any('logout','Admin\AdminAuth@a_logout');

//        admins
        Route::resource('admins','Admin\AdminController');
        Route::delete('admins/{id}','Admin\AdminController@destroy');


//        permission & role
        Route::resource('permissions','Admin\roles\PermissionController');
        Route::resource('roles','Admin\roles\RoleController');
        Route::resource('admins/permission_role','Admin\roles\permission_roles');

//        setting
        Route::get('setting','SettingController@index')->name('setting');
        Route::post('setting','SettingController@setting_save')->name('setting.save');

        Route::resource('setting/slider', 'Admin\setting\SliderController');
        Route::resource('setting/about', 'Admin\setting\AboutController');
        Route::resource('setting/service', 'Admin\setting\ServiceController');
        Route::resource('setting/message', 'Admin\setting\MessageController');
        Route::resource('setting/feature', 'Admin\setting\FeatureController');
        Route::resource('setting/NewsDetails', 'Admin\setting\NewsDetailsController');
        Route::resource('setting/director', 'Admin\setting\DirectorController');

        Route::resource('setting/comments', 'Admin\setting\CommentController');

        Route::post('setting/comments/approve', 'Admin\setting\CommentController@approve')->name('approve');
        Route::post('comments/reply', 'Admin\setting\CommentController@reply')->name('reply');

//        Route::POST('setting/adcomment/ChangeComment/{id}', 'Admin\setting\CommentController@ChangeComment')->name('ChangeComment');
        Route::resource('setting/image_gellery', 'Admin\setting\ImageGelleryController');
//        files upload

//        Contact us

        Route::resource('contact-us', 'Admin\contact\contactUsController');

//        Newsletter controller

        Route::resource('newsletter', 'Admin\newsletter\NewsletterController');



//        country && city
        Route::resource('countries','Admin\Country\CountryController');
        Route::resource('cities','Admin\City\CitiesController');
        Route::resource('state','Admin\State\StateController');

//        departments
        Route::resource('departments','Admin\Department\DepartmentsController');
        Route::get('departments/department/print','Admin\Department\DepartmentsController@print');
        Route::get('departments/reports/report','Admin\Department\DepartmentsController@reports')->name('departments.reports');
        Route::get('departments/reports/details','Admin\Department\DepartmentsController@details')->name('departments.details');
        Route::post('departments/reports/pdf','Admin\Department\DepartmentsController@pdf');
//        cc
        Route::resource('cc','Admin\Cc\CcController');
        Route::get('cc/report/motioncc','Admin\Cc\ReportController@motioncc');
        Route::get('cc/report/motioncc/show','Admin\Cc\ReportController@show');
        Route::get('cc/report/motioncc/details','Admin\Cc\ReportController@details');
        Route::post('cc/reports/pdf','Admin\Cc\ReportController@pdf');
        Route::get('cc/report/checkReports','Admin\Cc\ReportController@checkReports');
        Route::get('cc/report/checkReports/show','Admin\Cc\ReportController@checkShow');
        Route::get('cc/report/checkReports/details','Admin\Cc\ReportController@checkDetails');
        Route::post('cc/report/checkReports/pdf','Admin\Cc\ReportController@print');


//        classes
        Route::resource('grades','Admin\classes\gradesController');
        Route::get('active-grad','Admin\classes\gradesController@activeGrad')->name('activeGrad');
        Route::get('active-class','Admin\classes\classController@activeClass')->name('activeClass');
        Route::get('active-room','Admin\classes\classroomController@activeRoom')->name('activeRoom');
        Route::resource('class','Admin\classes\classController');
        Route::get('getClass', 'Admin\classes\classController@getClass')->name('getClass');
        Route::resource('classroom','Admin\classes\classroomController');
        Route::get('fees','Admin\classes\feesController@index');
        Route::post('getStdFees','Admin\classes\feesController@getStdFees');
        Route::post('getStdFeesForShow','Admin\classes\feesController@getStdFeesForShow');
        Route::post('getStdFeesForDisc','Admin\classes\feesController@getStdFeesForDisc');
        Route::get('getDisc','Admin\classes\feesController@getDisc')->name('getDisc');
        Route::post('setDisc','Admin\classes\feesController@setDisc')->name('setDisc');
        Route::post('setBroDisc','Admin\classes\feesController@setBroDisc')->name('setBroDisc');
        Route::post('getStdGrad','Admin\classes\feesController@getStdGrad');
        Route::post('getStdRooms','Admin\classes\feesController@getStdClassRoom');
        Route::post('manual_disc', 'Admin\classes\feesController@manual_disc');

        Route::resource('discount','Admin\classes\discountController');


//        users
        Route::resource('users','Admin\UserController');


//        subcriber
        Route::resource('students','Admin\student\StudentController');
        Route::get('waiting', 'Admin\student\StudentController@getWaitingList')->name('studentWaitingList');
        Route::get('print/student/{Cstm_No}','Admin\student\StudentController@print');
        Route::get('student-class-list', 'Admin\student\StudentController@studentClassList')->name('studentClassList');
        Route::get('hijri', 'Admin\student\StudentController@convertToDateToHijri')->name('hijri');
        Route::get('getStds', 'Admin\student\StudentController@getStds')->name('getStds');

        //Norhan
        Route::get('sub_student','Admin\student\subbusController@getBro')->name('getBro');
        Route::get('sub-student-parent','Admin\student\subbusController@getParentInfo')->name('getParentInfo');
        Route::get('show_bro','Admin\student\subbusController@showBro')->name('showBro');
        Route::delete('remove_subparents','Admin\student\subbusController@remove_subparents')->name('remove_subparents');

        Route::get('subbus','Admin\student\subbusController@index');
        Route::post('sub_student','Admin\student\subbusController@substudent');
        Route::post('sub_parents','Admin\student\subbusController@subparents');

        Route::get('phase','Admin\student\subbusController@phase');
        Route::get('classesphase','Admin\student\subbusController@classesphase');
        Route::resource('relatedness','Admin\RelatednessController');
//        Premium reports
        //Route::get('premium','Admin\report\PremiumController@index')->name('premium');

//        attendance
        Route::resource('attendance','Admin\Attendance\AttendanceController');

        Route::resource('transfer_to','Admin\studentMovement\TransferToController');

        Route::resource('exclude','Admin\studentMovement\ExcludeController');

        Route::resource('accept','Admin\studentMovement\AcceptController');
        Route::get('acceptStudent/{id}','Admin\studentMovement\AcceptController@acceptStudent')->name('acceptStudent');


//خدنات الطلاب المقيدين
        Route::resource('student_services','Admin\StudentServices\StudentServicesController');
        Route::get('std-data-service','Admin\StudentServices\StudentServicesController@getStdData')->name('stdDataService');

        // شؤون الطلاب

        Route::resource('discnoti', 'Admin\concern\DiscountNotiController');
        Route::get('getStdData','Admin\concern\DiscountNotiController@getStdData')->name('getStdData');
        Route::get('createTrNo', 'Admin\concern\DiscountNotiController@createTrNo')->name('createTrNo');
        Route::get('getMainDisc', 'Admin\concern\DiscountNotiController@getMainDisc')->name('getMainDisc');

//      student report

        Route::get('registeredstudents', 'Admin\studentReport\RegisteredStudentController@index');
        Route::get('registeredstudents/show', 'Admin\studentReport\RegisteredStudentController@show');
        Route::get('registeredstudents/details', 'Admin\studentReport\RegisteredStudentController@details');
        Route::post('registeredstudents/pdf', 'Admin\studentReport\RegisteredStudentController@pdf');

        Route::resource('acceptreport','Admin\studentReport\AcceptPaperController');
        Route::post('acceptreport/pdf/{id}','Admin\studentReport\AcceptPaperController@pdf');

        Route::get('excludereport','Admin\studentReport\ExcludePaperController@index');
        Route::get('excludereport/show','Admin\studentReport\ExcludePaperController@show');
        Route::get('excludereport/details','Admin\studentReport\ExcludePaperController@details');
        Route::post('excludereport/pdf/{id}','Admin\studentReport\ExcludepaperController@pdf');



//        drivers
        Route::resource('drivers','Admin\drivers\DriverController');


//        supplier
        Route::resource('suppliers','Admin\supplier\SupplierController');


//        bus
        Route::resource('bustype','Admin\bus\CartypeController');
        Route::resource('busstyle','Admin\bus\CarstyleController');
        Route::resource('bus','Admin\bus\BusController');
        Route::get('bus-sub-record','Admin\bus\BusController@bus_sub_record')->name('bus_sub_record');
        Route::get('show-student-info','Admin\bus\BusController@show_student_info')->name('show_student_info');
        Route::get('ownersbus','Admin\bus\busownerController@create')->name('ownerbus.create');
        Route::get('suppliersbus','Admin\bus\busownerController@suppliers');
        Route::post('upload/image/{id}','Admin\bus\BusController@upload_image')->name('upload.image');
        Route::post('delete/image','Admin\bus\BusController@delete_image')->name('upload.delete');


//        insurance
        Route::resource('insurances','Admin\insurance\InsuranceController');


//        owner bus
        Route::resource('ownerbus','Admin\ownercar\OwnerbusController');


//        Schedule
        Route::resource('schedule','Admin\schedule\ScheduleController');
        Route::resource('busschedule','Admin\schedule\BusscheduleController');


//        book
        Route::resource('subbook','Admin\book\SubbookController');
        Route::resource('substudent','Admin\book\substudentcontroller');
        Route::post('subbook/storehome','Admin\book\SubbookController@storehome')->name('subbook.storehome');
//        Route::resource('cancelledbus','Admin\book\CancelledbusController');
        Route::get('subscriber/show','Admin\subscriber\SubStatusController@show');
        Route::get('subscriber/selectdate','Admin\subscriber\SubStatusController@selectdate');
        Route::delete('subbook/delete/{id}/{select}','Admin\book\SubbookController@delete')->name('subbook.delete');

//        report
        Route::resource('reportdriver','Admin\report\ReportDriverController');
        Route::get('reportpdf/pdf/{id}',[ 'as' => 'report.pdf', 'uses' =>'Admin\report\ReportDriverController@pdf']);

        Route::get('report/Register/std','Admin\report\RegisterStudentController@index');
        Route::get('registerreport/select','Admin\report\RegisterStudentController@select');
        Route::post('registerreport/pdf','Admin\report\RegisterStudentController@pdf');

        Route::get('report/wait/std','Admin\report\WaitingReportController@index');
        Route::get('waitingreport/select','Admin\report\WaitingReportController@select');
        Route::post('waitingreport/pdf','Admin\report\WaitingReportController@pdf');

        Route::get('subscriber-bus','Admin\report\SubscriberBusController@index');
        Route::get('subscriber-bus/select','Admin\report\SubscriberBusController@select');
        Route::post('subscriber-bus/pdf','Admin\report\SubscriberBusController@pdf');

        Route::get('report/list/std','Admin\report\StudentReportController@index');
        Route::get('studentreport/select','Admin\report\StudentReportController@select');
        Route::post('studentreport/pdf','Admin\report\StudentReportController@pdf');


        Route::get('print/id/std','Admin\report\IdPrintController@index');
        Route::get('printid/select','Admin\report\IdPrintController@select');
        Route::post('printid/pdf','Admin\report\IdPrintController@pdf');

        Route::get('student-attendance','Admin\report\StudentAttendanceReportController@index');
        Route::get('student-attendance/select','Admin\report\StudentAttendanceReportController@select');
        Route::post('student-attendance/pdf','Admin\report\StudentAttendanceReportController@pdf');

        Route::get('fees-detailed-report','Admin\report\FeeDetailedReportController@index');
        Route::get('fees-detailed-report/select','Admin\report\FeeDetailedReportController@select');
        Route::post('fees-detailed-report/pdf','Admin\report\FeeDetailedReportController@pdf');

        Route::get('nationality-report','Admin\report\NationalityReportController@index');
        Route::get('nationality-report/select','Admin\report\NationalityReportController@select');
        Route::get('nationality-report/getStudent','Admin\report\NationalityReportController@getStudent');
        Route::post('nationality-report/pdf','Admin\report\NationalityReportController@pdf');


        Route::get('Collection/fees','Admin\report\CollectionOfFeesController@index');
        Route::get('Collection/fees/select','Admin\report\CollectionOfFeesController@select');
        Route::post('Collection/fees/pdf','Admin\report\CollectionOfFeesController@pdf');



//        blog
        Route::resource('blog','Admin\blog\BlogController');

//        branches
        Route::resource('branches','Admin\Branches\BranchesController');

//        distribution
        Route::resource('distribution/disbus','Admin\distribution\DisBus');
        Route::resource('distribution/disdriver','Admin\distribution\DisDriver');


//        funds and banks
        Route::get('banks/Receipt/create','Admin\banks\ReceiptController@create')->name('receipt.create');
        Route::get('banks/Receipt/show','Admin\banks\ReceiptController@show')->name('receipt.show');
        Route::get('banks/Receipt/detailsSelect','Admin\banks\ReceiptController@detailsSelect')->name('receipt.detailsSelect');
        Route::get('banks/Receipt/cc','Admin\banks\ReceiptController@cc')->name('receipt.cc');
        Route::get('banks/Receipt/invoice','Admin\banks\ReceiptController@index')->name('receipts.invoice');
        Route::get('receiptsData/create','Admin\banks\ReceiptController@receiptsData')->name('receiptsData.create');
//        Route::delete('receiptsData/{id}','Admin\banks\ReceiptController@receiptsDataDelete')->name('receiptsData.destroy');
        Route::get('banks/Receipt/invoice/invoice','Admin\banks\ReceiptController@invoice');
        Route::get('banks/Receipt/receipts/{id}/edit','Admin\banks\ReceiptController@edit');
        Route::put('banks/Receipt/receipts/{id}','Admin\banks\ReceiptController@update')->name('receipts.update');
//        edit by Ibrahim El Monier
        Route::post('banks/Receipt/receipts/pdf/{id}','Admin\banks\ReceiptController@pdf');
//        end edit by Ibrahim El Monier
        Route::post('banks/Receipt/receipts/print/{id}','Admin\banks\ReceiptController@print');
        Route::get('banks/Receipt/receipts/print/{id}','Admin\banks\ReceiptController@print')->name('receipts.print');
        Route::get('banks/Receipt/receipts','Admin\banks\ReceiptController@receipts')->name('receipts');
        Route::post('receiptsData/editdatatable','Admin\banks\ReceiptController@editdatatable');
        Route::post('receiptsData/select','Admin\banks\ReceiptController@select');
        Route::get('banks/Receipt/receipts/{id}','Admin\banks\ReceiptController@receiptsShow')->name('receiptsShow');
        Route::delete('banks/Receipt/invoice/{id}','Admin\banks\ReceiptController@destroy')->name('receipts.destroy');
        Route::post('banks/Receipt','Admin\banks\ReceiptController@store')->name('receipt.store');
        Route::post('receiptsData/delete','Admin\banks\ReceiptController@delete');
        Route::post('receiptsData/singledelete','Admin\banks\ReceiptController@singledelete');

//        limitations
        Route::resource('limitations','Admin\limitations\LimitationsController');
        Route::get('limitations/show/{id}','Admin\limitations\limitationsData@show')->name('limitations.show');
        Route::post('limitationsData/create','Admin\limitations\limitationsData@create');
        Route::post('limitationsData/editdatatable','Admin\limitations\limitationsData@editdatatable');
        Route::post('limitationsData','Admin\limitations\limitationsData@store')->name('limitations.store');
        Route::get('limitationsData/invoice','Admin\limitations\limitationsData@index')->name('limitations.invoice');
        Route::get('limitationsData/invoice/invoice','Admin\limitations\limitationsData@invoice');
        Route::post('limitationsData/invoice/print/{id}','Admin\limitations\limitationsData@print');
        Route::get('limitationsData/invoice/print/{id}','Admin\limitations\limitationsData@print')->name('limitation.print');
        Route::post('limitationsData/invoice/pdf/{id}','Admin\limitations\limitationsData@pdf');
        Route::post('limitationsData/select','Admin\limitations\limitationsData@select');
        Route::post('limitationsData/delete','Admin\limitations\limitationsData@destroy');
        Route::post('limitationsData/softdelete','Admin\limitations\limitationsData@softdelete');

//        openingentry
        Route::resource('openingentry','Admin\limitations\OpeningEntryController');
        Route::post('openingentrydata','Admin\limitations\OpeningEntryData@store')->name('openingentrydata.store');
        Route::post('openingentrydata/create','Admin\limitations\OpeningEntryData@create');
        Route::post('openingentrydata/select','Admin\limitations\OpeningEntryData@select');
        Route::get('openingentrydata/invoice','Admin\limitations\OpeningEntryData@index')->name('openingentrydata.invoice');
        Route::get('openingentrydata/show/{id}','Admin\limitations\OpeningEntryData@show')->name('openingentrydata.show');
        Route::post('openingentrydata/invoice/print/{id}','Admin\limitations\OpeningEntryData@print');
        Route::get('openingentrydata/invoice/print/{id}','Admin\limitations\OpeningEntryData@print')->name('openingentry.print');
        Route::post('openingentrydata/invoice/pdf/{id}','Admin\limitations\OpeningEntryData@pdf');
        Route::get('openingentrydata/invoice/invoice','Admin\limitations\OpeningEntryData@invoice');


//        accountingReports
//        dailyReport
        Route::get('dailyReport','Admin\accountingReports\dailyReportController@index');
        Route::get('dailyReport/show','Admin\accountingReports\dailyReportController@show');
        Route::get('dailyReport/details','Admin\accountingReports\dailyReportController@details');
        Route::post('dailyReport/pdf','Admin\accountingReports\dailyReportController@pdf');



//        accountStatement
        Route::get('accountStatement','Admin\accountingReports\accountStatementController@index');
        Route::get('accountStatement/show','Admin\accountingReports\accountStatementController@show');
        Route::get('accountStatement/details','Admin\accountingReports\accountStatementController@details');
        Route::Post('accountStatement/pdf','Admin\accountingReports\accountStatementController@pdf');
//        trialBalanceController
        Route::get('trialbalance','Admin\accountingReports\trialBalanceController@index');
        Route::get('trialbalance/show','Admin\accountingReports\trialBalanceController@show');
        Route::get('trialbalance/details','Admin\accountingReports\trialBalanceController@details');
        Route::post('trialbalance/pdf','Admin\accountingReports\trialBalanceController@pdf');


        // Excel routes

        Route::get('export', 'Admin\student\StudentExportImportExcel@index')->name('index');
        Route::post('import', 'Admin\student\StudentExportImportExcel@import')->name('import');
//        Route::get('export/{type}', 'Admin\student\StudentExportImportExcel@export')->name('export');



    });

});
