<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Customer extends Authenticatable implements JWTSubject
{
    use HasFactory;
    protected $fillable = ['name','username','email','password','phone','status','role_id'];
    protected $hidden = ['password'];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function cart() : HasMany
    {
        return $this->hasMany(cart::class);
    }
    public function role() : BelongsTo {
        return $this->belongsTo(Role::class,'role_id');
    }
}
