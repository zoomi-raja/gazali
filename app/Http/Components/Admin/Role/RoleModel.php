<?php
/**
 * Created by PhpStorm.
 * User: zamurd
 * Date: 2/3/2019
 * Time: 10:07 AM
 */
namespace App\Http\Components\Admin\Role;


use Illuminate\Database\Eloquent\Model;

class RoleModel extends Model{

    protected $table        = 'roles';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'u_id', 's_id', 'r_id', 'view', 'add', 'update'
    ];
}