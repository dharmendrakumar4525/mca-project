<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    use HasFactory;
    protected $fillable = [
        'address_line1',
        'address_line1',
        'status',
        'state',
        'city',
        'zip',
        'user_id',
        'country'


    ];
    

}
