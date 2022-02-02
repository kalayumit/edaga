<?php

namespace App\Services;

use App\Contracts\WaiterContract;
use Illuminate\Support\Str;

class WaiterService implements WaiterContract
{
    protected $_model = "App\\Models\\Waiter";

    function create($entity)
    {
        $model = new $this->_model();
        
        $model->id = (string) Str::uuid();
        $model->full_name = $entity->full_name;
        $model->phone = $entity->phone;
        $model->gender = $entity->gender;
        $model->status = true;
        
        $model->save();
        return response()->json($model, 201);
    }

    function update($id, $entity){        
        $obj = $this->_model::findOrFail($id);
        
        $obj->id = (string) Str::uuid();
        $obj->full_name = $entity->full_name;
        $obj->gender = $entity->gender;
        $obj->phone = $entity->phone;
        $obj->status = $entity->status;      

        $obj->save();
        return response()->json('Record updated successfully!!', 200);
    }

    function get($id)
    {
        $obj = $this->_model::findOrFail($id);
        return response()->json($obj, 200);
    }

    function getAll(){
        $resultList = $this->_model::orderBy('full_name')->get();
        return response()->json($resultList, 200);
    }

    public function query($attribute,$value)
    {                                
        $resultList = $this->_model::where($attribute,$value)->orderBy('full_name')->get();      
        return response()->json($resultList);
    }

    function toggleStatus($id)
    {
        $obj = $this->_model::findOrFail($id);
        $obj->update(array('status' => ($obj->status ^ 1))); 
        return response()->json('Record status toggled', 200);
    }

    function delete($id)
    {
        $obj = $this->_model::findOrFail($id);
        $obj->delete();
        return response()->json('Record deleted successfuly', 200);
    }
}
