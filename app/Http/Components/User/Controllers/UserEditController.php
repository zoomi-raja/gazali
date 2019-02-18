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
use App\Http\Components\School\SchoolModel;
use App\Http\Components\User\UserClassModel;
use App\Http\Components\User\UserModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserEditController extends Controller
{
    public function __construct(){
    }

    public function detail(){
        $user       = Auth::User();
        $entityIds  = $user->entityRelation();
        DB::enableQueryLog();
        UserClassModel::with(['haveSchool','haveSchool.classes'])->where('u_id',1)->whereHas('haveSchool.classes',function($query){$query->where('classes.id','=','class_school.id');})->get();

        dd(DB::getQueryLog());
        $school     = SchoolModel::all();
        $class      = ClassesModel::all();
        return view('userDetailEdit');
    }

}