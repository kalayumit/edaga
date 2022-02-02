<?php
namespace App\Http\Controllers;

use App\Contracts\RoleContract;
use App\Services\RoleService;
use Illuminate\Http\Request;

class RoleController extends Controller {

    private $_modelRepository;
    function __construct(RoleContract $contract)
    {
        $this->_modelRepository = $contract;
    }


    function create(Request $request){
        return $this->_modelRepository->createRole($request);
    }

    function update(Request $request, $id){

    }

    function enable($id){
        return $this->_modelRepository->enableRole($id);
    }

    function disable($id){
        return $this->_modelRepository->disableRole($id);
    }
}
