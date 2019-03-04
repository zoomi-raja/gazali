<?php
/**
 * Created by PhpStorm.
 * User: zamurd
 * Date: 2/3/2019
 * Time: 10:04 AM
 */

namespace App\Http\Components\User\Controllers;

use App\Http\Components\Controller;
use App\Http\Components\User\Repositories\UserRepository;
use App\Http\Components\User\UserModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    private $userRepository;
    public function __construct( UserRepository $userRepository ){
        $this->userRepository = $userRepository;
    }
    public function list( UserModel $user ){
        $users = $user->with('groups')->get();
        return view('userList',compact('users'));
    }


    public function detail( $id ){
        $userRepo   = $this->userRepository->getUserDetail($id);
        if($userRepo) {
            $user   = $userRepo->getCompensationInfo()->getSchoolInfo()->getUserData();
        }
        return view('userDetail',compact('user'));
    }
}


//all these working examples
//for insetion a new group
// UserModel::find(2)->groups()->attach($groups)
//this one only groups of authorize user
//Auth::User()->groups()->get();

//all user and groups
//$users = Auth::User()->groups()->get();//;
//$users = UserModel::find(2)->groups()->get();
//to get all users with there role
//$temp = UserModel::with('groups')->get(); or  UserModel::getGroups()
//note all() return collection not model intance;
//Parcel::with(['tractor'=>function($q){$q->wherePivot('date','<','2019/2/12');}])->whereHas('tractor',function($q){$q->where('tractors.id','2');})->where('processed',1)->where('id',4)->get();
