@include('layouts.adminheader2')
@include('layouts.adminsidebar')
<div class="page-container">
    @include('layouts.adminheadernavebar')
    <main class="main-content bgc-grey-100">
        <div id="mainContent">
            @yield('content')
        </div>
    </main>
    <footer class="bdT ta-c p-30 lh-0 fsz-sm c-grey-600">
        <span>Copyright © 2017 Designed by <a href="https://colorlib.com" target="_blank" title="Colorlib">Colorlib</a>. All rights reserved.</span>
    </footer>
</div>
@include('layouts.adminfooter2')