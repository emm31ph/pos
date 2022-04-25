<?php

namespace App\Models;
 
use App\Models\UserBranch;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable  implements JWTSubject
{
    use LaratrustUserTrait;
    use   HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    
    protected $appends = [
        'allPermissions', 
    ]; 
    
    
    public function getAllPermissionsAttribute()
    {
        return ($this->allPermissions());
    }
     /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier() {
        return $this->getKey();
    }
    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims() {
        return [];
    }    
    
    public function mybranch()
    {
        return  $this->hasManyThrough(Branch::class, UserBranch::class,
        'user_id', // Foreign key on the types table...
        'id', // Foreign key on the items table...
        'id', // Local key on the categories table...
        'branch_id' // Local key on the users table...
        ); 
    }

 
    
    public function branch()
    {
        return  $this->hasManyThrough(Branch::class, UserBranch::class,
        'user_id', // Foreign key on the types table...
        'id', // Foreign key on the items table...
        'id', // Local key on the categories table...
        'branch_id' // Local key on the users table...
        ); 
    }
    
    public function syncBranch()
    {
        return $this->belongsToMany('App\Models\Branch','App\Models\UserBranch','user_id','branch_id');
    }
    
}
