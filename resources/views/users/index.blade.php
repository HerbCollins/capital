@extends('layouts.frontend.master')

@section('title', 'User Panel')

@section('body')
    <div class="row font-md">
        <div class="panel" >
                <div class="panel-body" style="padding-bottom: 0px;">
                    <div class="row">
                        <div class="col-xs-6" style=" border-right:1px solid #eee;">
                            <div class="row">
                                <div class="col-xs-5" >
                                    <img src="http://tt35.iiio.top/attachment/images/1/2018/04/RhmdRBFdD4v474DZw6MvdkJhxvvk2H.png" class="avatar" alt="">
                                </div>
                                <div class="col-xs-7" style="padding:0px;">
                                    <p class="m-b-m">ID:1011</p>
                                    <p>昵称：全球总裁</p>
                                    <p class="m-t-m"><span class="label label-default">全球vip1</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="row">
                                <div class="col-xs-8">
                                    <p class="m-b-m">全球：</p>
                                    <h4>11422.00</h4>
                                    <p class="m-t-m">[推荐人：总店]</p>
                                </div>
                                <div class="col-xs-4">
                                    <p class="m-b-l"><a href="" class="label label-info">提现</a></p>
                                    <p class="m-t-l"><a href="" class="label label-primary">充值</a></p>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="row text-center m-t-l bg-dark p-a">
                        <div class="col-xs-3">
                            <a href="">
                                <p class="m-b-m"><span>生产数</span></p>
                                <p>2</p>
                            </a>
                        </div>
                        <div class="col-xs-3">
                            <a href="">
                                <p class="m-b-m"><span>完成数</span></p>
                                <p>2</p>
                            </a>
                        </div>
                        <div class="col-xs-3">
                            <a href="">
                                <p class="m-b-m"><span>交易</span></p>
                                <p>2</p>
                            </a>
                        </div>
                        <div class="col-xs-3">
                            <a href="">
                                <p class="m-b-m"><span>好评</span></p>
                                <p>2</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        <div class="panel">
            <div class="panel-body text-center" >
                <div class="row">
                    <div class="col-xs-3">
                        <a href="">
                            <span style="display: block;" class="m-b-m"><i class="fa fa-fw fa-yen fa-2x"></i></span>
                            <span>我的订单</span>
                        </a>
                    </div>
                    <div class="col-xs-3">
                        <a href="">
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
                        <a href="">
                            <span style="display: block;" class="m-b-m"><i class="fa fa-fw fa-edit fa-2x"></i></span>
                            <span>全球签到</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="panel font-md">
            <div class="panel-body" style="padding-bottom:0px;">
                <ul class="user-list">
                    <li><a href="">
                            <i class="fa fa-fw fa-star"></i> 我的资料
                            <span class="pull-right"><i class="fa fa-fw fa-chevron-right"></i></span>
                        </a></li>
                    <li><a href="">
                            <i class="fa fa-fw fa-search"></i> 账单明细
                            <span class="pull-right"><i class="fa fa-fw fa-chevron-right"></i></span>
                        </a></li>
                    <li><a href="">
                            <i class="fa fa-fw fa-yen"></i> 提现明细
                            <span class="pull-right"><i class="fa fa-fw fa-chevron-right"></i></span>
                        </a></li>
                    <li><a href="">
                            <i class="fa fa-fw fa-user"></i> 会员招募
                            <span class="pull-right"><i class="fa fa-fw fa-chevron-right"></i></span>
                        </a></li>
                    <li><a href="">
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
