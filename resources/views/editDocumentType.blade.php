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
                            <th>編號</th>
                            <th>文件類別名稱</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>001</td>
                            <td>B.R. 商業登記證</td>
                        </tr>
                        <tr>
                            <td>002</td>
                            <td>自定</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <form class="form-horizontal">
                <div class="form-group">
                    <label for="docTypeIndex" class="col-sm-3 control-label">編號</label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" id="docTypeIndex" placeholder="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="docType" class="col-sm-3 control-label">文件類別名稱</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="docType" placeholder="">
                    </div>
                </div>

                <div class="row button-group">
                    <div class="col-sm-3">
                        <button class="btn btn-block">新增</button>
                    </div>
                    <div class="col-sm-3">
                        <button class="btn btn-block">編輯</button>
                    </div>
                    <div class="col-sm-3">
                        <button class="btn btn-block">取消</button>
                    </div>
                </div>

                <div class="row button-group">
                    <div class=" col-sm-3">
                        <button class="btn btn-block">存檔</button>
                    </div>
                    <div class="col-sm-3">
                        <button class="btn btn-block">刪除</button>
                    </div>
                    <div class="col-sm-offset-3 col-sm-3">
                        <button class="btn btn-block">退出</button>
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