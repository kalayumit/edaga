<?php
namespace App\Contracts;

interface LookupTypeContract extends CommonContract{    
    function toggleStatus($id);
    function getLookups($type);
}

