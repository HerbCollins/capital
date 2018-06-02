@extends('layouts.frontend.children')

@section('page-name' , '账单明细')

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
                        <ul class="list-group">
                            @foreach($outs as $out)
                            <li class="list-group-item">
                                <span>
                                    @if($out->type == 1)
                                        <span class="label label-info">{{ $out->log_type->type }}</span>
                                    @else
                                        <span class="label label-success">{{ $out->log_type->type }}</span>
                                    @endif
                                    {{ $out->coin }}{{ $coin_name }}币
                                </span>
                                <span class="pull-right">{{ $out->created_at }}</span>
                            </li>
                            @endforeach
                        </ul>
                        @else
                            <p class="text-center p-t-m">暂无记录</p>
                        @endif
                    </div>
                    <div role="tabpanel" class="tab-pane" id="ins">
                        @if(count($ins))
                            <ul class="list-group">
                                @foreach($ins as $in)
                                    <li class="list-group-item">
                                        <span>
                                            @if($in->type == 1)
                                                <span class="label label-info">{{ $in->log_type->type }}</span>
                                            @else
                                                <span class="label label-success">{{ $in->log_type->type }}</span>
                                            @endif
                                            {{ $in->coin }}{{ $coin_name }}币
                                        </span>
                                        <span class="pull-right">{{ $in->created_at }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-center p-t-m">暂无记录</p>
                        @endif
                    </div>
                </div>
            </div>
    </div>
@stop

@section('js')
    <script type="text/javascript">

    </script>
@stop
