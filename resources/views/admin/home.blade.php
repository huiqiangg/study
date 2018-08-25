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
        <div class="collapse navbar-collapse" id="example-navbar-collapse">
            <ul class="nav navbar-nav">
                @foreach(menu() as $menu)
                    <li class="active"><a class="icon-bar" href="{{ route($menu['name']) }}">{{ $menu['display_name'] }}</a></li>
                @endforeach
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
            @include('layouts.leftmenu',['menus'=>Menu()])
            {{--<ul class="list-group"><a href="#" class="list-group-item active">商品管理 <span class="fa arrow"></span></a>--}}
                {{--<li class="list-group-item"><a class="menu"  href="{{route('version')}}"> 版本列表</a></li>--}}
                {{--<li class="list-group-item"><a class="menu"  href="{{route('user')}}"> 账号管理</a></li>--}}
                {{--<li class="list-group-item"><a class="menu"  href="{{route('role')}}"> 角色管理</a></li>--}}
            {{--</ul>--}}
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



    })

    $(function () {
        $('body').on('click','.menu', function (e) {
            var url = $(this).attr('href');
            $("#myManu").load(url);
            return false;
        });
        $('#myManu').on('click', '.pagination a', function (e) {
            var url = $(this).attr('href');
            $("#myManu").load(url);
            return false;
        });
    });

    function search(url) {
        $.ajax({
            type: "POST",//方法类型
            url: url,//url
            data: $('#search_form').serialize(),
            success: function (result) {
                if (result.code >0) {
                    BootstrapDialog.alert({title: '错误', message: result.message});
                } else {
                    $("#myManu").html(result);
                }
            },
        });
    }
</script>
</html>