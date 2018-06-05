@extends('admin.layouts.admin')

@section('admin-css')
    <link href="{{ asset('asset_admin/assets/plugins/treeTable/vsStyle/jquery.treeTable.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('asset_admin/assets/plugins/gritter/css/jquery.gritter.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('asset_admin/assets/plugins/bootstrap-sweetalert-master/dist/sweetalert.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('admin-content')
    <div id="content" class="content">
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">提现列表</h1>
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
                                <th style="width: 10%;">编号</th>
                                <th style="width: 5%;">用户</th>
                                <th style="width: 5%;">微信</th>
                                <th style="width: 5%;">支付宝</th>
                                <th style="width: 5%;">银行卡</th>
                                <th style="width: 8%;">提现金额</th>
                                <th style="width: 8%;">状态</th>
                                <th style="width: 10%;">操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($cashs as $cash)
                                <tr id="{{ $cash->id }}">
                                    <td>{{ $cash->cash_no }}</td>
                                    <td>{{ $cash->user->name }}</td>
                                    <td>{{ $cash->user->wexin }}</td>
                                    <td>{{ $cash->user->alipay }}</td>
                                    <td>{{ $cash->user->bankcard }}</td>
                                    <td>{{ $cash->rmb }}</td>
                                    <td>
                                        @if($cash->status == 'dealing')
                                            <span>未处理</span>
                                        @elseif($cash->status == 'finished')
                                            <span>完成</span>
                                        @else
                                            <span>已撤销</span>
                                            @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.cashs.deal' , ['id' => $cash->id ]) }}" class="label label-success">
                                            <i class="fa fa-fw fa-check-circle"></i> 已处理
                                        </a>

                                        <a href="{{ route('admin.cashs.reply' , ['id' => $cash->id ]) }}" class="label label-danger">
                                            <i class="fa fa-fw fa-reply"></i> 驳回申请
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        {!! $cashs->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop