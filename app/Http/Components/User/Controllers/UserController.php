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
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $user;
    public function __construct(UserModel $user){
        $this->user = $user;
    }
    public function list( Request $request ){
        var_dump( $request->input('name', 'nothing is passed') );
        $data = $this->user->getList();
        return view('user',['data' => $data]);
    }
}