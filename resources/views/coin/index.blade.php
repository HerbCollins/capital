@extends('layouts.frontend.master')

@section('body')
    <div class="row">
        <div class="col-xs-12 col-lg-8 col-lg-offset-2 m-t-m">
            @if(isset($miners) && $miners)
                @foreach($miners as $miner)
                    <div class="panel font-md">
                        <div class="panel-heading">
                            <span class="label label-default">VIP</span>
                            <a href="">【全球VIP1】{{ $miner->title }}</a>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-xs-4 col-md-4">
                                    <img src="{{ asset($miner->img) }}" alt="">
                                </div>
                                <div class="col-xs-8 col-md-8">
                                    <p>周期收益: {{ $miner->income }}全球币</p>
                                    <p>周期时间: {{ $miner->timelong }}小时</p>
                                    <p>收益周期: {{ $miner->cycle }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <p>累计限购{{ $miner->max }}个 可同时存在{{ $miner->exist_max }}个 每天限购{{ $miner->day_max }}个</p>
                                    <p><span>单价：{{ $miner->price }} 全球币</span></p>
                                    <hr>
                                    <p><a href="" class="btn btn-primary btn-sm pull-right">立即购买</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@stop