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
    public function __construct(UserModel $user){
        $this->user = $user;
    }
    public function list(){
        $data = $this->user->getList();
        return view('user',['data' => $data]);
    }
}