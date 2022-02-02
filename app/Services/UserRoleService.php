<?php
namespace App\Services;

use App\Contracts\UserRoleContract;
use App\Models\UserRole;
use App\Repositories\UserRoleRepository;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class UserRoleService implements UserRoleContract{

    protected $_model = "App\\Models\\UserRole";

    function addRole($userId, $roleId){
        $model = new $this->_model();
        $model->user_id = $userId;
        $model->role_id = $roleId;
        try{
            $roleFound = DB::table('user_roles')->where(['user_id' => $userId], ['role_id' => $roleId])->get();
            if($roleFound->isEmpty()){
                return response()->json('User has already this role assigned to him/her', 400);
            }
            $model->save();
            return response()->json($model, 200);
        }catch(Exception $e){
            return response()->json($e, 500);
        }
    }

    function deleteRole($id)
    {
        try{
            $obj = $this->_model::findOrFail($id);
            $obj->delete();
            return response()->json('Resource role for ' + $id + 'doesn\'t exist anymore.', 402);
        }catch(Exception $e){
            return response()->json('User role doesn\'t exist', 404);
        }
    }

}
