<?php
/**
 * Created by PhpStorm.
 * User: zamurd
 * Date: 3/3/2019
 * Time: 5:11 PM
 */

namespace App\Http\Components\User\Traits;


use App\Http\Components\User\UserModel;

Trait UserTrait
{
    public function getUserDetail( $id = null ){
        if(!$id)
            return false;
        return UserModel::find($id)->validateUser();
    }
}