<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = ['cost'=>'integer'];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function pictures()
    {
        return $this->hasMany(Picture::class);
    }

    public function discount()
    {
        return $this->hasOne(Discount::class);
    }

    public function costWithDiscount()
    {
        return $this->getAttribute('cost') - $this->getAttribute('cost') * $this->discount->value/100;
    }
}
