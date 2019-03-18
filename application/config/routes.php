<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['login'] 				= 'basics/login';
$route['logout']                = 'basics/logout';
$route['switch_lang']           = 'basics/swich_lang';
$route['lock_screen']    		= 'basics/lock_screen_view';
$route['screen_lock']    		= 'basics/lock_screen_fun';


$route['roles']                 = 'panel/permissions/get_roles';
$route['add_role']              = 'panel/permissions/add_new_role';
$route['edit_emps/(:num)']      = 'panel/permissions/edit_role_emps/$1';
$route['edit_pers/(:num)']      = 'panel/permissions/edit_role_perts/$1';
$route['edit_desc/(:num)']      = 'panel/permissions/edit_role_data/$1';



$route['home']			= 'welcome';
$route['sons/(:any)']	= 'welcome/get_sons/$1';


$route['create_user']            		 = 'panel/user/create_new_emp';
$route['create_new_user']          		 = 'panel/user/admin_new_emp';
$route['change_password']          		 = 'panel/user/change_password';
$route['employees']              		 = 'panel/user/employees_list';
$route['fire_emp/(:num)']        		 = 'panel/user/fire_employee/$1';
$route['edit_salary/(:num)']     		 = 'panel/user/edit_emp_salary/$1';
$route['edit_emp/(:num)']        		 = 'panel/user/edit_basic_emp_info/$1';
$route['emp_details/(:num)']     		 = 'panel/user/all_user_details/$1';
$route['sus_emps']    			 		 = 'panel/user/suspended_employees';
$route['restore_emp/(:num)']	 		 = 'panel/user/restore_employee/$1';
$route['check_usrnm_emp/(:any)'] 		 = 'panel/user/get_username_emp/$1';
$route['charts'] 				 		 = 'panel/user/charts';
$route['user_info'] 		 	 		 = 'panel/user/user_info';
$route['edit_request'] 		 	 		 = 'panel/user/edit_emp_data';
$route['edit_request_data/(:num)'] 		 = 'panel/user/edit_emp/$1';
$route['pay_login'] 					 = 'panel/user/payment_login';
$route['admin_edit_request'] 	 		 = 'panel/user/admin_edit_emp';
$route['admin_edit_request_data/(:num)'] = 'panel/user/admin_edit_emp_r/$1';
$route['add_course_cat'] 	 	      	 = 'panel/user/insert_courses_cats';
$route['courses_cat'] 	 	  		  	 = 'panel/user/courses_cat';
$route['insert_tutors'] 	 	 	  	 = 'panel/user/insert_tutors';
$route['courses/(:num)']   			  	 = 'panel/user/courses_list/$1';
$route['add_course/(:num)']   		  	 = 'panel/user/insert_courses/$1';
$route['courses_levels/(:num)']   	  	 = 'panel/user/courses_levels/$1';
$route['add_courses_levels/(:num)']   	 = 'panel/user/insert_courses_levels/$1';
$route['edit_level/(:num)/(:num)']   	 = 'panel/user/edit_courses_levels/$1/$2';
$route['activate/(:num)'] 			  	 = 'panel/user/activate_cat/$1';
$route['activate_co/(:num)'] 		  	 = 'panel/user/activate_course/$1';
$route['activate_lev/(:num)'] 		  	 = 'panel/user/activate_c_lev/$1';
$route['register_course']			  	 = 'panel/user/register_s2';
$route['reg_course']			  	 	 = 'panel/user/register_new_course';
$route['get_courses/(:num)']			 = 'panel/user/get_courses/$1';
$route['get_lvls/(:num)']			 	 = 'panel/user/get_lvls/$1';
$route['get_std_lev/(:num)']			 = 'panel/user/std_levl_list/$1';
$route['update_comm']			 	 	 = 'panel/user/update_comm_maqu';
$route['activate_st/(:num)/(:num)']		 = 'panel/user/activate_std_levl/$1/$2';
$route['activate_role/(:num)']			 = 'panel/user/activate_std_role/$1';
$route['week_comms']			 	 	 = 'panel/user/get_week_comms';
$route['week_comms/(:num)']			 	 = 'panel/user/get_week_comms/$1';
$route['week_studs']			 	 	 = 'panel/user/get_week_studs';
$route['week_studs/(:num)']			 	 = 'panel/user/get_week_studs/$1';
$route['students']			 			 = 'panel/user/students_list';
$route['user_details/(:num)']			 = 'panel/user/user_details/$1';
$route['statics']			 			 = 'panel/user/get_statics';
$route['edit_student/(:num)']			 = 'panel/user/edit_student/$1';
$route['unpaid_statics']		 		 = 'panel/user/get_unpaid_statics';
$route['user_course/(:num)']		 	 = 'panel/user/user_course/$1';
$route['stop_student/(:num)/(:num)']	 = 'panel/user/stop_student/$1/$2';
$route['stop_agency/(:num)/(:num)']		 = 'panel/user/stop_agency/$1/$2';
$route['send_message']	 				 = 'panel/user/send_message';
$route['send_message/(:num)']	 		 = 'panel/user/send_message/$1';
$route['pend_all_level/(:num)']	 		 = 'panel/user/pend_all_level/$1';


$route['export_level_students/(:num)']	 = 'panel/excel/export_level_students/$1';

//test 

$route['convert_balance']    = 'panel/payments';
$route['std_list']    		 = 'Basics/all_std';



$route['payments']    		  = 'panel/payments/transfer_bank_ops';
$route['transfer']    		  = 'panel/payments/trans_comm_op';
$route['pending_pays']    	  = 'panel/payments/pending_payments';
$route['my_pending_pays']	  = 'panel/payments/my_pending_payments';
$route['approve_pay/(:num)']  = 'panel/payments/approve_payment/$1';
$route['cancel_pay/(:num)']   = 'panel/payments/cancel_payment/$1';
$route['change_pay_password'] = 'panel/payments/change_pay_password';     


$route['get_notifications']   	= 'panel/notifications/get_notifications';
$route['read_notifications']	= 'panel/notifications/read_notifications';
$route['notifications']  	 	= 'panel/notifications/notifications';
$route['get_more_notifs']  	    = 'panel/notifications/get_more_notifications';

//SITE
$route['sliders_list']			 = 'panel/manage/get_sliders';
$route['tutor_list']			 = 'panel/manage/get_tutors';
$route['sliders']				 = 'panel/manage/sliders_manage';
$route['news'] 				 	 = 'panel/manage/news_manage';
$route['news_list']			 	 = 'panel/manage/get_news';
$route['prods'] 				 = 'panel/manage/prods_manage';
$route['prods_list']			 = 'panel/manage/get_prods';
$route['edit_slider/(:num)']	 = 'panel/manage/edit_slider/$1';
$route['del_slide/(:num)']		 = 'panel/manage/del_slide/$1';
$route['edit_news/(:num)']	 	 = 'panel/manage/edit_news/$1';
$route['del_news/(:num)']		 = 'panel/manage/del_news/$1';
$route['edit_prod/(:num)']	 	 = 'panel/manage/edit_prod/$1';
$route['del_prod/(:num)']		 = 'panel/manage/del_prod/$1';
$route['active_slider/(:num)'] 	 = 'panel/manage/activate_slider/$1';
$route['active_news/(:num)']	 = 'panel/manage/activate_news/$1';
$route['active_prod/(:num)']	 = 'panel/manage/activate_prods/$1';
$route['highlight_news/(:num)']	 = 'panel/manage/highlight_news/$1';
$route['highlight_prod/(:num)']	 = 'panel/manage/highlight_prods/$1';
$route['basics']	 	 		 = 'panel/manage/edit_basic_data';
$route['active_tutor/(:num)']	 = 'panel/manage/activate_tutor/$1';
$route['del_tutor/(:num)']		 = 'panel/manage/del_tutor/$1';
$route['tutors']				 = 'panel/manage/tutors_manage';
$route['edit_tutor/(:num)']		 = 'panel/manage/edit_tut/$1';
$route['edit_services']			 = 'panel/manage/edit_services';
$route['edit_social']			 = 'panel/manage/edit_social';
$route['about_us']				 = 'panel/manage/about_us';
$route['contact_us']				 = 'panel/manage/edit_contact_us';




