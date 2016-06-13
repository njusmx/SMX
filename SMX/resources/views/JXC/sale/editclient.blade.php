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
                <li role="presentation" class="active"><a href="#">所有客户</a></li>
                <li role="presentation"><a href="/sale/client/add">增加客户</a></li>
                <li role="presentation"><a href="/sale/client/find">查找客户</a></li>
            </ul>
        </div>
        <!-- main content -->
        <div class="col-xs-9 col-sm-7 col-md-8 col-xs-offset-1 col-sm-offset-1 col-md-offset-1">

            <!-- Default panel contents -->
            <div class="panel panel-default panel-success">
                <div class="panel-heading">客户信息</div>
                <div class="panel-body">
                    <div class="personal-mes">
                        @include('errors.list')
                        {!! Form::open(['url' => '/sale/client/edit', 'class' => 'form-horizontal', 'role' => 'form']) !!}
                        <div class="form-group">
                            {!! Form::label('name', '姓名', ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::text('email', $client->name, ['class' => 'form-control', 'readonly'=>'readonly','required']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('tel', '电话', ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::text('tel',$client->tel, ['class' => 'form-control', 'required']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('address', '地址', ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::text('address',$client->address, ['class' => 'form-control', 'required']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('limit', '额度', ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::text('limit',$client->limit, ['class' => 'form-control', 'required']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('type', '类型', ['class' => 'col-md-4 control-label']) !!}
                            <div class="controls">
                                <div class="col-md-6">
                                    <!-- Inline Radios -->
                                    <label class="radio-inline">
                                        <input type="radio" value="进货商" checked="checked" name="type"> 进货商
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" value="销售商" name="type"> 销售商
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('level', '等级', ['class' => 'col-md-4 control-label']) !!}
                            <div class="controls">
                                <div class="col-md-6">
                                    <!-- Inline Radios -->
                                    <label class="radio-inline">
                                        <input type="radio" value="1" checked="checked" name="level"> 1
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" value="2" name="level"> 2
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" value="3" name="level"> 3
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" value="4" name="level"> 4
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" value="5" name="level"> 5
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                {!! Form::submit('确认修改', ['class' => 'btn btn-success form-control']) !!}
                            </div>
                        </div>
                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

</html>


