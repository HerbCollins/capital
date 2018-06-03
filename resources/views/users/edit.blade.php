@extends('layouts.frontend.children')

@section('link')
{{ url('user') }}
@stop

@section('page-name' , '个人资料')

@section('top-right')
    <button type="button" id="save_button" class="btn btn-link btn-sm no-padding" style="color:#000000">保存</button>
@stop

@section('child-body')
    <form action="{{ url('user/update') }}" method="post">
        {{ csrf_field() }}
        <div class="panel font-md">
            <div class="panel-heading">
                <span>账号设置</span>
            </div>
            <div class="panel-body">
                <ul class="user-list">
                    <li>
                        <div class="span-li">
                            <div class="row">
                                <label for="" class="col-xs-3">昵称</label>
                                <div class="col-xs-9">
                                    <input type="text" class="form-control no-border-form text-right" name="name" value="{{ $user->name }}">
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="span-li">
                            <div class="row">
                                <label for="" class="col-xs-3">姓名</label>
                                <div class="col-xs-9">
                                    <input type="text" class="form-control no-border-form text-right" name="username" value="{{ $user->username }}">
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="span-li">
                            <div class="row">
                                <label for="" class="col-xs-3">手机号码</label>
                                <div class="col-xs-6">
                                    <input type="text" class="form-control no-border-form text-right" disabled="disabled" value="{{ $user->phone }}">
                                </div>
                                <div class="col-xs-3"><span class="text-danger" style="line-height: 35px;">不可修改</span></div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="panel font-md">
            <div class="panel-heading">
                <span>收款设置</span>
            </div>
            <div class="panel-body">
                <ul class="user-list">
                    <li>
                        <div class="span-li">
                            <div class="row">
                                <label for="" class="col-xs-3">微信</label>
                                <div class="col-xs-9">
                                    <input type="text" class="form-control no-border-form text-right" name="wechat" value="{{ $user->wechat }}">
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="span-li">
                            <div class="row">
                                <label for="" class="col-xs-3">支付宝</label>
                                <div class="col-xs-9">
                                    <input type="text" class="form-control no-border-form text-right" name="alipay" value="{{ $user->alipay }}">
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="span-li">
                            <div class="row">
                                <label for="" class="col-xs-3">银行卡号</label>
                                <div class="col-xs-9">
                                    <input type="text" class="form-control no-border-form text-right" name="bankcard" value="{{ $user->bankcard }}">
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="span-li">
                            <div class="row">
                                <label for="" class="col-xs-3">银行支行</label>
                                <div class="col-xs-9">
                                    <input type="text" class="form-control no-border-form text-right" name="bank" value="{{ $user->bank }}">
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="panel font-md">
            <div class="panel-heading">
                <span>密码设置</span>
            </div>
            <div class="panel-body">
                <ul class="user-list">
                    <li>
                        <a href="{{ url('user/reset') }}">
                            登录密码
                            <span class="pull-right"><i class="fa fa-fw fa-chevron-right"></i></span>
                        </a>

                    </li>
                    <li>
                        <a href="{{ url('user/payment') }}">交易密码<span class="pull-right"><i class="fa fa-fw fa-chevron-right"></i></span></a>
                    </li>
                </ul>
            </div>
        </div>
    </form>
@stop


@section('js')
    <script type="text/javascript">
        $("#save_button").click(function () {
            var _data = $("form").serialize();
            var _method = $("form").attr('method');
            var _url = $("form").attr('action');

            $.ajax({
                url:_url,
                type:_method,
                dataType:"json",
                data:_data,
                beforeSend:function () {
                    _toas =new $.Toast({
                        icon : '<i class="fa fa-spinner fa-spin fa-fw"></i>',
                        message:"保存中",
                        type : 0
                    });
                    _toas.success();
                },
                success:function (rst) {
                    console.log(rst)
                    _toas =new $.Toast({
                        icon : '<i class="fa fa-fw fa-check-circle"></i>',
                        message:'保存成功',
                        type : 0
                    });
                    _toas.success();
                },
                error:function () {
                    _toas =new $.Toast({
                        icon : '<i class="fa fa-fw fa-check-circle"></i>',
                        message:'保存失败',
                        type : 1
                    });
                    _toas.error();
                }
            })
        });


    </script>
@stop