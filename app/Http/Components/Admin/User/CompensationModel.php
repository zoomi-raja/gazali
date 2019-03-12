<?php
/**
 * Created by PhpStorm.
 * User: zamurd
 * Date: 2/3/2019
 * Time: 10:07 AM
 */
namespace App\Http\Components\admin\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Http\Components\admin\Group\GroupModel;
use function Sodium\add;

class CompensationModel extends Model {
    use Notifiable;


    protected $table        = 'compensations';


    public function user()
    {
        return $this->belongsTo(UserModel::class,'u_id');
    }

}