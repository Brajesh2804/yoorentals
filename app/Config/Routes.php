<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

//  Public Routes
$routes->get('/', 'Home::home');
$routes->get('/home', 'Home::home');
$routes->post('searchAds', 'Home::search_ads');


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
    $routes->get('admin/members/adminindex', 'Admin\Dashboard::admins');
    $routes->get('admin/members/edit_admin/(:num)', 'Admin\Dashboard::editAdmin/$1');
    $routes->match(['get','post'],'admin/members/edit_admin/(:num)','Admin\Dashboard::editAdmin/$1');
    $routes->match(['get','post'],'admin/members/view_admin/(:num)','Admin\Dashboard::viewAdmin/$1');
    $routes->match(['get','post'],'admin/members/add_admin','Admin\Dashboard::addAdmin');

    $routes->match(['get','post'],'admin/members/delete_admin/(:num)','Admin\Dashboard::deleteAdmin/$1');

    $routes->get('admin/members/user', 'Admin\Dashboard::members');
    $routes->get('admin/members/view/(:num)', 'Admin\Dashboard::viewMember/$1');
    $routes->get('admin/members/edit/(:num)', 'Admin\Dashboard::editMember/$1');
    $routes->get('admin/members/delete/(:num)', 'Admin\Dashboard::deleteMember/$1');


    $routes->get('users/members/userindex', 'Admin\Dashboard::users');
    $routes->get('users/members/view_user/(:num)', 'Admin\Dashboard::viewUser/$1');
    $routes->get('users/members/user_ads/(:num)', 'Admin\Dashboard::userAds/$1');
    $routes->match(['get','post'],'users/members/block_user/(:num)','Admin\Dashboard::blockUser/$1');
    $routes->match(['get','post'],'users/members/edit_user/(:num)','Admin\Dashboard::editUser/$1');
    $routes->get('users/members/unblock_user/(:num)', 'Admin\Dashboard::unblockUser/$1');
    $routes->get('users/members/delete_user/(:num)', 'Admin\Dashboard::deleteUser/$1');
    $routes->get('users/members/adsindex', 'Admin\Dashboard::allAds');





    // Profile
    $routes->match(['get', 'post'], '/users/profile', 'Users\Profile::profile');
    $routes->post('users/updateProfile', 'Users\Profile::updateProfile');

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

    //About
    $routes->match(['get', 'post'], 'about', 'Home::about');
    $routes->match(['get', 'post'], 'privacy-policy', 'Home::privacy');
    $routes->match(['get', 'post'], 'terms', 'Home::terms');
    $routes->match(['get', 'post'], 'contact', 'Home::contact');

    $routes->match(['get','post'], 'subscribe', 'Home::subscribe');

});

$routes->get('authentication-failed', 'Home::authenticationFailed');