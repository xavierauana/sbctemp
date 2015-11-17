<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src='https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit&hl=zh-HK'></script>
    <script type="text/javascript">
        var onloadCallback = function() {
            grecaptcha.render('captcha', {
                'sitekey' : '6LepqxATAAAAADoPDxLSFlbpgQcp_VpQPSNhGYSy'
            });
        };
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <link rel="stylesheet" href="/css/sass/main.css">
</head>
<body>
<div class="container">

    <div class="col-sm-8 col-sm-offset-2 login-container">
        <div class="col-sm-11 hidden-xs title default">
            駿業客戶文件中心 SBC Clients Document Center
        </div>
        <div class="visible-xs title">
            駿業客戶文件中心 SBC Clients Document Center
        </div>
        <div class="row">
            <form class="form-horizontal">
                <div class="form-group">
                    <label for="login" class="sr-only">Email</label>
                    <div class="col-sm-offset-2 col-sm-8">
                        <input type="text" name="login" class="form-control" id="login" placeholder="登入名稱 Login" autofocus>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="sr-only">Password</label>
                    <div class="col-sm-offset-2 col-sm-8">
                        <input type="password" name="password" class="form-control" id="password" placeholder="登入密碼 Password">
                    </div>
                </div>
                <div class="col-xs-offset-4 col-xs-4">
                    <div id="captcha" class="center-block"></div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                        <button type="submit" class="btn btn-lg  btn-block">登入 Sign in</button>
                        <div id="forgetPasswordLink">
                            <a href="#" id="">忘記密碼 Forget Password</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


</body>
</html>