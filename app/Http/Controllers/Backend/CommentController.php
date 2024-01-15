<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Comment;
use Illuminate\Database\Eloquent;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paginate = Comment::where('status','pub')->orderBy('created_at', 'desc');
        $countPub = Comment::where('status','pub')->count();
        $countPend = Comment::where('status','pend')->count();
        $countTr = Comment::where('status','del')->count();
        $comments = $paginate->paginate(10);
        return view('backend.comments.index', compact('comments','countPub','countPend','countTr'));
    }

    public function pend()
    {
        $paginate = Comment::where('status','pend')->orderBy('created_at', 'desc');
        $countPub = Comment::where('status','pub')->count();
        $countPend = Comment::where('status','pend')->count();
        $countTr = Comment::where('status','del')->count();
        $comments = $paginate->paginate(10);
        return view('backend.comments.index', compact('comments','countPub','countPend','countTr'));
    }

    public function trashed()
    {
        $paginate = Comment::where('status','del')->orderBy('created_at', 'desc');
        $countPub = Comment::where('status','pub')->count();
        $countPend = Comment::where('status','pend')->count();
        $countTr = Comment::where('status','del')->count();
        $comments = $paginate->paginate(10);
        return view('backend.comments.trashed', compact('comments','countPub','countPend','countTr'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $current_date_time = \Carbon\Carbon::now()->addHours(3)->toDateTimeString();
        $postId = $request->post_id;
        $userId = auth()->id();


        if (\Auth::user()) {
            $userName = auth()->user()->name;
            $makeComment = Comment::insert([
            'comment' => $request->comment,
            'created_at' => $current_date_time,
            'post_id' => $postId,
            'user_id' => $userId,
            'user_name' => $userName,
        ]);
        } else {
            $userName = $request->name;
            $makeComment = Comment::insert([
            'comment' => $request->comment,
            'created_at' => $current_date_time,
            'post_id' => $postId,
            'user_id' => $userId,
            'user_name' => $userName,
            'user_email' => $request->email,
        ]);
        }
        if ($makeComment) {
        return redirect()->back()->with('success','Post Created Successfully!');
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comment = Comment::find($id);
        return view('backend.comments.edit', compact('comment')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
            $comment = Comment::find($id);
            $comment->comment = $request->comment;
            $comment->save();

      if ($comment) {
        return redirect()->back()->with('success','Comment Updated Successfully!');
    }
     else {
  echo 'Process failed!';}
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $comment = Comment::find($id);
        $comment->status = 'del';
        $comment->save();
        return redirect()->back()->with('success', 'Comment moved to trash');
    }

    public function recover($id)
    { 
        $comment = Comment::find($id);
        $comment->status = 'pend';
        $comment->save();
        return redirect()->back()->with('success', 'Comment recovered');
    }
    
     public function destroy($id)
    {
        $comment = Comment::find($id);
        $comment->delete();
        return redirect()->back()->with('success', 'Comment deleted');
    }

    public function publish($id)
    {
        $comment = Comment::find($id);
        $comment->status = 'pub';
        $comment->save();
        return redirect()->back()->with('success', 'Comment published');
    }
}
