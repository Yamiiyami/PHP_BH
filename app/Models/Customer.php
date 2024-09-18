<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = ['name','username','email','password','phone','status','role_id'];
    protected $hidden = ['password'];

    public function cart() : HasMany
    {
        return $this->hasMany(cart::class);
    }
    public function role() : BelongsTo {
        return $this->belongsTo(Category::class);
    }
}
