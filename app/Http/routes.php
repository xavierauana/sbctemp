<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('client');
});
Route::get('/accountActivation', function () {
    return view('accountActivation');
});
Route::get('/adminInfo', function () {
    return view('adminInfo');
});
Route::get('/createNewAdmin', function () {
    return view('createNewAdmin');
});
Route::get('/editDocumentType', function () {
    return view('editDocumentType');
});
Route::get('/permissionSetting', function () {
    return view('permissionSetting');
});
Route::get('/resetPassword', function () {
    return view('resetPassword');
});
Route::get('/searchUser', function () {
    return view('searchUser');
});
Route::get('/uploadFile', function () {
    return view('uploadFile');
});
Route::get('/documentCenter', function () {
    return view('documentCenter');
});
