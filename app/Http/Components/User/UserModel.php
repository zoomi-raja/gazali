<?php
/**
 * Created by PhpStorm.
 * User: zamurd
 * Date: 2/3/2019
 * Time: 10:07 AM
 */
namespace App\Http\Components\User;

use Illuminate\Database\Eloquent\Model;

class UserModel extends Model{
    public function getList(){
        return 'here will fetch data from list';
    }
}