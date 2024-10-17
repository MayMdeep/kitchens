<?php

namespace Modules\Kitchen\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
// use Modules\Kitchen\Database\Factories\KitchenFactory;

class Kitchen extends Model
{
    use HasFactory, SoftDeletes;
    protected $connection="mysql";
    protected $table = "kitchens";

    protected $fillable = [];
    public function locations()
    {
        return $this->hasMany(Location::class);
    }
}
