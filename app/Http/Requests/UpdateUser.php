<?php

namespace App\Http\Requests;

use App\Http\Components\User\Traits\UserTrait;
use App\Rules\ClassRule;
use App\Rules\CompensationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUser extends FormRequest
{
    use UserTrait;

    public $user;
    public $userType;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $this->user     = $this->getUserDetail($this->route('id'));
        $this->userType = ($this->user->isStudent)?4:1;
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'active'    => 'boolean',
            'name'      => 'required|max:255',
            'email'     => 'required|unique:users,email,'.$this->route('id').'|email',
            'phone'     => 'numeric|digits_between:11,14',
            'dob'       => 'nullable|date',
            'gender'    => 'in:M,F',
            'class'     => ['required','exists:classes,id', new ClassRule( $this->user )],
            'fees'      => ['required',new CompensationRule( $this->route('id'), $this->userType, $this->request->get('class') )],//todo 1 is for fees and 2 for salary
            'school'    => 'required|exists:schools,id',
            'group'     => 'required|exists:groups,id',
            'address'   => 'nullable'
        ];
    }
}
