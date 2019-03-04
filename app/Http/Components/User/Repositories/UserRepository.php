<?php
/**
 * Created by PhpStorm.
 * User: zamurd
 * Date: 3/4/2019
 * Time: 10:17 AM
 */

namespace App\Http\Components\User\Repositories;


use App\Http\Components\School\SchoolModel;
use App\Http\Components\User\CompensationModel;
use App\Http\Components\User\UserClassModel;
use App\Http\Components\User\UserModel;
use Illuminate\Support\Facades\DB;

class UserRepository
{
    private $userModel;
    function  __construct( UserModel $userModel){
        $this->userModel = $userModel;
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