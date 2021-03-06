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
        <h4>駿客戶文件中心 - 重設密碼</h4>
        <h4>SBC Clients Document Centre - Forget Password</h4>
    </div>
    <div class="form-container">
        <form class="form-horizontal">
            <div class="form-group">
                <label for="email" class="sr-only">Email</label>
                <div class="col-sm-offset-2 col-sm-8">
                    <input type="text" name="email" class="form-control" id="email" placeholder="電郵地址 Email Address" autofocus>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-lg btn-block  btn-purple">確定 Confirm</button>
                </div>
            </div>
        </form>
    </div>
</div>


</body>
</html>