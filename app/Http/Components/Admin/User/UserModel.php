<?php
/**
 * Created by PhpStorm.
 * User: zamurd
 * Date: 2/3/2019
 * Time: 10:07 AM
 */
namespace App\Http\Components\Admin\User;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Admin\Auth\MustVerifyEmail;
use App\Http\Components\Group\GroupModel;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class UserModel extends Authenticatable{
    use Notifiable;


    protected $table       = 'users';
    public $isStudent      = false;
    public $isSuperAdmin   = false;
    public $isAdmin        = false;
    public $isTeacher      = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'phone', 'gender', 'password', 'login', 'dob', 'address'
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
    }

    public function schools(){
        return $this->hasMany(UserClassModel::class,'u_id');
    }


    public function compensation(){
        return $this->hasOne(CompensationModel::class,'u_id');
    }

    public function setUserType(){
        $this->groups->search(function ( $item, $key ){
            switch ($item->key){
                case 'STUDENT':
                    $this->isStudent    = true;
                    break;
                case 'SUPER_ADMIN':
                    $this->isSuperAdmin = true;
                    break;
                case 'TEACHER':
                    $this->isTeacher    = true;
                    break;
                case 'ADMIN':
                    $this->isAdmin      = true;
                    break;
            }
        });
        return $this;
    }

    public function setSchoolInfo(){
        $tempSchoolClassIDs = [];
        $this->schools->each(function ($item, $key) use(&$tempSchoolClassIDs) {
            foreach ($item->classes as $classInfo){
                $tempSchoolClassIDs[$classInfo->pivot->s_id][] = $classInfo->id;
            }
        });
        $this->schoolIDs = $tempSchoolClassIDs;
        return $this;
    }

    public function scopeGetGroups($query)
    {
        return $query->with("groups")->get();
    }

}