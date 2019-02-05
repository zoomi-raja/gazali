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

class UserController extends Controller
{
    private $user;
    public function __construct(){
    }
    public function list( UserModel $user ){
        $users = $user->paginate(10);
        return view('userList',compact('users'));
    }
}