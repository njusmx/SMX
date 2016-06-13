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
                    <a href="/stock">商品分类</a>
                </li>
                <li>
                    <a href="/stock/show">库存查看</a>
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
        <div class="sidebar col-xs-2 col-sm-3 col-md-2">
            <ul class="nav nav-pills nav-stacked">
                <li role="presentation"><a href="/stock">所有分类</a></li>
                <li role="presentation" class="active"><a href="#">增加分类</a></li>
            </ul>
        </div>
        <!-- main content -->
        <div class="col-xs-9 col-sm-7 col-md-8 col-xs-offset-1 col-sm-offset-1 col-md-offset-1">
            <!-- Default panel contents -->
            <div class="row">
                <form class="form-horizontal" method="POST"
                      action="add">
                    {!! csrf_field() !!}

                    <div class="form-group">
                        <label for="inputTitle" class="col-sm-2 control-label">类别名称</label>

                        <div class="col-sm-8 col-md-6 col-lg-8">
                            <input name="name" type="text" class="form-control"
                                   id="inputName" placeholder="请输入类别名称"
                                   value="{{ old('title') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputParent" class="col-sm-2 control-label">父类别ID</label>
                        <!-- Single button -->
                        <div class="col-sm-8 col-md-6 col-lg-8">
                            <input name="parent" type="text" class="form-control"
                                   id="inputParent" placeholder="请输入父类别ID"
                                   value="{{ old('parent') }}">
                        </div>
                    </div>
                    <br>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-success">添加类别</button>
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
