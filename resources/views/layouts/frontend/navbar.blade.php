<!-- Fixed navbar -->
    <div class="container">
            <div class="col-xs-12 col-lg-6 col-lg-offset-3">
                <div class="nav-box">
                    <div class="nav bottom-nav">
                        <div class="text-center">
                            <div class="col-xs-3">
                                <a href="{{ url('/') }}">
                                    <span class="icon-nav"><i class="fa fa-fw fa-home fa-2x"></i></span>
                                    <span>首页</span>
                                </a>
                            </div>
                            <div class="col-xs-3">
                                <a href="{{ url('/coins') }}">
                                    <span class="icon-nav"><i class="fa fa-fw fa-bitcoin fa-2x"></i></span>
                                    <span>{{ $coin_name }}币</span>
                                </a>
                            </div>
                            <div class="col-xs-3">
                                <a href="{{ url('/transaction') }}">
                                    <span class="icon-nav"><i class="fa fa-fw fa-handshake-o fa-2x"></i></span>
                                    <span>交易</span>
                                </a>
                            </div>
                            <div class="col-xs-3">
                                <a href="{{ url('/user') }}">
                                    <span class="icon-nav"><i class="fa fa-fw fa-user-o fa-2x"></i></span>
                                    <span>我的</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
