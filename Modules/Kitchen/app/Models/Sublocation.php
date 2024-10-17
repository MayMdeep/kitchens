<?php

namespace Modules\Kitchen\App\Models;

use Modules\Kitchen\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Kitchen\Database\Factories\SublocationFactory;

class Sublocation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    // Sublocation belongs to a Location
    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    // Sublocation has many Products
    public function products()
    {
        return $this->hasMany(Product::class, 'sub_location_id');
    }

}
