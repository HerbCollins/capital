@extends('layouts.frontend.children')

@section('link')
    {{ url('user') }}
@stop

@section('page-name' , '交易大厅')

@section('child-body')
    <div class="panel" >
        <div class="panel-body">
            <ul class="user-list">
                <li><a href="{{ url('user/sendsell') }}">
                        自主出售
                        <span class="pull-right"><i class="fa fa-fw fa-chevron-right"></i></span>
                    </a></li>
                <li><a href="{{ url('user/sendbought') }}">
                        自主求购
                        <span class="pull-right"><i class="fa fa-fw fa-chevron-right"></i></span>
                    </a></li>
                <li><a href="{{ url('user/getbought') }}">
                        接单买入
                        <span class="pull-right"><i class="fa fa-fw fa-chevron-right"></i></span>
                    </a></li>
                <li><a href="{{ url('user/getsell') }}">
                        接单卖出
                        <span class="pull-right"><i class="fa fa-fw fa-chevron-right"></i></span>
                    </a></li>
            </ul>
        </div>
    </div>
@stop

@section('js')
    <script type="text/javascript">

    </script>
@stop
