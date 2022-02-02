<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model{

    //
    
    public $incrementing = false;
    protected $keyType = 'string';

    

    public function role()
    {
        return $this->belongsTo('App\Models\Role');
    }
    
}
