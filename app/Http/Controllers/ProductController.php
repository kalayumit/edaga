<?php
namespace App\Http\Controllers;

use App\Contracts\ProductContract;
use Illuminate\Http\Request;

class ProductController extends Controller{
    
    private $_modelRepository;
    function __construct(ProductContract $contract)
    {
        $this->_modelRepository = $contract;
    }

    function getAll(){
        return $this->_modelRepository->getAll();
    }

    function create(Request $request){
        $this->validate($request, [
            'code' => 'required|string|unique:products,code',
            'name' => 'required|string',
            'order' => 'required|integer',
            'price' => 'required|integer',
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
