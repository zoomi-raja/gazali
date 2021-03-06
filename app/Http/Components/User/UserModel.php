<?php
/**
 * Created by PhpStorm.
 * User: zamurd
 * Date: 2/3/2019
 * Time: 10:07 AM
 */
namespace App\Http\Components\User;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Http\Components\Group\GroupModel;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserModel extends Authenticatable{
    use Notifiable;


    protected $table        = 'users';
//    protected $primaryKey   = 'ID';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'phone', 'gender', 'password', 'login', 'dob'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function getList(){
        return 'here will fetch data from list';
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
//    public function getAuthPassword()
//    {
//        return $this->PASSWORD;
//    }

    public function groups(){
        return $this->belongsToMany(GroupModel::class, 'group_user', 'u_id', 'g_id');
//        return $this->hasMany('App\GroupUser','U_ID')->get();
    }
    public function scopeGetGroups($query)
    {
        return $query->with("groups")->get();
    }

}