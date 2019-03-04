@extends('..\..\..\..\..\layouts.admin')
@section('title', 'Edit User')
@section('css')
    @parent

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://unpkg.com/gijgo@1.9.11/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.11/css/gijgo.min.css" rel="stylesheet" type="text/css" />
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
    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="bgc-white bd bdrs-3 p-20 mB-20">
                    <form class="form" action="{{action('User\Controllers\UserEditController@update',$arResult->userDetails->id)}}" method="post" id="registrationForm">
                        @csrf
                        <div class="row">
                            <div class="col-md-3"><!--left col-->
                                <div class="text-center">
                                    <img src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png" class="avatar img-circle img-thumbnail" alt="avatar">
                                    <h6>Upload a different photo...</h6>
                                    <input type="file" class="text-center center-block file-upload">
                                </div>
                                <div class="form-group mt-4">
                                    <div class="col-xs-6">
                                        <div class="form-check">
                                            <label class="form-check-label"><h4>Active</h4></label>
                                                <input class="ml-3" type="checkbox" name="active" id="active" value="1" checked="<?=($arResult->userDetails->active == 'Y')?'checked':''?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-6">
                                        <label for="dob"><h4>Date Of Birth</h4></label>
                                        <input type="text" class="form-control" name="dob"  value="<?=$arResult->userDetails->dob?>" id="dob" placeholder="DOB" title="enter Date of Birth.">
                                    </div>
                                </div>
                            </div><!--/col-3-->
                            <div class="col-md-6">
                                <hr>
                                    <div class="form-group">
                                        <div class="col-xs-6">
                                            <label for="first_name"><h4>Name</h4></label>
                                            <input type="text" class="form-control" name="name" value="<?=$arResult->userDetails->name?>" id="first_name" placeholder="first name" title="enter your first name if any.">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-xs-6">
                                            <label for="last_name"><h4>Father name</h4></label>
                                            <input type="text" class="form-control" name="father_name" value="<?=$arResult->userDetails->father_name?>" id="last_name" placeholder="last name" title="enter your last name if any.">
                                        </div>
                                    </div>

                                    <div class="form-group">

                                        <div class="col-xs-6">
                                            <label for="phone"><h4>Phone</h4></label>
                                            <input type="text" class="form-control" name="phone" value="<?=$arResult->userDetails->phone?>" id="phone" placeholder="enter phone" title="enter your phone number if any.">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-xs-6">
                                            <label for="email"><h4>Email</h4></label>
                                            <input type="email" class="form-control" name="email" value="<?=$arResult->userDetails->email?>" id="email" placeholder="enter email" title="enter email.">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-xs-6">
                                            <label for="address"><h4>Address</h4></label>
                                            <input type="text" class="form-control" id="address" name="address" value="<?=$arResult->userDetails->address?>" placeholder="somewhere" title="enter a address">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-xs-6">
                                            <label for="gender"><h4>Gender</h4></label>
                                            <div class="row row mx-4">
                                                <div class="form-check col-md-6">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="radio" name="gender" id="gender" value="M" checked="checked">
                                                        Male
                                                    </label>
                                                </div>
                                                <div class="form-check col-md-6">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="radio" name="gender" id="gender" value="F">
                                                        Female
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <hr>
                            </div><!--/tab-content-->
                            <div class="col-md-3">
                                <hr>

                                <div class="form-group">
                                    <div class="col-xs-6">
                                        <label for="fees"><h4>@if($arResult->userDetails->isStudent)fees @else Salary @endif</h4></label>
                                        <input type="text" class="form-control" name="fees" value="<?=$arResult->userDetails->compensation->amount?>" id="fees" placeholder="Fees" title="enter Amount.">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-6">
                                        <label for="school"><h4>School</h4></label>
                                        <select class="form-control form-control-sm"  id="school" name="school">
                                            <option value="1"><?=$arResult->schools->name?></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-6">
                                        <label for="class"><h4>Classe</h4></label>
                                        <select class="form-control form-control-sm  " multiple data-live-search="true"  id="class" <?=($arResult->userDetails->isStudent)?'name="class"':'name="class[]" multiple '?>>
                                        <?php $arClass = (empty($arResult->userDetails->schoolIDs[1]))?[]:$arResult->userDetails->schoolIDs[1];?>
                                        @foreach($arResult->schools->classes as $class )
                                                <option value="{{$class->id}}" <?=in_array( $class->id,$arClass)?'selected':''; ?>><?=$class->name?></option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-xs-6">
                                        <label for="class"><h4>Group</h4></label>
                                        <select class="form-control form-control-sm  disabled" multiple data-live-search="true"  id="class" name="group[]" multiple>
                                            <?php $arGroups = $arResult->userDetails->groups->pluck('id')->toArray();?>
                                            @foreach($arResult->groups as $group )
                                                <option value="{{$group->id}}" <?=in_array( $group->id,$arGroups)?'selected':''; ?>><?=$group->name?></option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div><!--/col-9-->
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <button class="btn btn-lg btn-success" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Save</button>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group float-right">
                                            <a href="{{URL('user')}}" class="btn btn-lg" type="reset"><i class="glyphicon glyphicon-repeat"></i> Back</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#dob').datepicker({
                uiLibrary: 'bootstrap4',
                format:'yyyy-mm-dd',
            });
        });
    </script>
@endsection