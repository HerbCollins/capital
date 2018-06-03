@extends('layouts.frontend.children')

@section('link')
{{ url('user') }}
@stop

@section('page-name' , '提现操作')

@section('child-body')
    <div class="panel">
        <div class="panel-body text-center">
            提现已提交，正在等待管理员处理！
        </div>
    </div>
@stop