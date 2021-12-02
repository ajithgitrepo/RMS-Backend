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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



Route::group(['middleware' => ['cors','json.response']], function () {
  
    // public routes
    Route::post('/login', 'Api\ApiAuthController@login')->name('login.api');
    Route::post('/register','Api\ApiAuthController@register')->name('register.api');

    Route::post('forgot_password', 'Api\PasswordResetController@forgot_password');
    Route::get('find/{token}', 'Api\PasswordResetController@find');
    Route::post('reset_password', 'Api\PasswordResetController@reset_password');
     Route::view('reset/{token}', 'auth.api.reset')->name('password.reset');

   
});

Route::middleware('auth:api')->group(function () {

    // our routes to be protected will go in here

    Route::group(['middleware' => ['cors','json.response']], function () {

        Route::post('/logout', 'Api\ApiAuthController@logout')->name('logout.api');

     //   Route::post('change_password', 'Api\ApiAuthController@change_password');

        //today jouney detail end points  
        Route::post('/today_planned_journey', 'Api\ApiJourneyPlanController@today_planned_journey')->name('today_planned_journey');

        Route::post('/today_completed_journey', 'Api\ApiJourneyPlanController@today_completed_journey')->name('today_completed_journey');

        Route::post('/today_skipped_journey', 'Api\ApiJourneyPlanController@today_skipped_journey')->name('today_skipped_journey');

         //week jouney detail end points 
        Route::post('/week_planned_journey', 'Api\ApiJourneyPlanController@week_planned_journey')->name('week_planned_journey');

        Route::post('/week_completed_journey', 'Api\ApiJourneyPlanController@week_completed_journey')->name('week_completed_journey');
       
        Route::post('/week_skipped_journey', 'Api\ApiJourneyPlanController@week_skipped_journey')->name('week_skipped_journey');

        //month jouney detail end points 
        Route::post('/complete_percentage', 'Api\ApiJourneyPlanController@complete_percentage')->name('complete_percentage');

        Route::post('/journey', 'Api\ApiJourneyPlanController@journey')->name('journey.api');

        Route::post('/dashboard_monthly', 'Api\ApiDashboardController@dashboard_monthly')->name('dashboard_monthly.api');
        
        Route::post('/dashboard_daily', 'Api\ApiDashboardController@dashboard_daily')->name('dashboard_daily.api');

        // add journey
        Route::post('/add_unscheduled_journeyplan', 'Api\ApiJourneyPlanController@add_unscheduled_journeyplan')->name('add_unscheduled_journeyplan.api');
		
		 Route::post('/add_scheduled_journeyplan', 'Api\ApiJourneyPlanController@add_scheduled_journeyplan')->name('add_scheduled_journeyplan.api');

		// delete_jpurney
        Route::post('/delete_journeyplan', 'Api\ApiJourneyPlanController@delete_journeyplan')->name('delete_journeyplan.api');
		
        // outlet full details  
        Route::post('/outlet_details', 'Api\ApiOutletController@outlet_details')->name('outlet_details.api');
        
        // add outlet
        Route::post('/add_outlet', 'Api\ApiOutletController@add_outlet')->name('add_outlet.api');
		
		        Route::post('/update_outlet', 'Api\ApiOutletController@update_outlet')->name('update_outlet.api');


        // Journy checin out update 
        Route::post('/check_in_out', 'Api\ApiOutletController@check_in_out')->name('check_in_out.api');

        // Time Sheet Monthly  
        Route::post('/timesheet_monthly', 'Api\ApiJourneyPlanController@timesheet_monthly')->name('timesheet_monthly.api');

        // Time Sheet Daily 
        Route::post('/timesheet_daily', 'Api\ApiJourneyPlanController@timesheet_daily')->name('timesheet_daily.api');
		
		// Time Sheet date 
        Route::post('/timesheet_by_date', 'Api\ApiJourneyPlanController@timesheet_by_date')->name('timesheet_by_date.api');

         // attendance    

         Route::post('/attendance_monthly', 'Api\ApiAttendanceController@attendance_monthly')->name('attendance_monthly.api');
		
		 Route::post('/attendance_daily', 'Api\ApiAttendanceController@attendance_daily')->name('attendance_daily.api');
		
		 Route::post('/attendance_in', 'Api\ApiAttendanceController@attendance_in')->name('attendance_in.api');
       
        Route::post('/attendance_out', 'Api\ApiAttendanceController@attendance_out')->name('attendance_out.api');
          
         // Leave
        // dd(\Route::getCurrentRoute());
         
        Route::post('/leave_request', 'Api\ApiLeaveController@leave_request')->name('leave_request.api');

        Route::post('/leave_details', 'Api\ApiLeaveController@leave_details')->name('leave_details.api');
    
        Route::post('/leave_details_view_by_fieldmanager', 'Api\ApiLeaveController@leave_details_view_by_fieldmanager')->name('leave_details_view_by_fieldmanager.api');
    
        Route::post('/update_leave_rule', 'Api\ApiLeaveController@update_leave_rule')->name('update_leave_rule.api');

        Route::post('/leave_rule_details', 'Api\ApiLeaveController@leave_rule_details')->name('leave_rule_details.api');

         
         // Employee
         Route::post('/employee_details', 'Api\ApiEmployeeDetailsController@employee_details')->name('employee_details.api');

         Route::post('/change_password', 'Api\ApiEmployeeDetailsController@change_password')->name('change_password.api');

         Route::post('/all_roles', 'Api\ApiEmployeeDetailsController@all_roles')->name('all_roles.api');
		
		 Route::post('/update_employee', 'Api\ApiEmployeeDetailsController@update_employee')->name('update_employee.api');
		
	         Route::post('/employee_details_by_role', 'Api\ApiEmployeeDetailsController@employee_details_by_role')->name('employee_details_by_role.api');


      // Reporting To  
         Route::post('/employee_details_for_report', 'Api\ApiEmployeeDetailsController@employee_details_for_report')->name('employee_details_for_report.api');

         Route::post('/add_reporting', 'Api\ApiReportingToController@add_reporting')->name('add_reporting.api');

         Route::post('/reporting_to_details', 'Api\ApiReportingToController@reporting_to_details')->name('reporting_to_details.api');

         // Holidays
         Route::post('/add_holidays', 'Api\ApiHoliDaysController@add_holidays')->name('add_holidays.api');

         Route::post('/holidays_details', 'Api\ApiHoliDaysController@holidays_details')->name('holidays_details.api');
  
         /****** HR *****/ 

         Route::post('/hr_dashboard', 'Api\ApiHrDashboardController@hr_dashboard')->name('hr_dashboard.api');

         Route::post('/outlet_chart', 'Api\ApiDashboardController@outlet_chart')->name('outlet_chart.api');
		
		         Route::post('/outlet_expected_outlet_chart', 'Api\ApiDashboardController@outlet_expected_outlet_chart')->name('outlet_expected_outlet_chart.api');

         
        /**** Field Manager  *****/ 

        Route::post('/merchandiser_under_fieldmanager_details', 'Api\ApiReportingToController@merchandiser_under_fieldmanager_details')->name('merchandiser_under_fieldmanager_details.api');

        Route::post('/fieldmanager_dashboard', 'Api\ApiFieldManagerDashboardController@fieldmanager_dashboard')->name('fieldmanager_dashboard.api');
		
		  Route::post('/add_employee', 'Api\ApiEmployeeDetailsController@add_employee')->name('add_employee.api');
 
        // Store

        Route::post('/add_store', 'Api\ApiStoreController@add_store')->name('add_store.api');

        Route::post('/store_details', 'Api\ApiStoreController@store_details')->name('store_details.api');

        Route::post('/merchandiser_leave_details', 'Api\ApiLeaveController@merchandiser_leave_details')->name('merchandiser_leave_details.api');
		
		  Route::post('/leave_accept_reject', 'Api\ApiLeaveController@leave_accept_reject')->name('leave_accept_reject.api');
		
		 // Brand

        Route::post('/brand_details', 'Api\ApiBrandController@brand_details')->name('brand_details.api');

        Route::post('/add_brand', 'Api\ApiBrandController@add_brand')->name('add_brand.api');

   // category    

          Route::post('/category_details', 'Api\ApiCategoryController@category_details')->name('category_details.api');

          Route::post('/add_category', 'Api\ApiCategoryController@add_category')->name('add_category.api');
		
		 // Product

          Route::post('/product_details', 'Api\ApiProductController@product_details')->name('product_details.api');

          Route::post('/add_product', 'Api\ApiProductController@add_product')->name('add_product.api');
    
    // outlet product mapping 
          Route::post('/add_outlet_brand_mapping', 'Api\ApiOutletBrandMappingController@add_outlet_brand_mapping')->name('add_outlet_brand_mapping.api');
          
          Route::post('/outlet_brand_mapping_details', 'Api\ApiOutletBrandMappingController@outlet_brand_mapping_details')->name('outlet_brand_mapping_details.api');
		
		          Route::post('/fieldmanager_add_outlet_category_mapping', 'Api\ApiOutletBrandMappingController@fieldmanager_add_outlet_category_mapping')->name('fieldmanager_add_outlet_category_mapping.api');
		
		          Route::post('/fieldmanager_add_outlet_shareofself', 'Api\ApiOutletBrandMappingController@fieldmanager_add_outlet_shareofself')->name('fieldmanager_add_outlet_shareofself.api');

          Route::post('/fieldmanager_add_outlet_planogram', 'Api\ApiOutletBrandMappingController@fieldmanager_add_outlet_planogram')->name('fieldmanager_add_outlet_planogram.api');
		
		          Route::post('/delete_outlet_products_mapping', 'Api\ApiOutletBrandMappingController@delete_outlet_products_mapping')->name('delete_outlet_products_mapping.api');


	
		// availability

         Route::post('/availability_details', 'Api\ApiAvailabilityController@availability_details')->name('availability_details.api');

         Route::post('/add_availability', 'Api\ApiAvailabilityController@add_availability')->name('add_availability.api');
		
		// visibility

         Route::post('/visibility_details', 'Api\ApiVisibilityController@visibility_details')->name('visibility_details.api');
		
		         Route::post('/add_visibility', 'Api\ApiVisibilityController@add_visibility')->name('add_visibility.api');
		
		 // Pano  

         Route::post('/Planogram_details', 'Api\ApiPlanogramCheckController@Planogram_details')->name('Planogram_details.api');
     
                 Route::post('/add_planogram', 'Api\ApiPlanogramCheckController@add_planogram')->name('add_Planogram.api');
		
		
		 // Share of self  

          Route::post('/share_of_shelf_details', 'Api\ApiShareOfShelfController@share_of_shelf_details')->name('share_of_shelf_details.api');
     
          Route::post('/add_share_of_shelf', 'Api\ApiShareOfShelfController@add_share_of_shelf')->name('add_share_of_shelf.api');
		
		 // competition  

         Route::post('/competition_details', 'Api\ApiCompetitionController@competition_details')->name('competition_details.api');
     
         Route::post('/add_competition', 'Api\ApiCompetitionController@add_competition')->name('add_competition.api');
		
		         Route::post('/add_competitor_visibility', 'Api\ApiCompetitionController@add_competitor_visibility')->name('add_competitor_visibility.api');

// promotion

        Route::post('/fieldmanager_view_promotion_details', 'Api\ApiPromotionController@fieldmanager_view_promotion_details')->name('fieldmanager_view_promotion_details.api');
		
          Route::post('/fieldmanager_add_promotion', 'Api\ApiPromotionController@fieldmanager_add_promotion')->name('fieldmanager_add_promotion.api');
		
		        Route::post('/fieldmanager_get_promotion_products_details', 'Api\ApiPromotionController@fieldmanager_get_promotion_products_details')->name('fieldmanager_get_promotion_products_details.api');
		
	        Route::post('/merchandiser_view_updated_promotion__details', 'Api\ApiPromotionController@merchandiser_view_updated_promotion__details')->name('merchandiser_view_updated_promotion__details.api');
		
		 Route::post('/merchandiser_add_promotion__details', 'Api\ApiPromotionController@merchandiser_add_promotion__details')->name('merchandiser_add_promotion__details.api');
		
		 Route::post('/merchandiser_view_updated_promotion_check_details', 'Api\ApiPromotionController@merchandiser_view_updated_promotion_check_details')->name('merchandiser_view_updated_promotion_check_details.api');

// Week Off 

       Route::post('/add_week_off', 'Api\ApiWeekOffController@add_week_off')->name('add_week_off.api');
        
       Route::post('/week_off_details', 'Api\ApiWeekOffController@week_off_details')->name('week_off_details.api');
		
		  // Task outlet_task_details

       Route::post('/add_outlet_task', 'Api\ApiOutletTaskController@add_outlet_task')->name('add_outlet_task.api');
        
       Route::post('/outlet_task_details', 'Api\ApiOutletTaskController@outlet_task_details')->name('outlet_task_details.api');

	       Route::post('/send_outlet_task_response', 'Api\ApiOutletTaskController@send_outlet_task_response')->name('send_outlet_task_response.api');
		
		 Route::post('/fieldmanager_view_outlet_task_response', 'Api\ApiOutletTaskController@fieldmanager_view_outlet_task_response')->name('fieldmanager_view_outlet_task_response.api');
		
		 Route::post('/active_outlet_task', 'Api\ApiOutletTaskController@active_outlet_task')->name('active_outlet_task.api');
		
		  Route::post('/de_active_outlet_task', 'Api\ApiOutletTaskController@de_active_outlet_task')->name('de_active_outlet_task.api');
		
		
       // stock 

     //  Route::post('/stock_expiry_details', 'Api\ApiOutletStockExpiryController@stock_expiry_details')->name('stock_expiry_details.api');

    //   Route::post('/stock_product_details', 'Api\ApiOutletStockExpiryController@stock_product_details')->name('stock_product_details.api');
       
        //    Route::post('/add_stock_expiry', 'Api\ApiOutletStockExpiryController@add_stock_expiry')->name('add_stock_expiry.api');
		
		 // stock  new

       Route::post('/stock_expiry_details_new', 'Api\ApiOutletStockExpiryController@stock_expiry_details_new')->name('stock_expiry_details_new.api');

       Route::post('/stock_product_details_new', 'Api\ApiOutletStockExpiryController@stock_product_details_new')->name('stock_product_details_new.api');
       
            Route::post('/add_stock_expiry_new', 'Api\ApiOutletStockExpiryController@add_stock_expiry_new')->name('add_stock_expiry_new.api');

		        Route::post('/merchandiser_view_updated_stock_expirey_details', 'Api\ApiOutletStockExpiryController@merchandiser_view_updated_stock_expirey_details')->name('merchandiser_view_updated_stock_expirey_details.api');

		 // NBL
       Route::post('/fieldmanager_add_outlet_nbl', 'Api\ApiOutletBrandMappingController@fieldmanager_add_outlet_nbl')->name('fieldmanager_add_outlet_nbl.api');
      
       Route::post('/fieldmanager_view_outlet_nbl_details', 'Api\ApiOutletBrandMappingController@fieldmanager_view_outlet_nbl_details')->name('fieldmanager_view_outlet_nbl_details.api');
		
		// Client

        Route::post('/client_view_outlet_details', 'Api\ApiClientOutletReportController@client_view_outlet_details')->name('client_view_outlet_details.api');
		
		 Route::post('/client_view_outlet_visibility_details', 'Api\ApiClientOutletReportController@client_view_outlet_visibility_details')->name('client_view_outlet_visibility_details.api');
		
		Route::post('/client_view_outlet_planogram_details', 'Api\ApiClientOutletReportController@client_view_outlet_planogram_details')->name('client_view_outlet_planogram_details.api');
		
		Route::post('/client_view_outlet_visibility_details', 'Api\ApiClientOutletReportController@client_view_outlet_visibility_details')->name('client_view_outlet_visibility_details.api');
		
		Route::post('/client_view_outlet_shareofself_details', 'Api\ApiClientOutletReportController@client_view_outlet_shareofself_details')->name('client_view_outlet_shareofself_details.api');
		
		Route::post('/client_view_outlet_promotion_check_details', 'Api\ApiClientOutletReportController@client_view_outlet_promotion_check_details')->name('client_view_outlet_promotion_check_details.api');
		
		Route::post('/client_view_outlet_stock_expirey_details', 'Api\ApiClientOutletReportController@client_view_outlet_stock_expirey_details')->name('client_view_outlet_stock_expirey_details.api');
		
		Route::post('/client_view_outlet_competitior_info_details', 'Api\ApiClientOutletReportController@client_view_outlet_competitior_info_details')->name('client_view_outlet_competitior_info_details.api');

	// outlet survey	
		Route::post('/outlet_survey_details', 'Api\ApiOutletSurveyController@outlet_survey_details')->name('outlet_survey_details.api');
		
		Route::post('/add_outlet_survey', 'Api\ApiOutletSurveyController@add_outlet_survey')->name('add_outlet_survey.api');
		
		Route::post('/add_force_checkin', 'Api\ApiOutletSurveyController@add_force_checkin')->name('add_force_checkin.api');
		
				Route::post('/add_unfinished_outlet_reason', 'Api\ApiOutletSurveyController@add_unfinished_outlet_reason')->name('add_unfinished_outlet_reason.api');

	
 // outlet journey time
      
		Route::post('/outlet_journey_check_in_out', 'Api\ApiOutletSurveyController@outlet_journey_check_in_out')->name('outlet_journey_check_in_out.api');
       
		Route::post('/outlet_journey_time_details', 'Api\ApiOutletSurveyController@outlet_journey_time_details')->name('outlet_journey_time_details.api');
		
	 // Notification
		Route::post('/view_notification_details', 'Api\ApiNotificationController@view_notification_details')->name('view_notification_details.api');
		
		Route::post('/make_notification_viewed', 'Api\ApiNotificationController@make_notification_viewed')->name('make_notification_viewed.api');
		
		Route::post('/make_notification_all_viewed', 'Api\ApiNotificationController@make_notification_all_viewed')->name('make_notification_all_viewed.api');
		
		Route::post('/add_audit_trails_mobile', 'Api\ApiNotificationController@add_audit_trails_mobile')->name('add_audit_trails_mobile.api');

				Route::post('/view_audit_trails_details', 'Api\ApiNotificationController@view_audit_trails_details')->name('view_audit_trails_details.api');

		
		 // Reliver

		Route::post('/view_reliver_details', 'Api\ApiRelieverController@view_reliver_details')->name('view_reliver_details.api');
          
		Route::post('/search_reliver', 'Api\ApiRelieverController@search_reliver')->name('search_reliver.api');

		Route::post('/add_reliver', 'Api\ApiRelieverController@add_reliver')->name('add_reliver.api');
		
		// Report
		Route::post('/add_excel_report', 'Api\ApiExcelReportController@add_excel_report')->name('add_excel_report.api');
		
		Route::post('/excel_report_details', 'Api\ApiExcelReportController@excel_report_details')->name('excel_report_details.api');
		
		 // Track Employee
        Route::post('/add_emp_location', 'Api\ApiEmployeeDetailsController@add_emp_location')->name('add_emp_location.api');
		
		Route::post('/track_employee_location_details', 'Api\ApiEmployeeDetailsController@track_employee_location_details')->name('track_employee_location_details.api');
		
		 // CDE Reporting To  
         Route::post('/merchandiser_under_cde_details', 'Api\ApiCdeController@merchandiser_under_cde_details')->name('merchandiser_under_cde_details.api');

         Route::post('/add_cde', 'Api\ApiCdeController@add_cde')->name('add_cde.api');

         Route::post('/cde_reporting_to_details', 'Api\ApiCdeController@cde_reporting_to_details')->name('cde_reporting_to_details.api');
         
          Route::post('/cde_dashboard', 'Api\ApiCdeDashboardController@cde_dashboard')->name('cde_dashboard.api');
    
         Route::post('/cde_timesheet_approval', 'Api\ApiCdeDashboardController@cde_timesheet_approval')->name('cde_timesheet_approval.api');
		
	
	});


});

