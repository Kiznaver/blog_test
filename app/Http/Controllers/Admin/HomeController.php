<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $categoryes_count=Category::all()->count();
        $posts_count=Post::all()->count();
        return view('admin.home.index',[
            'posts_count'=>$posts_count,
            'categories_count'=>$categoryes_count
        ]);
    }
}
