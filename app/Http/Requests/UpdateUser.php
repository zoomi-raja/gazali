<?php

namespace App\Http\Requests;

use App\Http\Components\User\Repositories\UserRepository;
use App\Http\Components\User\Traits\UserTrait;
use App\Rules\ClassRule;
use App\Rules\CompensationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUser extends FormRequest
{
    use UserTrait;

    public $user;
    public $userType;
    public $userRepository;

    function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $this->user     = $this->userRepository->getUserDetail($this->route('id'))->getUserData();
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
            'fees'      => ['required',new CompensationRule( $this->user, $this->request->get('class') )],//todo 1 is for fees and 2 for salary
            'school'    => 'required|exists:schools,id',
            'group'     => 'required|exists:groups,id',
            'address'   => 'nullable'
        ];
    }
}
