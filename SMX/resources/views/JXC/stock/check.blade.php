<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link href="css/bootstrap.css" rel="stylesheet" media="screen"> -->
    <!-- <link href="css/bootstrap-theme.min.css" rel="stylesheet" media="screen"> -->
    <link href="{{ URL::asset('/') }}css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="{{ URL::asset('/') }}css/main.css" rel="stylesheet" media="screen">
    <script type="text/javascript" src="{{ URL::asset('/') }}js/jquery-2.1.4.min.js"></script>
    <script type="text/javascript" src="{{ URL::asset('/') }}js/bootstrap.js"></script>
    <script src="js/Chart.js"></script>
    <style>
        body {
            padding-top: 80px;
        }

        .sidebar {
            /*background-color: #000;*/
        }

        #canvas-holder {
            width: 30%;
        }
    </style>
</head>

<body>
<!-- fixed header -->
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
                <li>
                    <a href="/stock/show">库存查看</a>
                </li>
                <li class="active">
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
        <div class="sidebar col-xs-2 col-sm-3 col-md-2">
            <ul class="nav nav-pills nav-stacked">
                <li role="presentation" class="active"><a href="#">今日盘点</a></li>
            </ul>
        </div>
        <!-- main content -->
        <div class="col-xs-9 col-sm-7 col-md-8 col-xs-offset-1 col-sm-offset-1 col-md-offset-1">
            <!-- Default panel contents -->
            <h3 align="center">库存商品表</h3>
            <table class="table table-hover">
                <tr>
                    <td>编号</td>
                    <td>名称</td>
                    <td>型号</td>
                    <td>库存</td>
                    <td>均价</td>
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
                        </tr>
                    @endforeach
                @else
                    <h1>库中没有商品</h1>
                @endif
            </table>

        </div>
    </div>
</div>
</body>

</html>
