@extends('layouts.frontend.children')

@section('link')
{{ url('coins') }}
@stop

@section('page-name' , '订单详情')

@section('child-body')
    <div class="panel">
        <div class="panel-body font-md">
            <ul class="user-list">
                <li>
                    <div class="span-li">
                        <div class="row">
                            <div class="col-xs-6">
                                订单编号
                            </div>
                            <div class="col-xs-6 text-right">
                                <span><b>{{ $order_no }}</b></span>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="span-li">
                        <div class="row">
                            <div class="col-xs-6">
                                矿机
                            </div>
                            <div class="col-xs-6 text-right">
                                <span><b>{{ $miner->title }}</b></span>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="span-li">
                        <div class="row">
                            <div class="col-xs-6">
                                单价
                            </div>
                            <div class="col-xs-6 text-right">
                                <span><b>{{ $miner->price }}{{ $coin_name }}</b></span>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="span-li">
                        <div class="row">
                            <div class="col-xs-6">
                                周期时间
                            </div>
                            <div class="col-xs-6 text-right">
                                <span><b>{{ $miner->timelong }} 小时</b></span>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="span-li">
                        <div class="row">
                            <div class="col-xs-6">
                                周期收益
                            </div>
                            <div class="col-xs-6 text-right">
                                <span><b>{{ $miner->income }}{{ $coin_name }}</b></span>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="span-li">
                        <div class="row">
                            <div class="col-xs-6">
                                生命周期
                            </div>
                            <div class="col-xs-6 text-right">
                                <span><b>{{ $miner->cycle }}</b></span>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <form action="{{ url('/coins/miner/payment') }}" method="post">
    <div class="panel font-md">
        <div class="panel-body">
            <ul class="user-list">
                <li>
                    <div class="span-li">
                        <div class="row">
                            <div class="col-xs-6">
                                预计收益
                            </div>
                            <div class="col-xs-6 text-right">
                                <span data-type="income" data-price="{{ $miner->price }}" data-cycle="{{ $miner->cycle }}" data-income="{{ $miner->income }}"><b><span id="income">{{ $number * $miner->cycle * $miner->income }}</span> {{ $coin_name }}</b></span>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="span-li">
                        <div class="row">
                            <div class="col-xs-6">
                                周期总时
                            </div>
                            <div class="col-xs-6 text-right">
                                <span><b>{{ $miner->cycle * $miner->timelong }} 小时</b></span>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="span-li">
                        <div class="row">
                            <div class="col-xs-4">
                                采购数量
                            </div>
                            <div class="col-xs-8 text-right">
                                <div class="input-group">
                                      <span class="input-group-btn">
                                        <button class="btn btn-default" data-control="addition" data-toggle="minus" data-id="{{ $miner->id }}" type="button">&emsp;-&emsp;</button>
                                      </span>
                                    <input type="text" id="value_{{ $miner->id }}" data-max="{{ $miner->day_max }}" name="number" value="{{ $number }}" class="form-control text-right" placeholder="{{ $number }}">
                                    <span class="input-group-btn">
                                        <button data-control="addition" data-toggle="plus" data-id="{{ $miner->id }}" class="btn btn-default" type="button">&emsp;+&emsp;</button>
                                      </span>
                                </div><!-- /input-group -->
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>

    <div class="panel font-lg">
        <div class="panel-body text-right">
            {{ csrf_field() }}
            <input type="hidden" value="{{ $order_no }}" name="order_no">
            <input type="hidden" name="miner_id" value="{{ $miner->id }}">
            <span class="text-danger">共需支付：<span id="payment">{{ $miner->price * $number }}</span>{{ $coin_name }}</span>&emsp;&emsp;
            <button type="submit" class="btn btn-danger">&emsp;支付&emsp;</button>
        </div>
    </div>
    </form>
@stop


@section('js')
    <script type="text/javascript">

        $('form').submit(function () {
            var _data = $(this).serialize();
            var _url = $(this).attr('action');

            $.ajax({
                data:_data,
                type:"post",
                dataType:'json',
                url:_url,
                success:function (rst) {
                    if(rst.code == 0){
                        _toas =new $.Toast({
                            icon : '<i class="fa fa-check-circle fa-fw"></i>',
                            message:"购买成功",
                            type : 0
                        });
                        _toas.success();

                        setTimeout(function () {
                            window.location.href = "{{ url('user/myminer') }}"
                        } , 2000);
                    }else{
                        _toas =new $.Toast({
                            icon : '<i class="fa fa-times-circle fa-fw"></i>',
                            message:rst.message,
                            type : 0
                        });
                        _toas.error();
                    }
                }
            })

            return false;
        });

        $("[data-control='addition']").click(function () {
            var _dom = $(this);
            changeNum(_dom);
        });

        $("input[name='number']").change(function () {
            var _new_val = $(this).val();
            var _income_dom = $("[data-type='income']");
            var _income = _income_dom.data('income');
            var _cycle = _income_dom.data('cycle');
            var _price = _income_dom.data('price');
            $('#income').text(_new_val * _income * _cycle);

            $('#payment').text(_price * _new_val);
        });

        function changeNum(_dom) {
            var _method = _dom.data('toggle');
            var _id = _dom.data('id');

            if(_method == 'minus'){
                _new_val = minus(_id);
            }else{
                _new_val = plus(_id)
            }

            var _income_dom = $("[data-type='income']");
            var _income = _income_dom.data('income');
            var _cycle = _income_dom.data('cycle');
            var _price = _income_dom.data('price');
            $('#income').text(_new_val * _income * _cycle);

            $('#payment').text(_price * _new_val);
        }

        function minus(_id) {
            var _input_dom = $("#value_"+_id);
            var _value = parseInt(_input_dom.val());

            if(_value == 0)
                return 0;
            else
                _input_dom.val(_value-1);

            return _value - 1;
        }

        function plus(_id) {
            var _input_dom = $("#value_"+_id);
            var _value = parseInt(_input_dom.val());
            var _max = _input_dom.data('max');

            if(_value >= _max){
                _input_dom.val(_max);
                return _max;
            }else{
                _input_dom.val(_value+1);
                return _value+1;
            }
        }
    </script>
@stop