<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::orderBy('id', 'desc')->paginate();

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::orderBy('name', 'asc')
                        ->get();

        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'slug' => 'required | unique:posts',
            'category_id' => 'required | exists:categories,id'
        ]);

        $data['user_id'] = auth()->id();

        $post = Post::create($data);

        session()->flash('swal',[
            'title' => 'Success',
            'text' => 'The post was created successfully',
            'icon' => 'success'
        ]);

        return redirect()->route('admin.posts.edit', $post);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $categories = Category::orderBy('name', 'asc')
                        ->get();

        return view('admin.posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
            'title' => 'required',
            'slug' => 'required | unique:posts,slug,' . $post->id,
            'category_id' => 'required | exists:categories,id',
            'excerpt' => 'nullable',
            'content' => 'nullable',
            'image' => 'nullable | image',
            'is_published' => 'required | boolean'
        ]);

        if($request->hasFile('image')){
            Storage::disk('public')->put('posts', $request->image);
        };

        $post->update($data);

        session()->flash('swal',[
            'title' => 'Success',
            'text' => 'The post was updated successfully',
            'icon' => 'success'
        ]);

        return redirect()->route('admin.posts.edit', $post);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
