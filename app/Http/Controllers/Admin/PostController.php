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
            {
               if($add_tags->tag!=$request->tag)
               {
                   $data='<a href="' . route('getpost', [$add_tags['cat_id'],$add_tags['id']]) . '">' . $add_tags->tag . '</a>';
                   $replaced = Str::replace($add_tags->tag, $data, $replaced);
                }

            }
            $post=new Post();
            $post->title=$request->title;
            $post->img=$request->img;
            $post->text=$replaced;
            $post->cat_id=$request->cat_id;
            $post->chbox=$request->chbox;
            $post->tag=$request->tag;
            $post->save();
            foreach(Post::all() as $add_new_tags)
            {
                if($add_new_tags->tag!=$request->tag)
                {
                    foreach(Post::all() as $tags_all)
                    {   $new_text=$tags_all->text;
                        $data='<a href="' . route('getpost', [$request['cat_id'],Post::select('id')->orderBy('id','DESC')->first()]) . '">' . $request->tag . '</a>';
                        $new_text = Str::replace($request->tag, $data, $new_text);
                        $tags_all->text=$new_text;
                        $tags_all->save();
                    }
                }
            }


            // ->select('id')->orderBy('id', 'DESC')->first();

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
        return view('main.home', ['post' => $post]);
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
                ++$check;
            }
            elseif($check>1)
            {

                return redirect()->back()->withSuccess('Такий тег вже існує!');
            }
        }
        if($check<=1)
        {
            $replaced=$request->text;
            foreach(Post::all() as $add_tags)
            {
               if($add_tags->tag!=$request->tag)
               {
                   $data='<a href="' . route('getpost', [$add_tags['cat_id'],$add_tags['id']]) . '">' . $add_tags->tag . '</a>';
                   $replaced = Str::replace($add_tags->tag, $data, $replaced);
                }

            }
            $post->title=$request->title;
            $post->img=$request->img;
            $post->text=$replaced;
            $post->cat_id=$request->cat_id;
            $post->chbox=$request->chbox;
            if($request->tag!=$post->tag)
            {
                foreach(Post::all() as $tags_all)
                {
                    if($post->id!=$tags_all->id)
                    {   $old_text=$tags_all->text;
                        $data='<a href="' . route('getpost', [$request['cat_id'],$post['id']]) . '">' . $post->tag . '</a>';
                        $old_text = Str::replace($data, $post->tag, $old_text);

                        $data_new='<a href="' . route('getpost', [$request['cat_id'],$post['id']]) . '">' . $request->tag . '</a>';
                        $new_text = Str::replace($data_new, $request->tag, $old_text);
                        $tags_all->text=$new_text;
                        $tags_all->save();
                    }
                }
            }
            $post->tag=$request->tag;
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
        foreach(Post::all() as $tags_all)
        {
            if($post->id!=$tags_all->id)
            {   $new_text=$tags_all->text;
                $data='<a href="' . route('getpost', [$post['cat_id'],$post['id']]) . '">' . $post->tag . '</a>';
                $new_text = Str::replace($data, $post->tag, $new_text);
                $tags_all->text=$new_text;
                $tags_all->save();
            }
        }
        $post->delete();
        return redirect()->back()->withSuccess('Стаття була успішно видалена!');
    }

}
