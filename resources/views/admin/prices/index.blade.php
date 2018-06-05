@extends('admin.layouts.admin')


@section('admin-css')
    <link href="{{ asset('asset_admin/assets/plugins/treeTable/vsStyle/jquery.treeTable.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('asset_admin/assets/plugins/gritter/css/jquery.gritter.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('asset_admin/assets/plugins/bootstrap-sweetalert-master/dist/sweetalert.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('admin-content')
    <div id="content" class="content">
        <!-- begin page-header -->
        <h1 class="page-header">价格总览</h1>
        <!-- end page-header -->
        <!-- begin row -->
        <div class="row">
            <!-- begin col-6 -->
            <div class="col-md-3">
                <!-- begin panel -->
                <div class="panel panel-inverse" data-sortable-id="table-basic-5">
                    <div class="panel-heading">
                        <div class="panel-heading-btn">
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        </div>
                        <h4 class="panel-title">当前价</h4>
                    </div>
                    <div class="panel-body">
                        <h1 class="text-center" style="color:#0396FF"><small><i class="fa fa-fw fa-yen"></i></small> <span >{{ sprintf("%.2f",$price['price']) }}</span></h1>
                        <p class="text-center">设置时间：{{ $price['updated_at'] }}</p>
                        <hr>
                        <p>设置当前价</p>
                        @if(count($errors)>0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form  data-parsley-validate="true" action="{{ url('admin/coinprices') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-8"><input type="text" name="price" class="form-control"></div>
                                <div class="col-md-4"><button type="submit" class="btn btn-primary">设置</button></div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- end panel -->
            </div>
            <!-- end col-6 -->
            <div class="col-md-9">
                <div class="panel">
                    <div class="panel-body">
                        <div class="contain" style="height: 360px;" id="contain"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('admin-js')
    <script src="{{ asset('asset_admin/assets/plugins/gritter/js/jquery.gritter.js') }}"></script>
    <script src="{{ asset('asset_admin/assets/plugins/bootstrap-sweetalert-master/dist/sweetalert.js') }}"></script>
    <script src="https://cdn.bootcss.com/echarts/4.1.0.rc2/echarts.js"></script>
    <script>
        $(function(){

            @if (session()->has('flash_notification.message'))
            //通知信息
            $.gritter.add({
                title: '操作消息！',
                text: '{!! session('flash_notification.message') !!}'
            });
            @endif

            function getData()
            {
                var prices = [];   // 设置两个变量用来存变量
                var times = [];
                $.post("{{ url('admin/coinprices/axis') }}", {
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
                    tooltip: {
                        trigger: 'axis'
                    },
                    xAxis: {
                        type: 'category',
                        boundaryGap: false,
                        data: times
                    },
                    yAxis: {
                        type: 'value',
                        boundaryGap: [0, '100%']
                    },
                    dataZoom: [{
                        type: 'inside',
                        start: 80,
                        end: 100
                    }, {
                        start: 0,
                        end: 10,
                        handleIcon: 'M10.7,11.9v-1.3H9.3v1.3c-4.9,0.3-8.8,4.4-8.8,9.4c0,5,3.9,9.1,8.8,9.4v1.3h1.3v-1.3c4.9-0.3,8.8-4.4,8.8-9.4C19.5,16.3,15.6,12.2,10.7,11.9z M13.3,24.4H6.7V23h6.6V24.4z M13.3,19.6H6.7v-1.4h6.6V19.6z',
                        handleSize: '100%',
                        handleStyle: {
                            color: '#fff',
                            shadowBlur: 3,
                            shadowColor: 'rgba(3, 150, 255, 0.6)',
                            shadowOffsetX: 2,
                            shadowOffsetY: 2
                        }
                    }],
                    series: [
                        {
                            name:'价格',
                            type:'line',
                            smooth:true,
                            symbol: 'none',
                            sampling: 'average',
                            itemStyle: {
                                normal: {
                                    color: 'rgb(3, 150, 255)'
                                }
                            },
                            areaStyle: {
                                normal: {
                                    color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [{
                                        offset: 0,
                                        color: 'rgb(171, 220, 255)'
                                    }, {
                                        offset: 1,
                                        color: 'rgb(3, 150, 255)'
                                    }])
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

            //删除
            $(document).on('click','.destroy',function(){
                var _delete_id = $(this).attr('data-id');
                swal({
                        title: "确定删除？",
                        text: "删除将不可逆，请谨慎操作！",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonClass: "btn-danger",
                        cancelButtonText: "取消",
                        confirmButtonText: "确定",
                        closeOnConfirm: false
                    },
                    function () {
                        $('form[name=delete_item_'+_delete_id+']').submit();
                    }
                );
            });
        });
    </script>

@endsection