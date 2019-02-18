<?php
/**
 * Created by PhpStorm.
 * User: zamurd
 * Date: 2/3/2019
 * Time: 10:04 AM
 */

namespace App\Http\Components\Group\Controllers;

use App\Http\Components\Controller;
use App\Http\Components\Group\GroupModel;

class GroupController extends Controller
{
    public function __construct(){
    }
    public function list(GroupModel $groups ){
        $groups = $groups->paginate(10);
        return view('groupList',compact('groups'));
    }
}