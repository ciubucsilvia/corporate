<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;
use App\Models\Comment;
use Response;

class CommentController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommentRequest $request)
    {
        $data = $request->except('_token', 'comment_post_ID', 'comment_parent');
        $data['article_id'] = $request->input('comment_post_ID');
        $data['parent_id'] = $request->input('comment_parent');

        $user = auth()->user();

        $comment = new Comment($data);

        if($user) {
            $comment->user_id = $user->id;
        }

        // $post = Article::find($data['article_id']);
        $post = $this->article_repository->getById($data['article_id']);
        $post->comments()->save($comment); 

        return redirect()->route('$post', $post->slug);
    }
}
