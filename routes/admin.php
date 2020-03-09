<?php
Route::get('/', 'web\PageController@getIndex')->name('home.index');

Route::group(['prefix'=>'admin'],function (){
    Config::set('auth.defines','admin');

//    login
    Route::get('/','Admin\AdminAuth@login')->name('admin.login');
    Route::post('adminlogin','Admin\AdminAuth@dologin');
    Route::get('forgetPassword','Admin\AdminAuth@forgetPassword');
    Route::post('forgetPassword','Admin\AdminAuth@forgetPasswordPost');
    Route::get('reset/password/{token}','Admin\AdminAuth@reset_password');
    Route::post('reset/password/{token}','Admin\AdminAuth@reset_password_post');
    Route::post('getCompanies','Admin\AdminAuth@getCompanies')->name('getCompanies');




    Route::get('lang/{lang}',function ($lang){
        session()->has('lang')?session()->forget('lang'):'';
        $lang == 'ar' ? session()->put('lang','ar') : session()->put('lang','en');
        return back();
    });
//    admin panal
    Route::group(['middleware'=>'auth:admin'], function(){
//        laguage
//        dashboard
        Route::get('/dashboard','DashboardController@home')->name('admin.home');
        Route::post('/sendmail','DashboardController@sendmail')->name('admin.sendmail');
        Route::any('logout','Admin\AdminAuth@a_logout');

//        admins
        Route::resource('admins','Admin\AdminController');
        Route::get('admin_setting','Admin\AdminController@admin_setting');
        Route::delete('admins/{id}','Admin\AdminController@destroy');


//        permission & role
        Route::resource('permissions','Admin\roles\PermissionController');
        Route::resource('roles','Admin\roles\RoleController');
        Route::resource('admins/permission_role','Admin\roles\permission_roles');

//        setting
        Route::get('setting','SettingController@index')->name('setting');
        Route::post('setting','SettingController@setting_save')->name('setting.save');
        Route::resource('companies', 'Admin\Companies\CompaniesController');


//        activities
        Route::resource('activities','Admin\activities\ActivitiesController');

//        expulsion
        Route::resource('expulsion','Admin\expulsion\expulsionController');
        Route::resource('expulsioncc','Admin\expulsion\expulsionccController');





//        country && city
//        Route::get('countries_setting', function () {
//            return view('admin.Dashboard_setting.countries_setting');
//        });
        Route::resource('countries','Admin\Country\CountryController');
        Route::resource('cities','Admin\City\CitiesController');
        Route::resource('state','Admin\State\StateController');

//        departments
        Route::resource('departments','Admin\Department\DepartmentsController');
        Route::get('department_setting','Admin\Department\DepartmentsController@department_setting');

        Route::get('departments/department/goTree','Admin\Department\DepartmentsController@goTree')->name('goTree');
        Route::post('departments/department/print','Admin\Department\DepartmentsController@print')->name('printTree');

        Route::get('departments/department/tree','Admin\Department\DepartmentsController@tree');
        Route::get('departments/department/print','Admin\Department\DepartmentsController@print');

        Route::get('departments/reports/report','Admin\Department\DepartmentsController@reports')->name('departments.reports');
        Route::get('departments/reports/details','Admin\Department\DepartmentsController@details')->name('departments.details');
        Route::get('departments/report/print','Admin\Department\DepartmentsController@DepReportPrint')->name('Dep_report_print');
        Route::post('departments/report/pdf','Admin\Department\DepartmentsController@DepReportpdf')->name('Dep_report_pdf');

        Route::get('get/department/show','Admin\Department\DepartmentsController@dep_report_select')->name('depReportSelect');
        Route::post('departments/reports/pdf','Admin\Department\DepartmentsController@pdf');
        Route::post('departments/getEditBlade','Admin\Department\DepartmentsController@getEditBlade')->name('getEditBlade');
        Route::post('departments/createNewAcc','Admin\Department\DepartmentsController@createNewAcc')->name('createNewAcc');
        Route::post('departments/getTree','Admin\Department\DepartmentsController@getTree')->name('getTree');
        Route::post('departments/initChartAcc','Admin\Department\DepartmentsController@initChartAcc')->name('initChartAcc');
        Route::post('departments/getParentName','Admin\Department\DepartmentsController@getParentName')->name('getParentName');


        Route::get('departments/department/Review','Admin\Department\DepartmentsController@Review');
        Route::get('departments/department/reviewdepartment','Admin\Department\DepartmentsController@reviewdepartment')->name('reviewdepartment');

//        cc

        Route::resource('cc','Admin\Cc\CcController');
        //Route::get('cc/department/print','Admin\Cc\CcController@print');
        Route::get('cc/reports/report','Admin\Cc\CcController@reports')->name('cc.reports');
        Route::get('cc/reports/getTreeCC','Admin\Cc\CcController@getTree')->name('goTreeCC');
        Route::post('cc/reports/print','Admin\Cc\CcController@print')->name('printTreeCC');
        Route::get('cc/reports/printCC','Admin\Cc\CcController@CcReportPrint')->name('cc_report_print');
        Route::post('cc/report/pdf','Admin\Cc\CcController@CcReportpdf')->name('cc_report_pdf');
       // Route::post('cc/reports/pdf','Admin\Cc\CcController@pdf');


        Route::get('cc/reports/show','Admin\Cc\CcController@cc_report_select')->name('ccReportSelect');

        Route::get('cc/reports/details','Admin\Cc\CcController@details')->name('cc.details');
        Route::post('cc/getEditBlade','Admin\Cc\CcController@getEditBlade')->name('getCcEditBlade');
        Route::post('cc/getCc','Admin\Cc\CcController@getCc')->name('getCc');

        Route::post('cc/createNewAcc','Admin\Cc\CcController@createNewAcc')->name('createCcNewAcc');
        Route::post('cc/initChartAcc','Admin\Cc\CcController@initChartAcc')->name('initCcChartAcc');


        Route::get('cc/department/Review','Admin\Cc\CcController@Review');
        Route::get('cc/department/reviewdepartment','Admin\Cc\CcController@reviewdepartment')->name('reviewdeCcpartment');
        Route::get('cc/report/checkReports','Admin\Cc\ReportController@checkReports');
        Route::get('cc/report/checkReports/show','Admin\Cc\ReportController@checkShow');
        Route::get('cc/report/checkReports/details','Admin\Cc\ReportController@checkDetails');
        Route::post('cc/report/checkReports/pdf','Admin\Cc\ReportController@print');

        Route::get('cc/report/motioncc','Admin\Cc\ReportController@motioncc');
        Route::get('cc/report/motioncc/show','Admin\Cc\ReportController@show');
        Route::get('cc/report/motioncc/details','Admin\Cc\ReportController@details');

        Route::get('cc/report/ccpublicbalance','Admin\Cc\ReportController@CCpublicbalance');
        Route::get('cc/report/ccpublicbalance/level','Admin\Cc\ReportController@CCpublicbalancelevel');
        Route::get('cc/report/ccpublicbalance/print','Admin\Cc\ReportController@CCpublicbalanceprint');
        Route::POST('cc/report/ccpublicbalance/pdf','Admin\Cc\ReportController@CCpublicbalancepdf');

        Route::post('cc/reports/pdf','Admin\Cc\ReportController@pdf');


        Route::resource('projects','Admin\Project\ProjectController1');

        Route::get('projects_section','Admin\Project\ProjectController1@projects_section')->name('projects.projects_section');

        Route::get('projects/department/print','Admin\Project\ProjectController1@print');
        Route::get('projects/reports/report','Admin\Project\ProjectController1@reports')->name('projects.reports');
        Route::get('projects/reports/details','Admin\Project\ProjectController1@details')->name('projects.details');
        Route::post('projects/reports/pdf','Admin\Project\ProjectController1@pdf');
        Route::post('projects/getTreePrj','Admin\Project\ProjectController1@getTree')->name('getTreePrj');
        Route::post('projects/getproj','Admin\Project\ProjectController1@getproj')->name('getproj');
        Route::post('projects/getEditBladePrj','Admin\Project\ProjectController1@getEditBlade')->name('getEditBladePrj');
        Route::post('projects/createNewAccPrj','Admin\Project\ProjectController1@createNewPrj')->name('createNewAccPrj');
        Route::post('projects/initChartAccPrj','Admin\Project\ProjectController1@initChartPrj')->name('initChartAccPrj');

        Route::get('getCity','Admin\Project\ProjectController1@getCities')->name('getCity');


        Route::get('projects/department/Review','Admin\Project\ProjectController1@Review');
        Route::get('projects/department/reviewdepartment','Admin\Project\ProjectController1@reviewdepartment')->name('reviewdepartment');




//        users
        Route::resource('users','Admin\UserController');


//        subcriber
        Route::resource('subscribers','Admin\subscriber\SubscribeController');
        Route::get('customer_report','Admin\subscriber\SubscribeController@customer_report')->name('customer_report');
        Route::get('get_mainbranches','Admin\subscriber\SubscribeController@get_mainbranches')->name('get_mainbranches');
        Route::get('cust_report_select','Admin\subscriber\SubscribeController@cust_report_select')->name('cust_report_select');
        Route::get('cust_report_print','Admin\subscriber\SubscribeController@cust_report_print')->name('cust_report_print');
        Route::post('cust_report_pdf','Admin\subscriber\SubscribeController@cust_report_pdf')->name('cust_report_pdf');
        Route::post('createCstmNo','Admin\subscriber\SubscribeController@createCstmNo')->name('createCstmNo');
        Route::put('subscribers/status/{id}','Admin\subscriber\SubStatusController@status')->name('subscribers.status');

        // Route::resource('relatedness','Admin\RelatednessController');

        Route::resource('systems','Admin\SystemController');
//        Premium reports
        Route::get('premium','Admin\report\PremiumController@index')->name('premium');






//        employees
        Route::resource('employees','Admin\employees\EmployeeController');
        Route::get('getProjects', 'Admin\employees\EmployeeController@getProjects')->name('getProjects');
        Route::get('getProjectsChild', 'Admin\employees\EmployeeController@getProjectsChild')->name('getProjectsChild');

        Route::get('stuff_data','Admin\employees\EmployeeController@stuff_data')->name('stuff_data');
        Route::get('employees_report','Admin\employees\EmployeeController@employees_report')->name('employees_report');
        Route::get('get_Branches','Admin\employees\EmployeeController@get_Branches')->name('get_BranchesR');
        Route::get('get_data_redio','Admin\employees\EmployeeController@get_data_redio')->name('get_data_redio');



//        supplier
        Route::resource('suppliers','Admin\supplier\MtsSuplirController');
        Route::get('supplier_report','Admin\supplier\MtsSuplirController@supplier_report')->name('supplier_report');
        //Route::get('get_mainbranches','Admin\supplier\MtsSuplirController@get_mainbranches')->name('get_mainbranches');
        Route::get('sup_report_select','Admin\supplier\MtsSuplirController@sup_report_select')->name('sup_report_select');
        Route::get('sup_report_print','Admin\supplier\MtsSuplirController@sup_report_print')->name('sup_report_print');
        Route::post('sup_report_pdf','Admin\supplier\MtsSuplirController@sup_report_pdf')->name('sup_report_pdf');
        Route::post('createSupNo','Admin\supplier\MtsSuplirController@createSupNo')->name('createSupNo');



        //Projcontractmfs
        Route::resource('project_contract','Admin\Projcontractmfs\ProjcontractmfsController');
        Route::post('project_contract/getComp','Admin\Projcontractmfs\ProjcontractmfsController@getComp')->name('getComp');
        Route::post('getproj','Admin\Projcontractmfs\ProjcontractmfsController@getproj')->name('getproj');



//        astsupctg
        Route::resource('astsupctg','Admin\Astsupctg\AstsupctgController');


//        activities
        Route::resource('activities','Admin\activities\ActivitiesController');

//        AstNutrbusn
        Route::resource('AstNutrbusn','Admin\AstNutrbusn\AstNutrbusnController');

        Route::resource('subscribers','Admin\subscriber\SubscribeController');
        Route::put('subscribers/status/{id}','Admin\subscriber\SubStatusController@status')->name('subscribers.status');

        Route::get('subscribers/{id}/deActive','SubscribeController@deActive');
        Route::get('subscribers/{id}/active','SubscribeController@active');
        // Route::resource('relatedness','Admin\RelatednessController');


        Route::resource('delegates', 'Admin\Delegates\DelegatesController');



        Route::resource('supervisors', 'Admin\Supervisors\supervisorsController');


        Route::get('/country','Admin\SubscribeController@getCountries');
        Route::get('city','Admin\subscriber\SubscribeController@getCities')->name('getCities');
        Route::get('getBranch','Admin\subscriber\SubscribeController@getBranches')->name('getBranch');


// 0_0 Dashboard_setting
        Route::get('general_setting', function () {
            return view('admin.general_setting.general_setting');
        });

        Route::get('employees_data', function () {
            return view('admin.basic_data.employees_data');
        });

// 1_1 Dashboard_setting
// 0_0 Dashboard_setting
        Route::get('Dashboard_setting', function () {
            return view('admin.Dashboard_setting.Dashboard_setting');
        });
// 1_1 Dashboard_setting
//        0_0 basic_Data
        Route::get('basic_data', function () {
            return view('admin.basic_data.basic_data');
        });
        Route::get('customer_data', function () {
            return view('admin.basic_data.customer.customer_data');
        });
        Route::get('supplier_data', function () {
            return view('admin.basic_data.supplier.supplier_data');
        });
            Route::get('departments_data', function () {
            return view('admin.basic_data.departments.departments_data');
        });
            Route::get('cc_data', function () {
            return view('admin.basic_data.cc.cc_data');
        });

        Route::get('categroy_data', function () {
            return view('admin.basic_data.category.category_data');
        });

        Route::get('project_data', function () {
            return view('admin.basic_data.project.projact_data');
        });

//            Route::get('stuff_data', function () {
//            return view('admin.basic_data.stuff.stuff_data');
//        });

        Route::get('sales_setting', function () {
            return view('admin.general_setting.sales_setting');
        });

        Route::get('account_setting', function () {
            return view('admin.general_setting.account_setting');
        });


        Route::get('Fixed_assets', function () {
            return view('admin.basic_data.Fixed_assets.Fixed_assets');
        });
            Route::get('cars_data', function () {
            return view('admin.basic_data.cars.cars_data');
        });
            Route::get('sales_data', function () {
            return view('admin.general_setting.sales.sales_data');
        });


//        0_0 fininncil_report
//        0
        Route::get('financial_reports','Admin\financial_reports\general_accountsController@financial_reports')->name('financial_reports');
        Route::get('general_accounts','Admin\financial_reports\general_accountsController@general_accounts')->name('general_accounts');
        Route::get('account_statement','Admin\financial_reports\general_accountsController@account_statement')->name('account_statement');
        Route::get('branche','Admin\financial_reports\general_accountsController@branche')->name('branche');
        Route::get('acc_state','Admin\financial_reports\general_accountsController@acc_state')->name('acc_state');
        Route::get('account_statement/details','Admin\financial_reports\general_accountsController@details')->name('accountStatement.details');
        Route::Post('account_statement/pdf','Admin\financial_reports\general_accountsController@print')->name('accountStatement.acc_pdf');
        Route::get('trial_balance','Admin\financial_reports\general_accountsController@trial_balance')->name('trial_balance');
        Route::get('branche_trial_balance','Admin\financial_reports\general_accountsController@branche_trial_balance')->name('branche_trial_balance');
        Route::get('trialbalance_show','Admin\financial_reports\general_accountsController@trialbalance_show')->name('trialbalance.show');
        Route::get('trialbalance_details','Admin\financial_reports\general_accountsController@trialbalance_details')->name('trialbalance.details');
        Route::get('trialbalance_level','Admin\financial_reports\general_accountsController@trialbalance_level')->name('trialbalance.level');
        Route::post('trialbalance_general_print','Admin\financial_reports\general_accountsController@trialbalance_print')->name('trialbalance.print');
        Route::get('daily_restriction','Admin\financial_reports\general_accountsController@daily_restriction')->name('daily_restriction');
        Route::get('daily_restriction_show','Admin\financial_reports\general_accountsController@daily_restriction_show')->name('daily_restriction.show');
        Route::get('daily_restriction_details','Admin\financial_reports\general_accountsController@daily_restriction_details')->name('daily_restriction.details');
        Route::Post('daily_restriction_print','Admin\financial_reports\general_accountsController@daily_restriction_print')->name('daily_restriction.print');

        //       1
//        0
        Route::get('customer_accounting','Admin\financial_reports\customer_accountingcontroller@customer_accounting')->name('customer_accounting');
        Route::get('cust_account_statement','Admin\financial_reports\customer_accountingcontroller@cust_account_statement')->name('cust_account_statement');
        Route::get('account_statement_cust/details','Admin\financial_reports\customer_accountingcontroller@details')->name('accountStatementCust.details');
        Route::get('acc_state_cust','Admin\financial_reports\customer_accountingcontroller@acc_state')->name('acc_state_cust');
        Route::Post('cust_account_statement/pdf','Admin\financial_reports\customer_accountingcontroller@print')->name('accountStatementCust.acc_pdf');

        Route::get('cust_trial_balance','Admin\financial_reports\customer_accountingcontroller@trial_balance')->name('cust_trial_balance');
        Route::get('trialbalance_cust_show','Admin\financial_reports\customer_accountingcontroller@trialbalance_show')->name('trialbalanceCust.show');
        Route::get('details_trial_balance','Admin\financial_reports\customer_accountingcontroller@details_trial_balance')->name('details_trial_balance');
        Route::Post('print_trial_balance','Admin\financial_reports\customer_accountingcontroller@print_trial_balance')->name('print_trial_balance');
        Route::get('cust_daily_restriction','Admin\financial_reports\customer_accountingcontroller@daily_restriction')->name('cust_daily_restriction');
        Route::get('cust_daily_restriction_show','Admin\financial_reports\customer_accountingcontroller@cust_daily_restriction_show')->name('cust_daily_restriction.show');
        Route::get('cust_daily_restriction_details','Admin\financial_reports\customer_accountingcontroller@cust_daily_restriction_details')->name('cust_daily_restriction.details');
        Route::Post('cust_daily_restriction_print','Admin\financial_reports\customer_accountingcontroller@cust_daily_restriction_print')->name('cust_daily_restriction.print');

//        1
//        0
        Route::get('supplier_accounting','Admin\financial_reports\supplier_accountingController@supplier_accounting')->name('supplier_accounting');
        Route::get('supp_account_statement','Admin\financial_reports\supplier_accountingController@supp_account_statement')->name('supp_account_statement');
        Route::get('account_statement_sup/details','Admin\financial_reports\supplier_accountingController@details')->name('accountStatementSup.details');
        Route::get('acc_state_sup','Admin\financial_reports\supplier_accountingController@acc_state')->name('acc_state_sup');
        Route::Post('sup_account_statement/pdf','Admin\financial_reports\supplier_accountingController@print')->name('accountStatementSup.acc_pdf');
        Route::get('supp_trial_balance','Admin\financial_reports\supplier_accountingController@trial_balance')->name('supp_trial_balance');
        Route::get('trialbalance_sup_show','Admin\financial_reports\supplier_accountingController@trialbalance_show')->name('trialbalanceSup.show');
        Route::get('trialbalance_sup_details','Admin\financial_reports\supplier_accountingController@trialbalance_details')->name('trialbalanceSup.details');
        Route::get('trialbalance_sup_details_level','Admin\financial_reports\supplier_accountingController@trialbalance_level')->name('trialbalanceSup.level');
        Route::POST('trialbalance_sup_print','Admin\financial_reports\supplier_accountingController@trialbalance_print')->name('trialbalanceSup.print');
        Route::get('sup_daily_restriction','Admin\financial_reports\supplier_accountingController@sup_daily_restriction')->name('sup_daily_restriction');
        Route::get('sup_daily_restriction_show','Admin\financial_reports\supplier_accountingController@sup_daily_restriction_show')->name('sup_daily_restriction.show');
        Route::get('sup_daily_restriction_details','Admin\financial_reports\supplier_accountingController@sup_daily_restriction_details')->name('sup_daily_restriction.details');
        Route::Post('sup_daily_restriction_print','Admin\financial_reports\supplier_accountingController@sup_daily_restriction_print')->name('sup_daily_restriction.print');





//        1
        Route::get('staff_accounting','Admin\financial_reports\staff_accountingController@staff_accounting')->name('staff_accounting');
        Route::get('staff_account_statement','Admin\financial_reports\staff_accountingController@staff_account_statement')->name('staff_account_statement');
        Route::get('staff_trial_balance','Admin\financial_reports\staff_accountingController@staff_trial_balance')->name('staff_trial_balance');
        Route::get('staff_daily_restriction','Admin\financial_reports\staff_accountingController@staff_daily_restriction')->name('staff_daily_restriction');




//   0
        Route::get('cc_accounting','Admin\financial_reports\CC_accountingController@cc_accounting')->name('cc_accounting');
        Route::get('balances_cc','Admin\financial_reports\CC_accountingController@balances_cc')->name('balances_cc');
        Route::get('movement_statement','Admin\financial_reports\CC_accountingController@movement_statement')->name('movement_statement');
        Route::get('movement_acc_cc','Admin\financial_reports\CC_accountingController@movement_acc_cc')->name('movement_acc_cc');
        Route::get('movement_details','Admin\financial_reports\CC_accountingController@movement_details')->name('movement_details');
        Route::post('movement_pdf','Admin\financial_reports\CC_accountingController@movement_pdf')->name('movement_pdf');
        Route::get('movement_balance','Admin\financial_reports\CC_accountingController@movement_balance')->name('movement_balance');
        Route::get('get_levels','Admin\financial_reports\CC_accountingController@get_levels')->name('get_levels');
        Route::get('movement_trialbalance_show','Admin\financial_reports\CC_accountingController@trialbalance_show')->name('movementTrialbalance.show');
        Route::get('movement_trialbalance_details','Admin\financial_reports\CC_accountingController@trialbalance_details')->name('movementTrialbalance.details');
        Route::get('trialbalance_details_level','Admin\financial_reports\CC_accountingController@trialbalance_level')->name('movementTrialbalance.level');
        Route::POST('trialbalance_cc_print','Admin\financial_reports\CC_accountingController@trialbalance_print')->name('movementTrialbalance.print');
        /***/
        Route::get('cc_balance','Admin\financial_reports\CC_accountingController@cc_balance')->name('cc_balance');
        Route::get('cc_balance_show','Admin\financial_reports\CC_accountingController@cc_balance_show')->name('cc_balance.show');
        Route::get('cc_balance_details','Admin\financial_reports\CC_accountingController@cc_balance_details')->name('cc_balance.details');
        Route::get('cc_balance_details_level','Admin\financial_reports\CC_accountingController@cc_balance_level')->name('cc_balance.level');
        Route::POST('cc_balance_print','Admin\financial_reports\CC_accountingController@cc_balance_print')->name('cc_balance.print');
        Route::get('general_balance_cc','Admin\financial_reports\CC_accountingController@general_balance_cc')->name('general_balance_cc');

//        1_1 financial_report

//basic_reports
        Route::get('basic_reports', function () {
            return view('admin.basic_reports.basic_reports');
        });
        Route::get('department_print_Reports', function () {
            return view('admin.basic_reports.Departments.department_print_Reports');
        });
        Route::get('department_Reports', function () {
            return view('admin.basic_reports.Departments.department_Reports');
        });
        Route::get('cc_report', function () {
            return view('admin.basic_reports.CC.cc_report');
        });


        Route::get('stuff_report', function () {
            return view('admin.basic_reports.stuff.stuff_report');
        });
//        report
        Route::resource('reports','Admin\report\ReportController');
        Route::resource('reportsbus','Admin\report\ReportBusController');
//        Route::resource('reportdriver','Admin\report\ReportDriverController');
        Route::resource('reportbranche','Admin\report\ReportBrancheController');
        Route::get('reportbushome','Admin\report\RBusController@index');
//        Route::get('reportdriver','Admin\report\RDriverController@index');

//        Route::get('reportpdf/pdf/{id}',[ 'as' => 'report.pdf', 'uses' =>'Admin\report\ReportDriverController@pdf']);

//        blog
        Route::resource('blog','Admin\blog\BlogController');

//        branches
        Route::resource('branches','Admin\Branches\BranchesController');
        Route::post('branches/getBranchesAndStores','Admin\Branches\BranchesController@getBranchesAndStores')->name('getBranchesAndStores');


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
        // Route::post('banks/Receipt/receipts/print/{id}','Admin\banks\ReceiptController@print');
        // Route::get('banks/Receipt/receipts/print/{id}','Admin\banks\ReceiptController@print')->name('receipts.print');
        Route::get('banks/Receipt/receipts','Admin\banks\ReceiptController@receipts')->name('receipts');
        Route::post('receiptsData/editdatatable','Admin\banks\ReceiptController@editdatatable');
        Route::post('receiptsData/select','Admin\banks\ReceiptController@select');
        Route::get('banks/Receipt/receipts/{id}','Admin\banks\ReceiptController@receiptsShow')->name('receiptsShow');
        Route::delete('banks/Receipt/invoice/{id}','Admin\banks\ReceiptController@destroy')->name('receipts.destroy');
        Route::post('banks/Receipt','Admin\banks\ReceiptController@store')->name('receipt.store');
        Route::post('receiptsData/delete','Admin\banks\ReceiptController@delete');
        Route::post('receiptsData/singledelete','Admin\banks\ReceiptController@singledelete');

        Route::resource('rcatchs', 'Admin\banks\ReceiptCatchController');
        Route::get('get_snadat', 'Admin\banks\ReceiptCatchController@get_snadat');
        Route::get('hijri', 'Admin\banks\ReceiptCatchController@convertToDateToHijri')->name('hijri');
        Route::post('getSalesMan', 'Admin\banks\ReceiptCatchController@getSalesMan')->name('getSalesMan');
        Route::post('createTrNo', 'Admin\banks\ReceiptCatchController@createTrNo')->name('createTrNo');
        Route::post('getSubAcc', 'Admin\banks\ReceiptCatchController@getSubAcc')->name('getSubAcc');
        Route::post('getMainAccNo', 'Admin\banks\ReceiptCatchController@getMainAccNo')->name('getMainAccNo');
        Route::post('getTaxValue', 'Admin\banks\ReceiptCatchController@getTaxValue')->name('getTaxValue');
        Route::post('validateCache', 'Admin\banks\ReceiptCatchController@validateCache')->name('validateCache');
        Route::post('getCatchRecpt', 'Admin\banks\ReceiptCatchController@getCatchRecpt')->name('getCatchRecpt');
        Route::get('printCatchRecpt/{id}','Admin\banks\ReceiptCatchController@print')->name('printCatchRecpt');
        Route::post('branchForEdit','Admin\banks\ReceiptCatchController@branchForEdit')->name('branchForEdit');
        Route::post('getRcptDetails','Admin\banks\ReceiptCatchController@getRcptDetails')->name('getRcptDetails');
        Route::post('updateTrns','Admin\banks\ReceiptCatchController@updateTrns')->name('updateTrns');
        Route::post('deleteTrns','Admin\banks\ReceiptCatchController@deleteTrns')->name('deleteTrns');
        Route::get('getRecieptByCmp','Admin\banks\ReceiptCatchController@getRecieptByCmp')->name('getRecieptByCmp');
        Route::post('getCurencyRate','Admin\banks\ReceiptCatchController@getCurencyRate')->name('getCurencyRate');
        Route::post('getCmpSalesMen','Admin\banks\ReceiptCatchController@getCmpSalesMen')->name('getCmpSalesMen');
        Route::post('addDeletedLines','Admin\banks\ReceiptCatchController@addDeletedLines')->name('addDeletedLines');

        Route::resource('curencies', 'Admin\Curency\CurencyController');

        //import external db
        Route::get('import', 'Admin\import_db\ImportController@import')->name('import');
        Route::post('import/send', 'Admin\import_db\ImportController@send')->name('send');


        Route::resource('receiptCash', 'Admin\Cash\receiptCashController'); // سند صرف
        Route::get('hijriC', 'Admin\Cash\receiptCashController@convertToDateToHijri')->name('hijriC');
        Route::post('getSalesManC', 'Admin\Cash\receiptCashController@getSalesMan')->name('getSalesManC');
        Route::post('createTrNoC', 'Admin\Cash\receiptCashController@createTrNo')->name('createTrNoC');
        Route::post('getSubAccC', 'Admin\Cash\receiptCashController@getSubAcc')->name('getSubAccC');
        Route::post('getMainAccNoC', 'Admin\Cash\receiptCashController@getMainAccNo')->name('getMainAccNoC');
        Route::post('getTaxValueC', 'Admin\Cash\receiptCashController@getTaxValue')->name('getTaxValueC');
        Route::post('validateCacheC', 'Admin\Cash\receiptCashController@validateCache')->name('validateCacheC');
        Route::post('updateTrnsC', 'Admin\Cash\receiptCashController@updateTrnsC')->name('updateTrnsC');
        Route::post('getCatchRecptC', 'Admin\Cash\receiptCashController@getCatchRecpt')->name('getCatchRecptC');
        Route::post('getCashptDetails','Admin\Cash\receiptCashController@getCashptDetails')->name('getCashptDetails');
        Route::post('addDeletedLiness','Admin\Cash\receiptCashController@addDeletedLines')->name('addDeletedLiness');


        Route::get('printCatchRecptC/{id}','Admin\Cash\receiptCashController@print')->name('printCatchRecptC');
        Route::post('branchForEditC','Admin\Cash\receiptCashController@branchForEdit')->name('branchForEditC');
        Route::post('getRcptDetailsC','Admin\Cash\receiptCashController@getRcptDetails')->name('getRcptDetailsC');
       // Route::post('getBranchesFilter', 'Admin\Cash\receiptCashController@getBranchesFilter')->name('getBranchesFilter');




        Route::get('banks/Receipt/receipts/catch/catch','Admin\banks\ReceiptController@catchindex')->name('receipts.catch');
        Route::get('banks/Receipt/receipts/caching/caching','Admin\banks\ReceiptController@cachingindex')->name('receipts.caching');
        Route::get('banks/Receipt/receipts/catch/all','Admin\banks\ReceiptController@catch')->name('receipts.catch');
        Route::get('banks/Receipt/receipts/caching/all','Admin\banks\ReceiptController@caching')->name('receipts.caching');





        Route::resource('accbanks', 'Admin\setting\GLaccBnkCintroller');
        Route::post('accbanks/getAcc', 'Admin\setting\GLaccBnkCintroller@getAcc')->name('getAcc');
        Route::post('accbanks/getCharts', 'Admin\setting\GLaccBnkCintroller@getCharts')->name('getCharts');



        //Notices
        Route::resource('notice', 'Admin\Notice\NoticeController');

        Route::post('deleteTrnsN','Admin\banks\ReceiptCatchController@deleteTrns')->name('deleteTrnsN');
        Route::post('getCmpSalesMenN','Admin\banks\ReceiptCatchController@getCmpSalesMen')->name('getCmpSalesMenN');
        Route::post('getCurencyRateN','Admin\Notice\NoticeController@getCurencyRate')->name('getCurencyRateN');
        Route::get('include', 'Admin\Notice\NoticeController@getPages')->name('getPages');
        Route::get('getcr', 'Admin\Notice\NoticeController@getSelect')->name('getSelect');
        Route::post('addDeletedLinesN','Admin\Notice\NoticeController@addDeletedLines')->name('addDeletedLinesN');
        Route::get('hijriNoti', 'Admin\Notice\NoticeController@convertToDateToHijri')->name('hijriNoti');
        Route::post('updateTrnsN','Admin\Notice\NoticeController@updateTrns')->name('updateTrnsN');
        Route::post('getSalesManN', 'Admin\Notice\NoticeController@getSalesMan')->name('getSalesManN');
        Route::post('createTrNoN', 'Admin\Notice\NoticeController@createTrNo')->name('createTrNoN');
        Route::post('getSubAccN', 'Admin\Notice\NoticeController@getSubAcc')->name('getSubAccN');
        Route::post('getMainAccNoN', 'Admin\Notice\NoticeController@getMainAccNo')->name('getMainAccNoN');
        Route::post('getTaxValueN', 'Admin\Notice\NoticeController@getTaxValue')->name('getTaxValueN');
        Route::post('validateCacheN', 'Admin\Notice\NoticeController@validateCache')->name('validateCacheN');
        Route::post('getCatchRecptN', 'Admin\Notice\NoticeController@getCatchRecpt')->name('getCatchRecptN');
        Route::get('printCatchRecptN/{id}','Admin\Notice\NoticeController@print')->name('printCatchRecptN');
        Route::post('branchForEditN','Admin\Notice\NoticeController@branchForEdit')->name('branchForEditN');
        Route::post('getRcptDetailsN','Admin\Notice\NoticeController@getRcptDetails')->name('getRcptDetailsN');



        //        limitations
        Route::resource('limitations','Admin\limitations\LimitationsController');
        Route::get('get_limitions','Admin\limitations\LimitationsController@get_limitions');

//        Route::get('limitations/show/{id}','Admin\limitations\limitationsData@show')->name('limitations.show');
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

        /**
         * Limitation routes
         */
        Route::get('limitations/notice/noticedebt','Admin\limitations\LimitationsController@noticedebt');
        Route::get('limitations/dept/create','Admin\limitations\LimitationsController@debt');
        Route::resource('limitationType', 'Admin\limitations\LimitationTypeController');
        Route::resource('limitationOperation', 'Admin\limitations\LimitationsOperationsController');
        Route::post('limitationBranchForEdit','Admin\limitations\LimitationsOperationsController@branchForEdit')->name('limitationBranchForEdit');
        Route::post('limitationGetCmpSalesMen','Admin\limitations\LimitationsOperationsController@getCmpSalesMen')->name('limitationGetCmpSalesMen');
        Route::post('limitationCreateTrNoN', 'Admin\limitations\LimitationsOperationsController@createTrNo')->name('limitationCreateTrNoN');
        Route::post('checkSetting', 'Admin\limitations\LimitationsOperationsController@checkSetting')->name('checkSetting');
        Route::post('limitationGetMainAccNoN', 'Admin\limitations\LimitationsOperationsController@getMainAccNo')->name('limitationGetMainAccNoN');
        Route::post('limitationGetSubAccN', 'Admin\limitations\LimitationsOperationsController@getSubAcc')->name('limitationGetSubAccN');
        Route::post('limitationGetSalesMan', 'Admin\limitations\LimitationsOperationsController@getSalesMan')->name('limitationGetSalesMan');
        Route::post('limitationValidate', 'Admin\limitations\LimitationsOperationsController@validateCache')->name('limitationValidate');
        Route::post('limitationGetRcptDetails', 'Admin\limitations\LimitationsOperationsController@getRcptDetails')->name('limitationGetRcptDetails');
        Route::post('limitationUpdateTrns', 'Admin\limitations\LimitationsOperationsController@updateTrns')->name('limitationUpdateTrns');
        Route::post('limitationDeleteTrns', 'Admin\limitations\LimitationsOperationsController@deleteTrns')->name('limitationDeleteTrns');



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
        Route::get('trialbalance/details2','Admin\accountingReports\trialBalanceController@details2');
        Route::post('trialbalance/pdf','Admin\accountingReports\trialBalanceController@pdf');
        Route::post('trialbalance/pdf2','Admin\accountingReports\trialBalanceController@pdf2');


//        publicbalance
        Route::get('publicbalance','Admin\accountingReports\publicBalanceController@index');
        Route::get('publicbalance/show','Admin\accountingReports\publicBalanceController@show');
        Route::post('publicbalance/pdf','Admin\accountingReports\publicBalanceController@pdf');
        Route::get('publicbalance/level','Admin\accountingReports\publicBalanceController@level');


        // Projects data for projects

        //Route::resource('project_contract', 'Admin\Project_contract\projectcontractcontroller');

        route::get('/admin/contracttype','Admin\Contract\ContractController@contracttype')->name('contract.type');
        route::post('/admin/contracttype','Admin\Contract\ContractController@contracttypeadd')->name('contract.add');
        route::get('/contracts/deleteperson/{id}','Admin\Contract\ContractController@resposible')->name('resposibleperson.delete');

        route::get('/contractortype','Admin\Contractors\ContractorsController@contractortype')->name('contractor.type');
        route::post('/contractortype','Admin\Contractors\ContractorsController@contractortypeadd')->name('contractor.add');
        route::get('/contracts/deleteperson/{id}','Admin\Contractors\ContractorsController@resposible')->name('resposibleperson.delete');

        Route::resource('contractors', 'Admin\Contractors\ContractorsController');
        Route::resource('contracts', 'Admin\Contracts\ContractsController');
        Route::resource('ProjectsSites', 'Admin\ProjectsSites\ProjectsSitesController');


        /**
         * all about Categories
         */

        Route::resource('categories', 'Admin\categories\CategoriesController');
        Route::resource('units', 'Admin\categories\UnitsController');
        Route::resource('mainCategories', 'Admin\categories\MainCategoriesController');
        Route::post('updateRootOrChildOrCreateChild', 'Admin\categories\MainCategoriesController@updateRootOrChildOrCreateChild')->name('updateRootOrChildOrCreateChild');
        Route::post('deleteRootOrChild', 'Admin\categories\MainCategoriesController@deleteRootOrChild')->name('deleteRootOrChild');
        Route::post('returnCreateChildBlade', 'Admin\categories\MainCategoriesController@returnCreateChildBlade')->name('returnCreateChildBlade');
        Route::post('generateChildNo', 'Admin\categories\MainCategoriesController@generateChildNo')->name('generateChildNo');
        Route::get('getRootOrChildForEdit', 'Admin\categories\MainCategoriesController@getRootOrChildForEdit')->name('getRootOrChildForEdit');

        Route::post('getCategoryItem','Admin\categories\MainCategoriesController@getCategoryItem')->name('getCategoryItem');

        /**
         * All about bills and sales
         */

        Route::get('getSalesInvoicesGeneralView',function (){
            return view('admin.sales_invoices.general_screen');
        })->name('getSalesInvoicesGeneralView');
        Route::get('purchases',function (){
            return view('admin.purchases_invoices.general_screen');
        })->name('getpurchasesInvoicesGeneralView');
        Route::get('stores',function (){
            return view('admin.stores_invoices.general_screen');
        })->name('getstoresInvoicesGeneralView');

        Route::resource('salesInvoices', 'Admin\sales_invoices\SalesInvoicesController');
        Route::get('salesInvoices/print/{id}', 'Admin\sales_invoices\SalesInvoicesController@salesInvoices_print')->name('salesInvoices.print');
        Route::get('getActivityCustomer', 'Admin\sales_invoices\SalesInvoicesController@getActivityCustomer')->name('getActivityCustomer');
        Route::get('returnCountOfDays', 'Admin\sales_invoices\SalesInvoicesController@returnCountOfDays')->name('returnCountOfDays');
        Route::get('createNewRow', 'Admin\sales_invoices\SalesInvoicesController@createNewRow')->name('createNewRow');
        Route::get('returnItemInfo', 'Admin\sales_invoices\SalesInvoicesController@returnItemInfo')->name('returnItemInfo');
        Route::get('returnUnitPrice', 'Admin\sales_invoices\SalesInvoicesController@returnUnitPrice')->name('returnUnitPrice');
        Route::post('createNewLine', 'Admin\sales_invoices\SalesInvoicesController@createNewLine')->name('createNewLine');
        Route::get('deleteLine', 'Admin\sales_invoices\SalesInvoicesController@deleteLine')->name('deleteLine');
        Route::get('additionalDisc', 'Admin\sales_invoices\SalesInvoicesController@additionalDisc')->name('additionalDisc');
        /* puraches */
        Route::resource('purchasesInvoices', 'Admin\puraches_invoices\PurachesInvoicesController');
        Route::get('purchasesInvoices/print/{id}', 'Admin\puraches_invoices\PurachesInvoicesController@purchasesInvoices_print')->name('purchasesInvoices.print');
        Route::get('getPurchaseActivityCustomer', 'Admin\puraches_invoices\PurachesInvoicesController@getPurchaseActivityCustomer')->name('getPurchaseActivityCustomer');
        Route::get('returnPurchasesCountOfDays', 'Admin\puraches_invoices\PurachesInvoicesController@returnPurchasesCountOfDays')->name('returnPurchasesCountOfDays');
        Route::get('returnPurchasesExchangeRate', 'Admin\puraches_invoices\PurachesInvoicesController@returnPurchasesExchangeRate')->name('returnPurchasesExchangeRate');
        Route::get('createNewPuracheseRow', 'Admin\puraches_invoices\PurachesInvoicesController@createNewPuracheseRow')->name('createNewPuracheseRow');
        Route::get('returnPurchaseItemInfo', 'Admin\puraches_invoices\PurachesInvoicesController@returnPurchaseItemInfo')->name('returnPurchaseItemInfo');
        Route::get('returnPurchaseUnitPrice', 'Admin\puraches_invoices\PurachesInvoicesController@returnPurchaseUnitPrice')->name('returnPurchaseUnitPrice');
        Route::post('createPurchaseNewLine', 'Admin\puraches_invoices\PurachesInvoicesController@createPurchaseNewLine')->name('createPurchaseNewLine');
        Route::get('deletePurchaseLine', 'Admin\puraches_invoices\PurachesInvoicesController@deletePurchaseLine')->name('deletePurchaseLine');
        Route::get('addPurchaseitionalDisc', 'Admin\puraches_invoices\PurachesInvoicesController@addPurchaseitionalDisc')->name('addPurchaseitionalDisc');
        
        /**
         * all about stores place
         */

        Route::resource('stores', 'Admin\stores\StoresController');




        // nb3 for test only settings routes placed in the last of menu
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






    });



});
