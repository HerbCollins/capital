@extends('layouts.frontend.master')

@section('body')
    <div class="miners">
        @if(isset($miners) && $miners)
            @foreach($miners as $miner)
                <div class="panel">
                    <div class="panel-heading">
                        <span class="label label-default">VIP</span>
                        <a href="">【{{ $coin_name }}VIP1】{{ $miner->title }}</a>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-4 col-md-4">
                                <img src="{{ asset($miner->img) }}" alt="">
                            </div>
                            <div class="col-xs-8 col-md-8">
                                <p>周期收益: {{ $miner->income }}{{ $coin_name }}币</p>
                                <p>周期时间: {{ $miner->timelong }}小时</p>
                                <p>收益周期: {{ $miner->cycle }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <p>累计限购{{ $miner->max }}个 可同时存在{{ $miner->exist_max }}个 每天限购{{ $miner->day_max }}个</p>
                                <p><span>单价：{{ $miner->price }} {{ $coin_name }}币</span></p>
                                <hr>
                                <form action="{{ url('coins/miner/buyorder') }}" method="post">
                                    <div class="row">
                                        <div class="col-xs-7">
                                            <div class="input-group">
                                                <span class="input-group-btn">
                                                    <button class="btn btn-default" data-control="addition"
                                                            data-toggle="minus" data-id="{{ $miner->id }}" type="button">&emsp;-&emsp;</button>
                                                </span>
                                                    <input type="text" id="value_{{ $miner->id }}"
                                                           data-max="{{ $miner->day_max }}" name="number" value="10"
                                                           class="form-control text-right" placeholder="10">
                                                <span class="input-group-btn">
                                                    <button data-control="addition" data-toggle="plus"
                                                            data-id="{{ $miner->id }}" class="btn btn-default"
                                                            type="button">&emsp;+&emsp;</button>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-xs-4">
                                            {{ csrf_field() }}
                                            <input type="hidden" value="{{ $miner->id }}" name="miner_id"><button type="submit" class="btn btn-primary pull-right">立即购买</button></div>
                                    </div>


                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
@stop

@section('js')
    <script type="text/javascript">
        $("[data-control='addition']").click(function () {
            var _dom = $(this);

            var _method = _dom.data('toggle');
            var _id = _dom.data('id');

            if (_method == 'minus') {
                minus(_id);
            } else {
                plus(_id)
            }
        });

        function minus(_id) {
            var _input_dom = $("#value_" + _id);
            var _value = parseInt(_input_dom.val());

            if (_value == 0)
                return false;
            else
                _input_dom.val(_value - 1);
        }

        function plus(_id) {
            var _input_dom = $("#value_" + _id);
            var _value = parseInt(_input_dom.val());
            var _max = _input_dom.data('max');

            if (_value >= _max)
                _input_dom.val(_max);
            else
                _input_dom.val(_value + 1);
        }
    </script>
@stop