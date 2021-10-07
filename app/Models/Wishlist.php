<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;
    /**
     * Relationship to get product
     */
    public function wishlist()
    {
        return $this->belongsTo(Product::class);
    }
}
