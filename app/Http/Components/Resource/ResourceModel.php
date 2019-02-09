<?php
/**
 * Created by PhpStorm.
 * User: zamurd
 * Date: 2/3/2019
 * Time: 10:07 AM
 */
namespace App\Http\Components\Resource;

use Illuminate\Database\Eloquent\Model;

class ResourceModel extends Model{


    protected $table        = 'resources';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'key',
    ];

}