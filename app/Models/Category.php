<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];
    /**
     * @var mixed
     */

    public function parent()
    {
        return $this->belongsTo(Category::class,'category_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class,'category_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class,'category_id');
    }

    public function getProducts()
    {
        $categoryId =[
            $this->getAttribute('id')
        ];
        $children1 = $this->children->pluck('id');
        for ($i=0;$i<sizeof($children1);$i++){
            array_push($categoryId, $children1[$i]);
        }
        $children2 = $this->children;
        foreach ($children2 as $child){
            $ids = $child->children->pluck('id');
            for($i=0;$i<sizeof($ids);$i++) {
                array_push($categoryId, $ids[$i]);
            }
        }

        return Product::query()->whereIn('category_id',$categoryId)->get()->take(10);
    }

    public function productCount() : int
    {
        $count = 0;
        $count += $this->products()->count();
        $children1 = $this->children;
        foreach ($children1 as $child){
            $count += $child->products()->count();
            $children2 = $child->children;
            foreach ($children2 as $child2){
                $count += $child2->products()->count();
            }
        }
        return $count;
    }
}
