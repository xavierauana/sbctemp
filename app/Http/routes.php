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

CONST USER1 = [
    'cNumber'      => '8888',
    'login'        => 'testuser1',
    'password'     => 'asd2asr5ou99',
    'email'        => 'user@test.com',
    'chinese_name' => '',
    'english_name' => '',
    'status'       => true
];
CONST USER2 = [
    'cNumber'      => '9999',
    'login'        => 'testuser2',
    'password'     => "abacdec98",
    'email'        => 'user1@testagain.com',
    'chinese_name' => '測試公司',
    'english_name' => 'Testing company',
    'status'       => true
];
CONST DOCUMENTS = [
    [
        "id"         => 1,
        "uploadDate" => "2015/12/1",
        "docType"    => "BR",
        "docName"    => "BR-123-123-1",
    ],
    [
        "id"         => 2,
        "uploadDate" => "2015/12/2",
        "docType"    => "BR",
        "docName"    => "BR-123-123-2",
    ],
    [
        "id"         => 3,
        "uploadDate" => "2015/12/3",
        "docType"    => "BR",
        "docName"    => "BR-123-123-3",
    ],
    [
        "id"         => 4,
        "uploadDate" => "2015/12/4",
        "docType"    => "CI",
        "docName"    => "CI-123-123-1",
    ],
    [
        "id"         => 5,
        "uploadDate" => "2015/12/5",
        "docType"    => "CI",
        "docName"    => "CI-123-123-2",
    ],
    [
        "id"         => 6,
        "uploadDate" => "2015/12/6",
        "docType"    => "CI",
        "docName"    => "CI-123-123-3",
    ],
    [
        "id"         => 7,
        "uploadDate" => "2015/12/7",
        "docType"    => "Annual Report",
        "docName"    => "AR-123-123-1",
    ],
    [
        "id"         => 8,
        "uploadDate" => "2015/12/8",
        "docType"    => "Annual Report",
        "docName"    => "AR-123-123-2",
    ],
    [
        "id"         => 9,
        "uploadDate" => "2015/12/9",
        "docType"    => "Annual Report",
        "docName"    => "AR-123-123-3",
    ],
    [
        "id"         => 10,
        "uploadDate" => "2015/12/10",
        "docType"    => "Annual Report",
        "docName"    => "AR-123-123-4",
    ]
];

Route::get('/new', function () {
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
        ["id" => "1001", "label" => "讀取客戶資料"],
        ["id" => "1002", "label" => "讀取管理人員資料"],
        ["id" => "1003", "label" => "上載文件"],
        ["id" => "1004", "label" => "新增客戶"],
        ["id" => "1005", "label" => "新增管理人員"],
        ["id" => "1006", "label" => "刪除文件"],
        ["id" => "1007", "label" => "更改客戶資料"],
        ["id" => "1008", "label" => "更改管理人員資料"],
        ["id" => "1009", "label" => "更改文件類別資料"],
        ["id" => "1010", "label" => "刪除客戶"],
        ["id" => "1011", "label" => "更改及刪除管理人員"],
        ["id" => "1012", "label" => "讀取 / 更改客戶登入名稱及密碼"],
        ["id" => "1013", "label" => "讀取 / 更改管理人員登入名稱及密碼"],
    ];
});
Route::get('/getpermissionprofiles', function () {
    return [
        [
            "id"          => "1",
            "label"       => "General Staff",
            'permissions' => [
                '1001',
                '1011'
            ]
        ],
        [
            "id"          => "2",
            "label"       => "Admin",
            'permissions' => [
                '1003',
                '1004',
                '1005',
                '1007'
            ]
        ],
        [
            "id"          => "3",
            "label"       => "Super Admin",
            'permissions' => [
                '1001',
                '1002',
                '1003',
                '1004',
                '1005',
                '1006',
                '1007',
                '1008',
                '1009',
                '1010',
                '1011',
                '1012'
            ]
        ],
    ];
});
Route::get('/getadminusers', function () {
    return [
        ["id" => 1, "loginName" => "Admin-Rainbow", "profile_id" => '3', "password" => "123456"],
        ["id" => 2, "loginName" => "Admin-RJ", "profile_id" => '1', "password" => "abcdefg"]
    ];
});

Route::get('/getdoctypes', function () {
    return [
        ["id" => 1, "type" => "BR", "index" => '1001'],
        ["id" => 2, "type" => "Certificate", "index" => '1002'],
    ];
});

Route::get('/searchcustomer/{cnumber}', function ($cnumber) {
    if ($cnumber == 8888) {
        return USER1;
    }
    if ($cnumber == 9999) {
        return USER2;
    }

    return null;
});

Route::post("/uploadfile", function (\Illuminate\Http\Request $request) {
    return $request->hasFile('file') ? 'there is file' : 'no file';
});

Route::get('/getUserDocuments/{cnumber}', function ($cnumber) {
    if($cnumber == 8888){
        return DOCUMENTS;
    }
});
Route::get('/exportData', function(){
   return response()->download(public_path('/files/allUsersCSV.csv'),"abc.csv",[
       'Content-type'=>'text/csv',
       'Content-disposition'=>'attachment'
   ]);
});








