<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class cart extends Model
{
    protected $fillable = [
        'customer_id',
        'status',
    ];
    use HasFactory;

    public function customer() : BelongsTo
    {
        return $this->belongsTo(customer::class);
    }
}
