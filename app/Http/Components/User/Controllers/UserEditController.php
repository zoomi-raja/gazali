<?php
/**
 * Created by PhpStorm.
 * User: zamurd
 * Date: 2/18/2019
 * Time: 11:22 AM
 */

namespace App\Http\Components\User\Controllers;

use App\Http\Components\Classes\ClassesModel;
use App\Http\Components\Controller;
use App\Http\Components\Group\GroupModel;
use App\Http\Components\School\SchoolModel;
use App\Http\Components\User\UserClassModel;
use App\Http\Components\User\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserEditController extends Controller
{
    public $request;
    public function __construct(Request $request){
        $this->request = $request;
    }

    public function detail( $id ){
        $obj                = new \StdClass();
        $entityIds          = UserModel::with(['groups','compensation','schools.classes'=>function($query){
//            $query->where('class_school.s_id','=','1');//todo this is hardcoded current selected school id
        }])->find( $id );
        $obj->userDetails   = $entityIds->setSchoolInfo()->isStudent();
        $obj->schools       = SchoolModel::with('classes')->find(1);
        $obj->groups        = GroupModel::get();
        return view('userDetailEdit',[ 'arResult' => $obj]);
    }

}