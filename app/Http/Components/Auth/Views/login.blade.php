@extends('..\..\..\..\..\layouts.app')
@section('title', 'Login User')
@section('css')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ get_resource_path('css') }}">
@endsection
@section('content')
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if(session()->has('alert-success'))
            <div class="alert alert-success">
                {{ session()->get('alert-success') }}
            </div>
        @endif
<div id="loader">
    <div class="spinner"></div>
</div>
<script>
    window.addEventListener('load', () => {
        const loader = document.getElementById('loader');
        setTimeout(() => {
            loader.classList.add('fadeOut');
        }, 300);
    });
</script>
<div class="peers ai-s fxw-nw h-100vh">
    <div class="d-n@sm- peer peer-greed h-100 pos-r bgr-n bgpX-c bgpY-c bgsz-cv" style="background-image:url(<?=asset('public/assets/static/images/bg.jpg')?>)">
        <div class="pos-a centerXY">
            <div class="bgc-white bdrs-50p pos-r" style="width:120px;height:120px">
                <img class="pos-a centerXY" src="<?=asset('public/assets/static/images/logo.png')?>" alt="">
            </div>
        </div>
    </div>
    <div class="col-12 col-md-4 peer pX-40 pY-80 h-100 bgc-white scrollable pos-r" style="min-width:320px">
        <h4 class="fw-300 c-grey-900 mB-40">Login</h4>
        <form action="{{action('Auth\Controllers\LoginController@login')}}" method="post">
            @csrf
            <div class="form-group"><label class="text-normal text-dark">Username</label>
                <input type="email" name="email" class="form-control" placeholder="John Doe">
            </div>
            <div class="form-group"><label class="text-normal text-dark">Password</label>
                <input type="password"  name="password" class="form-control" placeholder="Password">
            </div>
            <div class="form-group">
                <div class="peers ai-c jc-sb fxw-nw">
                    <div class="peer">
                        <div class="checkbox checkbox-circle checkbox-info peers ai-c">
                            <input type="checkbox" id="inputCall1" name="remember_token" class="peer">
                            <label for="inputCall1" class="peers peer-greed js-sb ai-c">
                                <span class="peer peer-greed">Remember Me</span>
                            </label>
                        </div>
                    </div>
                    <div class="peer">
                        <button class="btn btn-primary">Login</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript" src="<?=asset('public/js/vendor.js')?>"></script>
<script type="text/javascript" src="<?=asset('public/js/bundle.js')?>"></script>
@endsection
