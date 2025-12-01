<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->set404Override(function(){
    echo view('errors/html/error_404');
});
$routes->get('404', function(){
    echo view('errors/html/error_404');
});

$routes->get('/about-us', 'Home::about_us');
$routes->get('/contact-us', 'Home::contact_us');

// $routes->match(['get','post'],'/checkout', 'Home::checkout');
// $routes->match(['get','post'],'/paypal-payment-success', 'Home::paypal_payment_success');
// $routes->match(['get','post'],'/paypal-payment-cancel', 'Home::paypal_payment_cancel');
// $routes->match(['get','post'],'/paypal-payment-notification', 'Home::paypal_payment_notification');

// $routes->match(['get','post'],'/form', 'Home::formsubmit');

//front ajax
$routes->match(['get','post'],'/save_contact_us', 'Home::save_contact_us');


$routes->group('', ['filter' => 'AuthCheck'], function($routes){
    //Add all routes need protected by this filter
    $routes->match(['get', 'post'],'/logout', 'Auth::logout');
    $routes->match(['get', 'post'],'/profile', 'Auth::edit_profile');
    $routes->match(['get', 'post'],'/change-password', 'Auth::change_password');
    $routes->get('/admin', 'Admin::index');
    /****************************setting************************************ */
    $routes->match(['get','post'],'/admin/setting', 'Admin::setting');
    /*********************************Testimonial********************************* */
    $routes->get('/admin/testimonial', 'Admin::testimonial');
    $routes->match(['get','post'],'/admin/add_edit_testimonial', 'Admin::add_edit_testimonial');
    $routes->match(['get','post'],'/admin/add_edit_testimonial/(:num)', 'Admin::add_edit_testimonial/$1');
    $routes->match(['get','post'],'/admin/delete_testimonial/(:num)', 'Admin::delete_testimonial/$1');
    $routes->match(['get','post'],'/admin/remove_testimonial_image/(:num)', 'Admin::remove_testimonial_image/$1');
    /********************************Contact-us List******************************* */
    $routes->match(['get','post'],'/admin/contact-us-list', 'Admin::contact_us_list');
    /********************************Product Management******************************* */
    $routes->get('/admin/products', 'Admin::products');
    $routes->match(['get','post'],'/admin/product_cu', 'Admin::add_edit_product');
    $routes->match(['get','post'],'/admin/product_cu/(:num)', 'Admin::add_edit_product/$1');
    $routes->match(['get','post'],'/admin/product_cu/(:num)/(:num)', 'Admin::add_edit_product/$1/$2');


    // for file upload ajax 
    $routes->match(['get', 'post'],'image_upload_show_modal','Fileupload::image_upload_show_modal');
    $routes->match(['get', 'post'],'common_image_upload','Fileupload::common_image_upload');
    $routes->match(['get', 'post'],'get_image_gallary_by_ajax','Fileupload::get_image_gallary_by_ajax');
    $routes->match(['get', 'post'],'delete_image_by_ajax','Fileupload::delete_image_by_ajax');
    $routes->match(['get', 'post'],'admin/update_current_tab','Admin::update_current_tab');
    $routes->match(['get', 'post'],'admin/remove_image','Admin::remove_image');
    

});

$routes->group('', ['filter' => 'AuthCheck'], function($routes){
    $routes->get('/admin', 'Admin::index');
    $routes->add('/logout', 'Auth::logout');
});
$routes->group('', ['filter' => 'AlreadyLoggedIn'], function($routes){
    //Add all routes need protected after logged in
    $routes->match(['get','post'],'/'.ADMIN_LOGIN, 'Auth::login');
});
$routes->group('', ['filter' => 'NoAccessFilter'], function($routes){
    //Add all routes need protected from Direct Access
    $routes->get('/auth/login', 'Auth::login');
    $routes->get('/auth/logout', 'Auth::logout');
});

