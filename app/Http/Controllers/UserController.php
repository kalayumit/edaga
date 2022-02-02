<?php
namespace App\Http\Controllers;

use App\Contracts\UserContract;
use Illuminate\Http\Request;

class UserController extends Controller{

    private $_modelRepository;
    function __construct(UserContract $contract)
    {
        $this->_modelRepository = $contract;
    }

    //creates a new user
    function create(Request $req){

        $this->validate($req, [
            'full_name' => 'required|string|min:2|max:50',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8'
        ]);

        return $this->_modelRepository->create($req);
    }

    //updates a user with $id
    function update(Request $req, $id){
        return $this->_modelRepository->update($req, $id);
    }

    //views a specific user with id
    function get($id){
        return $this->_modelRepository->get($id);
    }

    function getAll(){
        return $this->_modelRepository->getAll();
    }

    //make user active
    function enable($id){
        return $this->_modelRepository->enableUser($id);
    }

    //make user inactive
    function disable($id){
        return $this->_modelRepository->disableUser($id);
    }

}
