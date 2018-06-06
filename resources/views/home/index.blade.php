@extends('layouts.frontend.master')

@section('body')
        <div class="col-xs-12>
            <div class="row">
                <div class="col-xs-12 banner">
                    <img src="https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1526472571948&di=073f2929284de93527e3a3426d432a8a&imgtype=0&src=http%3A%2F%2Fimg.ec.com.cn%2Farticle%2F20180424%2F20180424104512852.jpg" alt="">
                </div>
            </div>
            <div class="row m-t-m">
                <div class="col-xs-6 col-lg-6">
                    <div class="panel">
                        <div class="panel-body text-center">
                            <span class="home-icons"><i class="fa fa-fw fa-user"></i> {{ $inviter }}</span>
                            <p>直推人数</p>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-lg-6">
                    <div class="panel">
                        <div class="panel-body text-center">
                            <span class="home-icons"><i class="fa fa-fw fa-bitcoin"></i> {{ $coin }}</span>
                            <p>{{ $coin_name }}币余额/{{ $coin_name }}币</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6 col-lg-6">
                    <div class="panel">
                        <div class="panel-body text-center">
                            <span class="home-icons"><i class="fa fa-fw fa-area-chart"></i> {{ $today_get }}</span>
                            <p>今日收益/{{ $coin_name }}币</p>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-lg-6">
                    <div class="panel">
                        <div class="panel-body text-center">
                            <span class="home-icons"><i class="fa fa-fw fa-database"></i> {{ $income }}</span>
                            <p>{{ $coin_name }}币收益总额</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-md-12">
                    <div class="panel">
                        <div class="panel-heading">
                            公告
                        </div>
                        <div class="panel-body">
                            @if(count($notices))
                            <ul class="list-group">
                                @foreach($notices as $notice)
                                <a class="list-group-item" href="{{ url('/notice/'.$notice->id) }}">
                                    {{ $notice->title }}
                                </a>
                                @endforeach
                            </ul>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection