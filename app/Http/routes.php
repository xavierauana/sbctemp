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


use App\Customer;
use App\User;

Cache::forever('user1', [
    'cNumber'      => '8888',
    'login'        => 'testuser1',
    'password'     => 'asd2asr5ou99',
    'email'        => 'user@test.com',
    'chinese_name' => '',
    'english_name' => '',
    'status'       => true
]);
Cache::forever('user2', [
    'cNumber'      => '9999',
    'login'        => 'testuser2',
    'password'     => "abacdec98",
    'email'        => 'user1@testagain.com',
    'chinese_name' => '測試公司',
    'english_name' => 'Testing company',
    'status'       => true
]);
Cache::forever('documents', [
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
]);

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
        ["id" => "1001", "label" => "上載文件"],
        ["id" => "1002", "label" => "讀取客戶資料"],
        ["id" => "1003", "label" => "更改客戶資料"],
        ["id" => "1004", "label" => "更改客戶登入權限"],
        ["id" => "1005", "label" => "讀取管理人員資料"],
        ["id" => "1006", "label" => "新增管理人員"],
        ["id" => "1007", "label" => "更改管理人員資料"],
        ["id" => "1008", "label" => "刪除管理人員"],
        ["id" => "1009", "label" => "刪除文件"],
        ["id" => "1010", "label" => "更改或刪除文件類別"],
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
    $customer = Customer::whereId($cnumber)->first();
    return response()->json(compact('customer'));
    if ($cnumber == 8888) {
        return Cache::get('user1');
    }
    if ($cnumber == 9999) {
        return Cache::get('user2');
    }

    return null;
});

Route::post("/uploadfile", function (\Illuminate\Http\Request $request) {
    return $request->hasFile('file') ? 'there is file' : 'no file';
});

Route::get('/getUserDocuments/{cnumber}', function ($cnumber) {
    if ($cnumber == 8888) {
        return Cache::get('documents');
    }
});
Route::post('/exportData', function (\Illuminate\Http\Request $request) {
    if ($request->get('status') == 'all') {
        $records = \App\Customer::where('id', '>=', $request->get('start'))->where('id', '<=',
            $request->get('end'))->get([
            'id',
            'chinese_name',
            'english_name',
            'loginname',
            'password',
            'status'
        ])->toArray();
    } elseif ($request->get('status') == 'not') {
        $records = \App\Customer::where('id', '>=', $request->get('start'))->where('id', '<=',
            $request->get('end'))->whereStatus(0)->get([
            'id',
            'chinese_name',
            'english_name',
            'loginname',
            'password',
            'status'
        ])->toArray();
    } elseif ($request->get('status') == 'active') {
        $records = \App\Customer::where('id', '>=', $request->get('start'))->where('id', '<=',
            $request->get('end'))->whereStatus(1)->get([
            'id',
            'chinese_name',
            'english_name',
            'loginname',
            'password',
            'status'
        ])->toArray();
    }

    $headers = ['cnumber', 'chinese name', 'english name', 'login name', 'password', 'status'];
    $records = array_map(function($row){
        return array_values($row);
    }, $records);
    array_unshift($records, $headers);
    $path = storage_path().'/temp.csv';
    $csv = fopen($path, 'w');
    foreach ($records as $row) {
        fputcsv($csv, $row); // here you can change delimiter/enclosure
    }
    fclose($csv);
    return response()->download($path, "user_info.csv", [
        'Content-type'        => 'text/csv',
        'Content-disposition' => 'attachment'
    ]);
});

Route::get('/fetchUser/{userId}', function($userId){
    $user = User::whereId($userId)->first(['name']);
    return $user?['code'=>200,'data'=>$user]:['code'=>404,'data'=>$user];
});

Route::get('/fetchCompany/{companyId}/user/{userId}', function($companyId, $userId){
   $company = Customer::whereId($companyId)->first();
    if($company){
        if($company->pnumber == $userId) return ['code'=>201,'data'=>['english_name'=>$company->english_name]];
        if($company->pnumber > 0 && $company->pnumber !=$userId ) return ['code'=>202,'data'=>['english_name'=>$company->english_name]];
        if($company->pnumber == 0) return ['code'=>200,'data'=>['english_name'=>$company->english_name]];
    }

    return ['code'=>404,'data'=>$company];
});

Route::get('/createLinkage/user/{userId}/company/{companyId}', function($userId, $companyId){
    $company = Customer::whereId($companyId)->first();
    $company->pnumber = $userId;
    $company->save();
    return ['code'=>200];
});
//
//Route::get('/generate/dummy/user', function () {
//    for($i=0; $i<1000; $i++){
//        factory(\App\User::class)->create();
//    }
//});
//
//




