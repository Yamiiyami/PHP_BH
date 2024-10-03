<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class cartinfo extends Model
{
    protected $fillable = ['quantity','price','product_id','carts_id'];
    use HasFactory;
    public function product() : HasMany {
        return $this->hasMany(product::class);
    }

    public function cart() : HasMany {
        return $this->hasMany(cart::class);
    }

    
}
