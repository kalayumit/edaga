<?php
namespace App\Services;

use App\Contracts\CustomerContract;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class CustomerService implements CustomerContract{

    protected $_model = "App\\Models\\Customer";
    protected $_intermediaries = ['group'];

    function create($entity){
        $model = new $this->_model();

        $model->id = (string) Str::uuid();
        $model->group_id = $entity->group_id;
        $model->name = $entity->name;
        $model->email = $entity->email;
        $model->address = $entity->address;
        $model->telephone = $entity->telephone;
        $model->account = $entity->account;

        $model->save(); 
        return response()->json($model ,200);
    }


    function update($entity, $id){
             
        $obj = $this->_model::findOrFail($id);

        $obj->group_id = $entity->group_id;
        $obj->name = $entity->name;
        $obj->email = $entity->email;
        $obj->address = $entity->address;
        $obj->telephone = $entity->telephone;
        $obj->account = $entity->account;   

        $obj->save();
        return response()->json('Record updated successfully!!', 200);
    }

    function getAll($limit, $skip){
        // $resultList = $this->_model::with($this->_intermediaries)->orderBy('name')->paginate($limit);
        $currentPage = $limit != 0 ? ($skip/$limit)+1 : 1;
        $resultList = $this->_model::with($this->_intermediaries)->paginate(
            $perPage = $limit, $columns = ['*'], $currentPage = $currentPage
        );
        return response()->json($resultList, 200);
    }

    function get($id){
        $task = $this->_model::with($this->_intermediaries)->findOrFail($id);
        return response()->json($task, 200);
    }

    function createDependency(){

    }

    function delete($id){
        
        $obj = $this->_model::findOrFail($id);
        $obj->delete();
        return response()->json('Record deleted successfuly', 200);
    }

    public function query($attribute,$value)
    {
        $resultList = $this->_model::with($this->_intermediaries)->where($attribute,$value)->get();
        return response()->json($resultList);
    }

    public function filter($req)
    {
        $resultList = $this->_model::with($this->_intermediaries)->where('waiter_id', $req->waiter_id)->
                    whereDate( 'created_at', '=', $req->created_at)->get();
        return response()->json($resultList);
    }

    public function filterByDate($date)
    {
        $resultList = $this->_model::with($this->_intermediaries)->whereDate('created_at', '=', $date)->get();
        return response()->json($resultList);
    }

    public function getIntermediary($id, $intermediaryName)
    {
        $resultList= $this->_model::with($intermediaryName)->where('id',$id)->first();
        if(!$resultList)
            return response()->json("Id not found", 404);
        return response()->json($resultList, 200);
    }
    
    function toggleStatus($id)
    {
        $obj = $this->_model::findOrFail($id);
        $obj->update(array('status' => ($obj->status ^ 1))); 
        return response()->json('Record status toggled', 200);
    }    

    function items($id)
    {
        $obj = $this->_model::with('items')->first($id);
        if(!$obj)
            return response()->json("Id not found", 404);
        return response()->json($obj->items, 200);
    }
}
