<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'category_id',
        'subcategory_id',
        'supplier_id',
        'price',
        'image',
        'description',
        'unit_in_stock',
    ];
    use HasFactory;

    public function orders()
    {
        return $this->hasMany(Order::class, 'product_id');
    }
   
}
