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
                                <strong>修改用户</strong>
                            </li>
                        </ol>
                    </div>
                </div>

                <div class="wrapper wrapper-content">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <h5>修改用户</h5>
                                </div>
                                <div class="ibox-content">
                                    <form class="form-horizontal" method="post"
                                          action="{{ route('user.update',['id'=>$user->id]) }}">
                                        {{csrf_field()}}
                                        {{--<p>Sign in today for more expirience.</p>--}}
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">用户名</label>
                                            <div class="col-lg-6">
                                                <input type="text" disabled placeholder="Name" value="{{ $user->name }}"
                                                       class="form-control">
                                            </div>
                                        </div>
                                        <div class="hr-line-dashed"></div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">邮箱</label>
                                            <div class="col-lg-6">
                                                <input type="email" disabled placeholder="Email"
                                                       value="{{ $user->email }}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="hr-line-dashed"></div>
                                        <div class="form-group {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                            <label class="col-lg-2 control-label">密码</label>
                                            <div class="col-lg-6">
                                                <input type="password" name="password" placeholder="密码" value=""
                                                       class="form-control">
                                                <span class="help-block m-b-none">{{ $errors->first('password') }}</span>
                                            </div>
                                        </div>
                                        <div class="hr-line-dashed"></div>
                                        <div class="form-group  {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                            <label class="col-lg-2 control-label">密码确认</label>
                                            <div class="col-lg-6">
                                                <input type="password" name="password_confirmation" placeholder="确认密码"
                                                       value="" class="form-control">
                                                <span class="help-block m-b-none">{{ $errors->first('password_confirmation') }}</span>
                                            </div>
                                        </div>
                                        <div class="hr-line-dashed"></div>
                                        <div class="form-group {{ $errors->has('role_id') ? ' has-error' : '' }}">
                                            <label class="col-sm-2 control-label">角色列表</label>
                                            <div class="col-sm-6">
                                                @foreach($roles as $k => $role)
                                                    <div class="module-list">
                                                        <h4 class="checkbox">
                                                            <label><input type="checkbox" class="minimal"
                                                                          name="role_id[]"
                                                                          value="{{$role->id}}" {{isset($selected_roles[$role->id])?"checked":''}} /> {{$role->display_name}}
                                                            </label>
                                                        </h4>
                                                    </div>
                                                @endforeach
                                                @if ($errors->has('role_id'))
                                                    <span class="help-block">
                                                {{ $errors->first('role_id') }}
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="hr-line-dashed"></div>
                                        <div class="form-group">
                                            <div class="col-lg-offset-2 col-lg-6">
                                                <button class="btn btn-info" type="submit">修改</button>
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