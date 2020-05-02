<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    /**
     * Вывод всех комментариев
     */
    public function allComments()
    {
        $comment = new Comment; 
        return view('welcome', ['data' => $comment->orderBy('created_at', 'asc')->get()]);
    }

    /**
     * Добавление комментария
     */
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

    /**
     * Удаление комментария
     */
    public function delete($comment)
    {
        Comment::find($comment)->delete();
        return redirect('/');
    }
    /**
     * Редактирование комментария
     */
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

    /**
     * Поиск комментарий к родительному комментарию.
     */
    public function findParent(Request $request)
    {
        $data = $request->all();
        $comment = new Comment;
        return view('welcome', ['data' => $comment->where('parent_id', '=', $data['parent_id'])->get()]);
    }
}
