<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view("client.layout.index",[
//            'categories' => Category::query()->where('category_id',null)->get(),
//            'brands' => Brand::all(),
            'products' => Product::all(),
        ]);
    }
}
