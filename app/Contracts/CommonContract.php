<?php
namespace App\Contracts;

interface CommonContract {
    function get($id);
    function getAll($limit, $skip);
    function query($attribute, $value);
    function update($id, $request);
    function delete($id);
    function create($request);
}
