<!-- Stored in resources/views/layouts/app.blade.php -->
@include('layouts.adminheader')
@section('sidebar')
    This is the master sidebar.
@show

<div class="container">
    @yield('content')
</div>
@include('layouts.adminfooter')