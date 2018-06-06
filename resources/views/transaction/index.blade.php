@extends('layouts.frontend.master')

@section('body')
    <div class="col-lg-6 col-lg-offset-3">
        <div class="panel">
            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-4">
                        <p><span>当前价</span></p>
                        <span><i class="fa fa-fw fa-yen"></i></span>
                        <h2 style="display: inline-block;">{{ $present['price'] }}</h2>
                    </div>
                    <div class="col-xs-8">
                        <p class="m-b-m">
                            <span >最高价：<i class="fa fa-fw fa-yen"></i> {{ $max }}</span>
                            <span class="pull-right">最低价：<i class="fa fa-fw fa-yen"></i> {{ $min }}</span>
                        </p>
                        <p class="m-b-m">
                            涨幅：{{ $increase * 100 }}%
                        </p>
                        <p class="m-b-m">
                            当前求购订单量：{{ $bought }}
                        </p>
                        <p class="m-b-m">
                            当前出售订单量：{{ $sell }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="panel ">
            <div class="panel-heading font-md">
                {{ $coin_name }}
            </div>
            <div class="panel-body">
                <div id="contain" style="height: 360px;"></div>
            </div>
        </div>

        <div class="panel font-md">
            <div class="panel-heading">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">买入</a></li>
                    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">卖出</a></li>
                </ul>
            </div>
            <div class="panel-body">
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="home">
                        <p>可用{{ $coin_name }}：{{ $user->coin }}</p>
                            <form action="{{ url('transaction/wantbuy') }}" method="post">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-xs-6">
                                        <input type="number" class="form-control" name="number" placeholder="请输入购买数量">
                                    </div>
                                    <div class="col-xs-6">
                                        <input type="number" class="form-control" name="price" placeholder="请输入求购单价">
                                    </div>
                                </div>
                                <div class="m-t-m text-center">
                                    <button type="submit" class="btn btn-success">确认求购</button>
                                </div>
                            </form>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="profile">
                        <p>可用{{ $coin_name }}：{{ $user->coin }}</p>
                            <form action="{{ url('transaction/wantsell') }}" method="post">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-xs-6">
                                        <input type="number" class="form-control" name="number" placeholder="请输入卖出数量">
                                    </div>
                                    <div class="col-xs-6">
                                        <input type="number" class="form-control" name="price" placeholder="请输入卖出单价">
                                    </div>
                                </div>
                                <div class="m-t-m text-center">
                                    <button type="submit" class="btn btn-success">确认卖出</button>
                                </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>


        <div class="panel font-md">
            <div class="panel-heading">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#wantbuy" aria-controls="home" role="tab" data-toggle="tab">求购列表</a></li>
                    <li role="presentation"><a href="#wantsell" aria-controls="profile" role="tab" data-toggle="tab">出售列表</a></li>
                </ul>
            </div>
            <div class="panel-body">
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="wantbuy" data-page="0">
                        <div class="orders"></div>
                        <div class="loading text-center fade" data-loading="wantbuy">
                            <i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>
                        </div>
                        <div class="text-center p-a-m fade" data-loadmore="wantbuy">
                            <a href="javascript:loadmoreWantBuy();"  class="text-gray">加载更多</a>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="wantsell" data-page="0">
                        <div class="orders"></div>
                        <div class="loading text-center fade" data-loading="wantsell">
                            <i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>
                        </div>
                        <div class="text-center p-a-m fade" data-loadmore="wantsell">
                            <a href="javascript:loadmoreWantSell();"  class="text-gray">加载更多</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">支付密码</h4>
                    </div>
                    <form action="" id="modal_form" method="post">
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="password" class="form-control" name="payment_password" placeholder="请输入支付密码">
                                <input type="hidden" name="order_id" id="order_id">
                            </div>
                        </div>
                        <div class="modal-footer text-center">
                            <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                            <button type="submit" class="btn btn-primary">确定</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
@stop


@section('js')
    <script src="https://cdn.bootcss.com/echarts/4.1.0.rc2/echarts.js"></script>
    <script type="text/javascript">

        loadmoreWantBuy();
        loadmoreWantSell();

        function loadmoreWantBuy() {
            var _page = parseInt($("#wantbuy").data('page')) + 1;
            $('[data-loading="wantbuy"]').removeClass('fade');
            $.ajax({
                url:"{{ url('/transaction/boughtorder') }}",
                type:"post",
                dataType:"json",
                data:{'_token' : "{{ csrf_token() }}" , 'page':_page},
                success:function (rst) {
                    console.log(rst)
                    if(rst.code == 0){
                        $('[data-loading="wantbuy"]').addClass('fade');
                        var _div = '';
                        $.each(rst.data.orders , function (i,k) {
                            _div += '<div class="panel">\n' +
                                '                            <div class="panel-body">\n' +
                                '                                <div class="row">\n' +
                                '                                    <div class="col-xs-4">'+ k.user.name +'</div>\n' +
                                '                                    <div class="col-xs-4 text-center"><small>{{ $coin_name }}数量</small><p>'+ k.coins +'</p></div>\n' +
                                '                                    <div class="col-xs-4 text-right"><small>单价</small><p>'+ k.price +'</p></div>\n' +
                                '                                </div>\n' +
                                '                                <div class="row p-t-m">\n' +
                                '                                    <div class="col-xs-6 text-left"><i class="fa fa-fw fa-yen"></i>'+ (k.price * (k.coins*100) / 100).toFixed(2) +'</div>\n' +
                                '                                    <div class="col-xs-6 text-right"><button type="button" onclick="sell('+ k.id + ')" class="btn btn-primary btn-sm">卖出</button></div>\n' +
                                '                                </div>\n' +
                                '                            </div>\n' +
                                '                        </div>';
                        })

                        $('#wantbuy>.orders').append(_div);
                        if(!rst.data.is_over){
                            $('[data-loadmore="wantbuy"]').removeClass('fade');
                            $("#wantbuy").data('page' , _page);
                        }else{

                            $('[data-loadmore="wantbuy"]').addClass('fade');
                        }
                    }
                },
                error:function (e) {
                    console.log(e);
                }
            });

            return false;
        }

        function loadmoreWantSell() {
            var _page = parseInt($("#wantsell").data('page')) + 1;
            $('[data-loading="wantsell"]').removeClass('fade');
            $.ajax({
                url:"{{ url('/transaction/sellorder') }}",
                type:"post",
                dataType:"json",
                data:{'_token' : "{{ csrf_token() }}" , 'page':_page},
                success:function (rst) {
                    if(rst.code == 0){
                        $('[data-loading="wantsell"]').addClass('fade');
                        var _div= '';
                        $.each(rst.data.orders , function (i,k) {

                            _div += '<div class="panel"><div class="panel-body"><div class="row"><div class="col-xs-4">'+ k.user.name +'</div><div class="col-xs-4"><small>{{ $coin_name }}数量</small><p>'+ k.coins +'</p></div>';
                                _div += '<div class="col-xs-4 text-right"><small>单价</small><p>'+ k.price +'</p></div></div>';
                                _div += '<div class="row p-t-m"><div class="col-xs-6 text-left"><i class="fa fa-fw fa-yen"></i>'+ (k.price * (k.coins*100) / 100).toFixed(2) +'</div>';
                                _div += '<div class="col-xs-6 text-right"><button type="button" onclick="buy('+ k.id + ')" class="btn btn-info btn-sm">买入</button></div></div></div></div>';

                        })

                        $('#wantsell>.orders').append(_div);
                        if(!rst.data.is_over){
                            $('[data-loadmore="wantsell"]').removeClass('fade');
                            $("#wantsell").data('page' , _page);
                        }else{
                            $('[data-loadmore="wantsell"]').addClass('fade');
                        }
                    }
                },
                error:function (e) {
                    console.log(e);
                }
            });

            return false;
        }

        function getData()
        {
            var prices = [];   // 设置两个变量用来存变量
            var times = [];
            $.post("{{ url('/transaction/ajaxdata') }}", {
                "_token": "{{ csrf_token() }}"
            }, function(data) {
                $.each(data, function(i, item) {
                    prices.push(item.price);
                    times.push(item.day);
                });

                chart(prices , times);
            });
        }


        function chart( prices , times) {
            var myChart = echarts.init(document.getElementById("contain"));

            option = {
                title: {
                    text: '近5天价格趋势'
                },
                xAxis: {
                    type: 'category',
                    data: times
                },
                yAxis: {
                    type: 'value'
                },
                series: [
                    {
                        name:'价格',
                        type:'line',
                        itemStyle: {
                            normal: {
                                lineStyle:{
                                    color:'#5cb85c',
                                    width:3
                                },
                                label:{
                                    show:true,
                                    color:'#000000'
                                }
                            }
                        },
                        data: prices
                    }
                ]
            };
            // 使用刚指定的配置项和数据显示图表。
            myChart.setOption(option);
        }

        getData();

        function sell(_order) {
            $("input#order_id").val(_order);
            $("form#modal_form").attr('action' , "{{ url('transaction/sellout') }}")
            $('#modal').modal({
                show:true
            });
        }

        function buy(_order) {
            $("input#order_id").val(_order);
            $("form#modal_form").attr('action' , "{{ url('transaction/buyinto') }}")
            $('#modal').modal({
                show:true
            });
        }

        function wantsell() {
            $("form#modal_form").attr('action' , "{{ url('transaction/wantsell') }}")
            $('#modal').modal({
                show:true
            });
        }

        function wantbuy() {
            $("form#modal_form").attr('action' , "{{ url('transaction/wantbuy') }}")
            $('#modal').modal({
                show:true
            });
        }

        $("form").submit(function () {
            var _data = $(this).serialize();
            var _url = $(this).attr('action');
            var _method = $(this).attr('method');
            
            $.ajax({
                data:_data,
                url:_url,
                type:_method,
                dataType:"json",
                success:function (rst) {
                    if(rst.code == 0){

                        $('#modal').hide();
                        _toas =new $.Toast({
                            icon : '<i class="fa fa-check-circle fa-fw"></i>',
                            message:"操作成功",
                            type : 0
                        });
                        _toas.success();

                        setTimeout(function () {
                            window.location.reload();
                        } , 2000);
                    }else{
                        _toas =new $.Toast({
                            icon : '<i class="fa fa-times-circle fa-fw"></i>',
                            message:rst.message,
                            type : 1
                        });
                        _toas.error();
                    }
                }
            });

            return false;
        });

    </script>
@stop