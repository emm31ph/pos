<?php

namespace App\Models;

use App\Models\Serial;
use App\Models\UserBranch;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Branch extends Model
{
    use HasFactory;
    
    
    protected $table = 'branch';
    protected $fillable = [
        'name', 'branch'
    ];
    
    
    public function branch_users()
    {
        return $this->hasMany(UserBranch::class,'branch_id','id');
    }
      
    public function branch_serial()
    {
        return $this->hasOne(Serial::class,'branch','branch');
    }

    // // this is a recommended way to declare event handlers
    public static function boot() {
        parent::boot();

        static::deleting(function($user) { // before delete() method call this
            $user->branch_users()->delete();
            $user->branch_serial()->delete();
             // do the rest of the cleanup...
        });
    }
    
}
