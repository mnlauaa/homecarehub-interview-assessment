<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use App\Http\Requests\PostCreateRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rows = Post::orderByDesc("created_at")->get();
        $posts = $rows->map(function ($row) {
            $row->image = Storage::url($row->image);
            return $row;
        });
        return Inertia::render('PostList', ["posts" => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('PostCreate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostCreateRequest $request)
    {
        $image_path = null;
        $post = $request->validated();

        // make sure no repeated image file name
        do {
            $image_path = $this->generateFilePath($request->image);
        } while (Storage::disk('public')->exists($image_path));

        // Store image
        Storage::disk('public')->put($image_path, $request->image->get());
        $post['image'] = $image_path;

        $created_post = Post::create($post);

        return redirect()->route('post.show', ['post' => $created_post->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::with('comments')->findOrFail($id);
        $post->image = Storage::url($post->image);
        return Inertia::render('PostDetail', ["post" => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $post->image = Storage::url($post->image);
        return Inertia::render('PostEdit', ["post" => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostUpdateRequest $request, $id)
    {
        $origin_post = Post::findOrFail($id);
        $post = $request->validated();

        if ($request->hasFile('image')) {
            $image_path = null;
            // make sure no repeated image file name
            do {
                $image_path = $this->generateFilePath($request->image);
            } while (Storage::disk('public')->exists($image_path));
            // Store image
            Storage::disk('public')->put($image_path, $request->image->get());
            $post['image'] = $image_path;
        } else {
            unset($post['image']);
        }

        $origin_post->update($post);

        return redirect()->route('post.show', ['post' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return redirect()->route('post.index');
    }

    private static function generateFilePath($image)
    {
        return 'post_image/' . Str::uuid() . '-' . $image->getClientOriginalName();
    }
}
