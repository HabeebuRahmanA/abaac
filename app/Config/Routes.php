<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// Auth routes
service('auth')->routes($routes);

// Admin group
$routes->group('admin', ['filter' => 'group:superadmin'], function ($routes) {
    $routes->get('/', 'AdminController::index');
    $routes->get('users', 'AdminController::users');
    $routes->get('managers', 'AdminController::managers');
    $routes->get('unassigned-users', 'AdminController::unassignedusers');
    $routes->get('create-user', 'AdminController::create');
    $routes->post('save-user', 'AdminController::save');
    $routes->get('users/edit/(:segment)', 'AdminController::edit/$1');
    $routes->get('manager/users/(:segment)', 'AdminController::manager/$1');
    $routes->post('users/update/(:segment)', 'AdminController::update/$1');
    $routes->get('users/delete/(:segment)', 'AdminController::delete/$1');
    $routes->post('subscriptions/update/(:segment)', 'AdminController::updateSubscription/$1');
    $routes->get('users/plan/(:segment)', 'AdminController::plans/$1');
    $routes->get('users/plan/pay/(:segment)/(:segment)', 'AdminController::pay/$1/$2');
    $routes->get('purchase/confirm/(:segment)/(:segment)', 'AdminController::purchase_confirm/$1/$2');
    $routes->get('flats', 'AdminController::flats');
    $routes->get('flats/edit/(:num)', 'AdminController::flatEdit/$1');
    $routes->post('flats/update', 'AdminController::flatUpdate');
    $routes->post('flats/delete/(:num)', 'AdminController::flatDelete/$1');
});

// Customer group
$routes->group('customer', ['filter' => 'group:customer'], function ($routes) {
    $routes->get('/', 'CustomerController::index');
    $routes->get('subscription', 'CustomerController::index');
    $routes->get('plans', 'CustomerController::plans');
    $routes->get('pay/(:segment)', 'CustomerController::pay/$1');
    $routes->get('purchase/confirm/(:segment)', 'CustomerController::purchase_confirm/$1');
    $routes->get('account', 'CustomerController::account');
    $routes->post('saveDetails', 'CustomerController::save_AdditionalDetails');
});

// Manager group
$routes->group('manager', ['filter' => 'group:manager'], function ($routes) {
    $routes->get('/', 'ManagerController::index');
    $routes->get('customers/(:segment)', 'ManagerController::manager/$1');
    $routes->get('create-user', 'ManagerController::create');
    $routes->post('save-user', 'ManagerController::save');
    $routes->post('users/update/(:segment)', 'ManagerController::update/$1');
    $routes->get('users/delete/(:segment)', 'ManagerController::delete/$1');
    $routes->get('users/edit/(:segment)', 'ManagerController::edit/$1');
    $routes->post('subscriptions/update/(:segment)', 'ManagerController::updateSubscription/$1');
});

// Payment group
$routes->group('payment', function ($routes) {
    $routes->get('confirm/(:segment)', 'CustomerController::purchase_confirm/$1');
    $routes->get('initiate_payment', 'PaymentController::initiate_payment');
    $routes->get('success', 'PaymentController::success');
    $routes->post('callback', 'PaymentController::callback');
});
