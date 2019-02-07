<?php
/**
 * Created by PhpStorm.
 * User: zamurd
 * Date: 2/3/2019
 * Time: 10:04 AM
 */

namespace App\Http\Components\User\Controllers;

use App\Http\Components\Controller;
use App\Http\Components\User\UserModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    private $user;
    public function __construct(){
    }
    public function list( UserModel $user ){
//        Auth::logout();
        DB::enableQueryLog();
//        $users = Auth::User()->groups()->get();//->paginate(10);
        $users = $user->find(2)->getGroups();
        dd(DB::getQueryLog());
        return view('userList',compact('users'));
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
