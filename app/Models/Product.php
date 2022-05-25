<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['title', 'category_id', 'user_id', 'description', 'image', 'is_active'];

    public function category()
    {
        return $this->belongsTo(Category::class);
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

    public function productPrices()
    {
        return $this->hasMany(ProductPrice::class)->Orderby('id', 'ASC')->with('priceType');
    }
}
