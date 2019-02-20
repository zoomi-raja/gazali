<?php
/**
 * Created by PhpStorm.
 * User: zamurd
 * Date: 2/3/2019
 * Time: 10:07 AM
 */
namespace App\Http\Components\User;

use App\Http\Components\School\SchoolModel;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Http\Components\Group\GroupModel;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use function Sodium\add;

class UserModel extends Authenticatable{
    use Notifiable;


    protected $table     = 'users';
    public $isStudent    = false;
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
    }

    public function schools(){
        return $this->hasMany(UserClassModel::class,'u_id');
    }


    public function compensation(){
        return $this->hasOne(CompensationModel::class,'u_id');
    }

    public function isStudent(){

        $this->groups->search(function ( $item, $key ){
            if($item->key == 'STUDENT'){
                $this->isStudent = true;
            }
        });
        return $this;
    }
    public function setSchoolInfo(){
        $schoolRelationIDs = $temp = [];
        if($this->relations['schools']){
            foreach ($this->relations['schools'] as $d)
                $schoolRelationIDs[] = $d->cs_id;
        }
        $schoolData = DB::table('class_school')
            ->join('schools','schools.id','=','class_school.s_id')
            ->join('classes','classes.id','=','class_school.c_id')
            ->whereIn('class_school.id',$schoolRelationIDs)
            ->groupBy('class_school.s_id')
            ->select(
                'schools.id',
                'schools.name',
                'schools.address',
                'class_school.s_id',
                DB::raw('GROUP_CONCAT(classes.id,\',\',classes.name SEPARATOR \'|\' ) as school')
            )->get();
        foreach($schoolData as $key => $schoolInfo){
            $classes    = explode('|',$schoolInfo->school);
            foreach ($classes as $classInfo){
                 if( !isset( $schoolData[$key]->classeInfo ) )
                     $schoolData[$key]->classeInfo  = new Collection();
                list($classID,$className)   = explode(',',$classInfo);
                $schoolData[$key]->classeInfo->put($classID,['id' => $classID,'name' =>$className]);
                unset($classObj);
            }
        }
        $this->schoolInfo = $schoolData;
        return $this;
    }
//    public function getSchoolClassDetails(){
//
//        $data = SchoolModel::with(['classes'=>function($query) use ($schoolRelationIDs){
//            $query->whereIn('class_school.id',$schoolRelationIDs);
//        }])->where('id',1)->get();
//    }
    public function scopeGetGroups($query)
    {
        return $query->with("groups")->get();
    }

}