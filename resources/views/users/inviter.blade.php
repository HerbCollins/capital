@extends('layouts.frontend.children')

@section('page-name' , '会员招募')

@section('child-body')
    <div class="panel" >
        <div class="panel-body text-center">
            <h4>推荐码：{{ $hash }}</h4>
            {!! QrCode::size(200)->generate($url); !!}
        </div>
    </div>
@stop

@section('js')
    <script type="text/javascript">

    </script>
@stop
