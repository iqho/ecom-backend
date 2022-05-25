<?php

namespace App\Models;

use App\Models\PriceType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductPrice extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['product_id', 'price_type_id', 'amount'];

    public function priceType()
    {
        return $this->belongsTo(PriceType::class);
    }
}
