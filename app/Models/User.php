<?php

namespace App\Models;

use App\Http\Controllers\WishlistController;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'address',
        'phone',
        'image'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function categories()
    {
        return $this->hasMany(Category::class, "created_by");
    }

    public function products()
    {
        return $this->hasMany(Product::class, "supplier_id");
    }

    public function carts()
    {
        return $this->hasMany(AddToCart::class, 'customer_id');
    }

    /**
     * Relationship to get customer wishlist
     */
    public function wishlists()
    {
        return $this->belongsToMany(Product::class, 'wishlists', 'customer_id', 'product_id');
    }

    /**
     * Relationship to get Orders
     */

    // public function orders()
    // {
    //     return $this->hasMany(Orders::class,'customer_id');
    // }
    public function orders()
    {
        return $this->hasMany(Order::class, 'customer_id');
    }
    public function addresses()
    {
        return $this->hasMany(UserAddress::class);
    }
}
