<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use PHPUnit\TextUI\XmlConfiguration\CodeCoverage\Report\Php;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts=Post::orderBy('created_at','DESC')->get();
        $posts_count=Post::all()->count();
        return view('admin.post.index',[
            'posts'=>$posts,
            'posts_count'=>$posts_count,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::orderBy('created_at','DESC')->get();
        return view('admin.post.create',[
            'categories'=>$categories
        ]);
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
        foreach(Post::all() as $check_tag)
        {
            if($check_tag->tag==$request->tag)
            {
                $check=1;
                return redirect()->back()->withSuccess('Такий тег вже існує!');
            }
        }
        if($check==0)
        {
            $replaced=$request->text;
            foreach(Post::all() as $add_tags)
            {  // $data='<a href="#">$add_tags->tag</a>';
                $data='<a href="route('getpost',[$add_tags[cat_id],$add_tags[id]])">$add_tags->tag</a>';
                $replaced = Str::replace($add_tags->tag, $data, $replaced);

            }
            $post=new Post();
            $post->title=$request->title;
            $post->img=$request->img;
            $post->text=$replaced;
            $post->cat_id=$request->cat_id;
            $post->chbox=$request->chbox;
            $post->tag=$request->tag;
            $post->save();

            return redirect()->back()->withSuccess('Стаття була успішно додана');
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories=Category::orderBy('created_at','DESC')->get();

        return view('admin.post.edit',[
            'categories'=>$categories,
            'post'=>$post,

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $check=0;
        foreach(Post::pluck('tag') as $check_tag)
        {
            if($check_tag==$request->tag)
            {
                $check=1;
                return redirect()->back()->withSuccess('Такий тег вже існує!');
            }
        }
        if($check==0)
        {
            $post->tag=$request->tag;
            $post->title=$request->title;
            $post->img=$request->img;
            $post->text=$request->text;
            $post->cat_id=$request->cat_id;
            $post->chbox=$request->chbox;
            $post->save();
            return redirect()->back()->withSuccess('Стаття була успішно оновленна');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->back()->withSuccess('Стаття була успішно видалена!');
    }

    // public function update_tags()
    // {
    //     foreach($posts as $add_tags)
    //     $replaced=$add_tags->text;
    //                        if ($add_tags['tag_id']!==$add_tags->tag['id'])
    //                             $data='<a href="{{route('getpost',[$add_tags[cat_id],$add_tags[id]])}}">{{$add_tags->tag}}</a>';
    //                             $replaced = Str::replace($add_tags->tag->title, $data, $replaced);


    // }
}
