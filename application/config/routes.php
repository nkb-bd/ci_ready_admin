<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'welcome';

$route['404_override']         = 'errors/error404';
$route['translate_uri_dashes'] = TRUE;

$route['login']                = 'user/login';
$route['logout']               = 'user/logout';
$route['dashboard']            = 'admin/dashboard';
$route['user']                 = 'User_controller/dashboard';

$route['sitemap\.xml']         = 'sitemap';


// user
$route['register'] = 'user/register/';

// common
$route['category'] = "welcome/all_category";
$route['category/(:any)'] = "welcome/category_single_view/$1";
$route['sub_category/(:any)/(:any)'] = "welcome/sub_category_single_view/$1/$2";
$route['browse_jobs'] = "welcome/browse_jobs";
$route['search'] = "welcome/search/";


// error page
$route['404_override'] = 'welcome/error_page';