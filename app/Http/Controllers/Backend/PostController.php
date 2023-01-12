<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Auth;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;



class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('id', 'desc')
            ->where('user_id', auth()->user()->id)
            ->simplePaginate(10);
        // dd($posts);
        return view('backend.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('id', 'ASC')->pluck('title', 'id');
        $tags       = Tag::orderBy('title', 'ASC')->get();
        $user       = auth()->user()->id;
        // dd($user);
        return view('backend.posts.create', compact('categories', 'tags', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        
        $post = new Post();
        $post->title = $request->input('title');
        $post->slug = $request->input('slug');
        $post->body = $request->input('body');
        $post->category_id = $request->input('category_id');
        $post->user_id = $request->input('user_id');

        // dd($request->all());   
        if ($request->allFiles('image')) {     
            // $fileName = time().$request->file('image')->getClientOriginalName();
            // $fileName = time().$request->file('image')->hashName();
            $fileName = $request->file('image')->hashName();
            $path = $request->file('image')->storeAs('images', $fileName, 'public');
            $post["image"] = '/storage/'.$path;
            //dd($request->all());
        }

        // TAGS
        $post->tags()->attach($request->get('tags'));

        $post->save();

        return redirect('/admin/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = DB::table('posts')
        ->select(DB::raw('posts.*, categories.title as category_title'))
        ->join('categories', function ($join) use($slug) {
            $join->on('posts.category_id', '=', 'categories.id')
                 ->where('posts.slug', '=', $slug);
        })
        ->get();
        
        return view('backend.posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        // $post = Post::find($id);
        $post = Post::where('slug', $slug)->first();

        $categories = Category::orderBy('title', 'ASC')->pluck('title', 'id');
        $tags       = Tag::orderBy('title', 'ASC')->get();
        //dd($post);
        return view('backend.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, $slug)
    {
        // $post = Post::find($id);
        $post = Post::where('slug', $slug)->first();

        $post->title = $request->input('title');
        $post->slug = $request->input('slug');
        $post->body = $request->input('body');
        $post->image = $request->input('image');
        $post->old_image = $request->input('old_image');
        // dd($request->all());

        $image = $post->old_image = $request->input('old_image');

        if ($request->allFiles('image') && $post->old_image == null) {
            !is_null($image) && Storage::delete($image);
            $fileName = $request->file('image')->hashName();
            $files = $request->file('image')->storeAs('images', $fileName, 'public');
            $post["image"] = '/storage/'.$files;            
            
            $post->save();
        }elseif ($request->allFiles('image')) {
            !is_null($image) && Storage::delete($image);
            /*
            unlink for delete images and substr 
            substr for remove letters. The letters: storage/images/ 
            replace substr in case of use on another Operative system
            */ 
            unlink(storage_path('app/public/images' . substr($image, 15) ));
            // $fileName = time().$request->file('image')->getClientOriginalName();
            // $fileName = time().$request->file('image')->hashName();
            $fileName = $request->file('image')->hashName();
            $files = $request->file('image')->storeAs('images', $fileName, 'public');
            $post["image"] = '/storage/'.$files;            
            
            $post->save();
        }else{
            $post->image = $post->old_image;
            $post->save();
        }

        // TAGS
        $post->tags()->sync($request->get('tags'));

        return redirect('/admin/posts/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        if ($post->image) {
            $image = $post->image;
            unlink(storage_path('app/public/images' . substr($image, 15) ));            
            $post->delete();
        }else{
            $post->delete();
        }
        return redirect('/admin/posts');
    }
}
