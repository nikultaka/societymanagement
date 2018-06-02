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
    return view('auth.login');
});
//Route::get('/login', function () {
//    return view('BackEnd.login');
//});
//Route::get('login', array('uses' => 'LoginController@showLogin'));
//Route::post('login', array('uses' => 'LoginController@doLogin'));
Auth::routes();
Route::get('/dashboard','DashboardController@home');
Route::get('/home', 'HomeController@index')->name('home');
//Route::get('/dashboard','DashboardController@home');



Route::get('listpayment','PaymentController@index');
Route::get('addpayment','PaymentController@addpayment');
// User Managment start
// Block Managment
Route::get('block', 'BlockController@index');
Route::get('block/getdata', 'BlockController@getlist')->name('block/getdata');
Route::post('block','BlockController@addblock');
Route::any('block/delete/','BlockController@deleteblock');
Route::any('block/edit/','BlockController@editblock');
Route::any('block/update/','BlockController@updateblock');

// Member Managment
Route::get('member', 'MemberController@index');
Route::get('member/getdata', 'MemberController@anyData')->name('member/getdata');
Route::post('member','MemberController@addmember');
Route::any('member/edit/','MemberController@editmember');
Route::any('member/update/','MemberController@updatemember');
Route::any('member/delete/','MemberController@deletemember');


//House Managment
Route::get('house', 'HouseController@index');
Route::get('house/getdata', 'HouseController@anyData')->name('house/getdata');
Route::post('house','HouseController@addmember');
Route::any('house/edit/','HouseController@edithouse');
Route::any('house/update/','HouseController@updatehouse');
Route::any('house/delete/','HouseController@deletehouse');

//user Managment End...
//
//
//Expenses Managment
Route::get('expense', 'ExpenseController@index');
Route::get('expense/getdata', 'ExpenseController@anyData')->name('expense/getdata');
Route::post('expense','ExpenseController@addexpense');
Route::post('expensestype','ExpenseController@addexpensestype');
Route::any('expense/edit/','ExpenseController@editexpense');
Route::any('expense/update/','ExpenseController@update_expense');
Route::any('expense/delete/','ExpenseController@deleteexpense');

//Charges Managment
Route::get('charges', 'ChargesController@index');
Route::get('charges/getdata', 'ChargesController@anyData')->name('charges/getdata');
Route::post('charges','ChargesController@addcharges');
Route::any('charges/edit/','ChargesController@editcharges');
Route::any('charges/update/','ChargesController@updatecharges');
Route::any('charges/delete/','ChargesController@deletecharges');

// Payment Managment
Route::get('payment', 'PaymentController@index');
Route::get('payment/getdata', 'PaymentController@anyData')->name('payment/getdata');
Route::post('payment','PaymentController@addpayment');


//receipt managment
Route::any('addpaymentreceipt','PaymentController@addpaymentreceipt');


Route::get('receipt', 'ReceiptController@index');
Route::get('receipt/getdata', 'ReceiptController@anyData')->name('receipt/getdata');
Route::any('receipt/getdatafordropdown', 'ReceiptController@getdatafordropdown')->name('receipt/getdatafordropdown');
Route::any('receipt/getdataforhousemember', 'ReceiptController@getdataforhousemember')->name('receipt/getdataforhousemember');
Route::any('receipt/add_receipt_single', 'ReceiptController@add_receipt_single');
Route::any('receipt/get_charges_type','ReceiptController@get_charges_type')->name('receipt/get_charges_type');
Route::any('receipt/auto_receipt','ReceiptController@auto_receipt');
Route::any('receipt/get_receiptdetails_id','ReceiptController@get_receiptdetails_id');
Route::any('receipt/payment_status_change','ReceiptController@payment_status_change');

//trasfer section
Route::get('transfer', 'TransferController@index');
Route::post('transfer', 'TransferController@savenewhouse');
//Route::get('receipt/getdata', 'ReceiptController@anyData')->name('receipt/getdata');

// Report Managment
Route::any('report', 'ReportController@index');

Route::get('document','DocumentController@index');
Route::get('document/getdata','DocumentController@anyData')->name('document/getdata');
Route::post('document','DocumentController@adddocument');
Route::any('document/delete/','DocumentController@deletedocument');
