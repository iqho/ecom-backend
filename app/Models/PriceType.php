<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PriceType extends Model
{
    use HasFactory, SoftDeletes;

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
