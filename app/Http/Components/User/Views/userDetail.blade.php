@extends('..\..\..\..\..\layouts.app')
@section('title', 'Page Title')

@section('css')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ get_resource_path('css') }}">
@endsection
@section('content')
    <div class="container">
        {{ $user->name }}<br>
        @foreach ($user->groups as $group)
            {{ $group->name }}<br>
        @endforeach

    </div>
    {{--{{ $users->links() }}--}}
@endsection