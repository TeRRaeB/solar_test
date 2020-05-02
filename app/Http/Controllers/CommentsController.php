<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function allComments()
    {
        $comment = new Comment;
        // $comments = Comment::select(['id', 'parent_id', 'author', 'body', 'created_at'])->get();
        return view('welcome', ['data' => $comment->orderBy('created_at', 'asc')->get()]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'author' => 'required|max:30|min:3',
            'body'   => 'required|min:3'
        ]);
        $data = $request->all();
        $comment = new Comment;
        $comment->fill($data);
        $comment->save();
        return redirect('/');
    }

    public function delete($comment)
    {
        Comment::find($comment)->delete();
        return redirect('/');
    }
    public function edit(Request $request)
    {
        $data = $request->all();
       Comment::find($data['id'])->update(
            [
                'author' => $data['author'],
                'body'   => $data['body']
            ]
        );
        return redirect('/');
    }
    public function findParent(Request $request)
    {
        $data = $request->all();
        $comment = new Comment;
        return view('welcome', ['data' => $comment->where('parent_id', '=', $data['parent_id'])->get()]);
    }
}
