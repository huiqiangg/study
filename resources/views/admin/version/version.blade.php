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
                </div>
            </div>
            <!--
                列表展示
            -->
            <div class="table-responsive">
                <table class="table table-striped ">
                    <thead>
                    <tr>
                        <th style='width:10%;'>序号</th>
                        <th style='width:10%;'>提示版本号</th>
                        <th style='width:10%;'>更新版本号</th>
                        <th style='width:10%;'>强制更新</th>
                        <th style='width:10%;'>系统</th>
                        <th style='overflow:hidden;white-space:nowrap;text-overflow:ellipsis;width:40%;'>更新文案</th>
                        <th style='width:10%;'>操作</th>
                    </tr>

                    </thead>
                    <tbody>
                    @foreach($paginator as $key=>$v)
                        <tr>
                            <td>{{ $v->id }}</td>
                            <td>{{ $v->version }}</td>
                            <td>{{$v->update_version}}</td>
                            <td>{{ $v->mandatory_update }}</td>
                            <td>{{$v->os_type==1?'IOS':'Android' }}</td>
                            <td style='overflow:hidden;white-space:nowrap;text-overflow:ellipsis;width:40%;'>{{$v->content }}</td>
                            <td>
                                    <a  href="{{ route('version.update',['id'=>$v->id]) }}" class="menu btn btn-warning btn-rounded">编辑</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table >
                <div style="float: right;">
                    {!! $paginator->render() !!}
                </div>
            </div>
        </div>
    </div>
</div>
