<?php

namespace App\Services;

use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Validator;
use App\Contracts\UserContract;
use App\Models\Role;
use App\Models\UserRole;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserService implements UserContract
{

    protected $_model = "App\\Models\\User";

    private function uploadImage($profile)
    {
        try {
            $path = Storage::putFile('images/profiles', $profile);
            return $path;
        } catch (Exception $e) {
            return response()->json('Image could not be uploaded', 500);
        }
    }

    function create($request)
    {

        $model = new $this->_model();

        $model->id = (string) Str::uuid();
        $model->full_name = $request->full_name;
        $model->email = $request->email;
        $model->password = Hash::make($request->password);
        if ($request->photo != null) {
            $model->photo = $this->uploadImage($request->file('profile'));
        }
        $model->save();
        $role = Role::where('name', $request->role)->first();
        if($role)
        {
            $userRole = new UserRole();
            $userRole->id = (string) Str::uuid();
            $userRole->user_id = $model->id;
            $userRole->role_id = $role->id;
            $userRole->save();
        }        
        
        return response()->json($model, 201);
    }

    function get($id)
    {
        $obj = $this->_model::findOrFail($id);
        return response()->json($obj, 200);
    }

    function roles($id)
    {
        $obj = $this->_model::with('roles.role:id,name')->first($id);
        if(!$obj)
            return response()->json("Id not found", 404);
        return response()->json($obj->roles, 200);
    }

    function update($id, $request)
    {
        try {
            $obj = $this->_model::findOrFail($id);
            $obj->full_name = $request->full_name;
            $obj->email = $request->email;
            $obj->password = $request->password;
            $obj->save();
            
            $role = Role::where('name', $request->role)->first();
            if($role)
            {
                $userRoleObj = UserRole::where('user_id', $obj->id)->first();
                                
                $userRoleObj->role_id = $role->id;
                $userRoleObj->save();
            }
            return response()->json('User updated', 200);
        } catch (ModelNotFoundException $e) {
            return response()->json('User not found', 404);
        }
    }

    function updateProfile($image, $id)
    {
        //upload image here

    }

    function enableUser($id)
    {
            $obj = $this->_model::findOrFail($id);
            $obj->status = true;
            $obj->save();
            return response()->json('User has been enabled', 200);
    }

    function getAll(){
        $resultList = $this->_model::with('roles.role:name')->get();
        return response()->json($resultList, 200);
    }

    public function query($attribute,$value)
    {
        $resultList = User::where($attribute,$value)->get();
        return response()->json($resultList);
    }


    function disableUser($id)
    {
        try {
            $user = $this->_model::findOrFail($id);
            $user->status = false;
            $user->save();
            return response()->json('User has been enabled', 200);
        } catch (Exception $e) {
            return response()->json('User not found', 404);
        }
    }

    function delete($id){
        try {
            $user = $this->_model::findOrFail($id);
            $user->delete();
            return response()->json('User has been deleted', 200);
        } catch (Exception $e) {
            return response()->json('User not found', 404);
        }
    }

}
