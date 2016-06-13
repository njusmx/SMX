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
                <li class="active">
                    <a href="#">客户管理</a>
                </li>
                <li>
                    <a href="/sale/import">进货管理</a>
                </li>
                <li>
                    <a href="/sale/export">销售管理</a>
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
                <li role="presentation"><a href="/sale">所有客户</a></li>
                <li role="presentation"><a href="/sale/client/add">增加客户</a></li>
                <li role="presentation" class="active"><a href="#">查找客户</a></li>
            </ul>
        </div>
        <!-- main content -->
        <div class="col-xs-9 col-sm-7 col-md-8 col-xs-offset-1 col-sm-offset-1 col-md-offset-1">
            <!-- Default panel contents -->
            <div class="row">
                <form class="form-horizontal" method="POST"
                      action="find">
                    {!! csrf_field() !!}

                    <div class="form-group">
                        <label for="inputTitle" class="col-sm-2 control-label">姓名</label>

                        <div class="col-sm-8 col-md-6 col-lg-8">
                            <input name="name" type="text" class="form-control"
                                   id="inputName"
                                   value="{{ old('name') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('type', '类型', ['class' => 'col-md-2 control-label']) !!}
                        <div class="controls">
                            <div class="ol-sm-8 col-md-6 col-lg-8">
                                <!-- Inline Radios -->
                                <label class="radio-inline">
                                    <input type="radio" value="1" checked="checked" name="type"> 进货商
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" value="2" name="type"> 销售商
                                </label>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-success">查找客户</button>
                        </div>
                    </div>
                </form>
                @if($errors->any())
                    <ul class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li> @endforeach
                    </ul>
                @endif


            </div>

        </div>
    </div>
</div>
</body>

</html>
