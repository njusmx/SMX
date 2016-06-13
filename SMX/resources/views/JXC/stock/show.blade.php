<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link href="css/bootstrap.css" rel="stylesheet" media="screen"> -->
    <!-- <link href="css/bootstrap-theme.min.css" rel="stylesheet" media="screen"> -->
    <link href="{{ URL::asset('/') }}css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="{{ URL::asset('/') }}css/main.css" rel="stylesheet" media="screen">
    <link href="{{ URL::asset('/') }}bootstrap-datetimepicker-master/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
    <script type="text/javascript" src="{{ URL::asset('/') }}js/jquery-2.1.4.min.js"></script>
    <script type="text/javascript" src="{{ URL::asset('/') }}js/bootstrap.js"></script>
    <script src="{{ URL::asset('/') }}js/Chart.js"></script>
    <script type="text/javascript" src="{{ URL::asset('/') }}bootstrap-datetimepicker-master/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
    <script type="text/javascript" src="{{ URL::asset('/') }}bootstrap-datetimepicker-master/js/locales/bootstrap-datetimepicker.fr.js" charset="UTF-8"></script>
    <style>
        body {
            padding-top: 80px;
        }



        #canvas-holder {
            width: 30%;
        }
    </style>
</head>

<body>
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target="#collapse-header">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">进销存系统</a>
        </div>
        <div class="navbar-collapse collapse" role="navigation" id="collapse-header">
            <ul class="nav navbar-nav">
                <li>
                    <a href="/stock">商品分类</a>
                </li>
                <li class="active">
                    <a href="#">库存查看</a>
                </li>
                <li>
                    <a href="/stock/check">库存盘点</a>
                </li>
                <li>
                    <a href="/stock/correct">库存修正</a>
                </li>
                <li>
                    <a href="/stock/inform">库存通知</a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"><?php echo $name; ?><span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="/logout">退出登录</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container-fluid">
    <div class="row">
        <!-- sidebar -->
        <div class="sidebar col-xs-2 col-sm-3 col-md-2 ">
            <ul class="nav nav-pills nav-stacked">
                <li role="presentation"><a href="#">库存查询</a></li>
            </ul>
        </div>
        <!-- main content -->
        <div class="col-xs-9 col-sm-7 col-md-8 col-xs-offset-1 col-sm-offset-1 col-md-offset-1">
            {!! Form::open(['url' => '/stock/show', 'class' => 'form-horizontal', 'role' => 'form']) !!}
            <div class="form-group">
                <div class="input-group date form_date col-md-6" data-date="" data-date-format="yyyy-mm"  data-link-field="dtp_input2" data-link-format="yyyy-mm-dd hh:ii">
                    <input name="date" class="form-control" size="16" type="text" value="" readonly>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
            </div>
            <div class="form-group">
                {!! Form::submit('搜索', ['class' => 'btn btn-success col-md-2']) !!}
            </div>
            {!! Form::close() !!}

            <table class="table table-hover">
                <tr align=center style="font-weight:bold">
                    <td>日期</td>
                    <td>步数</td>
                    <td>里程数/km</td>
                    <td>消耗卡路里</td>
                </tr>
                @if (count($info))
                    @foreach ($info as $in)
                        <tr align=center>
                            <td>{{ $in->date }}</td>
                            <td>{{ $in->step }}</td>
                            <td>{{ $in->km }}</td>
                            <td>{{ $in->calory }}</td>
                        </tr>
                    @endforeach
                @else
                    <h1>没有运动信息=.=</h1>
                @endif
            </table>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('.form_datetime').datetimepicker({

        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        forceParse: 0,
        showMeridian: 1
    });
    $('.form_date').datetimepicker({

        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        minView: 2,
        forceParse: 0
    });
    $('.form_time').datetimepicker({

        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 1,
        minView: 0,
        maxView: 1,
        forceParse: 0
    });
</script>
</body>