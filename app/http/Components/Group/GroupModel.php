<?php
/**
 * Created by PhpStorm.
 * User: zamurd
 * Date: 2/3/2019
 * Time: 10:07 AM
 */
namespace App\Http\Components\Group;

use Illuminate\Database\Eloquent\Model;
use App\Http\Components\Resource\ResourceModel;

class GroupModel extends Model {
    protected $table = 'groups';

    public function resources(){
        return $this->belongsToMany(ResourceModel::class, 'roles', 'r_id', 'g_id')->withPivot('view', 'add', 'update');
        //to attach
//        GroupModel::Find(3)->resources()->attach($resource,['view'=>true,'add'=>false,'update'=>false, 's_id' => 0 ]);

    }
}