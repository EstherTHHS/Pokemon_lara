<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'price',
        'type',
        'rarity',
        'left',
        'image_url',
        'status'
    ];


    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];


    public function scopeFilterProduct($query, $search, $type, $rarity)
    {
        return $query
            ->when($type ?? false, function ($query, $type) {
                $query->where('type', 'like', "%$type%");
            })
            ->when($rarity ?? false, function ($query, $rarity) {
                $query->where('rarity', 'like', "%$rarity%");
            })
            ->when($search ?? false, function ($query, $search) {
                $query->where('name', 'like', "%$search%")
                    ->orWhere('description', 'like', "%$search%")
                    ->orWhere('price', 'like', "%$search%")
                    ->orWhere('left', 'like', "%$search%");
            });
    }
}
