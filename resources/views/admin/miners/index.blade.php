@extends('admin.layouts.admin')

@section('admin-css')
    <link href="{{ asset('asset_admin/assets/plugins/treeTable/vsStyle/jquery.treeTable.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('asset_admin/assets/plugins/gritter/css/jquery.gritter.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('asset_admin/assets/plugins/bootstrap-sweetalert-master/dist/sweetalert.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('admin-content')
    <div id="content" class="content">

        <!-- begin page-header -->
        <h1 class="page-header">矿机管理 </h1>
        <!-- end page-header -->
        <!-- begin row -->
        <div class="row">
            <!-- begin col-6 -->
            <div class="col-md-12">
                <!-- begin panel -->
                <div class="panel panel-inverse" data-sortable-id="table-basic-5">
                    <div class="panel-heading">
                        <div class="panel-heading-btn">
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        </div>
                        <h4 class="panel-title">列表</h4>
                    </div>
                    <div class="panel-body">
                        {{--@permission('menus.add')--}}
                        @if(auth('admin')->user()->can('miners.add'))
                            <a href="{{ url('admin/miners/create') }}">
                                <button type="button" class="btn btn-primary m-r-5 m-b-5"><i class="fa fa-plus-square-o"></i> 新增</button>
                            </a>
                        @endif
                        {{--@endpermission--}}
                        <table class="table table-bordered table-hover" id="treeTable">
                            <thead>
                            <tr>
                                <th style="width: 12%;">名称</th>
                                <th style="width: 5%;">价格</th>
                                <th style="width: 8%;">累计限购</th>
                                <th style="width: 8%;">每天限购</th>
                                <th style="width: 8%;">可同时存在</th>
                                <th style="width: 8%;">周期收益</th>
                                <th style="width: 8%;">周期时长</th>
                                <th style="width: 8%;">收益周期</th>
                                <th style="width: 10%;">更新时间</th>
                                <th style="width: 10%;">操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($miners as $miner)
                                <tr id="{{ $miner['id'] }}">
                                    <td>{{ $miner['title'] }}</td>
                                    <td>{{ $miner['price'] }}</td>
                                    <td>{{ $miner['max'] }}</td>
                                    <td>{{ $miner['day_max'] }}</td>
                                    <td>{{ $miner['exist_max'] }}</td>
                                    <td>{{ $miner['income'] }}</td>
                                    <td>{{ $miner['timelong'] }}</td>
                                    <td>{{ $miner['cycle'] }}</td>
                                    <td>{{ $miner['updated_at'] }}</td>
                                    <td>{!! $miner['button'] !!}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- end panel -->
            </div>
            <!-- end col-6 -->
        </div>
        <!-- end row -->
    </div>
@endsection

@section('admin-js')
    <script src="{{ asset('asset_admin/assets/plugins/gritter/js/jquery.gritter.js') }}"></script>
    <script src="{{ asset('asset_admin/assets/plugins/bootstrap-sweetalert-master/dist/sweetalert.js') }}"></script>
    <script>
        $(function(){

            @if (session()->has('flash_notification.message'))
            //通知信息
            $.gritter.add({
                title: '操作消息！',
                text: '{!! session('flash_notification.message') !!}'
            });
            @endif

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