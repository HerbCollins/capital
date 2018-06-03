@extends('layouts.frontend.children')

@section('link')
{{ url('user') }}
@stop

@section('page-name' , '充值')

@section('child-body')
    <div class="panel">
        <div class="panel-body">
            <div class="text-center font-md">
                RMB余额
                <p class="p-t-m"><b><i class="fa fa-fw fa-rmb"></i> {{ $rmb }}</b></p>
            </div>
            <hr />
            <div class="row ">
                <div class="col-xs-8 col-xs-offset-2">
                    <img src="http://tt35.iiio.top/attachment/images/1/2018/04/FUesPOil6LszvLll4PucVZuP6Uo4Lz.png" alt="">
                </div>

            </div>
            <p class="text-center font-md">RMB充值可联系客服微信咨询</p>
        </div>
    </div>
@stop

@section('js')

@stop