<?php
/**
 * Created by PhpStorm.
 * User: zamurd
 * Date: 2/3/2019
 * Time: 10:07 AM
 */
namespace App\Http\Components\Classes;


use App\Http\Components\School\SchoolModel;
use Illuminate\Database\Eloquent\Model;

class ClassesModel extends Model{

    protected $table        = 'Classes';

    public function schools(){
        return $this->belongsToMany( SchoolModel::class, 'class_school', 'c_id','s_id' );
    }
}