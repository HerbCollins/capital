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
                <div class="form-group">
                    <label for="" class="col-xs-3">新密码</label>
                    <div class="col-xs-9">
                        <input type="password" class="form-control" name="pwd" placeholder="新密码"/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-xs-3">确认密码</label>
                    <div class="col-xs-9">
                        <input type="password" class="form-control" name="rp_pwd" placeholder="确认密码"/>
                    </div>
                </div>
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