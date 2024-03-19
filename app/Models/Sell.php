<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sell extends Model
{
    use HasFactory;

    protected $fillable = ['amount', 'seller_id', 'commission'];

    public function seller()
    {
        return $this->belongsTo(Seller::class, 'seller_id');
    }
}
