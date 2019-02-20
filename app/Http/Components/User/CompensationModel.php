<?php
/**
 * Created by PhpStorm.
 * User: zamurd
 * Date: 2/3/2019
 * Time: 10:07 AM
 */
namespace App\Http\Components\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Http\Components\Group\GroupModel;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use function Sodium\add;

class CompensationModel extends Model {
    use Notifiable;


    protected $table        = 'compensations';
}