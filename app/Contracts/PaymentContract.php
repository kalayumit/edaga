<?php
namespace App\Contracts;

interface PaymentContract extends CommonContract{    
    function toggleStatus($id);
    function items($id);
    function filter($req);
    function filterByDate($date);
    function crossCheck($date);
}