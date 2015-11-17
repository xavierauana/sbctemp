<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.10/css/jquery.dataTables.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="/css/sass/main.css">
</head>
<body>
<div class="container-fluid">
    <nav class="navbar">
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-4">
                <img src="/imgs/sbc_logo.png" class="img-responsive" alt="">
            </div>
            <div class="col-xs-6 col-sm-6 col-md-8">
                <ul class="list-inline list-unstyled pull-right">
                    <li>Hello, Admin Rainbow</li>
                    <li><a href="#">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="row">
        <div class="col-sm-3">
            @include('sidemenu')
        </div>
        <div class="col-sm-9">

           <div class="panel panel-default">
               	  <table class="table table-hover">
               	  	<thead>
               	  		<tr>
               	  			<th>登入名稱</th>
               	  			<th>權限類別</th>
               	  		</tr>
               	  	</thead>
               	  	<tbody>
               	  		<tr>
               	  			<td>Admin-RJ</td>
               	  			<td>1</td>
               	  		</tr>
                        <tr>
               	  			<td>Admin-Rainbow</td>
               	  			<td>自定</td>
               	  		</tr>
               	  	</tbody>
               	  </table>
               </div>
            <form class="form-horizontal">
                <div class="form-group">
                    <label for="loginName" class="col-sm-3 control-label">管理人員登入名稱</label>
                    <div class="col-sm-9">
                        <input type="email" class="form-control" id="loginName" placeholder="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="profile" class="col-sm-3 control-label">管理人員權限類別</label>
                    <div class="col-sm-9">
                        <select name="profile" id="profile" class="form-control">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">自定</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="loginName" class="col-sm-3 control-label">登入密碼</label>
                    <div class="col-sm-9">
                        <input type="email" class="form-control" id="loginName" placeholder="">
                    </div>
                </div>

                <h5><strong>設定權限</strong></h5>

                <div class="row permissions" >
                    <div class="col-md-4 col-xs-6">
                        <label>
                            <input type="checkbox" value="1" > 讀取客戶資料
                        </label>
                    </div>
                    <div class="col-md-4 col-xs-6">
                        <label>
                            <input type="checkbox" value="1" > 讀取管理人員資料
                        </label>
                    </div>
                    <div class="col-md-4 col-xs-6">
                        <label>
                            <input type="checkbox" value="1" > 上載文件
                        </label>
                    </div>
                    <div class="col-md-4 col-xs-6">
                        <label>
                            <input type="checkbox" value="1" > 新增客戶
                        </label>
                    </div>
                    <div class="col-md-4 col-xs-6">
                        <label>
                            <input type="checkbox" value="1" > 新增管理人員
                        </label>
                    </div>
                    <div class="col-md-4 col-xs-6">
                        <label>
                            <input type="checkbox" value="1" > 刪除文件
                        </label>
                    </div>
                    <div class="col-md-4 col-xs-6">
                        <label>
                            <input type="checkbox" value="1" > 更改客戶資料
                        </label>
                    </div>
                    <div class="col-md-4 col-xs-6">
                        <label>
                            <input type="checkbox" value="1" > 更改管理人員資料
                        </label>
                    </div>
                    <div class="col-md-4 col-xs-6">
                        <label>
                            <input type="checkbox" value="1" > 更改文件類別資料
                        </label>
                    </div>
                    <div class="col-md-4 col-xs-6">
                        <label>
                            <input type="checkbox" value="1" > 刪除客戶
                        </label>
                    </div>
                    <div class="col-md-4 col-xs-6">
                        <label>
                            <input type="checkbox" value="1" > 更改及刪除管理人員
                        </label>
                    </div>
                    <div class="col-md-4 col-xs-6 hidden-xs">
                        <div class="empty"></div>
                    </div>
                    <div class="col-md-4 col-xs-6">
                        <label>
                            <input type="checkbox" value="1" > 讀取 / 更改客戶登入名稱及密碼
                        </label>
                    </div>
                    <div class="col-md-4 col-xs-6">
                        <label>
                            <input type="checkbox" value="1" > 讀取 / 更改管理人員登入名稱及密碼
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-12 col-sm-4 pull-right">
                        <button type="submit" class="btn btn-block">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('table').DataTable();
    });
</script>
</body>
</html>