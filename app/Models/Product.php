<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name','description','quantity','price','color','cate_id'];
    public function cart():HasMany{
        return $this->hasMany(cartinfo::class);
    }

    public function images() : HasMany {
        return $this->hasMany(image::class);
    }
    public function category() : BelongsTo{
        return $this->belongsTo(category::class);
    }
}
