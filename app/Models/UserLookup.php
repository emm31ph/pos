<?php

namespace App\Models;
 
use App\Models\Lookup; 
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserLookup extends Model
{
    use HasFactory;
    
    protected $table = 'user_lookup';
    
    
    public function lookup()
    {
        return $this->hasMany(Lookup::class,'code','code');
    }
}
