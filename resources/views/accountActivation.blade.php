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
    <div class="row purple titleBox">
        <h4>駿業客戶文件中心 - 賬戶啓動</h4>
        <h4>SBC Clients Document Center - Account Activation</h4>
    </div>
    <div class="form-container">
        <form class="form-horizontal">
            <div class="form-group">
                <label for="login" class="sr-only">Email</label>
                <div class="col-sm-offset-2 col-sm-8">
                    <input type="text" name="login" class="form-control" id="login" placeholder="新登入名稱 New Login Name" autofocus>
                </div>
            </div>
            <div class="form-group">
                <label for="password" class="sr-only">Password</label>
                <div class="col-sm-offset-2 col-sm-8">
                    <input type="password" name="password" class="form-control" id="password" placeholder="新密碼 New Password">
                </div>
            </div>
            <div class="form-group">
                <label for="password_confirmation" class="sr-only">Confirm Password</label>
                <div class="col-sm-offset-2 col-sm-8">
                    <input type="password" class="form-control"  name="password_confirmation" id="password_confirmation" placeholder="確定新密碼 Confirm New Password">
                </div>
            </div>
            <div class="form-group">
                <label for="email" class="sr-only">Password</label>
                <div class="col-sm-offset-2 col-sm-8">
                    <input type="email" name="email" class="form-control" id="email" placeholder="電郵 Email">
                </div>
            </div>
            <div class="form-group">
                <label for="email_confirmation" class="sr-only">Confirm Password</label>
                <div class="col-sm-offset-2 col-sm-8">
                    <input type="email" class="form-control"  name="email_confirmation" id="email_confirmation" placeholder="確定電郵 Confirm Email">
                    <p class="help-block">此電郵賬戶是於你忘記密碼時作重新啟動賬戶用途</p>
                    <p class="help-block">This email is used for resetting login account.</p>
                </div>
            </div>
            <div class="col-xs-offset-4 col-xs-4">
                <div id="captcha" class="center-block"></div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-lg btn-block btn-purple">確定 Confirm</button>
                </div>
            </div>
        </form>
    </div>
</div>


</body>
</html>