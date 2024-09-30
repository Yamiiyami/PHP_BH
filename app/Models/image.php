<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class image extends Model
{
    use HasFactory;
    protected $fillable = ['image','product_id'];
    public function products() : BelongsTo{
        return $this->belongsTo(product::class);
    }
}
