<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Seller extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email'];

    protected $casts = ['commission' => 'float'];

    public function sells(): HasMany
    {
        return $this->hasMany(Sell::class);
    }
}
