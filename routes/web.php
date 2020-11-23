<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'web'], function () {
Auth::routes();

/**********************:ADMINISTRATION ROUTE********************************/
Route::get('/home', 'HomeController@index')->name('home');
Route::resource('admin/revokepermission', 'revokepermissionController');
Route::resource('admin/roles', 'Admin\RolesController');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('permission/search', ['as' => 'permission/search', 'uses' => 'Admin\PermissionsController@search']);
Route::resource('admin/permission', 'Admin\PermissionsController');
Route::resource('admin/users', 'Admin\\UsersController');
Route::post('get_all_permissions', 'Admin\\UsersController@all_role_permisssions');
Route::get('admin/user/resetpasword/{id}','Admin\\UsersGeneralController@resetStaffPassword');
Route::post('payment_history_summary', 'Admin\\AdministratorController@admin_payment_summary');
Route::resource('admin/churchgroup', 'ChurchgroupController');
Route::resource('admin/churchgiven', 'Admin\\ChurchgivenController');
});

Route::resource('admin/churchgroups', 'Admin\\ChurchgroupsController');
Route::resource('testers', 'testersController');
Route::resource('admin/branch', 'Admin\\BranchController');
Route::resource('admin/memberdetails', 'Admin\\MemberdetailsController');
Route::resource('admin/collectiongroups', 'Admin\\collectiongroupsController');
Route::resource('admin/paymentplantypes', 'Admin\\PaymentplantypesController');
Route::resource('admin/paymentpoint', 'Admin\\PaymentpointController');
Route::resource('admin/membercustompayment', 'Admin\\MembercustompaymentController');
Route::resource('admin/churchcustompayment', 'Admin\\ChurchcustompaymentController');
Route::resource('admin/payment_history', 'Admin\\payment_historyController');
Route::resource('admin/resetpassword', 'Admin\\resetpasswordController');
Route::resource('admin/rollbackpayment', 'Admin\\RollbackpaymentController');



/**********************:MEMBER PAYMENT COLECTION ROUTE********************************/
Route::resource('admin/transport', 'Admin\\TransportController');
Route::resource('admin/transportcollection', 'Admin\\TransportcollectionController');
Route::resource('admin/pledgecollection', 'Admin\\pledgecollectionController');
Route::post('get_pledge_payment_details', 'Admin\\pledgecollectionController@getpledgeyeardetails');
Route::resource('admin/welfare', 'Admin\\WelfareController');
Route::post('get_welfare_payment_details', 'Admin\\WelfareController@getwelfareyeardetails');
Route::resource('admin/othercollections', 'Admin\\OthercollectionsController');
Route::resource('admin/tithes', 'Admin\\TithesController');
Route::post('get_tithe_payment_details', 'Admin\\TithesController@gettitheyeardetails');
Route::resource('admin/paymenthistory', 'Admin\\PaymenthistoryController');
//Route::post('get_pledge_payment_details', 'Admin\\UsersController@all_extra_permisssions');


/***************************:REPORTING ROUTE*******************************************/
Route::resource('admin/pledgedetailreport', 'Admin\\pledgedetailreportController');
Route::resource('admin/memberdetailreport', 'Admin\\MemberdetailreportController');
Route::resource('admin/transportdetailreport', 'Admin\\TransportdetailreportController');
Route::resource('admin/tithedetailreport', 'Admin\\TithedetailreportController');
Route::resource('admin/welfaredetailreport', 'Admin\\WelfaredetailreportController');
Route::resource('admin/othercollectiondetailreport', 'Admin\\othercollectiondetailreportController');


/*************************:TEXT MESSAGING  ROUTE********************************/
Route::resource('admin/smsnotification', 'Admin\\SmsNotificationController');
Route::resource('admin/textmessage', 'Admin\\TextmessageController');
Route::resource('admin/messagetag', 'Admin\\MessagetagController');
Route::resource('admin/smsgroups', 'Admin\\SmsgroupsController');
Route::resource('admin/birthdaynotification', 'Admin\\BirthdaynotificationController');
Route::resource('admin/groupcontact', 'Admin\\GroupcontactController');

Route::resource('admin/transportdetailreport', 'Admin\\TransportdetailreportController');
Route::resource('admin/memberdebtdetailreport', 'Admin\\MemberdebtdetailreportController');
