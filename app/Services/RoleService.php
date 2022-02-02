<?php
namespace App\Services;

use App\Contracts\RoleContract;
use App\Models\Role;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Str;

class RoleService implements RoleContract {

    protected $_model = "App\\Models\\Role";

    function create($request){

        $model = new $this->_model();

        $model->id = (string) Str::uuid();        
        $model->name = $request->name;
        $model->save();
            return response()->json($model, 201);

    }
    function update($request, $id){
        try{
            $role = $this->_model::findOrFail($id);
            $role->name = $request->name;
            // $role->status = $request->status;
            $role->save();
            return response()->json('Role updated', 200);
        }catch(ModelNotFoundException $e){
            return response()->json('Role not found', 404);
        }
    }
    function enable($id)
    {
        try{
            $role = $this->_model::findOrFail($id);
            $role->status = true;
            $role->save();
            return response()->json('Role Enabled', 200);
        }catch(ModelNotFoundException $e){
            return response()->json('Role not found', 404);
        }
    }
    function disable($id)
    {
        try{
            $role = $this->_model::findOrFail($id);
            $role->status = false;
            $role->save();
            return response()->json('Role disabled', 200);
        }catch(ModelNotFoundException $e){
            return response()->json('Role not found', 404);
        }
    }

}
