<?php
namespace App\Services;

use App\Contracts\LookupContract;
use App\Models\Lookup;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Str;

class LookupService implements LookupContract {

    protected $_model = "App\\Models\\Lookup";
    protected $_intermediaries = ['LookupType'];

    function create($request){

        $model = new $this->_model();

        $model->id = (string) Str::uuid();  

        $model->code = $request->code;    
        $model->lookup_type_id = $request->lookup_type_id;  
        $model->name = $request->name;   
        $model->local_name = $request->local_name;  
        $model->order = $request->order;
        $model->save();
            return response()->json($model, 201);

    }
    function update($request, $id){
        try{
            $obj = $this->_model::findOrFail($id);  

            $obj->code = $request->code;              
            $obj->lookup_type_id = $request->lookup_type_id;   
            $obj->name = $request->name;   
            $obj->local_name = $request->local_name;  
            $obj->order = $request->order;
            
            $role->save();
            return response()->json('Role updated', 200);
        }catch(ModelNotFoundException $e){
            return response()->json('Role not found', 404);
        }
    }

    function get($id)
    {
        $obj = $this->_model::with($this->_intermediaries)->findOrFail($id);
        return response()->json($obj, 200);
    }

    function getAll($limit, $skip){
        $resultList = $this->_model::with($this->_intermediaries)->orderBy('order')->get();
        return response()->json($resultList, 200);
    }

    public function query($attribute,$value)
    {                                
        $resultList = $this->_model::with($this->_intermediaries)->where($attribute,$value)->orderBy('order')->get();      
        return response()->json($resultList);
    }

    public function getLookups($type)
    {          
        $resultList = $this->_model::with(['LookupType' => function($query) use ($type) {
            $query->where('code', $type);
        }])->get();
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
