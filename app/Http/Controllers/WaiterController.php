<?php
namespace App\Http\Controllers;

use App\Contracts\WaiterContract;
use Illuminate\Http\Request;

class WaiterController extends Controller{
    
    private $_modelRepository;
    function __construct(WaiterContract $contract)
    {
        $this->_modelRepository = $contract;
    }

    function getAll(){
        return $this->_modelRepository->getAll();
    }

    function create(Request $request){
        $this->validate($request, [
            'full_name' => 'required|string',
            'gender' => 'required|string',
            'phone' => 'required|string'
         ]);
        return $this->_modelRepository->create($request);
    }

    
    function update(Request $req, $id){
        return $this->_modelRepository->update($req, $id);
    }

    function get($id){
        return $this->_modelRepository->get($id);
    }

    function query($attribute,$value){
        return $this->_modelRepository->query($attribute,$value);
    }

    function delete($id){
        return $this->_modelRepository->delete($id);
    }

    function toggleStatus($id){
        return $this->_modelRepository->toggleStatus($id);
    }
}
