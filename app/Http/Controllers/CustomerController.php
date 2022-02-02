<?php
namespace App\Http\Controllers;

use App\Contracts\CustomerContract;
use Illuminate\Http\Request;

class CustomerController extends Controller{
    
    private $_modelRepository;
    function __construct(CustomerContract $contract)
    {
        $this->_modelRepository = $contract;
    }

    function getAll(Request $request){
        return $this->_modelRepository->getAll($request->limit, $request->skip);
    }

    function create(Request $request){
        $this->validate($request, [
            'group_id' => 'required|string:customers|exists:lookups,id|uuid',
            'name' => 'required|string',
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