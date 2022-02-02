<?php
namespace App\Http\Controllers;

use App\Contracts\LookupContract;
use Illuminate\Http\Request;

class LookupController extends Controller{
    
    private $_modelRepository;
    function __construct(LookupContract $contract)
    {
        $this->_modelRepository = $contract;
    }

    function getAll(Request $request){
        return $this->_modelRepository->getAll($request->limit, $request->skip);
    }

    function create(Request $request){
        $this->validate($request, [
            'lookup_type_id' => 'required|string:lookups|exists:lookup_types,id|uuid',
            'code' => 'required|string',
            'name' => 'required|string'
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

    function getLookups($type){        
        return $this->_modelRepository->getLookups($type);
    }

    function delete($id){
        return $this->_modelRepository->delete($id);
    }

    function toggleStatus($id){
        return $this->_modelRepository->toggleStatus($id);
    }
}
