<?php   
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LookupType extends Model{
    protected $table = "lookup_types";
    
    public $incrementing = false;
    protected $keyType = 'string';

    // protected $fillable = [];
    protected $guarded = [];  

    // public $timestamps = false;

    public function lookups()
    {
        return $this->hasMany('App\Models\Lookup', 'lookup_type_id');
    }
}