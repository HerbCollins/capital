@extends('admin.layouts.admin')

@section('admin-css')
    <link href="{{ asset('asset_admin/assets/plugins/parsley/src/parsley.css') }}" rel="stylesheet" />
    <link href="{{ asset('asset_admin/assets/plugins/bootstrap-select/bootstrap-select.min.css') }}" rel="stylesheet" />
@endsection

@section('admin-content')
    <div id="content" class="content">
        <!-- begin page-header -->
        <h1 class="page-header">新增矿机 </h1>
        <!-- end page-header -->

        <!-- begin row -->
        <div class="row">
            <!-- begin col-6 -->
            <div class="col-md-12">
                <!-- begin panel -->
                <div class="panel panel-inverse" data-sortable-id="form-validation-1">
                    <div class="panel-heading">
                        <div class="panel-heading-btn">
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                        </div>
                        <h4 class="panel-title">新增矿机</h4>
                    </div>
                    @if(count($errors)>0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="panel-body panel-form">
                        <form class="form-horizontal form-bordered" data-parsley-validate="true" action="{{ url('admin/miners') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="title">名称 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="text" name="title" placeholder="矿机名称" data-parsley-required="true" data-parsley-required-message="请输入矿机名称" value="{{ old('title') }}"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="price">价格 * :</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="text" name="price" placeholder="价格" data-parsley-required="true" data-parsley-required-message="请输入矿机价格" value="{{ old('price') }}" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="exist_max">可同时存在数量:</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="number" name="exist_max" placeholder="可同时存在数量" data-parsley-required="true" data-parsley-required-message="可同时存在数量" value="{{ old('exist_max') }}"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="day_max">每天限购:</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="number" name="day_max" placeholder="每天限购" data-parsley-required="true" data-parsley-required-message="每天限购" value="{{ old('day_max') }}"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="max">累计限购:</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="number" name="max" placeholder="累计限购" data-parsley-required="true" data-parsley-required-message="累计限购" value="{{ old('max') }}"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="income">周期收益:</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="text" name="income" placeholder="周期收益" data-parsley-required="true" data-parsley-required-message="周期收益" value="{{ old('income') }}"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="timelong">周期时间:</label>
                                <div class="col-md-6 col-sm-6">
                                    <div class="row">
                                        <div class="col-md-8 col-sm-8">
                                            <input class="form-control" type="text" name="timelong" placeholder="周期时间" data-parsley-required="true" data-parsley-required-message="周期时间" value="{{ old('timelong') }}"/>
                                        </div>
                                        <div class="col-md-4 col-sm-4">小时</div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4" for="cycle">收益周期:</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="text" name="cycle" placeholder="收益周期" data-parsley-required="true" data-parsley-required-message="收益周期" value="{{ old('cycle') }}"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4"></label>
                                <div class="col-md-6 col-sm-6">
                                    <button type="submit" class="btn btn-primary">提交</button>
                                </div>
                            </div>
                        </form>
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
    <script src="{{ asset('asset_admin/assets/plugins/parsley/dist/parsley.js') }}"></script>
    <script src="{{ asset('asset_admin/assets/plugins/bootstrap-select/bootstrap-select.min.js') }}"></script>
    <script>
        $('.selectpicker').selectpicker('render');
    </script>
@endsection