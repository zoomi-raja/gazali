<?php
/**
 * Created by PhpStorm.
 * User: zamurd
 * Date: 2/18/2019
 * Time: 11:22 AM
 */

namespace App\Http\Components\admin\User\Controllers;

use App\Http\Components\Controller;
use App\Http\Components\admin\Group\GroupModel;
use App\Http\Components\admin\School\SchoolModel;
use App\Http\Components\admin\User\Repositories\UserRepository;
use App\Http\Requests\UpdateUser;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class UserEditController extends Controller
{
    public $userRepository;

    /**
     * UserEditController constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository){
        $this->userRepository   = $userRepository;
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void
     */
    public function detail($id ){
        $userRepo       = $this->userRepository->getUserDetail($id);
        if($userRepo) {
            $obj        = new \StdClass();
            $userDetail         = $userRepo->getCompensationInfo()->getSchoolInfo();
            $obj->userDetails   = $userDetail->getUserData();
            $obj->schools       = SchoolModel::with('classes')->find(1);
            $obj->groups        = GroupModel::where('key','!=','SUPER_ADMIN')->get();
            return view('userDetailEdit', ['arResult' => $obj]);
        }else{
            return abort(404);
        }
    }

    /**
     * @param $id
     * @param UpdateUser $updateUserRequest
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function update($id, UpdateUser $updateUserRequest ){
        $userRepo       = $this->userRepository->getUserDetail($id);
        if( $userRepo ) {
            $validatedData = $updateUserRequest->validated();
            DB::beginTransaction();
            try{
                $this->userRepository->prepareUserUpdate( $validatedData );
                $this->userRepository->getCompensationInfo()->setCompensationInfo( $validatedData['fees'] );
                $this->userRepository->setGroupInfo( (array)$validatedData['group'] );
                $this->userRepository->setSchoolInfo( $validatedData['class'] );
                $this->userRepository->save();

                DB::commit();
                return redirect()->back()->with('success', 'info saved lets see');
            }catch (\Exception $e){
                DB::rollBack();
                return Redirect::back()->withErrors([$e->getMessage()]);
            }
        }else{
            return abort(404);
        }
    }

}