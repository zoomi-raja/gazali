<?php
/**
 * Created by PhpStorm.
 * User: zamurd
 * Date: 2/3/2019
 * Time: 10:04 AM
 */

namespace App\Http\Components\Resource\Controllers;

use App\Http\Components\Controller;
use App\Http\Components\Resource\ResourceModel;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function __construct(){
    }
    public function list( ResourceModel $resource ){
        $resources = $resource->find(1);
        return view('resourceList',compact('resources'));
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
