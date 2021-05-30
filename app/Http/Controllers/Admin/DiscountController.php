<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DiscountRequest;
use App\Models\Discount;
use App\Models\Product;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Product $product
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create(Product $product)
    {
        //dd($product->getAttribute('id'));
        return view('admin.discounts.create',compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Product $product
     * @param DiscountRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|void
     */
    public function store(Product $product, DiscountRequest $request)
    {
        if (!$product->discount()->exists()){
            $product->discount()->create([
               'value' => $request->get('discount')
            ]);
        }
        return redirect(route('products.index'))->with([
           'success' => 'تخفیف جدید اعمال شد'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function show(Discount $discount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Product $product
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('admin.discounts.edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Product $product
     * @param DiscountRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(Product $product,DiscountRequest $request)
    {
        if ($product->discount()->exists()){
            $product->discount()->update([
                'value' => $request->get('discount')
            ]);
        }
        return redirect(route('products.index'))->with([
            'success' => 'تخفیف جدید اعمال شد'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function destroy(Product $product)
    {
        if ($product->discount()->exists()){
            $product->discount()->delete();
        }
        return redirect(route('products.index'))->with([
           'success' => 'تخفیف با موفقیت حذف شد.'
        ]);
    }
}
