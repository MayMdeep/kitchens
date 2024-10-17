<?php

namespace Modules\Kitchen\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Kitchen\App\Models\Location;
use Modules\Kitchen\App\Models\Sublocation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Kitchen\Database\Factories\ProductFactory;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    // Product belongs to a Location
    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    // Product belongs to a Sublocation (nullable)
    public function sublocation()
    {
        return $this->belongsTo(Sublocation::class, 'sub_location_id');
    }
}
