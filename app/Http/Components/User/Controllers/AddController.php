<?php
/**
 * Created by PhpStorm.
 * User: zamurd
 * Date: 2/4/2019
 * Time: 9:10 AM
 */

namespace App\Http\Components\User\Controllers;


use App\Http\Components\Controller;
use App\Http\Components\User\UserModel;
use Illuminate\Http\Request;

class AddController extends Controller
{
    public function __construct(){
    }
    public function showForm(){
        return view('userAddForm');
    }
    public function add( UserModel $user, Request $request ){
        $validatedData = $request->validate([
            'title' => 'required|unique:posts|max:255',
            'body' => 'required',
        ]);
var_dump($user);die;
    }
}