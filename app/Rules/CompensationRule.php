<?php

namespace App\Rules;

use App\Http\Components\User\UserModel;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class CompensationRule implements Rule
{
    private $user;
    private $classID;
    private $maxAmount = 0;

    /**
     * compensationRule constructor.
     * @param UserModel $userModel
     * @param $classID
     */
    public function __construct(UserModel $userModel, $classID )
    {
        $this->user     = $userModel;
        $this->classID  = (is_array($classID))?implode(',',$classID):$classID;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
       if(!$this->classID || !$this->user->isStudent )
           return true;
       $compensationUser = DB::select(DB::raw("SELECT fees FROM class_school where c_id in ($this->classID)  LIMIT 1"));
       if ($compensationUser) {
           $this->maxAmount = $compensationUser[0]->fees;
           if ($value >0 && $value <= $this->maxAmount)
               return true;
       }
       return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        $msg = '"The :attribute must be greater than 0 ';
        if($this->maxAmount > 0)
            $msg.="and less than $this->maxAmount.";
        return $msg;
    }
}
