<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

//  Public Routes
$routes->get('/', 'Home::home');
$routes->get('/home', 'Home::home');
$routes->post('search-ads', 'Home::search_ads');


//  Auth Routes (Login/Register)
$routes->group('', ['filter' => 'AlreadyLoggedIn'], function ($routes) {
    $routes->match(['get', 'post'], '/login', 'Users\Auth::login');
    $routes->match(['get', 'post'], '/register', 'Users\Auth::register');

    // WPS Admin Login
    $routes->match(['get', 'post'], '/wpsadmin', 'Admin\Auth::login');
    });
    

//  Logout Routes
// $routes->get('/logout', 'Admin\Auth::logout');
$routes->get('/logout', 'Users\Auth::logout');
$routes->match(['get', 'post'], '/admin/logout', 'Admin\Auth::logout');


//  Admin Panel Routes (Login Required)
$routes->group('', ['filter' => 'AuthCheck'], function ($routes) {

    // Dashboard
    $routes->get('/users/dashboard', 'Users\Dashboard::dashboard');
    $routes->get('/admin/dashboard', 'Admin\Dashboard::index');

    // Profile
    $routes->match(['get', 'post'], '/users/profile', 'Users\Auth::profile');
    $routes->match(['get', 'post'], '/admin/profile', 'Admin\Profile::index');
    $routes->match(['get', 'post'], '/admin/edit_profile/(:num)', 'Admin\Profile::edit_profile/$1');
    $routes->match(['get', 'post'], 'admin/profile/change_password', 'Admin\Profile::change_password');
    $routes->match(['get', 'post'], '/admin/updateProfile', 'Admin\Auth::updateProfile');

    // Property / Ads
    $routes->match(['get', 'post'], 'properties/category', 'Users\Items::category');
    $routes->match(['get', 'post'], 'properties/post-ad/(:any)', 'Users\Items::post_ad/$1');
    $routes->match(['get', 'post'], 'items/save-ad', 'Users\Items::save_ad');
    $routes->match(['get', 'post'], 'items/details/(:num)', 'Users\Items::item_details/$1');
    $routes->match(['get', 'post'], 'items/delete_ad/(:num)', 'Users\Items::delete_ad/$1');

    // Messages
    $routes->match(['get', 'post'], 'send-message', 'Users\Messages::send_message');
    $routes->match(['get', 'post'], 'messages', 'Users\Messages::view_messages');
    $routes->match(['get', 'post'], 'messages/chat/(:num)/(:num)', 'Users\Messages::view_messages/$1/$2');

});