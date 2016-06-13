<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="assets/img/favicon.png">

    <title>INVOICING</title>

    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">

    <!-- Fonts -->
    <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

    <!-- Bootstrap -->
    <link href="{{ asset('/assets/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/css/bootstrap-theme.css') }}" rel="stylesheet">

    <!-- siimple style -->
    <link href="{{ asset('/assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/css/sign.css') }}" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<!-- Fixed navbar -->
<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="login.html">INVOICING</a>
        </div>
    </div>
</div>

<div id="header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-5 col-lg-offset-1 col-md-6 col-sm-6">
                <h1>欢迎使用Invoicing</h1>
                <h2 class="subtitle">No need huge slogan, we believe in less is better</h2>
            </div>
            <br>
            <br>
            <br>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <h2 class="signIn">Invoicing</h2>
                <button type="submit" class="btn btn-theme" onclick="{location.href='login'}" style="font-weight: 500;font-size: 16px;">Sign In</button>

                <h2 class="signIn">新来Invoicing?</h2>
                <button type="submit" class="btn btn-theme btnm" onclick="{location.href='register'}" style="font-weight: 500;font-size: 16px;">Sign Up Invoicing</button>

            </div>
        </div>
    </div>
</div>
<div id="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-lg-offset-3">
                <p class="copyright">Copyright &copy; 2015 - Designed by <a href="#">Invoicing njusmx</a></p>
            </div>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="{{ asset('/assets/js/bootstrap.min.js') }}"></script>
@yield('scripts')
</body>
</html>
