@extends('layouts.frontend.children')

@section('link')
    {{ url()->previous() }}
@stop

@section('page-name' , 'RMB明细')

@section('child-body')
    <div class="panel" >
        <div class="panel-body">
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#outs" aria-controls="home" role="tab" data-toggle="tab">支出记录</a></li>
                <li role="presentation"><a href="#ins" aria-controls="profile" role="tab" data-toggle="tab">进账记录</a></li>
            </ul>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="outs">
                    @if(count($outs))
                        @foreach($outs as $out)

                            <div class="panel">
                                <div class="panel-heading">
                                    <span>编号：{{ $out->cash_no }}</span>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-xs-8">
                                            <p class="font-md">
                                                @if($out->type == "withdraw")
                                                    <span class="label label-info">提现</span>
                                                @else
                                                    <span class="label label-success">购买{{ $coin_name }}币</span>
                                                @endif
                                                <i class="fa fa-fw fa-yen"></i> {{ $out->rmb }}
                                            </p>
                                            <p><span>{{ $out->created_at }}</span></p>
                                        </div>
                                        <div class="col-xs-4 text-right">
                                            @if($out->status == "dealing")
                                                <span class="label label-info">处理中</span>
                                            @else
                                                @if($out->status == "finished")
                                                    <span class="label label-success">完成</span>
                                                @else
                                                    <span class="label label-danger">撤销</span>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="text-center p-t-m">暂无记录</p>
                    @endif
                </div>
                <div role="tabpanel" class="tab-pane" id="ins">
                    @if(count($ins))
                            @foreach($ins as $in)
                                <div class="panel">
                                    <div class="panel-heading">
                                        <span>编号：{{ $in->cash_no }}</span>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-xs-8">
                                                <p class="font-md">
                                                    <span>
                                                        @if($in->type == "sellcoin")
                                                            <span class="label label-info">出售{{ $coin_name }}币</span>
                                                        @else
                                                            <span class="label label-success">充值</span>
                                                        @endif
                                                        <i class="fa fa-fw fa-yen"></i> {{ $in->rmb }}
                                                    </span>
                                                </p>
                                                <p>{{ $in->created_at }}</p>
                                            </div>
                                            <div class="col-xs-4 text-right">
                                                @if($in->status == "dealing")
                                                    <span class="label label-success">完成</span>
                                                @endif
                                                @if($in->status == "finished")
                                                    <span class="label label-success">完成</span>
                                                @endif
                                                    @if($in->status == "withdraw")
                                                    <span class="label label-danger">撤销</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                    @else
                        <p class="text-center p-t-m">暂无记录</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop