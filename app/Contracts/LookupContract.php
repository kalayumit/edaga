<?php
namespace App\Contracts;

interface LookupContract extends CommonContract{    
    function toggleStatus($id);
    function getLookups($type);
}

