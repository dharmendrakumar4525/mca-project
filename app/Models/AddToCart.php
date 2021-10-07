<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddToCart extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'customer_id',
        'quantity',
    ];

    /**
     * Relationship to get product
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    
    /**
     * Relationship to get customer
     */
    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }
}