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
            <div class="col-lg-6 col-md-6 col-sm-6">
                <h2 class="signIn">新来Invoicing?</h2>
                <form class="form-inline signup" role="form" method="POST" action="{{ url('/register') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <div>
                            <input type="text" class="form-control" id="exampleInputEmail1" name="name" value="{{ old('name') }}" placeholder="Enter your username">
                        </div>
                        <div>
                            <input type="email" class="form-control" id="exampleInputEmail1" name="email" value="{{ old('email') }}" placeholder="Enter your email address">
                        </div>
                        <div>
                            <input type="password" class="form-control" id="exampleInputEmail1" name="password" placeholder="Enter your password">
                        </div>
                        <div>
                            <input type="password" class="form-control" id="exampleInputEmail1" name="password_confirmation" placeholder="Confirm your password">
                        </div>

                        <label>Select list(choose one) :</label>
                        <div class="col-sm-6">
                            <!-- Inline Radios -->
                            <div>
                                <label class="radio-inline" style="padding-left:0px;">
                                    <input type="radio" value="1" checked="checked" name="type" style="width: 15px!important; font-size: 16px;"> 库存管理人员
                                </label>
                            </div>
                            <div>
                                <label class="radio-inline" style="padding-left:0px;">
                                    <input type="radio" value="2" name="type" style="width: 15px!important; padding-left: 0px!important; font-size: 18px;"> 进货销售人员
                                </label>
                            </div>
                            <div>
                                <label class="radio-inline" style="padding-left:0px;">
                                    <input type="radio" value="3" name="type" style="width: 15px!important; padding-left: 0px!important; font-size: 18px;"> 财务人员
                                </label>
                            </div>
                            <div>
                                <label class="radio-inline" style="padding-left:0px;">
                                    <input type="radio" value="4" name="type" style="width: 15px!important; padding-left: 0px!important; font-size: 18px;"> 总经理
                                </label>
                            </div>
                            <div>
                                <label class="radio-inline" style="padding-left:0px;">
                                    <input type="radio" value="9" name="type" style="width: 15px!important; padding-left: 0px!important; font-size: 18px;"> 管理员
                                </label>
                            </div>
                        </div>

                        <div>
                            <button type="submit" class="btn btn-theme btnm" style="margin-top: 10px;">Sign Up Vigor</button>
                        </div>
                    </div>
                </form>
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
