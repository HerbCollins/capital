@extends('layouts.frontend.master')

@section('body')
    <div class="row p-m">
        <div class="panel">
            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-4">
                        <p><span>当前价</span></p>
                        <span><i class="fa fa-fw fa-yen"></i></span>
                        <h2 style="display: inline-block;">{{ $present['price'] }}</h2>
                    </div>
                    <div class="col-xs-8">
                        <p class="m-b-m">
                            <span >最高价：<i class="fa fa-fw fa-yen"></i> {{ $max }}</span>
                            <span class="pull-right">最低价：<i class="fa fa-fw fa-yen"></i> {{ $min }}</span>
                        </p>
                        <p class="m-b-m">
                            涨幅：0.10%
                        </p>
                        <p class="m-b-m">
                            当前求购订单量：1
                        </p>
                        <p class="m-b-m">
                            当前出售订单量：1
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="panel ">
            <div class="panel-heading font-md">
                全球币
            </div>
            <div class="panel-body">

            </div>
        </div>

        <div class="panel font-md">
            <div class="panel-heading">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">买入</a></li>
                    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">卖出</a></li>
                </ul>
            </div>
            <div class="panel-body">
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="home">...</div>
                    <div role="tabpanel" class="tab-pane" id="profile">...</div>
                </div>
            </div>
        </div>


        <div class="panel font-md">
            <div class="panel-heading">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#wantbuy" aria-controls="home" role="tab" data-toggle="tab">求购列表</a></li>
                    <li role="presentation"><a href="#wantsell" aria-controls="profile" role="tab" data-toggle="tab">出售列表</a></li>
                </ul>
            </div>
            <div class="panel-body">
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="wantbuy">...</div>
                    <div role="tabpanel" class="tab-pane" id="wantsell">...</div>
                </div>
            </div>
        </div>
    </div>
@stop