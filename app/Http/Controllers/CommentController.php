<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Jobs\SendCommentJob;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function create(){
        $comments = Comment::all()->sortByDesc('created_at');
        return view('home',compact('comments'));
    }
    public function store(Request $request){
        $comment = new Comment();
        $comment->name = $request['author'];
        $comment->commentary = $request['commentary'];
        $comment->save();
        $this->dispatch(new SendCommentJob($comment));
        return $this->create();
    }
}
