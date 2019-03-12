<?php
/**
 * Created by PhpStorm.
 * User: zamurd
 * Date: 2/3/2019
 * Time: 10:04 AM
 */

namespace App\Http\Components\Admin\School\Controllers;

use App\Http\Components\Controller;
use App\Http\Components\Admin\School\SchoolModel;

class UserController extends Controller
{
    private $user;
    public function __construct(){
    }
    public function list(SchoolModel $role ){
        $roles = $role->find(1);
        return view('roleList',compact('roles'));
    }
}
