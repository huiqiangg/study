<div class="container-fluid">
        <div class="row">
            <div class="col-sm-10">
                <div class="row wrapper border-bottom white-bg page-heading">
                    <div class="col-lg-10">
                        <ol class="breadcrumb">
                            <li>
                                <a href="{{ route('role') }}">角色管理</a>
                            </li>
                            <li class="active">
                                <strong>添加角色</strong>
                            </li>
                        </ol>
                    </div>
                </div>
                <div class="wrapper wrapper-content animated fadeInRight">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <h5>{{ $title }}</h5>
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
                                    <form method="post" action="{{ route('role.store') }}" class="form-horizontal">
                                        <div class="form-group {{ $errors->has('display_name') ? ' has-error' : '' }}">
                                            <label class="col-sm-2 control-label">角色名</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" required name="display_name"
                                                       placeholder="角色名">
                                                @if ($errors->has('display_name'))
                                                    <span class="help-block">
                                                {{ $errors->first('display_name') }}
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="hr-line-dashed"></div>
                                        <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
                                            <label class="col-sm-2 control-label">简介</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" required name="description"
                                                       placeholder="角色简介">
                                                @if ($errors->has('description'))
                                                    <span class="help-block">
                                                {{ $errors->first('description') }}
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="hr-line-dashed"></div>
                                        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                            <label class="col-sm-2 control-label">标示符</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" required name="name"
                                                       placeholder="标示符">
                                                @if ($errors->has('name'))
                                                    <span class="help-block">
                                                {{ $errors->first('name') }}
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="hr-line-dashed"></div>
                                        <div class="form-group {{ $errors->has('permission_id') ? ' has-error' : '' }}">

                                            <label class="col-sm-2 control-label">权限列表</label>
                                            <div class="col-sm-10">
                                                @foreach($permissions as $permission)
                                                    <hr class="col-lg-12">

                                                    <h4 class="checkbox col-lg-12" style="margin-left: -20px">
                                                        <label>
                                                            <input type="checkbox" class="minimal module-level1"
                                                                   name="permission_id[]"
                                                                   value="{{ $permission['id'] }}" {{isset($old['permission_id'][$permission['id']])?"checked":''}} /> {{$permission['display_name']}}
                                                        </label>
                                                    </h4>

                                                    @if(!empty($permission['_child']))
                                                        @foreach($permission['_child'] as $permiss)
                                                            <div class="checkbox col-lg-10">
                                                                <div>
                                                                    <label>
                                                                        <input type="checkbox"
                                                                               class="minimal module-level2 casecade"
                                                                               name="permission_id[]"
                                                                               value="{{ $permiss['id'] }}" {{isset($old['permission_id'][$permiss['id']])?"checked":'' }} /> {{ $permiss['display_name'] }}
                                                                    </label>
                                                                </div>
                                                                <div class="checkbox col-lg-10">
                                                                    @if(!empty($permiss['_child']))
                                                                        @foreach($permiss['_child'] as $per)
                                                                            <label>
                                                                                <input type="checkbox"
                                                                                       class="minimal module-level2"
                                                                                       name="permission_id[]"
                                                                                       value="{{ $per['id'] }}" {{isset($old['permission_id'][$per['id']])?"checked":'' }} /> {{ $per['display_name'] }}
                                                                            </label>
                                                                        @endforeach
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="hr-line-dashed"></div>
                                        <div class="form-group">
                                            <div class="col-sm-10 col-sm-offset-2">
                                                {!! csrf_field() !!}
                                                <button type="submit" class="btn btn-primary">提交</button>
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
            </div>
        </div>
    </div>
<script type="text/javascript">
    $(document).ready(function () {
        $('.casecade').on('click', function () {
            if (this.checked) {
                $(this).parent('label').parent('div').next('div.checkbox').find("input[type='checkbox']").prop('checked', true);
            } else {
                $(this).parent('label').parent('div').next('div.checkbox').find("input[type='checkbox']").prop('checked', false);
            }
        });
    })
</script>
