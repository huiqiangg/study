@extends('layouts.master')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <ol class="breadcrumb">
                <li>
                    <a href="#">用户管理</a>
                </li>
                <li class="active">
                    <strong>修改密码</strong>
                </li>
            </ol>
        </div>
    </div>


    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>修改密码</h5>
                    </div>
                    <div class="ibox-content">
                        <form class="form-horizontal" method="post" action="{{ route('user.password', Auth::user() ) }}">
                            {{csrf_field()}}
                            {{--<p>Sign in today for more expirience.</p>--}}
                            <div class="form-group">
                                <label class="col-lg-2 control-label">用户名</label>
                                <div class="col-lg-6">
                                    <p class="form-control-static text-info">
                                        {{$show['userinfo']->name}}
                                    </p>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group {{ $errors->has('password_original') ? ' has-error' : '' }}">
                                <label class="col-lg-2 control-label">原密码</label>
                                <div class="col-lg-6">
                                    <input type="password" name="password_original" placeholder="Original Password"  value="{{old('password')}}"  class="form-control">
                                    <span class="help-block m-b-none">{{ $errors->first('password_original') }}</span>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                                <label class="col-lg-2 control-label">密码</label>
                                <div class="col-lg-6">
                                    <input type="password" name="password" placeholder="Password"  value="{{old('password')}}"  class="form-control">
                                    <span class="help-block m-b-none">{{ $errors->first('password') }}</span>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group  {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <label class="col-lg-2 control-label">密码确认</label>
                                <div class="col-lg-6">
                                    <input type="password" name="password_confirmation" placeholder="Confirmation Password"  value="{{old('password_confirmation')}}"  class="form-control">
                                    <span class="help-block m-b-none">{{ $errors->first('password_confirmation') }}</span>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-6">
                                    <button class="btn btn-info" type="submit">确认</button>
                                    <button class="btn btn-default" type="reset" >重置</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
