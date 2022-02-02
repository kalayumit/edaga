<?php
namespace App\Services;

use App\Contracts\OrderContract;
use App\Models\OrderItem;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class OrderService implements OrderContract{

    protected $_model = "App\\Models\\Order";
    protected $_intermediaries = ['items'];

    function create($entity){
        $model = new $this->_model();

        $model->id = (string) Str::uuid();
        $model->waiter_id = $entity->waiter_id;
        $model->table_no = $entity->table_no;
        $model->total = $entity->total;
        
        $orderItems = collect();
        foreach ($entity->items as $key => $item) {
            $obj = (object)$item;

            $orderItem = new OrderItem();
            
            $orderItem->id = (string) Str::uuid(); 
            $orderItem->order_id = $model->id;
            $orderItem->product_id = $obj->product_id;
            $orderItem->qty = $obj->qty;
            $orderItem->unit_price = $obj->unit_price;
            $orderItems->push($orderItem);
        }   
        DB::transaction(function() use($model, $orderItems){            
            $model->save();            
            OrderItem::insert($orderItems->toArray());
        });
        $model->items = $orderItems;
        return response()->json($model ,200);
    }


    function update($entity, $id){
        
    }

    function getAll(){
        $resultList = $this->_model::with($this->_intermediaries)->orderBy('created_at')->get();
        return response()->json($resultList, 200);
    }

    function get($id){
        $task = $this->_model::with($this->_intermediaries)->findOrFail($id);
        return response()->json($task, 200);
    }

    function createDependency(){

    }

    function delete($id){
        //
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
