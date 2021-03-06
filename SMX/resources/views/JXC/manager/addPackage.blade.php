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

    <link rel="stylesheet" href="{{ asset('/bootstrap-datetimepicker-master/css/bootstrap-datetimepicker.css') }}">
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
                <small class="title">总经理</small>
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
                    <a href="/manager" title="审批单据">
                        <i class="fa fa-fw fa-shopping-cart"></i>审批单据
                    </a>
                </li>
                <li class=" nav-dropdown  open active">
                    <a href="/manager/strategy" title="策略制定" >
                        <i class="fa  fa-fw fa-tachometer"></i>策略制定
                    </a>
                    <ul class=" nav-sub">
                        <li >
                            <a  href="/manager/strategy" title="所有策略" >所有策略</a>
                        </li>
                        <li class="active">
                            <a  href="/manager/strategy/package" title="创建特价包">创建特价包</a>
                        </li>
                        <li>
                            <a  href="/manager/strategy/coupon" title="创建代金券赠送策略">创建代金券赠送策略</a>
                        </li>
                        <li>
                            <a  href="/manager/strategy/present" title="创建赠品赠送策略">创建赠品赠送策略</a>
                        </li>
                        <li>
                            <a  href="/manager/strategy/discount" title="创建打折促销策略">创建打折促销策略</a>
                        </li>
                    </ul>
                </li>
                <li class=" nav-dropdown ">
                    <a href="/manager/analysis/sale" title="业绩查看" >
                        <i class="fa  fa-fw fa-tachometer"></i>业绩查看
                    </a>
                    <ul class=" nav-sub">
                        <li>
                            <a  href="/manager/analysis/sale" title="销售分析" >销售分析</a>
                        </li>
                        <li>
                            <a  href="/manager/analysis/client" title="客户分析">客户分析</a>
                        </li>
                        <li>
                            <a  href="/manager/analysis/employee" title="员工业绩">员工业绩</a>
                        </li>
                        <li>
                            <a  href="/manager/analysis/interest" title="利润分析">利润分析</a>
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
            <h1>业务管理</h1>
            <p class="description">这里展示业务数据 </p>
        </div>
        <section id="main-content" class="animated fadeInUp">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h2  style="color: #fff;">创建特价包</h2>
                            <div class="actions pull-right">
                                <i class="fa fa-expand"></i>
                                <i class="fa fa-chevron-down"></i>
                                <i class="fa fa-times"></i>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="col-md-12">
                                <div class="panel panel-default">

                                    <div class="panel-body">
                                        <form class="form-horizontal" role="form" method="POST" action="{{ url('manager/strategy/package')}}">
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                </div>
                                            </div>
                                            <div class="col-md-7">
                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label">促销开始时间</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" name="start" class="form-control form_datetime">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label">促销结束时间</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" name="end" class="form-control form_datetime">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="clientname" class="col-sm-4 control-label">客户等级限制</label>
                                                    <div class="col-sm-6 col-md-6 col-lg-6">
                                                        <select name="level" class="form-control">
                                                            <option value="1">一级</option>
                                                            <option value="2">二级</option>
                                                            <option value="3">三级</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <input type="hidden" name="status"  value="0" >
                                                    <label class="col-sm-4 control-label">1号商品编号</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" name="commodityfirst" class="form-control" placeholder="Commodity ID" >
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label">数量</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" name="numfirst" class="form-control" placeholder="Number" >
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <input type="hidden" name="status"  value="0" >
                                                    <label class="col-sm-4 control-label">2号商品编号</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" name="commoditysecond" class="form-control" placeholder="Commodity ID" >
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label">数量</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" name="numsecond" class="form-control" placeholder="Number" >
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label">特价包定价</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" name="set" class="form-control" placeholder="Set Price" >
                                                    </div>
                                                </div>


                                                <div class="form-group">
                                                    <div class="col-md-offset-6 col-md-2 col-sm-offset-7 col-sm-10">
                                                        <button type="submit" class="btn btn-primary">创建特价包</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                    @if (count($errors) > 0)
                                        <div class="alert alert-danger alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                            <strong>错误</strong>你填写数据有问题！请重新填写！<br><br>
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h2  style="color: #fff;">商品列表</h2>
                            <div class="actions pull-right">
                                <i class="fa fa-expand"></i>
                                <i class="fa fa-chevron-down"></i>
                                <i class="fa fa-times"></i>
                            </div>
                        </div>
                        <div class="panel-body">
                            <table class="table table-hover table-striped">
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

<script src="{{ asset('bootstrap-datetimepicker-master/js/bootstrap-datetimepicker.js') }}"></script>
<script src="{{ asset('assets/plugins/c3Chart/js/c3-V.js') }}"></script>

<!--Load these page level functions-->
<script type="text/javascript">
    $(".form_datetime").datetimepicker({
        minView: "month", //选择日期后，不会再跳转去选择时分秒
        format: "yyyy-mm-dd", //选择日期后，文本框显示的日期格式
        language: 'zh-CN', //汉化
        autoclose:true //选择日期后自动关闭
    });
</script>
</body>

</html>


