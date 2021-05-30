<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PictureRequest;
use App\Models\Picture;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PictureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Product $product
     * @return \Illuminate\Http\Response
     */
    public function index(Product $product)
    {
        return view('admin.products.pictures',[
            'product' => $product,
            'pictures' => $product->pictures,
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Product $product
     * @param \Illuminate\Http\Request $request
     * @return void
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(PictureRequest $request,Product $product)
    {

        $name = Carbon::now()->timestamp . Carbon::now()->timestamp . '.' . $request->file('picture')->extension();
        $path = $request->file('picture')->storeAs('public/products',$name);
        Picture::query()->create([
           'path' => $path,
           'product_id' => $product->getAttribute('id'),
           'mime' => $request->file('picture')->getClientMimeType()
        ]);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Picture  $picture
     * @return \Illuminate\Http\Response
     */
    public function show(Picture $picture)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Picture  $picture
     * @return \Illuminate\Http\Response
     */
    public function edit(Picture $picture)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Picture  $picture
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Picture $picture)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Picture $picture
     * @param Product $product
     * @return void
     * @throws \Exception
     */
    public function destroy(Picture $picture,Product $product)
    {
        //dd($picture->toArray(),$product->toArray());
        Storage::delete($picture->getAttribute('path'));
        $picture->delete();
        return redirect()->back();
    }
}
