@extends('admin.layouts.admin')

@section('admin-css')
    <link href="{{ asset('asset_admin/assets/plugins/treeTable/vsStyle/jquery.treeTable.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('asset_admin/assets/plugins/gritter/css/jquery.gritter.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('asset_admin/assets/plugins/bootstrap-sweetalert-master/dist/sweetalert.css') }}" rel="stylesheet" type="text/css">
@endsection


@section('admin-content')
    <div id="content" class="content">
        <!-- begin breadcrumb -->
        <ol class="breadcrumb pull-right">
            <li><a href="javascript:;">Home</a></li>
            <li><a href="javascript:;">Tables</a></li>
            <li class="active">Basic Tables</li>
        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">菜单列表 <small>header small text goes here...</small></h1>
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
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th style="width: 12%;">用户名</th>
                                <th style="width: 5%;">矿机名称</th>
                                <th style="width: 8%;">购买数量</th>
                                <th style="width: 8%;">订单金额</th>
                                <th style="width: 8%;">周期收益</th>
                                <th style="width: 8%;">周期时长</th>
                                <th style="width: 8%;">收益周期</th>
                                <th style="width: 8%;">生产</th>
                                <th style="width: 10%;">订单状态</th>
                                <th style="width: 10%;">操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($userminers as $userminer)
                                <tr id="{{ $userminer['id'] }}">
                                    <td>{{ $userminer['name'] }}</td>
                                    <td>{{ $userminer['title'] }}</td>
                                    <td>{{ $userminer['number'] }}</td>
                                    <td>{{ $userminer['price'] }}</td>
                                    <td>{{ $userminer['income'] }}</td>
                                    <td>{{ $userminer['timelong'] }}</td>
                                    <td>{{ $userminer['cycle'] }}</td>
                                    <td>{{ $userminer['cycled'] * $userminer['income'] }} / {{ $userminer['timelong'] * $userminer['income'] }}</td>
                                    <td>{{ $userminer['status'] }}</td>
                                    <td>{!! $userminer['button'] !!}</td>
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