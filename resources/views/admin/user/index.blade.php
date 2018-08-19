<div class="container-fluid">
        <div class="row">
            <div class="col-sm-10">
                <div class="row wrapper border-bottom white-bg page-heading">
                    <div class="col-lg-10">
                        <ol class="breadcrumb">
                            <li>
                                <a href="{{ route('user') }}">用户管理</a>
                            </li>
                            <li class="active">
                                <strong>用户列表</strong>
                            </li>
                        </ol>
                    </div>
                </div>
                <div class="wrapper wrapper-content animated fadeInRight">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <h5>搜索条件</h5>
                                    <div class="ibox-tools">
                                        <a class="collapse-link">
                                            <i class="fa fa-chevron-up"></i>
                                        </a>
                                        <a class="close-link">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <h5>查询结果</h5>
                                    <div class="ibox-tools">
                                        <a class="collapse-link">
                                            <i class="fa fa-chevron-up"></i>
                                        </a>
                                        <a class="close-link">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="ibox-footer text-right">
                                    <a href="{{ route('user.add') }}" class="menu btn btn-w-m btn-sm btn-primary">新增</a>
                                </div>
                                <div class="ibox-content">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>用户名</th>
                                                <th>邮箱</th>
                                                <th>添加时间</th>
                                                <th>角色</th>
                                                <th>操作</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($users as $user)
                                                <tr>
                                                    <td>{{ $user->id }}</td>
                                                    <td>{{ $user->name }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>{{ $user->created_at }}</td>
                                                    <td>
                                                        @foreach($user->cachedRoles() as $role)
                                                            <span class="label label-primary">{{ $role->display_name }}</span>
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('user.edit',['id'=>$user->id]) }}"
                                                           class="menu btn btn-warning btn-rounded">编辑</a>
                                                        <a href="{{ route('user.delete',['id'=>$user->id]) }}"
                                                           class=" menu btn btn-danger btn-rounded">删除</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="ibox-footer text-right">
                                    {!! $users->render() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('a.btn-danger').on('click', function (e) {
                e.preventDefault();
                e.stopPropagation();
                var that = this;
                BootstrapDialog.confirm('确定要删除吗？', function (result) {
                    if (result) {
                        location.href = that.href;
                    }
                });
            });
        })
    </script>