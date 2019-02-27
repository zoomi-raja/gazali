<?php

namespace App\Http\Components\User;


use App\Http\Components\Classes\ClassesModel;
use Illuminate\Database\Eloquent\Model;

class UserClassModel extends Model{

    protected $table        = 'user_cs';

    public function schoolPivotRelation(){
        return $this->belongsTo( UserModel::class,'u_id','id');
    }

    public function classes(){
        return $this->belongsToMany(ClassesModel::class,'class_school','id','c_id','cs_id')->withPivot('s_id');
    }
}