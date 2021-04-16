<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;
use phpDocumentor\Reflection\Types\Boolean;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $categories = Category::all();
        return view("admin.category.index",compact("categories"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $categories = Category::all();
        return view("admin.category.create",compact("categories"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(),[
           'title' => ['required','unique:categories,title'],
           'category_id' => ['nullable','exists:categories,id']
        ]);

        if($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

        Category::create([
            'title'=> $request->get('title'),
            'category_id'=>$request->get('category_id')
        ]);
        return redirect(route('category.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param Category $category
     * @return void
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Category $category
     * @return Response
     */
    public function edit(Category $category)
    {
        $category = Category::all()->find($category->id);
        $categories = Category::all();
        return view("admin.category.edit",[
            "categories" => $categories,
            "category" => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Category $category
     * @return Response
     */
    public function update(Request $request, Category $category)
    {
        $categories = Category::all();
        $bool = false;
        foreach ($categories as $category1){
            if($category1->title === $request->get('title') && $category1->id!==$category->id)
                    $bool = true;
        }
        if ($bool==true){
            $validator = Validator::make($request->all(),[
                'title' => ['required','unique:categories,title'],
                'category_id' => ['nullable','exists:categories,id']
            ]);
        }else{
            $validator = Validator::make($request->all(),[
                'title' => 'required',
                'category_id' => ['nullable','exists:categories,id']
            ]);
        }


        if($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

        $category->update([
           'title' => $request->get('title'),
           'category_id' => $request->get('category_id')
        ]);
        return redirect(route("category.index"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return Response
     * @throws Exception
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect(route("category.index"));
    }
}
