<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <link rel="stylesheet" href="/css/sass/main.css">
</head>
<body>
<div class="container">
    <div class="well">
        <h3>Search User</h3>

        <form action="" method="POST">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search C Number" autofocus>
                  <span class="input-group-btn">
                    <button class="btn" type="button">Go!</button>
                  </span>
            </div>
        </form>
    </div>

    <div class="well clearfix">
        <form class="form-horizontal">
            <div class="form-group">
                <label for="cNumber" class="col-sm-2 control-label">C Number</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="cNumber" name="cNumber" placeholder="C Number">
                </div>
            </div>
            <div class="form-group">
                <label for="login" class="col-sm-2 control-label">Login Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="login" name="login" placeholder="Login Name">
                </div>
            </div>
            <div class="form-group">
                <label for="password" class="col-sm-2 control-label">Password</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="password" name="password" placeholder="Password">
                </div>
            </div>
            <div class="form-group">
                <label for="email" class="col-sm-2 control-label">Email</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                </div>
            </div>
            <div class="row button-group pull-right clearfix">
                <button class="btn">Reset</button>
                <button class="btn ">Print</button>
            </div>
        </form>
    </div>
</div>


</body>
</html>