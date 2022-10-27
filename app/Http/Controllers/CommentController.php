<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentCreateRequest;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(CommentCreateRequest $request)
    {
        $validated_request = $request->validated();
        $created_comment = Comment::create($validated_request);

        return redirect()->route('post.show', ['post' => $created_comment->post_id]);
    }
}
