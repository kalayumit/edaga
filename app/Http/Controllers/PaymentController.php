<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\PaymentContract;

class PaymentController extends Controller {
     
    private $_modelRepository;
    function __construct(PaymentContract $contract)
    {
        $this->_modelRepository = $contract;
    }

    function create(Request $req){
        $this->validate($req, [
            'waiter_id' => 'required|string:payments|exists:waiters,id|uuid',
            'total' => 'required',            
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|string:payments|exists:products,id|uuid',
            'items.*.qty' => 'required|integer',
            'items.*.unit_price' => 'required',
         ]);
        return $this->_modelRepository->create($req);
    }

    function update(Request $req, $id){        
        return $this->_modelRepository->update($id, $req);
    }

    function get($id){
        return $this->_modelRepository->get($id);
    }

    function getAll(){
        return $this->_modelRepository->getAll();   
    }

    function tasks($id){
        return $this->_modelRepository->items($id);
    }

    function query($attribute, $value){
        return $this->_modelRepository->query($attribute, $value);
    }

    function filter(Request $req){
        return $this->_modelRepository->filter($req);
    }
    
    function filterByDate($date){
        return $this->_modelRepository->filterByDate($date);
    }

    function delete($id){
        return $this->_modelRepository->delete($id);
    }

    function status($id){
        return $this->_modelRepository->toggleStatus($id);
    }

    function crossCheck($date)
    {
        return $this->_modelRepository->crossCheck($date);
    }
}
