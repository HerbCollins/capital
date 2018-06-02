@extends('layouts.frontend.children')

@section('page-name' , '我的团队')

@section('child-body')
    <div class="panel" >
        <div class="panel-body">
            <ul class="list-group">
                @foreach($users as $user)
                    <li class="list-group-item">{{ $user->name }}</li>
                @endforeach
            </ul>

        </div>
    </div>
@stop

@section('js')
    <script type="text/javascript">

    </script>
@stop
