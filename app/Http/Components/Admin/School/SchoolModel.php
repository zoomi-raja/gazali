<?php
/**
 * Created by PhpStorm.
 * User: zamurd
 * Date: 2/3/2019
 * Time: 10:07 AM
 */
namespace App\Http\Components\Admin\School;


use App\Http\Components\Admin\Classes\ClassesModel;
use Illuminate\Database\Eloquent\Model;

class SchoolModel extends Model{

    protected $table        = 'schools';

    public function classes(){
        return $this->belongsToMany(ClassesModel::class,'class_school','s_id','c_id');
    }
}