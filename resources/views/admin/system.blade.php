@extends('admin.layouts.admin')

@section('admin-content')
    <div id="content" class="content">
        <!-- begin breadcrumb -->
        <ol class="breadcrumb pull-right">
            <li><a href="javascript:;">Home</a></li>
            <li><a href="javascript:;">面包屑</a></li>
            <li class="active">面包屑</li>
        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">系统设置</h1>
        <!-- end page-header -->

        <div class="row">
            <div class="col-md-12">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    {{--<li role="presentation" class="active"><a href="#site" aria-controls="profile" role="tab" data-toggle="tab">站点设置</a></li>--}}
                    <li role="presentation" class="active"><a href="#coin" aria-controls="home" role="tab" data-toggle="tab">虚拟币</a></li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    {{--<div role="tabpanel" class="tab-pane active" id="site">--}}
                        {{--<form class="form-horizontal form-bordered" data-parsley-validate="true" action="{{ url('admin/system/setting' ) }}" method="POST">--}}
                            {{--{{ csrf_field() }}--}}
                            {{--<div class="form-group">--}}
                                {{--<label class="control-label col-md-4 col-sm-4" for="coin_name">站点名称:</label>--}}
                                {{--<div class="col-md-6 col-sm-6">--}}
                                    {{--<input class="form-control" type="text" name="site_name" placeholder="站点名称" data-parsley-required="true" data-parsley-required-message="请输入站点名称" @if(isset($settings['site_name']) && $settings['site_name']) value="{{ $settings['site_name'] }}" @endif/>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label class="control-label col-md-4 col-sm-4"></label>--}}
                                {{--<div class="col-md-6 col-sm-6">--}}
                                    {{--<button type="submit" class="btn btn-primary">保存</button>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</form>--}}
                    {{--</div>--}}
                    <div role="tabpanel" class="tab-pane active" id="coin">
                        <div class="panel">
                            <div class="panel-form">
                                <form class="form-horizontal form-bordered" data-parsley-validate="true" action="{{ url('admin/system/setting' ) }}" method="POST">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label class="control-label col-md-4 col-sm-4" for="coin_name">虚拟币名称:</label>
                                        <div class="col-md-6 col-sm-6">
                                            <input class="form-control" type="text" name="coin_name" placeholder="虚拟币名称，eg：全球；比特" data-parsley-required="true" data-parsley-required-message="请输入虚拟币名称" @if(isset($settings['coin_name']) && $settings['coin_name']) value="{{ $settings['coin_name'] }}" @endif/>
                                        </div>
                                        <div class="col-md-2 col-sm-2">
                                            币
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4 col-sm-4"></label>
                                        <div class="col-md-6 col-sm-6">
                                            <button type="submit" class="btn btn-primary">保存</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection