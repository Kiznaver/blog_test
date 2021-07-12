<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('created_at','desc')->get();
        return view('admin.category.index',[
            'categories'=>$categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $check=0;
        foreach(Category::pluck('title') as $check_title)
        {
            if($check_title==$request->title)
            {
                $check=1;
                return redirect()->back()->withSuccess('Така категорія вже існує!');
            }
        }
        if($check==0)
        {
            $new_category= new Category();
            $new_category->title=$request->title;
            $new_category->save();
            return redirect()->back()->withSuccess('Категорія була успішно створена!');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.category.edit',[
            'category'=>$category
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {

        $check=0;

        foreach (Category::pluck('title') as $check_title) {
            if($check_title==$request->title)
            {
                $check=1;
                return redirect()->back()->withSuccess('Така категорія вже існує!');
            }
        }
        if($check==1){
            $category->title=$request->title;
            $category->save();
            return redirect()->back()->withSuccess('Категорія була успішно оновлена!');

        }

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
        return redirect()->back()->withSuccess('Категорія була успішно видалена!');
    }
}
