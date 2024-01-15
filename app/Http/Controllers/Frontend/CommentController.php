<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Comment;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent;
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
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

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
            'user_email' => auth()->user()->email,
            'status' => 'pub',
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
            'status' => 'pend',
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
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
