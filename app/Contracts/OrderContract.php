<?php
namespace App\Contracts;

interface OrderContract extends CommonContract{    
    function toggleStatus($id);
    function items($id);
    function filter($req);
    function filterByDate($date);
}