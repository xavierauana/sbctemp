<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.10/css/jquery.dataTables.min.css">



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/0.12.15/vue.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.full.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>



    <link rel="stylesheet" href="/css/sass/main.css">

</head>
<body class="documentCenter">
    <div class="container">
        <br>
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-4">
                <img src="/imgs/sbc_logo.png" class="img-responsive" alt="">
            </div>
        </div>
        <br>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">
                        <span class="hidden-sm hidden-xs">駿業客戶文件管理中心</span> SBC Clients Document Center
                    </a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#">
                                Login Account: testing@sbc.com
                            </a></li>
                        <li><a href="#">Logout</a></li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
    </div>

    <div class="container">
        <div>
            <h4>中文公司名</h4>
            <h4>English Company Name</h4>
        </div>
        <div class="panel panel-default">
        	  <table class="table table-hover">
        	  	<thead>
        	  		<tr>
        	  			<th class="text-center">
                            文件日期
                            <br>
                            Document Date
                        </th>
        	  			<th class="text-center">
                            文件類別
                            <br>
                            Document Type
                        </th>
        	  			<th class="text-center">
                            文件名稱
                            <br>
                            Document Name
                        </th>
        	  			<th class="text-center">
                            下載文件
                            <br>
                            Download Document
                        </th>
        	  		</tr>
        	  	</thead>
        	  	<tbody>
        	  		<tr>
        	  			<td class="text-center">2015/12/1</td>
        	  			<td class="text-center">BR</td>
        	  			<td class="text-center">BR-123-123-1</td>
                        <td class="text-center">
                            <button class="btn btn-info btn-xs">Download 下載</button>
                        </td>
        	  		</tr>
        	  		<tr>
        	  			<td class="text-center">2015/12/2</td>
        	  			<td class="text-center">BR</td>
        	  			<td class="text-center">BR-123-123-2</td>
                        <td class="text-center">
                            <button class="btn btn-info btn-xs">Download 下載</button>
                        </td>
        	  		</tr>
        	  		<tr>
        	  			<td class="text-center">2015/12/3</td>
        	  			<td class="text-center">BR</td>
        	  			<td class="text-center">BR-123-123-3</td>
                        <td class="text-center">
                            <button class="btn btn-info btn-xs">Download 下載</button>
                        </td>
        	  		</tr>
        	  		<tr>
        	  			<td class="text-center">2015/12/4</td>
        	  			<td class="text-center">CI</td>
        	  			<td class="text-center">CI-123-123-1</td>
                        <td class="text-center">
                            <button class="btn btn-info btn-xs">Download 下載</button>
                        </td>
        	  		</tr>
        	  		<tr>
        	  			<td class="text-center">2015/12/5</td>
        	  			<td class="text-center">CI</td>
        	  			<td class="text-center">CI-123-123-2</td>
                        <td class="text-center">
                            <button class="btn btn-info btn-xs">Download 下載</button>
                        </td>
        	  		</tr>
        	  		<tr>
        	  			<td class="text-center">2015/12/6</td>
        	  			<td class="text-center">CI</td>
        	  			<td class="text-center">CI-123-123-3</td>
                        <td class="text-center">
                            <button class="btn btn-info btn-xs">Download 下載</button>
                        </td>
        	  		</tr>
        	  		<tr>
        	  			<td class="text-center">2015/12/7</td>
        	  			<td class="text-center">Annual Report</td>
        	  			<td class="text-center">AR-123-123-1</td>
                        <td class="text-center">
                            <button class="btn btn-info btn-xs">Download 下載</button>
                        </td>
        	  		</tr>
        	  		<tr>
        	  			<td class="text-center">2015/12/8</td>
        	  			<td class="text-center">Annual Report</td>
        	  			<td class="text-center">AR-123-123-2</td>
                        <td class="text-center">
                            <button class="btn btn-info btn-xs">Download 下載</button>
                        </td>
        	  		</tr>
        	  		<tr>
        	  			<td class="text-center">2015/12/9</td>
        	  			<td class="text-center">Annual Report</td>
        	  			<td class="text-center">AR-123-123-3</td>
                        <td class="text-center">
                            <button class="btn btn-info btn-xs">Download 下載</button>
                        </td>
        	  		</tr>
        	  		<tr>
        	  			<td class="text-center">2015/12/10</td>
        	  			<td class="text-center">Annual Report</td>
        	  			<td class="text-center">AR-123-123-4</td>
                        <td class="text-center">
                            <button class="btn btn-info btn-xs">Download 下載</button>
                        </td>
        	  		</tr>
        	  	</tbody>
        	  </table>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            $('table').DataTable();
        });
    </script>
</body>
</html>


