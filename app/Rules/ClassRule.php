<?php

namespace App\Rules;

use App\Http\Components\User\UserModel;
use Illuminate\Contracts\Validation\Rule;

class ClassRule implements Rule
{
    private $userModel;

    /**
     * Create a new rule instance.
     *
     * @param UserModel $userModel
     */
    public function __construct(UserModel $userModel)
    {
        $this->userModel = $userModel;
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
        if(is_array($value) && $this->userModel->isStudent)
            return false;
        else
            return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'only one class can be allocated to student.';
    }
}
