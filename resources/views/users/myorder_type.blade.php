@extends('layouts.frontend.children')

@section('page-name' , '交易大厅')

@section('child-body')
    @if(count($orders))
        @foreach($orders as $order)
            <div class="panel" >
                <div class="panel-heading">
                    <span>订单编号：{{ $order->hash_no }}</span>
                </div>
                <div class="panel-body">
                    <div class="row p-b-m">
                        <div class="col-xs-4">
                            <p><small>价格</small></p>
                            <p><i class="fa fa-fw fa-yen"></i> <span  class="font-md">{{ $order->price }}</span></p>
                        </div>
                        <div class="col-xs-4">
                            <p><small>数量</small></p>
                            <p><span  class="font-md">{{ $order->coins }}</span></p>
                        </div>
                        <div class="col-xs-4">
                            <p><small>总价</small></p>
                            <p><i class="fa fa-fw fa-yen"></i> <span  class="font-md">{{ $order->price * $order->coins }}</span></p>
                        </div>
                    </div>
                    <div class="row p-t-m">
                        <div class="col-xs-6">
                            <span>时间：{{ $order->created_at }}</span>
                        </div>
                        <div class="col-xs-6 text-right">
                            <span>@if($order->status == 1) <span class="label label-info">交易中</span> @elseif($order->status == 2) <span class="label label-success">已完成</span> @else <span class="label label-danger">订单取消</span> @endif</span>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
@stop

@section('js')
    <script type="text/javascript">

    </script>
@stop
