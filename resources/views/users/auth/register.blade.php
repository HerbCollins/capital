@extends('users.layouts.auth')
@section('user-auth-page-container')
    <div class="login-content">
        @if(count($errors)>0)
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div id="errors"></div>
        <form action="{{ url('user/register') }}" method="POST" class="margin-bottom-0">
            {{ csrf_field() }}
            <div class="form-group m-b-20">
                <div class="row">
                    <div class="col-xs-7">
                        <input type="text" name="phone" class="form-control input-lg" placeholder="手机号" value="{{ old('phone') }}"/>
                    </div>
                    <div class="col-xs-5">
                        <button type="button" onclick="sendSMS(this)" class="btn btn-lg btn-success" style="font-size: 12px; padding:13px 16px;">获取验证码</button>
                    </div>
                </div>
            </div>
            <div class="form-group m-b-20">
                <input type="text" name="code" class="form-control input-lg" placeholder="短信验证码" value="{{ old('code') }}"/>
            </div>
            <div class="form-group m-b-20">
                <input type="text" name="name" class="form-control input-lg" placeholder="姓名" value="{{ old('name') }}"/>
            </div>
            <div class="form-group m-b-20">
                <input type="password" name="password" class="form-control input-lg" placeholder="密码" />
            </div>
            <div class="form-group m-b-20">
                <input type="password" name="password_confirmation" class="form-control input-lg" placeholder="确认密码" />
            </div>
            <div class="form-group m-b-20">
                <input type="text" name="inviter" class="form-control input-lg" placeholder="邀请码（可不填）" value="{{ $code }}" />
            </div>
            <div class="login-buttons">
                <button type="submit" class="btn btn-success btn-block btn-lg">注 册</button>
            </div>
            <div class="m-t-20">
                已有账号? 请 <a href="{{ url('user/login') }}">登录</a>
            </div>
        </form>
    </div>
@endsection


@section('js')
    <script type="text/javascript">

        $("form").submit(function () {
            var _data = $(this).serialize();
            var _url = $(this).attr('action');
            var _method = $(this).attr('method');

            $.ajax({
                url:_url,
                data:_data,
                type:_method,
                dataType:"json",
                success:function (rst) {
                    if(rst.code == 0){
                        window.location.href = "{{ url('/user') }}"
                    }else{
                        var _alert = '<div class="alert alert-danger">' + rst.message + '</div>';
                        $("#errors").html(_alert);
                    }
                }
            });

            return false;
        });

        function sendSMS(_obj) {
            var _phone = $("input[name='phone']").val();
            var _data = {
                'phone' : _phone,
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

        function timer(_obj , _times) {
            _times--;
            $(_obj).text("重新发送（"+_times+"s)");
            if(_times >= 0){
                setTimeout(function () {
                    timer(_obj , _times);
                } , 1000);
            }else{
                $(_obj).text("重新发送");
                $(_obj).removeAttr('disabled');
            }
        }

    </script>
@stop