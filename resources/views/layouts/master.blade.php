<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <script src="{{asset('admin/js/jquery-2.1.1.js') }}"></script>
    <script src="{{asset('admin/js/bootstrap.js') }}"></script>
    <script src="{{asset('admin/js/bootstrap-dialog/bootstrap-dialog.js') }}"></script>
    <link href="{{asset('admin/css/bootstrap-dialog/bootstrap-dialog.css') }}" rel="stylesheet">
    <link href="{{asset('admin/css/bootstrap.min.css') }}" rel="stylesheet">
</head>

<body>
<nav class="navbar navbar-inverse" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#example-navbar-collapse">
                <span class="sr-only">切换导航</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">
                <img height="100%"/>
            </a>
        </div>
        <div class="collapse navbar-collapse" id="example-navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a class="icon-bar" href="#">网站设置</a></li>
                <li class="active"><a class="icon-bar" href="#">系统管理</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a>欢迎您,admin</a>
                </li>
                <li><a href="{{route('admin.loginout')}}">安全退出</a>
                </li>
            </ul>
        </div>

    </div>
</nav>
<div class=" container-fluid">
    <div class="row">
        <div class="col-sm-2">
            @include('layouts.leftmenu',['menus'=>getCurrentMenu()])
        </div>
        <div id="myManu">
            @yield('content')
        </div>
    </div>
</div>
@yield('foot')
</body>
<script>
    $(document).ready(function () {
        $("#myManu").load('');
    })

    var menuClick = function (menuUrl) {
        $("#myManu").load(menuUrl);
    };
</script>
</html>