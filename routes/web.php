<?php

use Illuminate\Support\Facades\Route;
  
use App\Http\Controllers\FullCalenderController;

use App\Http\Controllers\NotificationController;

use App\Http\Controllers\RelieverController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
  return view('pages.welcome');
})->name('welcome');


Route::get('/clear', function() {

   Artisan::call('cache:clear');
   Artisan::call('config:clear');
   Artisan::call('config:cache');
   Artisan::call('view:clear');

   return "Cleared!";

});

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('home', 'HomeController@index')->name('home');
Route::get('dashboard', 'HomeController@index')->name('home');
Route::get('pricing', 'ExamplePagesController@pricing')->name('page.pricing');
Route::get('lock', 'ExamplePagesController@lock')->name('page.lock');
Route::get('error', ['as' => 'page.error', 'uses' => 'ExamplePagesController@error']);

Route::group(['middleware' => App\Http\Middleware\FieldMiddleware::class], function () {

    Route::resource('delete', 'DeleteController',['except' => ['show']]);
    Route::get('deleterecords','DeleteController@deleterecords')->name('deleterecords');

    Route::resource('leaves', 'LeavesController',['except' => ['show']]);

	Route::resource('overall_journey_details', 'OverJourneyPlanController',['except' => ['show']]);
    Route::resource('weekoff', 'WeekoffController',['except' => ['show']]);
    Route::resource('schedule-outlets', 'ScheduleOutletsController',['except' => ['show']]);
    Route::resource('unschedule-outlets', 'UnscheduleOutletsController',['except' => ['show']]);
    Route::resource('defined-outlets', 'DefinedOutletsController',['except' => ['show']]);
    Route::resource('merchant-timesheet', 'MerchantimesheetController', ['except' => ['show']]);
    Route::resource('planogram', 'PlanogramController',['except' => ['show']]);
    Route::resource('promotion', 'PromotionController',['except' => ['show']]);
	Route::resource('outlet_stockexpiry', 'Outlet_stockexpiryController',['except' => ['show']]);
	Route::resource('over_all_journeyplan', 'OverJourneyPlanController',['except' => ['show']]);  // New
    Route::resource('scheduled_report', 'ScheduleOutlets_ReportController',['except' => ['show']]);
	Route::resource('overalloutlet_stockexpiry', 'Overalloutlet_stockexpiryController',['except' => ['show']]);
	Route::resource('field_outlet_report', 'FieldOutletReportController',['except' => ['show']]);
	Route::resource('cde_reporting', 'CdeReportingController',['except' => ['show']]);


    Route::get('filter_scheduled_outlet', 'ScheduleOutletsController@filter_scheduled_outlet')->name('filter_scheduled_outlet');

    Route::get('get_emp_list', 'WeekoffController@get_emp_list')->name('get_emp_list');

    Route::get('filter_unscheduled_outlet', 'UnscheduleOutletsController@filter_unscheduled_outlet')->name('filter_unscheduled_outlet');
    
    Route::get('filter_defined_journey', 'DefinedOutletsController@filter_defined_journey')->name('filter_defined_journey');

    Route::get('get_weekoff_days', 'DefinedOutletsController@get_weekoff_days')->name('get_weekoff_days');

    Route::get('filter_merchant_timesheet', 'MerchantimesheetController@filter_merchant_timesheet')->name('filter_timesheet');

    Route::get('approvedfield/{id}/{type}', 'LeavesController@approvedfield')->name('approvedfield');
    Route::get('rejectedfield/{id}', 'LeavesController@rejectedfield')->name('rejectedfield');

     Route::post('/export_schedule', 'TimesheetController@export_schedule');

    Route::post('/export_unshedule', 'TimesheetController@export_unshedule');

    //Route::get('/view_activity', 'DefinedOutletsController@view_activity');

   
    //Route::view('outlet_share','livewire.home');

    Route::get('get_promo_products','PromotionController@get_promo_products')->name('get_promo_products');

    Route::get('import_promotion', 'PromotionController@import_promotion')->name('import_promotion');
    Route::post('import_promo', 'PromotionController@import_promo')->name('import_promo');
	
	Route::get('report_promo','PromotionController@report_promo')->name('report_promo');
	Route::post('filter_stock_report','Outlet_stockexpiryController@filter_stock_report')->name('filter_stock_report');
	
	Route::post('filter_overallstock_report','Overalloutlet_stockexpiryController@filter_overallstock_report')->name('filter_overallstock_report');
    Route::get('export-stock1','Overalloutlet_stockexpiryController@export_stock1')->name('export-stock1');
    Route::get('view_outletstock1','Overalloutlet_stockexpiryController@view_outletstock1');


	Route::get('stock_report','Outlet_stockexpiryController@stock_report')->name('stock_report');

    Route::get('export-stock','Outlet_stockexpiryController@export_stock')->name('export-stock');

	Route::get('view_brands','PlanogramCheckController@view_brands');
	
	Route::get('/follow_timesheet', 'ScheduleOutletsController@follow_timesheet');

    Route::post('/add_follow_timesheet', 'ScheduleOutletsController@add_follow_timesheet');
	
	Route::get('import_timesheet', 'ScheduleOutletsController@import_timesheet')->name('import_timesheet');

    Route::post('import_timesheet', 'ScheduleOutletsController@import')->name('import_timesheet');
	
	Route::post('view_outletstock_report', 'Outlet_stockexpiryController@view_outletstock_report')->name('view_outletstock_report');
	
    Route::get('get_all_employees','OverJourneyPlanController@get_all_employees')->name('get_all_employees');;  // New

    Route::get('add_over_journey_plan','OverJourneyPlanController@add_over_journey_plan')->name('add_over_journey_plan');;  // New
    
    Route::post('overall_journey_details', 'OverJourneyPlanController@overall_journey_details')->name('overall_journey_details');  //New
   
    Route::post('remove_over_journey_plan', 'OverJourneyPlanController@remove_over_journey_plan')->name('remove_over_journey_plan');  //New
	
	// pon
	
	Route::resource('reliever', 'RelieverController',['except' => ['show']]);

    Route::get('get_merchandiser_for_reliver', [RelieverController::class, 'test_reliver']);

    Route::get('insert_merchandiser_for_reliver', [RelieverController::class, 'store']);
	
	Route::get('f_outlet_report', 'FieldOutletReportController@f_outlet_report')->name('f_outlet_report');

    Route::post('get_field_report', 'FieldOutletReportController@get_field_report')->name('get_field_report');
	
	Route::get('monthly_bar_chart_field', 'HomeController@monthly_bar_chart_field')->name('monthly_bar_chart_field');
	
	Route::get('filter_bar_chart_field', 'HomeController@filter_bar_chart_field')->name('filter_bar_chart_field');
 
	Route::get('monthly_bar_chart_cde', 'HomeController@monthly_bar_chart_cde')->name('monthly_bar_chart_cde');

    Route::get('filter_bar_chart_cde', 'HomeController@filter_bar_chart_cde')->name('filter_bar_chart_cde');

  Route::get('show_leave_documents', 'LeaverequestController@show_leave_documents')->name('show_leave_documents');
 
	
});

Route::group(['middleware' => App\Http\Middleware\MerchantMiddleware::class], function () {

    Route::resource('journey-plan', 'JourneyplanController', ['except' => ['show']]);
    Route::resource('timesheet', 'TimesheetController',['except' => ['show']]);
    Route::resource('customer_activity', 'CustomerActivityController',['except' => ['show']]);
    Route::resource('availabity', 'AvailabilityController',['except' => ['show']]);
    Route::resource('visibility', 'VisibilityController',['except' => ['show']]);
    Route::resource('share_of_shelf', 'ShareOfShelfController',['except' => ['show']]);
    Route::resource('competition', 'CompetitionController',['except' => ['show']]);
    Route::resource('promotion_check', 'PromotionCheckController',['except' => ['show']]);
    Route::resource('outlet_stockexpiry', 'Outlet_stockexpiryController',['except' => ['show']]);
    Route::resource('planogram_check', 'PlanogramCheckController',['except' => ['show']]);
    
    Route::get('view_brands','PlanogramCheckController@view_brands');
	
    Route::get('date_timesheet', 'TimesheetController@date_timesheet')->name('date_timesheet');

    Route::get('get_journey_plan', 'JourneyplanController@get_journey_plan')->name('get_journey_plan');
    Route::get('get_by_date', 'JourneyplanController@get_by_date')->name('get_by_date');
    Route::post('outlet_check_in', 'JourneyplanController@outlet_check_in')->name('outlet_check_in');
    Route::post('outlet_check_out', 'JourneyplanController@outlet_check_out')->name('outlet_check_out');

    Route::post('filter_timesheet', 'TimesheetController@filter_timesheet')->name('filter_timesheet');
    Route::get('/export/{type}', 'TimesheetController@export');

   
    Route::get('date_timesheet', 'TimesheetController@date_timesheet')->name('date_timesheet');
    Route::post('filter_date_timesheet', 'TimesheetController@filter_date_timesheet')->name('filter_date_timesheet');

    Route::get('outlet_details/{id}', 'OutletDeatailsController@index')->name('outlet_details');
    Route::get('outlet_detail', 'OutletDeatailsController@outlet_detail')->name('outlet_detail');

    Route::get('monthly_count', 'OutletDeatailsController@monthly_count')->name('monthly_count');

    Route::get('c-activity/{id}', 'CustomerActivityController@index')->name('c-activity');

    Route::get('p-availabity/{id}', 'AvailabilityController@index')->name('p-availabity');

    Route::get('p-visibility/{id}', 'VisibilityController@index')->name('p-visibility');

    Route::post('search_brand/{id}', 'AvailabilityController@search_brand')->name('search_brand');

    Route::post('update_product_availability', 'AvailabilityController@update_product_availability')->name('update_product_availability');

    Route::post('update_product_visibility', 'VisibilityController@update_product_visibility')->name('update_product_visibility');

    Route::get('share_of_shelf/{id}', 'ShareOfShelfController@index')->name('share_of_shelf');

    Route::post('get_share_details', 'ShareOfShelfController@get_share_details')->name('get_share_details');

    Route::post('update_shareof_shelf', 'ShareOfShelfController@update_shareof_shelf')->name('update_shareof_shelf');

    Route::get('competitor_info/{id}', 'CompetitionController@edit')->name('competitor_info');

    Route::post('competitor_visibility/{id}', 'CompetitionController@competitor_visibility')->name('competitor_visibility');

    Route::get('promotion_check/{id}', 'PromotionCheckController@index')->name('promotion_check'); 

    Route::post('update_promotion', 'PromotionCheckController@update_promotion')->name('update_promotion');

    Route::get('outlet_stockexpiry/{id}', 'Outlet_stockexpiryController@index')->name('outlet_stockexpiry'); 

    Route::get('p-planogramCheck/{id}', 'PlanogramCheckController@index')->name('p-planogramCheck');
    Route::post('update_product_Planogram_Check', 'PlanogramCheckController@update_product_Planogram_Check')->name('update_product_Planogram_Check');
    Route::get('view_palno','PlanogramCheckController@view_palno')->name('view_palno');;

     Route::get('get_category_check', 'CustomerActivityController@get_category_check')->name('get_category_check'); 

    Route::post('update_category_check', 'CustomerActivityController@update_category_check')->name('update_category_check'); 
	
 Route::get('show_leave_documents', 'LeaverequestController@show_leave_documents')->name('show_leave_documents');

});

Route::group(['middleware' => App\Http\Middleware\HRMiddleware::class], function () {

    Route::resource('employee', 'EmployeeController', ['except' => ['show']]);
    Route::resource('documents', 'DocumentsController', ['except' => ['show']]);
    Route::resource('leave_rule', 'LeaveruleController', ['except' => ['show']]);
    Route::resource('employeeleaves', 'EmployeeleavesController',['except' => ['show']]);
    Route::resource('leave-balance', 'LeaveBalance', ['except' => ['show']]);
    Route::resource('employee-reporting', 'EmployeereportingController', ['except' => ['show']]);
    Route::resource('emp-overall-attendance', 'OverAllAttendanceController',['except' => ['show']]);  
    Route::resource('attendance', 'EmployeeattendanceController',['except' => ['show']]);
    
    Route::resource('holidays', 'HolidaysController',['except' => ['show']]);
    Route::resource('mannual_attendance', 'MannualattendanceController',['except' => ['show']]);
	 Route::resource('update_leave_balance', 'AddleavebalanceController', ['except' => ['show']]);  // new

    Route::get('view_employee', 'EmployeeController@view_employee');
    Route::get('add_documents/{id}', 'DocumentsController@create')->name('add_documents');
    Route::get('update_documents/{id}', 'DocumentsController@edit')->name('update_documents');
    Route::get('view_documents','DocumentsController@view_documents');
    Route::get('view_documentsfields','DocumentsController@view_documentsfields');
    Route::get('approved/{id}/{type}', 'EmployeeleavesController@approved')->name('approved');
    Route::get('rejected/{id}', 'EmployeeleavesController@rejected')->name('rejected');
    Route::post('exportemplyeeleave', 'EmployeeleavesController@exportnew');

    Route::post('filtervaluesnew', 'EmployeeleavesController@filtervaluesnew')->name('filtervaluesnew');
    Route::post('overall_atterndance_details', 'OverAllAttendanceController@overall_atterndance_details')->name('overall_atterndance_details');  

    Route::post('filter-attn-report', 'EmployeeattendanceController@filter_attn_report')->name('filter-attn-report');
    Route::get('excel_approval', 'EmployeeattendanceController@excel_approval')->name('excel_approval');
    Route::post('exportnew', 'EmployeeattendanceController@exportnew');
   
   
	
	Route::get('import_employee_csv', 'EmployeeController@import_employee_csv')->name('import_employee_csv');  // new 
    Route::post('bulk_import_employee_csv', 'EmployeeController@bulk_import_employee_csv')->name('bulk_import_employee_csv');
	
	  Route::get('update_leave_by_hr','AddleavebalanceController@update_leave_by_hr')->name('update_leave_by_hr');;  // New

    Route::get('get_update_leave_by_hr','AddleavebalanceController@get_update_leave_by_hr')->name('get_update_leave_by_hr');;  // New
	
    Route::get('filter_employee', 'EmployeeController@filter_employee')-> 
    name('filter_employee'); // vj nre

    Route::post('filter_emp_attn', 'AttendanceController@filter_emp_attn')->name('filter_emp_attn'); // vj nre
    Route::post('filter_empleave_balance', 'EmpLeaveBalance@filter_empleave_balance')->name('filter_empleave_balance'); // vj nre
	
	 Route::get('get_merchandiser_for_reportingto', [RelieverController::class, 'get_report_employee']); //pon
	Route::post('filter_emp_reporting_to', 'EmployeereportingController@filter_emp_reporting_to')->name('filter_emp_reporting_to');
	
	Route::get('get_result_for_reportingto', [RelieverController::class, 'get_result_employee']);

 Route::get('show_leave_documents', 'LeaverequestController@show_leave_documents')->name('show_leave_documents');
	
   

});


Route::group(['middleware' => App\Http\Middleware\ClientMiddleware::class ], function () {

    Route::resource('store_details', 'Store_detailsController',['except' => ['show']]);
    Route::resource('outlet', 'OutletController',['except' => ['show']]);
    Route::resource('client_report', 'ClientOutletReportController', ['except' => ['show']]);
    Route::resource('outlet-products', 'OutletProductsController',['except' => ['show']]);
    Route::resource('brand_details', 'Brand_detailsController',['except' => ['show']]);
    Route::resource('category_details', 'Category_detailsController',['except' => ['show']]);
    Route::resource('task', 'TaskController',['except' => ['show']]);
    
	//Admin / TopManagement
	Route::resource('admin_activity', 'AdminActivityController',['except' => ['show']]);


    Route::get('import_csv', 'OutletController@import_csv')->name('import_csv');
    Route::post('import', 'OutletController@import')->name('import');
    Route::get('filter_outlet', 'OutletController@filter_outlet')->name('filter_outlet');
    Route::get('client_outlet_report', 'ClientOutletReportController@client_outlet_report')->name('client_outlet_report');
    Route::post('get_client_report', 'ClientOutletReportController@get_client_report')->name('get_client_report');
	
	
    Route::get('import_store', 'Store_detailsController@import_store')->name('import_store');
    Route::post('store_import', 'Store_detailsController@store_import')->name('store_import');
	
    Route::get('/task/create/{id}', 'TaskController@index');

    Route::get('import_task', 'TaskController@import_task')->name('import_task');

    Route::post('import_task', 'TaskController@import')->name('import_task');

    Route::get('/outlet-products/create/{id}', 'OutletProductsController@create');
    Route::get('/outlet-products/view_edit/{id}', 'OutletProductsController@view_edit');
    Route::get('/outlet-products/edit_view/{id}/{outlet}', 'OutletProductsController@edit');

    Route::get('add_outlet_categories/{id}', 'OutletProductsController@add_outlet_categories')->name('add_outlet_categories');

    Route::post('outlet_categories', 'OutletProductsController@outlet_categories')->name('outlet_categories');

    Route::post('remove_outlet_categories/{id}', 'OutletProductsController@remove_outlet_categories')->name('remove_outlet_categories');  

    Route::get('add_outlet_nbl/{id}', 'OutletProductsController@add_outlet_nbl')->name('add_outlet_nbl');                 
    Route::post('update_nbl_file', 'OutletProductsController@update_nbl_file')->name('update_nbl_file');

    Route::post('remove_nbl_file/{id}', 'OutletProductsController@remove_nbl_file')->name('remove_nbl_file'); 

    Route::get('add_outlet_share/{id}', 'OutletProductsController@add_outlet_share')->name('add_outlet_share');

    Route::post('outlet_share', 'OutletProductsController@outlet_share')->name('outlet_share'); 

    Route::post('remove_share/{id}', 'OutletProductsController@remove_share')->name('remove_share');

    Route::get('add_outlet_planogram/{id}', 'OutletProductsController@add_outlet_planogram')->name('add_outlet_planogram'); 

    Route::post('outlet_planogram', 'OutletProductsController@outlet_planogram')->name('outlet_planogram');

    Route::post('remove_planogram/{id}', 'OutletProductsController@remove_planogram')->name('remove_planogram');

    Route::get('import_product_csv', 'Product_detailsController@import_product_csv')->name('import_product_csv');
    
    Route::post('import_product', 'Product_detailsController@import_product')->name('import_product');
    Route::get('get_category_details','Product_detailsController@get_category_details')->name('get_category_details');

    Route::get('filter_product','Product_detailsController@filter_product')->name('filter_product');

    Route::get('filter_store','Store_detailsController@filter_store')->name('filter_store');

	//Admin / TopManagement
	Route::get('admin_store','AdminActivityController@admin_store')->name('admin_store');

    Route::get('admin_brand','AdminActivityController@admin_brand')->name('admin_brand');

    Route::get('admin_category','AdminActivityController@admin_category')->name('admin_category');

    Route::get('admin_products','AdminActivityController@admin_products')->name('admin_products');

    Route::get('admin_outlets','AdminActivityController@admin_outlets')->name('admin_outlets');
	
	Route::post('/getStatus', 'Product_detailsController@getStatus')->name('getStatus');

	Route::get('filter_brand','Brand_detailsController@filter_brand')->name('filter_brand');
	
	Route::get('trade_stock_report','ClientOutletReportController@trade_stock_report')->name('trade_stock_report');

    Route::post('filter_trade_report','ClientOutletReportController@filter_trade_report')->name('filter_trade_report');

	Route::get('monthly_bar_chart_client', 'HomeController@monthly_bar_chart_client')->name('monthly_bar_chart_client');

    Route::get('filter_bar_chart_client', 'HomeController@filter_bar_chart_client')->name('filter_bar_chart_client');
	

});


Route::group(['middleware' => App\Http\Middleware\AdminMiddleware::class ], function () {
	
	 Route::resource('client', 'ClientController',['except' => ['show']]);
    Route::resource('cde', 'CdeController',['except' => ['show']]);
    Route::resource('role', 'RoleController', ['except' => ['show', 'destroy']]);
    Route::resource('user', 'UserController', ['except' => ['show']]);
   

    Route::get('present_field','AdminActivityController@present_field')->name('present_field');
    Route::get('present_merchant','AdminActivityController@present_merchant')->name('present_merchant');
    Route::get('total_timesheets','AdminActivityController@total_timesheets')->name('total_timesheets');
    Route::get('filter_total_timesheet','AdminActivityController@filter_total_timesheet')->name('filter_total_timesheet');
    Route::get('today_timesheet','AdminActivityController@today_timesheet')->name('today_timesheet');
    Route::get('filter_today_timesheet','AdminActivityController@filter_today_timesheet')->name('filter_today_timesheet');
	 Route::get('absent_merchant','AdminActivityController@absent_merchant')->name('absent_merchant');
// Audit
	Route::resource('audit_trial_details', 'Audit_trial_detailsController', ['except' => ['show']]);
	Route::post('filter', 'Audit_trial_detailsController@filter')->name('filter');
	Route::get('export', 'Audit_trial_detailsController@export')->name('export');
	
	Route::get('monthly_bar_chart_admin', 'HomeController@monthly_bar_chart_admin')->name('monthly_bar_chart_admin');
    Route::get('filter_bar_chart_admin', 'HomeController@filter_bar_chart_admin')->name('filter_bar_chart_admin');
	Route::get('pie_chart_field', 'HomeController@pie_chart_field')->name('pie_chart_field');
	Route::get('filter_pie_monthly', 'HomeController@filter_pie_monthly')->name('filter_pie_monthly');

	
	Route::resource('manualcheckin', 'Manual_checkinController',['except' => ['show']]);  // hem
    Route::post('import_leave', 'EmployeeController@import_leave')->name('import_leave');
    Route::get('import', 'EmployeeController@import')->name('import');

 Route::get('show_leave_documents', 'LeaverequestController@show_leave_documents')->name('show_leave_documents');


	
});


Route::group(['middleware' => 'auth'], function () {

  

    Route::resource('category', 'CategoryController', ['except' => ['show']]);  
    Route::resource('tag', 'TagController', ['except' => ['show']]);  
    Route::resource('item', 'ItemController', ['except' => ['show']]);
    Route::resource('role', 'RoleController', ['except' => ['show', 'destroy']]);
    Route::resource('user', 'UserController', ['except' => ['show']]);   
    Route::resource('emp-leave-balance', 'EmpLeaveBalance', ['except' => ['show']]); 
    Route::resource('leaverequest', 'LeaverequestController', ['except' => ['show']]);
    Route::resource('emp-attendance', 'AttendanceController',['except' => ['show']]);
    Route::resource('timesheet-approval', 'TimesheetApprovalController',['except' => ['show']]);
    Route::resource('client', 'ClientController',['except' => ['show']]);
	Route::resource('product_details', 'Product_detailsController',['except' => ['show']]);
	Route::resource('dailyattendance', 'DailyattendanceController',['except' => ['show']]);
	
	Route::post('notification', [NotificationController::class, 'get_notification']);
    Route::post('notificationviwed', [NotificationController::class, 'viwed_notification']);
    Route::post('notification_single_viewdd', [NotificationController::class, 'single_viwed_notification']);
	 //Route::resource('calendar', 'FullCalenderController',['except' => ['show']]);
	Route::get('fullcalender', [FullCalenderController::class, 'index']);
    Route::post('fullcalenderAjax', [FullCalenderController::class, 'ajax']);
	
	Route::post('filter', 'DailyattendanceController@filter')->name('filter');
    Route::get('status','UserController@status')->name('status');

	
	Route::post('filter_audit', 'Audit_trial_detailsController@filter_audit')->name('filter_audit');
	

    Route::get('view_products','Product_detailsController@view_products');
	
	Route::get('/view_activity', 'DefinedOutletsController@view_activity');
    
    //Route::resource('working_days', 'WorkingdaysController',['except' => ['show']]);

    Route::get('checkin', 'EmployeeattendanceController@checkin')->name('checkin');
    Route::get('checkout', 'EmployeeattendanceController@checkout')->name('checkout');

    
    Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
    Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
    Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
  
    Route::get('show_documents', 'LeaverequestController@show_documents')->name('show_documents');

    Route::get('view_outletstock','Outlet_stockexpiryController@view_outletstock');

Route::get('show_leave_documents', 'LeaverequestController@show_leave_documents')->name('show_leave_documents');
 
   
    Route::get('rtl-support', ['as' => 'page.rtl-support', 'uses' => 'ExamplePagesController@rtlSupport']);
    Route::get('timeline', ['as' => 'page.timeline', 'uses' => 'ExamplePagesController@timeline']);
    Route::get('widgets', ['as' => 'page.widgets', 'uses' => 'ExamplePagesController@widgets']);
    Route::get('charts', ['as' => 'page.charts', 'uses' => 'ExamplePagesController@charts']);
    Route::get('calendar', ['as' => 'page.calendar', 'uses' => 'ExamplePagesController@calendar']);

    Route::get('buttons', ['as' => 'page.buttons', 'uses' => 'ComponentPagesController@buttons']);
    Route::get('grid-system', ['as' => 'page.grid', 'uses' => 'ComponentPagesController@grid']);
    Route::get('panels', ['as' => 'page.panels', 'uses' => 'ComponentPagesController@panels']);
    Route::get('sweet-alert', ['as' => 'page.sweet-alert', 'uses' => 'ComponentPagesController@sweetAlert']);
    Route::get('notifications', ['as' => 'page.notifications', 'uses' => 'ComponentPagesController@notifications']);
    Route::get('icons', ['as' => 'page.icons', 'uses' => 'ComponentPagesController@icons']);
    Route::get('typography', ['as' => 'page.typography', 'uses' => 'ComponentPagesController@typography']);
    
    Route::get('regular-tables', ['as' => 'page.regular_tables', 'uses' => 'TablePagesController@regularTables']);
    Route::get('extended-tables', ['as' => 'page.extended_tables', 'uses' => 'TablePagesController@extendedTables']);
    Route::get('datatable-tables', ['as' => 'page.datatable_tables', 'uses' => 'TablePagesController@datatableTables']);

    Route::get('regular-form', ['as' => 'page.regular_forms', 'uses' => 'FormPagesController@regularForms']);
    Route::get('extended-form', ['as' => 'page.extended_forms', 'uses' => 'FormPagesController@extendedForms']);
    Route::get('validation-form', ['as' => 'page.validation_forms', 'uses' => 'FormPagesController@validationForms']);
    Route::get('wizard-form', ['as' => 'page.wizard_forms', 'uses' => 'FormPagesController@wizardForms']);

    Route::get('google-maps', ['as' => 'page.google_maps', 'uses' => 'MapPagesController@googleMaps']);
    Route::get('fullscreen-maps', ['as' => 'page.fullscreen_maps', 'uses' => 'MapPagesController@fullscreenMaps']);
    Route::get('vector-maps', ['as' => 'page.vector_maps', 'uses' => 'MapPagesController@vectorMaps']);
  });


