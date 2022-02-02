<?php   
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lookup extends Model{
    protected $table = "lookups";
    
    public $incrementing = false;
    protected $keyType = 'string';

    // protected $fillable = [];
    protected $guarded = [];  

    // public $timestamps = false;

    public function LookupType()
    {
        return $this->belongsTo('App\Models\LookupType', 'lookup_type_id');
    }
}