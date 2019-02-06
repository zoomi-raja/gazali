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
//        DB::enableQueryLog();
        $users = $user->getGroups();//->paginate(10);
//        dd(DB::getQueryLog());
        var_dump($users);die;
        return view('userList',compact('users'));
    }
}