<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = [
        'name',
    ];

    public function product() :HasMany
    {
        return $this->hasMany(Sale::class);
    }

    public function sales()
{
    return $this->hasMany(Sale::class);
}
}
