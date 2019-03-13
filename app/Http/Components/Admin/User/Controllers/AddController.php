<?php
/**
 * Created by PhpStorm.
 * User: zamurd
 * Date: 2/4/2019
 * Time: 9:10 AM
 */

namespace App\Http\Components\admin\User\Controllers;


use App\Http\Components\Controller;
use App\Http\Components\admin\User\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;

class AddController extends Controller
{
    public function __construct(){
    }
    public function showForm(){
        return view('userAddForm');
    }
    public function add( UserModel $user, Request $request ){
        $messages = ['phone.numeric' => 'invalid number'];
        $validatedData = $this->validate($request,[
            'name' => 'required|max:255',
            'email' => 'required|email',
            'phone' => 'numeric|digits_between:11,14'
        ],$messages);
        $user->name     = $validatedData['name'];
        $user->email    = $validatedData['email'];
        $user->gender   = $request->input('gender','M');;
        $user->login    = explode('@',$validatedData['email'])[0];
        $user->dob      = '2018/12/03';
        $user->password = Hash::make('12345678');
        try {
            $user->save();
        }catch (QueryException $e){
            $errorCode = $e->errorInfo[1];
            if($errorCode == 1062){
                p($e->getMessage(),true);
            }
            p($e->getMessage(),true);
        }
        return view('userAddForm')->with('alert-success', 'The data was saved successfully');
    }
}