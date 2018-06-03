@extends('layouts.frontend.children')

@section('link')
{{ url('user') }}
@stop

@section('page-name' , '提现')

@section('child-body')
    <form action="{{ url('user/withdraw_result') }}" method="post">
        {{ csrf_field() }}
        <div class="panel">
            <div class="panel-body">
                <div class="text-center font-md">
                    RMB余额
                    <p class="p-t-m"><b><i class="fa fa-fw fa-rmb"></i> {{ $rmb }}</b></p>
                </div>
                <hr>
                <div class="form-group">
                    <label for="">
                        请输入提现的金额
                    </label>
                    <input type="number" name="rmb" data-max="{{ $rmb }}" class="form-control" placeholder="0">
                </div>
                <div class="form-group p-t-m">
                    <button type="submit" class="btn btn-success btn-block">确认提现</button>
                </div>
                <div class="form-group">
                    <a href="{{ url('user/mycash') }}" class="btn btn-info btn-block">RMB明细</a>
                </div>
            </div>
        </div>
    </form>
@stop

@section('js')
    <script type="text/javascript">
    </script>
@stop
