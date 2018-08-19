
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('version') }}">更新信息</a>
                </li>
                <li class="active">
                    <strong>添加版本</strong>
                </li>
            </ol>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>添加版本</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <form method="post" action="{{ route('version.add') }}" class="form-horizontal" id="form1">
                            <div class="form-group ">
                                <label class="col-sm-2 control-label">提示版本号</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" name="version" value="">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">更新版本号</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" name="update_version" value="">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">系统</label>
                                <div class="col-sm-3">
                                    <select class="form-control m-b" name="os_type">
                                        <option value="">请选择</option>
                                        <option value="1">IOS</option>
                                        <option value="2">Android</option>
                                    </select>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">强制更新</label>
                                <div class="col-sm-3">
                                    <select class="form-control m-b" name="mandatory_update">
                                        <option value="N">否</option>
                                        <option value="Y">是</option>
                                    </select>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">更新文案</label>
                                <div class="col-sm-5">
                                    <textarea class="form-control" rows="5" name="content"></textarea>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <div class="col-sm-10 col-sm-offset-2">
                                    {!! csrf_field() !!}
                                    <button   class="btn btn-primary" type="button" onclick="return saveData();">保存</button>
                                    <button type="button" class="btn btn-default" onclick="history.go(-1)"
                                            style="margin-left:20px;">取消
                                    </button>
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
            if ($("input[name='update_version']").val() == '') {
                BootstrapDialog.alert({title: '错误', message: '更新版本号不能为空'});
                return false;
            }
            if ($("select[name='os_type']").val() == '') {
                BootstrapDialog.alert({title: '错误', message: '请选择系统'});
                return false;
            }
            //检查主题长度
            if ($("textarea[name='content']").val().length > 500) {
                BootstrapDialog.alert({title: '错误', message: '更新文案不能超过100个汉字'});
                return false;
            }

            if ($("textarea[name='content']").val().length == 0) {
                BootstrapDialog.alert({title: '错误', message: '请输入更新文案内容'});
                return false;
            }
            $.ajax({
                type: "POST",//方法类型
                dataType: "json",//预期服务器返回的数据类型
                url: '{{ route('version.add')}}' ,//url
                data: $('#form1').serialize(),
                success: function (result) {
                    if (result.code == 1) {
                        BootstrapDialog.alert({title: '错误', message:result.message});
                    }else if(result.code == 200){
                      location.href=result.url;
                    }
                },
            });

        }
    </script>