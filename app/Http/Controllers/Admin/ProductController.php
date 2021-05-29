<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProductUpadeRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::query()->where('category_id',null)->get();
        $brands = Brand::all();
        return view('admin.products.create',[
                'categories' => $categories,
                'brands' => $brands
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(ProductRequest $request)
    {
        //dd($request->file('image'));
        $format = explode('.',$request->file('image')->getClientOriginalName());
        //dd($format[1]);
        $name = Carbon::now()->timestamp . Carbon::now()->timestamp . '.' . $format[1];
        $path = $request->file('image')->storeAs('public/products',$name);
        Product::query()->create([
           'title' => $request->get('title'),
           'slug' => Str::slug($request->get('slug')),
           'description' => $request->get('description'),
           'category_id' => $request->get('category_id'),
           'brand_id' => $request->get('brand_id'),
           'cost' => $request->get('cost'),
           'image' => $path,
        ]);
        return redirect(route('products.index'))->with(['success'=>'.محصول جدید اضافه شد']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('admin.products.edit',[
            'product' => $product,
            'categories' => Category::all(),
            'brands' => Brand::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProductUpadeRequest $request, Product $product)
    {
        $path = $product->getAttribute('image');
        $slug = Product::query()->where('slug',Str::slug($request->get('slug')))
            ->where('id','!=',$product->getAttribute('id'))
            ->exists();
        if ($slug){
            return redirect()->back()->withErrors([
                'slug' => 'اسلاگ منحصر به فرد نیست'
            ]);
        }
        if ($request->hasFile('image')){
            $format = explode('.',$request->file('image')->getClientOriginalName());
            $name = Carbon::now()->timestamp . Carbon::now()->timestamp . '.' . $format[1];
            $path = $request->file('image')->storeAs('public/products',$name);
        }

        Product::query()->update([
            'title' => $request->get('title',$product->getAttribute('title')),
            'slug' => Str::slug($request->get('slug',$product->getAttribute('slug'))),
            'description' => $request->get('description',$product->getAttribute('description')),
            'category_id' => $request->get('category_id',$product->getAttribute('category_id')),
            'brand_id' => $request->get('brand_id',$product->getAttribute('brand_id')),
            'cost' => $request->get('cost',$product->getAttribute('cost')),
            'image' => $path,
        ]);
        return redirect(route('products.index'))->with([
           'success' => 'محصول مورد نظر با موفقیت آپدیت شد.'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->back()->with([
           'success' => 'محصول مورد نظر با موفقیت حذف شد.'
        ]);

    }
}
