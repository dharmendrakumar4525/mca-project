<?php

namespace App\Http\Controllers;

use App\Http\Middleware\UserPermission;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\subCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(UserPermission::class)->except('show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user()->loadMissing(['categories' => function ($query) {
            $query->withCount('subCategories');
        }]);
        $categories = $user->categories;
        return view('category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $categories = auth()->user()->categories;
        return view('category.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $user = auth()->user();
        if (($request->categoryId == 0)) {
            $category =  new Category();
            $category->name =  $request->name;
            $category->created_by = $user->id;
            $category->save();
            $categories = $user->categories->toArray();
            return Response(compact('categories'));
        } else {
            $sub_category =  new  Subcategory();
            $sub_category->category_id = $request->categoryId;
            $sub_category->name =  $request->name;
            $sub_category->save();
            $categories = $user->categories->toArray();
            return Response(compact('categories'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        $categories = $category->subCategories;
        $products = $category->products;
        return Response(compact('categories', 'products'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Category  $category, Request $request)
    {
        $course = Category::where('id', $request->id)->update(['name' => $request->name]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {

        $category->delete();
        $categories = auth()->user()->categories;
        return Response(compact('categories'));
    }
}
