@extends('layouts.frontend.children')

@section('page-name' , '个人资料')

@section('child-body')

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
                                <input type="text" class="form-control no-border-form text-right" value="{{ $user->name }}">
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="span-li">
                        <div class="row">
                            <label for="" class="col-xs-3">姓名</label>
                            <div class="col-xs-9">
                                <input type="text" class="form-control no-border-form text-right" value="{{ $user->name }}">
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="span-li">
                        <div class="row">
                            <label for="" class="col-xs-3">微信账号</label>
                            <div class="col-xs-9">
                                <input type="text" class="form-control no-border-form text-right" value="{{ $user->name }}">
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
                            <div class="col-xs-6">
                                <input type="text" class="form-control no-border-form text-right" value="{{ $user->phone }}">
                            </div>
                            <div class="col-xs-3"><span class="text-danger" style="line-height: 35px;">不可修改</span></div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="span-li">
                        <div class="row">
                            <label for="" class="col-xs-3">支付宝</label>
                            <div class="col-xs-6">
                                <input type="text" class="form-control no-border-form text-right" value="{{ $user->phone }}">
                            </div>
                            <div class="col-xs-3"><span class="text-danger" style="line-height: 35px;">不可修改</span></div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="span-li">
                        <div class="row">
                            <label for="" class="col-xs-3">银行卡号</label>
                            <div class="col-xs-6">
                                <input type="text" class="form-control no-border-form text-right" value="{{ $user->phone }}">
                            </div>
                            <div class="col-xs-3"><span class="text-danger" style="line-height: 35px;">不可修改</span></div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="span-li">
                        <div class="row">
                            <label for="" class="col-xs-3">银行支行</label>
                            <div class="col-xs-6">
                                <input type="text" class="form-control no-border-form text-right" value="{{ $user->phone }}">
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
            <span>密码设置</span>
        </div>
        <div class="panel-body">
            <ul class="user-list">
                <li>
                    <a href="">
                        登录密码
                        <span class="pull-right"><i class="fa fa-fw fa-chevron-right"></i></span>
                    </a>

                </li>
                <li>
                    <a href="">交易密码<span class="pull-right"><i class="fa fa-fw fa-chevron-right"></i></span></a>

                </li>
            </ul>
        </div>
    </div>
@stop