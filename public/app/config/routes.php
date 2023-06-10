<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author		Jack Devians
 * @copyright	Merlinbox Digital Solution
 * @link		https://merlinbox.com
*/

$route['default_controller'] = 'dashboard';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['app-settings'] = "configuration";

// Users
$route['register'] = "userbase/login/register";
$route['login'] = "userbase/login";
$route['logout'] = "userbase/login/logout";
$route['enter-app'] = "userbase/login/enter_app";

$route['manage-users'] = "userbase/users";
$route['users/load_data'] = "userbase/users/load_data";

$route['users/add'] = "userbase/operation/add";
$route['users/edit'] = "userbase/operation/edit";
$route['users/delete'] = "userbase/operation/delete";

$route['account-settings'] = "userbase/users/settings";

$route['users/save_password'] = "userbase/users/save_password";
$route['users/save_profile'] = "userbase/users/save_profile";

// Dashboard
$route['dashboard/(:any)'] = "dashboard/index/$1";