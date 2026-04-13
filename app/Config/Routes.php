<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/home', 'Home::home');
$routes->post('search-ads', 'Home::search_ads');

$routes->match(['get','post'], '/login', 'Admin\Auth::login');
$routes->match(['get','post'], '/register', 'Admin\Auth::register');

$routes->get('/admin/_layouts/dashboard', 'Admin\Auth::dashboard');
$routes->get('/admin/admin_dashboard', 'Admin\Auth::admin_dashboard');
$routes->get('/logout', 'Admin\Auth::logout');
$routes->match(['get','post'], 'properties/category', 'Admin\Auth::category');
$routes->match(['get','post'], 'properties/post-ad/(:any)', 'Admin\Auth::post_ad/$1');
$routes->match(['get','post'], 'items/save-ad', 'Admin\Auth::save_ad');
$routes->match(['get','post'], 'items/details/(:num)', 'Admin\Auth::item_details/$1');
$routes->match(['get','post'], 'items/delete_ad/(:num)', 'Admin\Auth::delete_ad/$1');
/*****************************message***************************************/

$routes->match(['get','post'], 'send-message', 'Admin\Auth::send_message');

$routes->match(['get','post'], 'messages', 'Admin\Auth::view_messages');

$routes->match(['get','post'], 'messages/chat/(:num)/(:num)', 'Admin\Auth::view_messages/$1/$2');

$routes->match(['get','post'], '/admin/profile', 'Admin\Auth::profile');
$routes->match(['get','post'], '/admin/updateProfile', 'Admin\Auth::updateProfile');

$routes->group('', ['filter' => 'AlreadyLoggedIn'], function ($routes) {
    $routes->match(['get', 'post'], '/wpsadmin', 'Admin\Auth::admin_login');
});