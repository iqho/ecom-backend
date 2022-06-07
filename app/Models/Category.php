<?php

namespace App\Models;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    public function products()
    {
        return $this->hasMany(Product::class)->with('category', 'productPrices');
    }

    public function scopeActive($query)
    {
        $query->where('is_active', true);
    }

    public function scopeIdDescending($query)
    {
        return $query->orderBy('id', 'DESC');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
