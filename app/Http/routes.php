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

Route::get('/new', function(){
    return view('new');
});

Route::get('/', function () {
    return view('client');
});
Route::get('/adminlogin', function () {
    return view('admin_login');
});
Route::get('/admin', function () {
    return view('new');
});
Route::get('/forgetpassword', function () {
    return view('forgetpassword');
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
Route::get('/getpermissions', function () {
    return [
        ["id"=>"1001", "label"=>"讀取客戶資料"],
        ["id"=>"1002", "label"=>"讀取管理人員資料"],
        ["id"=>"1003", "label"=>"上載文件"],
        ["id"=>"1004", "label"=>"新增客戶"],
        ["id"=>"1005", "label"=>"新增管理人員"],
        ["id"=>"1006", "label"=>"刪除文件"],
        ["id"=>"1007", "label"=>"更改客戶資料"],
        ["id"=>"1008", "label"=>"更改管理人員資料"],
        ["id"=>"1009", "label"=>"更改文件類別資料"],
        ["id"=>"1010", "label"=>"刪除客戶"],
        ["id"=>"1011", "label"=>"更改及刪除管理人員"],
        ["id"=>"1012", "label"=>"讀取 / 更改客戶登入名稱及密碼"],
        ["id"=>"1013", "label"=>"讀取 / 更改管理人員登入名稱及密碼"],
    ];
});
Route::get('/getpermissionprofiles', function () {
    return [
        ["id"=>"1", "label"=>"General Staff", 'permissions'=>[
            '1001', '1011'
        ]],
        ["id"=>"2", "label"=>"Admin", 'permissions'=>[
            '1003', '1004','1005', '1007'
        ]],
        ["id"=>"3", "label"=>"Super Admin", 'permissions'=>[
            '1001', '1002', '1003', '1004','1005', '1006',
            '1007', '1008', '1009', '1010','1011', '1012'
        ]],
    ];
});
Route::get('/getadminusers', function(){
   return [
        ["id"=>1, "loginName"=>"Admin-Rainbow", "profile_id"=>'3', "password"=> "123456"],
        ["id"=>2, "loginName"=>"Admin-RJ", "profile_id"=>'1', "password"=> "abcdefg"]
   ];
});

Route::get('/getdoctypes', function(){
    return [
        ["id"=>1, "type"=>"BR", "index"=>'1001'],
        ["id"=>2, "type"=>"Certificate", "index"=>'1002'],
    ];
});

Route::get('/searchcustomer/{cnumber}', function($cnumber){
    if($cnumber == 8888){
        return ['cNumber'=>$cnumber, 'login'=>'testuser', 'password'=>'asd2asr5ou99', 'email'=>'user@test.com', 'name'=>'Test company'];
    }
    return null;
});

Route::post("/uploadfile", function(\Illuminate\Http\Request $request){
    return $request->hasFile('file')? 'there is file': 'no file';
});


