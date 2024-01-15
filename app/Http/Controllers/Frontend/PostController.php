<?php

namespace App\Http\Controllers\Frontend;

use App\Category;
use Illuminate\Http\Request;
use App\Post;
use App\Comment;
use Illuminate\Database\Eloquent;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $date = \Carbon\Carbon::now()->toDateTimeString();
        $posts = Post::where(['status' => '1', 'type' => 'post'])->where('created_at', '<=', $date)->orderBy('created_at', 'desc');
        $data = $posts->paginate(6);

        return view('frontend.posts.index', compact('data'));
    }

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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post, $slug, Comment $comment)
    {
        $date = \Carbon\Carbon::now()->toDateTimeString();
        $allSlugs = Post::get('slug');
        $post = Post::where('slug', $slug)->first();
        if ($allSlugs->contains('slug', $slug)) {
            $previous = Post::where('id', '<', $post->id)->where('status', '1')->where('created_at', '<', $date)->orderBy('id', 'desc')->first();
            $next = Post::where('id', '>', $post->id)->where('status', '1')->where('created_at', '<', $date)->orderBy('id')->first();
            $tags = $post->tags;
            $categories = $post->categories;
            $relatedposts = Post::whereHas('tags', function ($q) use ($post) {
                return $q->whereIn('name', $post->tags->pluck('name'));
            })
                ->where('id', '!=', $post->id)
                ->get();
        }
        if ($post && $post->status == 1 && $post->created_at <= $date) {
            $paginate = $post->comments()->where('status', 'pub')->orderBy('created_at', 'desc');
            $comments = $paginate->paginate(5);

            return view('frontend.posts.post', compact('post', 'comments', 'previous', 'next', 'tags', 'categories', 'relatedposts'));
        } else {
            abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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
