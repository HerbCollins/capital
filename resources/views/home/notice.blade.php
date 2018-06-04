@extends('layouts.frontend.children')

@section('link')
{{ url('/') }}
@endsection

@section('page-name' , '公告')

@section('child-body')
    <div class="panel">
        <div class="panel-body">
            <p>{{ $notice->title }}</p>
            <p class="p-t-m">
                <span><i class="fa fa-fw fa-clock-o"></i> {{ $notice->published_at }}</span>
            </p>
            <hr>
            {!! $notice->content !!}
        </div>
    </div>
@stop