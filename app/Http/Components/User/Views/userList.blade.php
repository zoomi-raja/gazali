@extends('..\..\..\..\..\layouts.app')

@section('title', 'Page Title')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
    <div class="container">
        @foreach ($users as $user)
            {{ $user->NAME }}<br>
        @endforeach
    </div>
    {{ $users->links() }}
@endsection