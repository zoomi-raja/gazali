<?php
/**
 * Created by PhpStorm.
 * User: zamurd
 * Date: 3/4/2019
 * Time: 10:17 AM
 */

namespace App\Http\Components\Admin\User\Repositories;


use App\Http\Components\Admin\School\SchoolModel;
use App\Http\Components\Admin\User\CompensationModel;
use App\Http\Components\Admin\User\UserClassModel;
use App\Http\Components\Admin\User\UserModel;
use Illuminate\Support\Facades\DB;

class UserRepository
{
    private $userModel;
    function  __construct( UserModel $userModel){
        $this->userModel = $userModel;
    }
    public function prepareRelationQuery(){
        return  DB::table('users')
            ->select('users.id','users.name','users.email','users.gender','users.dob','users.active')
            ->selectRaw('GROUP_CONCAT( DISTINCT CONCAT( groups.name,\'#\',groups.id )   SEPARATOR \'||\') as groups')
            ->selectRaw(' CONCAT ( CONCAT(schools.name,\'##\',schools.id),\'---\',
                GROUP_CONCAT(
                    DISTINCT CONCAT(
                        classes.name,\'#\',classes.id
                    )
                    SEPARATOR \'||\'
                )
            )
                as schools')
            ->join('group_user','group_user.u_id','=','users.id')
            ->join('groups','groups.id','=','group_user.g_id')
            ->join('user_cs','user_cs.u_id','=','users.id')
            ->join('class_school','class_school.id','=','user_cs.cs_id')
            ->join('schools','schools.id','=','class_school.s_id')
            ->join('classes','classes.id','=','class_school.c_id')
            ->groupBy('users.id')->groupBy('schools.id');
    }
    public function getSchoolUsers(){
        $users = $this->prepareRelationQuery()->where('schools.id','=','1')->get();///todo one time record of one schools only so
        $users->each(function(&$item, $key ){
            $groupsArr              = explode('||',$item->groups);
            $schoolsArr             = explode('---',$item->schools);
            unset($item->groups);
            unset($item->schools);
            $groupsDetails          = [];
            $schoolsDetails         = [];
            foreach ($groupsArr as $group){
                list($id,$name) = explode('#',$group);
                $groupsDetails[] = ['id' => $id, 'name' => $name ];
            }
            list($schoolId,$schoolName) = explode('##',$schoolsArr[0]);
            $schoolsDetails  = [ 'id'=>$schoolId,'name'=>$schoolName,'classes' => []];
            $classesArr             = explode('||',$schoolsArr[1]);
            foreach ($classesArr as $class){
                list($name,$id) = explode('#',$class);
                $schoolsDetails['classes'][] = ['id'=>$id,'name'=>$name];
            }
            $item->groups   = $groupsDetails;
            $item->schools  = $schoolsDetails;
        });
        return $users;
    }
    public function getUserDetail( $id = null ){
        if(!$id)
            return false;
        $this->userModel = UserModel::find($id);
        if($this->userModel) {
            $this->userModel->setUserType();
            return $this;
        }else
            return false;
    }
    public function getCompensationInfo(){
        $type = ($this->userModel->isStudent)?2:1;
        $this->userModel->load(['compensation' => function($query)use($type){
            $query->where('type','=',$type);
        }]);
        return $this;
    }
    public function setCompensationInfo( $amount = null ){
        if($amount && $this->userModel->id ) {
            $type = ($this->userModel->isStudent) ? 2 : 1;
            if (!$this->userModel->compensation) {
                $this->userModel->setRelation('compensation', new CompensationModel());
                $this->userModel->compensation->u_id = $this->userModel->id;
            }
            $this->userModel->compensation->amount = $amount;
            $this->userModel->compensation->type = $type;
            $this->userModel->compensation->save();
        }
        return $this;
    }
    public function setGroupInfo( $groups = [] ){
        $this->userModel->groups()->sync( $groups );
        return $this;
    }
    public function getSchoolInfo(){
        $this->userModel->load('schools.classes');
        $this->userModel->setSchoolInfo();
        if (!empty($this->userModel->schoolIDs)) {
            $userAffiliation = SchoolModel::with(['classes' => function ($query){
                $query->whereIn('classes.id', $this->userModel->schoolIDs['1']);//todo hardcoded school id
            }])->find(array_keys($this->userModel->schoolIDs));
            $this->userModel->setRelation('affiliation', $userAffiliation);
            $this->userModel->unsetRelation('schools');
        }
        return $this;
    }
    public function setSchoolInfo( $classes = null ){
        if( $classes ) {
            $this->userModel->schools()->delete();//todo instead of delete should b update
            if ($this->userModel->isStudent)
                $classIDs = $classes;
            else
                $classIDs = implode(',', (array)$classes);
            $classes = DB::select(DB::raw("SELECT * FROM class_school where c_id IN ($classIDs)"));
            foreach ($classes as $classInfo) {
                $tempObj        = new UserClassModel();
                $tempObj->cs_id = $classInfo->id;
                $tempObj->u_id  = $this->userModel->id;
                $tempObj->save();
            }
        }
        return $this;
    }
    public function getUserData(){
        return $this->userModel;
    }

    public function prepareUserUpdate( $validatedData ){
        $this->userModel->active   = $validatedData['active'];
        $this->userModel->name     = $validatedData['name'];
        $this->userModel->email    = $validatedData['email'];
        $this->userModel->phone    = $validatedData['phone'];
        $this->userModel->dob      = $validatedData['dob'];
        $this->userModel->gender   = $validatedData['gender'];
        $this->userModel->address  = $validatedData['address'];
    }

    public function save(){
        $this->userModel->save();
        return $this;
    }
}