<div class="container-fluid">
    <div class="col-sm-10">
        <ol class="breadcrumb">
            <li class="active">商品管理
            </li>
            <li class="active">修改
            </li>
        </ol>
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-content">
                        <form method="post"
                              class="form-horizontal" id="form">
                            <div class="form-group ">
                                <label class="col-sm-2 control-label">提示版本号</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" name="version"
                                           value="{{$new_data->version}}">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label ">更新版本号</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" name="update_version"
                                           value="{{$new_data->update_version}}">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">系统</label>
                                <div class="col-sm-3">
                                    <select class="form-control m-b" name="os_type">
                                        <option value="">请选择</option>
                                        <option value="1" {{$new_data->os_type==1? 'selected' : ''}} >IOS
                                        </option>
                                        <option value="2" {{$new_data->os_type==2? 'selected' : ''}} >Android
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">强制更新</label>
                                <div class="col-sm-3">
                                    <select class="form-control m-b" name="mandatory_update">
                                        <option value="N" {{$new_data->os_type=="N" ? 'selected' : ''}} >否
                                        </option>
                                        <option value="Y" {{$new_data->os_type=="Y" ? 'selected' : ''}} >是
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">更新文案</label>
                                <div class="col-sm-5">
                                            <textarea class="form-control" rows="5"
                                                      name="content">{{$new_data->content}}</textarea>
                                </div>
                            </div>
                            <input type="hidden" name="id" value="{{$new_data->id}}">
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <div class="col-sm-10 col-sm-offset-2">
                                    {!! csrf_field() !!}
                                    <button id="myButton" type="button" class="btn btn-primary"
                                            onclick="return saveData();">保存
                                    </button>

                                    <a class="menu" href="{{route('version')}}">
                                        <button type="button" class="btn btn-default"
                                                style="margin-left:20px;">取消
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function saveData() {
            if ($("input[name='version']").val() == '') {
                BootstrapDialog.alert({title: '错误', message: '提示版本号不能为空'});
                return false;
            }

            if ($("textarea[name='content']").val().length == 0) {
                BootstrapDialog.alert({title: '错误', message: '请输入更新文案内容'});
                return false;
            }
            $.ajax({
                type: "POST",//方法类型
                dataType: "json",//预期服务器返回的数据类型
                url: '{{ route('version.update')}}',//url
                data: $('#form').serialize(),
                success: function (result) {
                    if (result.code == 1) {
                        BootstrapDialog.alert({title: '错误', message: result.message});
                    } else if (result.code == 200) {
                        $("#myManu").load(result.url);
                    }
                },
            });

        }
    </script>