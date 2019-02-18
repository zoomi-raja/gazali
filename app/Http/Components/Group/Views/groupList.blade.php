@extends('..\..\..\..\..\layouts.app')

@section('title', 'Page Title')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
    <div class="container">
        @foreach ($groups as $user)
            {{ $user->name }}<br>
        @endforeach
    </div>
    {{ $groups->links() }}
@endsection