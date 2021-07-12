<?php
namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   $categories=Category::orderBy('title')->get();
        $posts=Post::paginate(3);
        return view('main.home',[
            'posts'=>$posts,
            'categories'=>$categories,

        ]);


    }
    public function postcategory($id)
    {
        $categories=Category::all();
        $curent_categories=Category::where('id',$id)->first();
        return view('main.home',[
            'posts'=>$curent_categories->posts()->paginate(3),
            'categories'=>$categories,

        ]);


    }
    public function getpost($category_id, $post_id)
    {
      $categories=Category::all();
      $post=Post::where('id', $post_id)->first();

      return view('main.showpost',[

        'post'=>$post,
        'categories'=>$categories,
        'category_id'=>$category_id,

      ]);

    }
}
