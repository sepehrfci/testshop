<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest as BrandRequestAlias;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\BrandRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;



class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $brands = Brand::all();
        return view('admin.brands.index',compact("brands"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view("admin.brands.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param BrandRequest $request
     * @return Response
     */
    public function store(BrandRequestAlias $request)
    {
        dd($request->file('image'));
        $path = $request->file('image')->storeAs('public/image',$request->file('image')->getClientOriginalName());
        Brand::create([
            'name' => $request->get('name'),
            'image' => $path
        ]);
        return redirect(route('brands.index'));
    }


    /**
     * Display the specified resource.
     *
     * @param Brand $brand
     * @return void
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Brand $brand
     * @return Response
     */
    public function edit(Brand $brand)
    {
        return view('admin.brands.edit',compact("brand"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Brand $brand
     * @return Response
     */
    public function update(Request $request, Brand $brand)
    {
        $brands = Brand::all();
        $bool = false;
        foreach ($brands as $brand1){
            if($brand1->name === $request->get('name') && $brand1->id!==$brand->id)
                $bool = true;
        }
        if ($bool==true){
            $validator = Validator::make($request->all(),[
                'name' => ['required','unique:brands,title'],
                'image' => ['mimes:png,jpg,jpeg','max:1024']
            ]);
        }else{
            $validator = Validator::make($request->all(),[
                'name' => 'required',
                'image' => ['mimes:png,jpg,jpeg','max:1024']
            ]);
        }

        if($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }
        if (!is_null($request->file('image'))){
            $path = $request->file('image')->storeAs('public/image',$request->file('image')->getClientOriginalName());
            $brand->update([
                'name' => $request->get('name'),
                'image' => $path
            ]);
        }else{
            $brand->update([
                'name' => $request->get('name'),
            ]);
        }
        return redirect(route('brands.index'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Brand $brand
     * @return void
     * @throws \Exception
     */
    public function destroy(Brand $brand)
    {
        $brand->delete();
        return redirect(route('brands.index'));

    }
}
