@extends('layouts.frontend.master')

@section('title', 'User Panel')

@section('body')
    <div class="col-lg-6 col-lg-offset-3">
        <div class="panel" >
                <div class="panel-body" style="padding-bottom: 0px;">
                    <div class="row">
                        <div class="col-xs-6" style=" border-right:1px solid #eee;">
                            <p class="m-b-m">HASH_ID:{{ $user->hash }}</p>
                            <p>昵称：{{ $user->name }}</p>
                            <p class="m-t-m"><span class="label label-default">{{ $coin_name }}vip1</span></p>
                        </div>
                        <div class="col-xs-6">
                            <div class="row">
                                <div class="col-xs-8">
                                    <p class="m-b-m">{{ $coin_name }}：{{ sprintf('%.2f' , $user->coin) }}</p>
                                    <p class="m-b-m">RMB：{{ sprintf('%.2f' , $user->rmb) }}</p>
                                    <p class="m-t-m">[推荐人：总店]</p>
                                </div>
                                <div class="col-xs-4">
                                    <p class="m-b-l"><a href="{{ url('user/withdraw') }}" class="label label-info">提现</a></p>
                                    <p class="m-t-l"><a href="{{ url('user/recharge') }}" class="label label-primary">充值</a></p>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="row text-center m-t-l bg-dark p-a">
                        <div class="col-xs-4">
                            <p class="m-b-m"><span>生产数</span></p>
                            <p>{{ $working }}</p>
                        </div>
                        <div class="col-xs-4">
                            <p class="m-b-m"><span>生产完成</span></p>
                            <p>{{ $finished }}</p>
                        </div>
                        <div class="col-xs-4">
                            <p class="m-b-m"><span>交易</span></p>
                            <p>{{ $order }}</p>
                        </div>
                    </div>
                </div>
            </div>

        <div class="panel">
            <div class="panel-body text-center" >
                <div class="row">
                    <div class="col-xs-3">
                        <a href="{{ url('user/myminer') }}">
                            <span style="display: block;" class="m-b-m"><i class="fa fa-fw fa-yen fa-2x"></i></span>
                            <span>我的订单</span>
                        </a>
                    </div>
                    <div class="col-xs-3">
                        <a href="{{ url('user/myorder') }}">
                            <span style="display: block;" class="m-b-m"><i class="fa fa-fw fa-handshake-o fa-2x"></i></span>
                            <span>交易大厅</span>
                        </a>
                    </div>
                    <div class="col-xs-3">
                        <a href="">
                            <span style="display: block;" class="m-b-m"><i class="fa fa-fw fa-truck fa-2x"></i></span>
                            <span>服务中心</span>
                        </a>
                    </div>
                    <div class="col-xs-3">
                        @if($is_signed)
                            <a href="javascript:void(0);" class="text-success">
                                <span style="display: block;" class="m-b-m"><i class="fa fa-fw fa-check-circle fa-2x"></i></span>
                                <span>今日已签</span>
                            </a>
                        @else
                            <a href="javascript:sign(this);">
                                <span style="display: block;" class="m-b-m"><i class="fa fa-fw fa-edit fa-2x"></i></span>
                                <span>签到</span>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="panel font-md">
            <div class="panel-body" style="padding-bottom:0px;">
                <ul class="user-list">
                    <li><a href="{{ url('user/edit') }}">
                            <i class="fa fa-fw fa-star"></i> 我的资料
                            <span class="pull-right"><i class="fa fa-fw fa-chevron-right"></i></span>
                        </a></li>
                    <li><a href="{{ url('user/mybill') }}">
                            <i class="fa fa-fw fa-search"></i> 账单明细
                            <span class="pull-right"><i class="fa fa-fw fa-chevron-right"></i></span>
                        </a></li>
                    <li><a href="{{ url('user/mycash') }}">
                            <i class="fa fa-fw fa-yen"></i> RMB明细
                            <span class="pull-right"><i class="fa fa-fw fa-chevron-right"></i></span>
                        </a></li>
                    <li><a href="{{ url('user/inviter') }}">
                            <i class="fa fa-fw fa-user"></i> 会员招募
                            <span class="pull-right"><i class="fa fa-fw fa-chevron-right"></i></span>
                        </a></li>
                    <li><a href="{{ url('user/mygroup') }}">
                            <i class="fa fa-fw fa-users"></i> 我的团队
                            <span class="pull-right"><i class="fa fa-fw fa-chevron-right"></i></span>
                        </a></li>
                    <li>
                        <a href="{{ url('user/logout') }}">
                            <i class="fa fa-fw fa-hand-o-right"></i> 退出登录
                            <span class="pull-right"><i class="fa fa-fw fa-chevron-right"></i></span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script type="text/javascript">

        function sign(obj) {
            var _url = "{{ url('user/ajaxsign') }}";
            var _token = "{{ csrf_token() }}";
            $.ajax({
                url:_url,
                data:{'_token':_token},
                type:'post',
                dataType:'json',
                success:function (rst) {
                    if(rst.code == 0){

                        _toas =new $.Toast({
                            icon : '<i class="fa fa-fw fa-check-circle"></i>',
                            message:'签到成功',
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
                }
            });
        }
    </script>
@stop
