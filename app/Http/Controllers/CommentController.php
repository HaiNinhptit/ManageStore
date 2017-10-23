<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Product;

class CommentController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('sendData');
    }
    public function create(Request $request, $id)
    {
        //user_id  product_id content
        $user_id = $request->session()->get('user_id');
        $comment = new Comment();
        $this->validate(request(), [
            'content' => 'required',
        ]);
        $comment->user_id = $user_id;
        $comment->product_id = $id;
        $comment->content = $request->input('content');
        $comment->save();
        return redirect('products/'.$id);
    }

    public function destroy($id, $id_product)
    {
        $comment = Comment::find($id);
        $comment->delete();
        return redirect('products/'.$id_product);
    }

    public function updateComment(Request $request, $id, $id_product)
    {
        $comment = Comment::find($id);
        $this->validate(request(), [
            'content1' => 'required',
        ]);
        $comment->content = $request->input('content1');
        $comment->save();
        return redirect('products/'.$id_product);
    }

    public function getLogin($id)
    {
        return view('users.login',compact('id'));
    }
}
