<?php

	defined('BASEPATH') OR exit('No direct script access allowed');

	$route['company/view/(.+)'] = 'Companies/view_company/$1';
	
	$route['default_controller'] = 'Homepage';
	$route['login'] = 'Accounts/login_page';
	$route['logout'] = 'Accounts/logout';
	$route['register'] = 'Accounts/register_page';
	$route['forgot-password'] = 'Accounts/forgot_password';
	$route['activate'] = 'Accounts/activate_page';
	$route['activate/([A-Z0-9]{5})'] = 'Accounts/activate_page/$1';

	$route['projects/view/(.+)'] = 'Projects/view_project/$1';
	$route['projects/delete/([A-Z0-9])'] = 'Projects/delete_project/$1';
	$route['projects/view/([A-Z0-9])/([A-Z0-9])'] = 'Projects/view_project_task/$1/$2';
	$route['404_override'] = '';
	$route['translate_uri_dashes'] = FALSE;
	$route['knowledge-base'] = 'Knowledge_Base/index';
	
	/*
	| ACCOUNTS
	*/
	$route['profile']				=	'accounts/profile';
	$route['accounts/view/(:any)'] 	= 	'accounts/view_account/$1';

	/*
	| COMPANIES
	*/
