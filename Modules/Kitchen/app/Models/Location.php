<?php

namespace Modules\Kitchen\App\Models;

use Modules\Kitchen\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Kitchen\Database\Factories\LocationFactory;

class Location extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

// Location belongs to a Kitchen
public function kitchen()
{
    return $this->belongsTo(Kitchen::class);
}

// Location has many Sublocations
public function sublocations()
{
    return $this->hasMany(Sublocation::class);
}

// Location has many Products
public function products()
{
    return $this->hasMany(Product::class);
}
}
