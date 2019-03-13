@extends('..\..\..\..\..\layouts.app')

@section('title', 'Page Title')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection
@section('content')
    <div class="container">
        @if(sizeof($users) > 1)
            @foreach ($users as $user)
                {{ $user->name }}<br>
                @if(property_exists($user,'groups'))
                    @foreach ($user->groups as $group)
                        {{ $group->name }}<br>
                    @endforeach
                @endif
            @endforeach
        @else
            {{ $users[0]->name }}<br>
            not array
        @endif

    </div>
    {{--{{ $users->links() }}--}}
@endsection