@extends('layouts.frontend.children')

@section('link')
    {{ url('user/edit') }}
@stop

@section('page-name' , '更新密码')

@section('top-right')
    <button type="button" id="save_button" class="btn btn-link btn-sm no-padding" style="color:#000000">保存</button>
@stop

@section('child-body')
    <form action="{{ url('user/ajaxpayment') }}" method="post">
        {{ csrf_field() }}
        <div class="panel">
            <div class="panel-body">
                <ul class="user-list">
                    <li>
                        <div class="span-li">
                            <div class="row">
                                <label for="" class="col-xs-3">验证码</label>
                                <div class="col-xs-5">
                                    <input type="text" class="form-control no-border-form text-right" name="code" placeholder="验证码">
                                </div>
                                <div class="col-xs-4">
                                    <button type="button" onclick="sendSMS(this)" class="btn btn-success">获取验证码</button>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="span-li">
                            <div class="row">
                                <label for="" class="col-xs-3">支付密码</label>
                                <div class="col-xs-9">
                                    <input type="password" class="form-control no-border-form text-right" name="pwd" placeholder="支付密码">
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="span-li">
                            <div class="row">
                                <label for="" class="col-xs-3">重复密码</label>
                                <div class="col-xs-9">
                                    <input type="password" class="form-control no-border-form text-right" name="rp_pwd" placeholder="重复密码">
                                </div>
                            </div>
                        </div>
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
                    if(rst.code == 0){
                        console.log(rst)
                        _toas =new $.Toast({
                            icon : '<i class="fa fa-fw fa-check-circle"></i>',
                            message:'保存成功',
                            type : 0
                        });
                        _toas.success();
                    }else{
                        _toas =new $.Toast({
                            icon : '<i class="fa fa-fw fa-times-circle"></i>',
                            message:rst.message,
                            type : 1
                        });
                        _toas.error();
                    }

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

        function sendSMS(_obj) {
            var _data = {
                'phone' : "18518506037",
                '_token' : "{{ csrf_token() }}"
            };

            $.ajax({
                url:"{{ url('api/send') }}",
                type:"post",
                dataType:"json",
                data:_data,
                beforeSend:function () {
                    $(_obj).attr('disabled' , 'true');
                },
                success:function (rst) {
                    console.log(rst);
                    if(rst.code == 0){
                        timer(_obj , 60);
                    }else{
                        var _alert = '<div class="alert alert-danger">' + rst.message + '</div>';
                        $("#errors").html(_alert);
                        $(_obj).removeAttr('disabled');
                    }
                },
                error:function (jqXHR , textStatus , errorThrown) {
                    var _alert = '<div class="alert alert-danger">系统繁忙，请稍后再试</div>';
                    $("#errors").html(_alert);
                }
            })
        }


    </script>
@stop