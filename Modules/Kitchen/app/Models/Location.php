<?php

namespace Modules\Kitchen\Models;

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

    // protected static function newFactory(): LocationFactory
    // {
    //     // return LocationFactory::new();
    // }
}
