<?php

namespace App\Http\Components\User;


use App\Http\Components\School\SchoolModel;
use Illuminate\Database\Eloquent\Model;

class UserClassModel extends Model{

    protected $table        = 'user_cs';

    public function schoolPivotRelation(){
        return $this->belongsTo( UserModel::class,'u_id','id');
    }

    public function haveSchool(){
        return $this->belongsToMany(SchoolModel::class,'class_school','id','s_id');
    }
}