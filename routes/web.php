<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

/** ------------------------------------------
 *  Admin Routes
 *  ------------------------------------------
 */

Route::group(array('prefix' => 'admin'), function() {

    Route::get('/', array('middleware' => 'guest.admin', 'uses' => 'Admin\LoginController@getIndex'));
    Route::get('logout', array('uses' => 'Admin\LoginController@doLogout'));
    Route::post('login', array('uses' => 'Admin\LoginController@doLogin'));
        
    // Password Reset Routes...
    Route::get('password/reset', array('uses'=>'Admin\ForgotPasswordController@showLinkRequestForm', 'as'=>'admin.password.email'));
    Route::post('password/email', array('uses'=>'Admin\ForgotPasswordController@sendResetLinkEmail', 'as'=>'admin.password.email'));
    Route::get('password/reset/{token}', array('uses'=>'Admin\ResetPasswordController@showResetForm', 'as'=>'admin.password.reset'));
    Route::post('password/reset', array('uses'=>'Admin\ResetPasswordController@reset', 'as'=>'admin.password.reset'));

    //after login
    Route::group(array('middleware' => 'auth.admin'), function() {

        Route::get('dashboard', 'Admin\DashboardController@index');

        #Page Management
        Route::get('pages/PagesData', 'Admin\PagesController@getPagesData');
        Route::post('pages/changeStatus', 'Admin\PagesController@changePageStatus');
        Route::resource('pages', 'Admin\PagesController');
       
        #Settings Management
        Route::resource('settings', 'Admin\SettingsController');
       
        #Admin Profile Management
        Route::resource('profile', 'Admin\ProfileController');
        
        #Admin password change
        Route::get('password/change', array('uses' => 'Admin\ProfileController@changePassword', 'as' => 'admin.password.change'));
        Route::post('password/change', array('uses' => 'Admin\ProfileController@updatePassword', 'as' => 'admin.password.change'));
       
        #Admin Metadata Management
        Route::get('metadata/getMetadataData', 'Admin\MetadataController@getMetadataData');
        Route::resource('metadata', 'Admin\MetadataController');
        
        #Slider Management
        Route::get('sliders/SlidersData', 'Admin\SlidersController@getSlidersData');
        Route::post('sliders/changeStatus', 'Admin\SlidersController@changeSliderStatus');
        Route::resource('sliders','Admin\SlidersController');
        
        #Portfolio Category Management
        Route::get('category/CategoryData', 'Admin\CategoryController@getCategoryData');
        Route::post('category/changeStatus', 'Admin\CategoryController@changeCategoryStatus');
        Route::resource('category', 'Admin\CategoryController');
        
        #Portfolio Management
        Route::get('portfolio/PortfolioData', 'Admin\PortfolioController@getPortfolioData');
        Route::post('portfolio/changeStatus', 'Admin\PortfolioController@changePortfolioStatus');
        Route::resource('portfolio','Admin\PortfolioController');
        
        #Active Request Management
        Route::get('active/ActiveData', 'Admin\ActiveController@getActiveData');
        Route::resource('active', 'Admin\ActiveController');

        #Flagged Management
        Route::get('flagged/FlaggedData', 'Admin\FlaggedController@getFlaggedData');
        Route::resource('flagged', 'Admin\FlaggedController');

        #Closed Management
        Route::get('closed/ClosedData', 'Admin\ClosedController@getClosedData');
        Route::resource('closed', 'Admin\ClosedController');

        #Praise Management
        Route::get('praise/PraiseData', 'Admin\PraiseController@getPraiseData');
        Route::resource('praise', 'Admin\PraiseController');
        
        #Banned Management
        Route::resource('banned', 'Admin\BannedController');
        Route::get('banned/BannedData', 'Admin\BannedController@getBannedData');
    });
});

/** ------------------------------------------
 *  Frontend Routes
 *  ------------------------------------------
 */
Route::get('/', 'Frontend\HomeController@getIndex');
Route::get('team', 'Frontend\HomeController@getTeam');
Route::get('services', 'Frontend\HomeController@getServices');
Route::get('portfolio', 'Frontend\HomeController@getPortfolio');

Route::get('page/{slug}', 'Frontend\HomeController@getPages');

Route::get('contact', 'Frontend\HomeController@getContact');
Route::post('contact', array('uses' => 'Frontend\HomeController@submitEnquiry', 'as' => 'contact'));

/** ------------------------------------------
 *  GLOBAL variable define
 *  ------------------------------------------
 */
defined('LOGO_PATH') or define('LOGO_PATH', base_path() . '/uploads/logo/');
defined('LOGO_ROOT') or define('LOGO_ROOT', URL('uploads/logo') . '/');

defined('SLIDER_IMAGE_PATH') or define('SLIDER_IMAGE_PATH', base_path() . '/uploads/sliders/');
defined('SLIDER_IMAGE_ROOT') or define('SLIDER_IMAGE_ROOT', URL('uploads/sliders') . '/');

defined('TEAM_IMAGE_PATH') or define('TEAM_IMAGE_PATH', base_path() . '/uploads/team/');
defined('TEAM_IMAGE_ROOT') or define('TEAM_IMAGE_ROOT', URL('uploads/team') . '/');

defined('SERVICE_IMAGE_PATH') or define('SERVICE_IMAGE_PATH', base_path() . '/uploads/services/');
defined('SERVICE_IMAGE_ROOT') or define('SERVICE_IMAGE_ROOT', URL('uploads/services') . '/');

defined('PORTFOLIO_IMAGE_PATH') or define('PORTFOLIO_IMAGE_PATH', base_path() . '/uploads/portfolio/');
defined('PORTFOLIO_IMAGE_ROOT') or define('PORTFOLIO_IMAGE_ROOT', URL('uploads/portfolio') . '/');



