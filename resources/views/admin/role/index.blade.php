<div class="container-fluid">
        <div class="row">
            <div class="col-sm-10">
                <ol class="breadcrumb">
                    <li class="active">商品管理
                    </li>
                    <li class="active">商品列表
                    </li>
                </ol>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        搜索
                    </div>
                    <div class="panel-body">
                        <form role="form" class="form-inline">
                            <div class="form-group">
                                <label for="name">名称</label>
                                <input type="text" class="form-control" id="name" placeholder="请输入名称">
                            </div>
                            <div class="form-group">
                                <label for="name">状态</label>
                                <select class="form-control">
                                    <option>上架</option>
                                    <option>下架</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-default">开始搜索</button>
                            </div>
                        </form>
                        <div class="ibox-footer text-right">
                            <a href="{{ route('role.create') }}" class="menu btn btn-w-m btn-sm btn-primary">新增</a>
                        </div>
                    </div>
                </div>
                <!--
                    列表展示
                -->
                <div class="table-responsive">
                    <table class="table table-striped ">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>角色名称</th>
                            <th>简介</th>
                            <th>角色标识符</th>
                            <th>创建时间</th>
                            <th>更新时间</th>
                            <th>操作</th>
                        </tr>

                        </thead>
                        <tbody>
                        @forelse($roles as $role)
                            <tr>
                                <td>{{ $role->id }}</td>
                                <td>{{ $role->display_name }}</td>
                                <td>{{ $role->description }}</td>
                                <td>{{ $role->name }}</td>
                                <td>{{ $role->created_at }}</td>
                                <td>{{ $role->updated_at }}</td>
                                <td>
                                    @if($role->name != 'admin')
                                        <a type="button" class="menu btn btn-w-m btn-sm btn-info" href="{{ route('role.edit', ['id'=>$role->id]) }}">修改</a>
                                        <a type="button" class="btn btn-w-m btn-sm btn-danger data-delete" href="{{ route('role.delete', ['id'=>$role->id]) }}">删除</a>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="12" class="no-data" align="center">
                                    <p class="bg-warning" style="padding:10px;">No data</p>
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table >
                    <div style="float: right;">
                        {!! $roles  ->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>