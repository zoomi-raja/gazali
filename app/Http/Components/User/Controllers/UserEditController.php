<?php
/**
 * Created by PhpStorm.
 * User: zamurd
 * Date: 2/18/2019
 * Time: 11:22 AM
 */

namespace App\Http\Components\User\Controllers;

use App\Http\Components\Classes\ClassesModel;
use App\Http\Components\Controller;
use App\Http\Components\Group\GroupModel;
use App\Http\Components\School\SchoolModel;
use App\Http\Components\User\CompensationModel;
use App\Http\Components\User\UserClassModel;
use App\Http\Components\User\UserModel;
use App\Http\Requests\UpdateUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class UserEditController extends Controller
{
    public $request;
    public function __construct(Request $request){
        $this->request = $request;
    }

    public function detail( $id ){
        $user = UserModel::find($id);
        $type = ($user->validateUser()->isStudent)?2:1;
        if($user) {
            $obj = new \StdClass();
            $useDetail = UserModel::with(['groups', 'compensation' => function($query)use($type){$query->where('type','=',$type);}, 'schools.classes'])->find($id);
            $useDetail->setSchoolInfo();
            if (!empty($useDetail->schoolIDs)) {
                $userAffiliation = SchoolModel::with(['classes' => function ($query) use ($useDetail) {
                    $query->whereIn('classes.id', $useDetail->schoolIDs['1']);//todo hardcoded school id
                }])->find(array_keys($useDetail->schoolIDs));
                $useDetail->setRelation('affiliation', $userAffiliation);
            }
            $obj->userDetails = $useDetail->setSchoolInfo()->validateUser();
            $obj->schools = SchoolModel::with('classes')->find(1);
            $obj->groups = GroupModel::where('key','!=','SUPER_ADMIN')->get();
            return view('userDetailEdit', ['arResult' => $obj]);
        }else{
            return abort(404);
        }
    }

    public function update( $id, UpdateUser $updateUserRequest ){
        $user   = UserModel::find($id);
        if( $user ) {
            $validatedData = $updateUserRequest->validated();
            DB::beginTransaction();
            try{
                $user->active   = $validatedData['active'];
                $user->name     = $validatedData['name'];
                $user->email    = $validatedData['email'];
                $user->phone    = $validatedData['phone'];
                $user->dob      = $validatedData['dob'];
                $user->gender   = $validatedData['gender'];
                $user->address  = $validatedData['address'];
                $type           = ($user->validateUser()->isStudent)?2:1;

                $user->load(['compensation'=>function($query) use ($type){
                    $query->where('type','=',$type);
                }]);

                if(!$user->compensation) {
                    $user->setRelation('compensation', new CompensationModel());
                    $user->compensation->u_id   = $id;
                }
                $user->compensation->amount = $validatedData['fees'];
                $user->compensation->type   = $type;
                $user->compensation->save();

                $user->groups()->sync((array)$validatedData['group']);
                $user->schools()->delete();
                if($user->isStudent)
                    $classIDs   = $validatedData['class'];
                else
                    $classIDs   = implode(',',$validatedData['class']);
                $classes = DB::select(DB::raw("SELECT * FROM class_school where c_id IN ($classIDs)" ) );
                foreach($classes as $classInfo){
                    $tempObj            = new UserClassModel();
                    $tempObj->cs_id     = $classInfo->id;
                    $tempObj->u_id      = $id;
                    $tempObj->save();
                }
                $user->save();

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