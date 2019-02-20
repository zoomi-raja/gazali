<?php

namespace App\Http\Components\User;


use Illuminate\Database\Eloquent\Model;

class UserClassModel extends Model{

    protected $table        = 'user_cs';

    public function schoolPivotRelation(){
        return $this->belongsTo( UserModel::class,'u_id','id');
    }
}