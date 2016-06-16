<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>BodyBoard</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('/assets/img/favicon.ico') }}" type="image/x-icon">
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="{{ asset('/assets/plugins/bootstrap/css/bootstrap.min.css') }}">
    <!-- Fonts  -->
    <link rel="stylesheet" href="{{ asset('/assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/simple-line-icons.css') }}">
    <!-- CSS Animate -->
    <link rel="stylesheet" href="{{ asset('/assets/css/animate.css') }}">
    <!-- C3 Chart-->
    <link rel="stylesheet" href="{{ asset('/assets/plugins/c3Chart/css/c3.css') }}">
    <!-- Daterange Picker -->
    <link rel="stylesheet" href="{{ asset('/assets/plugins/daterangepicker/daterangepicker-bs3.css') }}">
    <!-- Calendar demo -->
    <link rel="stylesheet" href="{{ asset('/assets/css/clndr.css') }}">
    <!-- Drop Zone-->
    <link rel="stylesheet" href="{{ asset('/assets/plugins/dropzone/css/dropzone.css') }}" >
    <link rel="stylesheet" href="{{ asset('/assets/plugins/dropzone/css/basic.css') }}">
    <!-- Switchery -->
    <link rel="stylesheet" href="{{ asset('/assets/plugins/switchery/switchery.min.css') }}">
    <!-- Custom styles for this theme -->
    <link rel="stylesheet" href="{{ asset('/assets/css/main.css') }}">
    <!-- Feature detection -->
    <script src="{{ asset('/assets/js/vendor/modernizr-2.6.2.min.js') }}"></script>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="{{ asset('/assets/js/vendor/html5shiv.js') }}"></script>
    <script src="{{ asset('/assets/js/vendor/respond.min.js') }}"></script>
    <![endif]-->
</head>

<body>
<section id="main-wrapper" class="theme-default">
    <header id="header">
        <!--logo start-->
        <div class="brand">
            <a href="index.html" class="logo">
                <i class="icon-heart"></i>
                <span>INVOIC</span>ING</a>
        </div>
        <!--logo end-->
    </header>
    <!--sidebar left start-->
    <aside class="sidebar sidebar-left">
        <div class="sidebar-profile">
            <div class="avatar">
                <img class="img-circle profile-image" src="/assets/img/profile.jpg" alt="profile">
                <i class="on border-dark animated bounceIn"></i>
            </div>
            <div class="profile-body dropdown">
                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><h4>{{Auth::user()->name}}<span class="caret"></span></h4></a>
                <small class="title">库存管理人员</small>
                <h4>业绩点:<span>{{Auth::user()->count}}</span></h4>


                <ul class="dropdown-menu animated fadeInRight" role="menu">
                    <br>
                    <li>
                        <a href="javascript:void(0);">
                            <span class="icon"><i class="fa fa-envelope"></i>
                            </span>Messages</a>
                    </li>
                    <li>
                        <a href="/logout">
                            <span class="icon"><i class="fa fa-sign-out"></i>
                            </span>Logout</a>
                    </li>
                    <br>

                </ul>
            </div>

        </div>
        <nav>
            <h5 class="sidebar-header">Navigation</h5>
            <ul class="nav nav-pills nav-stacked">
                <li class="nav-dropdown">
                    <a href="#" title="商品管理">
                        <i class="fa fa-fw fa-shopping-cart"></i> 商品管理
                    </a>
                    <ul class=" nav-sub">
                        <li>
                            <a  href="/stock" title="商品分类" >商品分类</a>
                        </li>
                        <li>
                            <a  href="/commodity" title="商品管理">商品管理</a>
                        </li>
                    </ul>
                </li>
                <li class=" nav-dropdown open active ">
                    <a href="#" title="库存管理" >
                        <i class="fa  fa-fw fa-tachometer"></i>库存管理
                    </a>
                    <ul class=" nav-sub">
                        <li>
                            <a  href="/stock/check" title="库存盘点">库存盘点</a>
                        </li>
                        <li class="active">
                            <a  href="/stock/show" title="库存查看">库存查看</a>
                        </li>
                        <li >
                            <a  href="/stock/correct" title="库存修正">库存修正</a>
                        </li>
                        <li >
                            <a  href="/stock/inform" title="库存通知">库存通知</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </aside>
    <!--sidebar left end-->

    <!--main content start-->
    <section class="main-content-wrapper">
        <div class="pageheader">
            <h1>库存管理</h1>
            <p class="description">这里展示库存数据 </p>
        </div>
        <section id="main-content" class="animated fadeInUp">

            <div class="row">

                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="tab-wrapper tab-primary">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#stockcheck" data-toggle="tab">库存查看</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="stockcheck">
                                        <section class="panel">
                                            <div class="panel-body">
                                                <div class="col-md-12">
                                                    <div class="panel panel-default">

                                                        <div class="panel-body">
                                                            <table class="table table-striped table-hover">
                                                                <tr>
                                                                    <td>编号</td>
                                                                    <td>名称</td>
                                                                    <td>型号</td>
                                                                    <td>库存</td>
                                                                    <td>默认进价</td>
                                                                    <td>默认售价</td>
                                                                    <td>默认报警数量</td>
                                                                    <td>默认积压数量</td>


                                                                </tr>
                                                                @if (count($commodities))
                                                                    @foreach ($commodities as $commodity)
                                                                        <tr>
                                                                            <td>{{ $commodity->id }}</td>
                                                                            <td>{{ $commodity->name }}</td>
                                                                            <td>{{ $commodity->type }}</td>
                                                                            <td>{{ $commodity->number }}</td>
                                                                            <td>{{ $commodity->avgin }}</td>
                                                                            <td>{{ $commodity->avgout }}</td>
                                                                            <td>{{ $commodity->lesswarn }}</td>
                                                                            <td>{{ $commodity->morewarn }}</td>
                                                                        </tr>
                                                                    @endforeach
                                                                @else
                                                                    <div class="alert alert-danger alert-dismissable">
                                                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                                        <strong>库中没有商品</strong>
                                                                    </div>
                                                                @endif
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </section>

    <!--main content end-->
</section>

<!--Config demo-->
<div id="config" class="config hidden-xs">
    <h4>Settings<a href="javascript:void(0)" class="config-link closed"><i class="icon-settings"></i></a></h4>
    <div class="config-swatch-wrap">
        <div class="row">
            <div class="col-xs-6">
                <ul class="options">
                    <li>
                        <div class="theme-style-wrapper" data-theme="theme-default">
                            <span class="header bg-white"></span>
                            <span class="header bg-white"></span>
                            <span class="nav bg-dark"></span>
                        </div>
                    </li>
                    <li>
                        <div class="theme-style-wrapper" data-theme="theme-dark">
                            <span class="header bg-dark"></span>
                            <span class="header bg-white"></span>
                            <span class="nav bg-dark"></span>
                        </div>
                    </li>
                    <li>
                        <div class="theme-style-wrapper" data-theme="theme-blue">
                            <span class="header bg-info"></span>
                            <span class="header bg-white"></span>
                            <span class="nav bg-dark"></span>
                        </div>
                    </li>
                    <li>
                        <div class="theme-style-wrapper" data-theme="theme-blue-full">
                            <span class="header bg-info"></span>
                            <span class="header bg-info"></span>
                            <span class="nav bg-dark"></span>
                        </div>
                    </li>
                    <li>
                        <div class="theme-style-wrapper" data-theme="theme-grey">
                            <span class="header bg-grey"></span>
                            <span class="header bg-white"></span>
                            <span class="nav bg-dark"></span>
                        </div>
                    </li>
                    <li>
                        <div class="theme-style-wrapper" data-theme="theme-grey-full">
                            <span class="header bg-grey"></span>
                            <span class="header bg-grey"></span>
                            <span class="nav bg-dark"></span>
                        </div>
                    </li>

                </ul>
            </div>
            <div class="col-xs-6">
                <ul class="options">
                    <li>
                        <div class="theme-style-wrapper" data-theme="theme-dark-full">
                            <span class="header bg-dark"></span>
                            <span class="header bg-dark"></span>
                            <span class="nav bg-dark"></span>
                        </div>
                    </li>
                    <li>
                        <div class="theme-style-wrapper" data-theme="theme-green">
                            <span class="header bg-green"></span>
                            <span class="header bg-white"></span>
                            <span class="nav bg-dark"></span>
                        </div>
                    </li>
                    <li>
                        <div class="theme-style-wrapper" data-theme="theme-green-full">
                            <span class="header bg-green"></span>
                            <span class="header bg-green"></span>
                            <span class="nav bg-dark"></span>
                        </div>
                    </li>
                    <li>
                        <div class="theme-style-wrapper" data-theme="theme-red">
                            <span class="header bg-red"></span>
                            <span class="header bg-white"></span>
                            <span class="nav bg-dark"></span>
                        </div>
                    </li>
                    <li>
                        <div class="theme-style-wrapper" data-theme="theme-red-full">
                            <span class="header bg-red"></span>
                            <span class="header bg-red"></span>
                            <span class="nav bg-dark"></span>
                        </div>
                    </li>
                    <li>
                        <div class="theme-style-wrapper" data-theme="theme-dark-blue-full">
                            <span class="header bg-dark-blue"></span>
                            <span class="header bg-dark-blue"></span>
                            <span class="nav bg-dark"></span>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!--/Config demo-->
<!--Global JS-->
<script src="{{ asset('assets/js/vendor/jquery-1.11.1.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/plugins/navgoco/jquery.navgoco.min.js') }}"></script>
<script src="{{ asset('assets/plugins/pace/pace.min.js') }}"></script>
<script src="{{ asset('assets/plugins/fullscreen/jquery.fullscreen-min.js') }}"></script>
<script src="{{ asset('assets/js/src/app.js') }}"></script>
<script src="{{ asset('assets/js/underscore.min.js') }}"></script>

<!--Page Level JS-->
<script src="{{ asset('assets/plugins/countTo/jquery.countTo.js') }}"></script>
<script src="{{ asset('assets/plugins/weather/js/skycons.js') }}"></script>
<script src="{{ asset('assets/plugins/daterangepicker/moment.min.js') }}"></script>
<script src="{{ asset('assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- ChartJS  -->
<script src="{{ asset('assets/plugins/chartjs/Chart.min.js') }}"></script>
<script src="{{ asset('assets/plugins/chartjs/chartjs-demo.js') }}"></script>

<!-- Morris  -->
<script src="{{ asset('assets/plugins/morris/js/morris.min.js') }}"></script>
<script src="{{ asset('assets/plugins/morris/js/raphael.2.1.0.min.js') }}"></script>
<!-- Vector Map  -->
<script src="{{ asset('assets/plugins/jvectormap/js/jquery-jvectormap-1.2.2.min.js') }}"></script>
<script src="{{ asset('assets/plugins/jvectormap/js/jquery-jvectormap-world-mill-en.js') }}"></script>
<!-- Gauge  -->
<script src="{{ asset('assets/plugins/gauge/gauge.min.js') }}"></script>
<script src="{{ asset('assets/plugins/gauge/gaugeV.js') }}"></script>
<!-- <script src="{{ asset('assets/plugins/gauge/gauge-demo.js') }}"></script> -->
<!-- Calendar  -->
<script src="{{ asset('assets/plugins/calendar/clndr.js') }}"></script>
<script src="{{ asset('assets/plugins/calendar/clndr-demo.js') }}"></script>
<!-- <script src="http://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.5.2/underscore-min.js"></script> -->
<!-- Switch -->
<script src="{{ asset('assets/plugins/switchery/switchery.min.js') }}"></script>
<script src="{{ asset('assets/plugins/dropzone/js/dropzone.min.js') }}"></script>
<!--Page Leve JS -->
<script src="{{ asset('assets/plugins/c3Chart/js/d3.v3.min.js') }}"></script>
<script src="{{ asset('assets/plugins/c3Chart/js/c3.js') }}"></script>
<script src="{{ asset('assets/plugins/c3Chart/js/c3-V.js') }}"></script>
<!--Load these page level functions-->

</body>

</html>


