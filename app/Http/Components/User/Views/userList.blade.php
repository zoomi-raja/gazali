@extends('..\..\..\..\..\layouts.app')
@section('title', 'Page Title')

@section('css')
@parent
<link rel="stylesheet" type="text/css" href="{{ get_resource_path('css') }}">
@endsection
@section('content')
    <div class="container">
        @if(sizeof($users) > 1)
            @foreach ($users as $user)
                {{ $user->name }}<br>
                @foreach ($user->groups as $group)
                    {{ $group->name }}<br>
                @endforeach
            @endforeach
        @else
            {{ $users[0]->name }}<br>
            not array
        @endif

    </div>
    {{--{{ $users->links() }}--}}
@endsection