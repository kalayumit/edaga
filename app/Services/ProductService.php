<?php

namespace App\Services;

use App\Contracts\ProductContract;
use Illuminate\Support\Str;

class ProductService implements ProductContract
{
    protected $_model = "App\\Models\\Product";

    function create($entity)
    {
        $model = new $this->_model();
        
        $model->id = (string) Str::uuid();
        $model->name = $entity->name;
        $model->code = $entity->code;
        $model->order = $entity->order;
        $model->price = $entity->price;
        $model->status = true;
        
        $model->save();
        return response()->json($model, 201);
    }

    function update($id, $entity){        
        $obj = $this->_model::findOrFail($id);
        
        $obj->id = (string) Str::uuid();
        $obj->name = $entity->name;
        $obj->code = $entity->code;
        $obj->order = $entity->order;
        $obj->price = $entity->price;
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
        $resultList = $this->_model::orderBy('order')->get();
        return response()->json($resultList, 200);
    }

    public function query($attribute,$value)
    {                                
        $resultList = $this->_model::where($attribute,$value)->orderBy('order')->get();      
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
