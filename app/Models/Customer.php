<?php   
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model{
    protected $table = "customers";
    
    public $incrementing = false;
    protected $keyType = 'string';

    // protected $fillable = [];
    protected $guarded = [];  


    // public $timestamps = false;

    public function group()
    {
        return $this->belongsTo('App\Models\Lookup', 'group_id');
    }
}