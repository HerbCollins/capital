@extends('layouts.frontend.children')

@section('link')
    {{ url('user') }}
@stop

@section('page-name' , '我的订单')

@section('child-body')
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#working" aria-controls="home" role="tab" data-toggle="tab">生产中</a></li>
        <li role="presentation"><a href="#finished" aria-controls="profile" role="tab" data-toggle="tab">生产完成</a></li>
    </ul>
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="working">
            @if(count($working))
                @foreach($working as $work)
                <div class="panel" >
                    <div class="panel-heading">
                        <span>订单编号：{{ $work->order_no }}</span>
                    </div>
                    <div class="panel-body text-left">
                        <div class="row p-b-m">
                            <div class="col-xs-4">
                                <p class="p-b-m"><small><b>矿机</b></small></p>
                                <p class="font-md">{{ $work->miner->title }}</p>
                            </div>
                            <div class="col-xs-3">
                                <p class="p-b-m"><small><b>周期生产</b></small></p>
                                <p class="font-md">{{ $work->miner->income }}</p>
                            </div>
                            <div class="col-xs-5">
                                <p class="p-b-m"><small><b>已生产周期 / 生产总周期</b></small></p>
                                <p class="font-md">{{ $work->finished }} / {{ $work->miner->cycle }}</p>
                            </div>
                        </div>
                        <div class="row p-t-m">
                            <div class="col-xs-4">
                                <p class="p-b-m"><small><b>购买数量</b></small></p>
                                <p class="font-md">{{ $work->number }}</p>
                            </div>
                            <div class="col-xs-4">
                                <p class="p-b-m"><small><b>已生产</b></small></p>
                                <p class="font-md">{{ $work->finished * $work->number * $work->miner->income }}</p>
                            </div>
                            <div class="col-xs-4">
                                <div data-type="ring" data-finished="{{ $work->finished }}" data-cycle="{{ $work->miner->cycle }}"></div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            @else
                <div class="panel" >
                    <div class="panel-body text-center">
                        暂无生产
                    </div>
                </div>
            @endif
        </div>
        <div role="tabpanel" class="tab-pane" id="finished">
            @if(count($finished))
                @foreach($finished as $finish)
                    <div class="panel" >
                        <div class="panel-heading">
                            <span>订单编号：{{ $finish->order_no }}</span>
                        </div>
                        <div class="panel-body text-left">
                            <div class="row p-b-m">
                                <div class="col-xs-4">
                                    <p class="p-b-m"><small><b>矿机</b></small></p>
                                    <p class="font-md">{{ $finish->miner->title }}</p>
                                </div>
                                <div class="col-xs-3">
                                    <p class="p-b-m"><small><b>周期生产</b></small></p>
                                    <p class="font-md">{{ $finish->miner->income }}</p>
                                </div>
                                <div class="col-xs-5">
                                    <p class="p-b-m"><small><b>已生产周期 / 生产总周期</b></small></p>
                                    <p class="font-md">{{ $finish->finished }} / {{ $finish->miner->cycle }}</p>
                                </div>
                            </div>
                            <div class="row p-t-m">
                                <div class="col-xs-4">
                                    <p class="p-b-m"><small><b>购买数量</b></small></p>
                                    <p class="font-md">{{ $finish->number }}</p>
                                </div>
                                <div class="col-xs-4">
                                    <p class="p-b-m"><small><b>已生产</b></small></p>
                                    <p class="font-md">{{ $finish->finished * $finish->number * $finish->miner->income }}</p>
                                </div>
                                <div class="col-xs-4">
                                    <div data-type="ring" data-finished="{{ $finish->finished }}" data-cycle="{{ $finish->miner->cycle }}"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="panel" >
                    <div class="panel-body text-center">
                        暂无完成
                    </div>
                </div>
            @endif
        </div>
    </div>
@stop

@section('js')
    <script src="{{ asset('js/circleChart.js') }}"></script>
    <script>
        var _rings = $("[data-type='ring']");
        _rings.each(function (i,k) {
            var _finished = $(k).data('finished');
            var _cycle = $(k).data('cycle');
            $(k).circleChart({
                size:40,
                value: _finished / _cycle * 100,
                text: 0,
                onDraw: function(el, circle) {
                    circle.text(Math.round(circle.value) + "%");
                }
            });
        })
    </script>
@stop