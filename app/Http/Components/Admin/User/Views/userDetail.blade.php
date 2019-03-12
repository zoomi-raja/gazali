@extends('..\..\..\..\..\layouts.admin')
@section('title', 'User Detail')
@section('content')
    <div class="container-fluid">
        @if( $user )
            <div class="row">
                <div class="col-md-4">
                    <div class="profile-img">
                        <img src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png" alt=""/>
                        {{--<div class="file btn btn-lg btn-primary">--}}
                            {{--Change Photo--}}
                            {{--<input type="file" name="file"/>--}}
                        {{--</div>--}}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="profile-head">
                        <h5>
                            {{$user->name}}
                        </h5>
                        <h6 class="mt-2">
                            <?php $gname = implode(',',$user->groups->pluck('name')->toArray());?>
                            {{$gname}}
                        </h6>
                        <h6 class="mt-2">
                            <?php $cname = implode(',',$user->affiliation[0]->classes->pluck('name')->toArray());?>
                            {{$cname}}
                        </h6>
                        <ul class="nav nav-tabs mt-5" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">More Detail</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-2">
                    <a href="{{action('User\Controllers\UserEditController@detail',[$user->id])}}"> Edit </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                </div>
                <div class="col-md-8">
                    <div class="tab-content profile-tab" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>School info</label>
                                </div>
                                <div class="col-md-6">
                                    <p>{{$user->id}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Name</label>
                                </div>
                                <div class="col-md-6">
                                    <p>{{$user->name}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Email</label>
                                </div>
                                <div class="col-md-6">
                                    <p>{{$user->email}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Phone</label>
                                </div>
                                <div class="col-md-6">
                                    <p>{{$user->phone}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Profession</label>
                                </div>
                                <div class="col-md-6">
                                    <p>{{$user->groups->implode('name',',')}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Gender</label>
                                </div>
                                <div class="col-md-6">
                                    <p>{{$user->gender}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Active</label>
                                </div>
                                <div class="col-md-6">
                                    <p>{{$user->active}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Registered</label>
                                </div>
                                <div class="col-md-6">
                                    <p>{{$user->created_at}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>age</label>
                                </div>
                                <div class="col-md-6">
                                    <p>{{$user->dob}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>English Level</label>
                                </div>
                                <div class="col-md-6">
                                    <p>Expert</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Availability</label>
                                </div>
                                <div class="col-md-6">
                                    <p>6 months</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Your Bio</label><br/>
                                    <p>Your detail description</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-6"></div>
                <div class="col-md-2"> <a href="{{URL('user')}}">Back</a></div>

            </div>

        @else
            <div class="alert alert-dark" role="alert">
                InValid id
            </div>
        @endif
    </div>
@endsection