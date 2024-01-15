<?php

namespace App\Http\Controllers\Backend;

use App\Category;
use App\Tag;
use Illuminate\Http\Request;
use App\Http\Requests\PostCreateRequest;
use App\Http\Controllers\Controller;
use App\Post;
use App\User;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function dashboard()
    {
        $countAll = Post::all()->where('type', 'post')->count();
        $countAllPages = Post::all()->where('type', 'page')->count();
        $postsByAuthor = auth()->user()->posts()->where('type', 'post')->count();
        $pagesByAuthor = auth()->user()->posts()->where('type', 'page')->count();
        return view('backend.index', compact('countAll', 'pagesByAuthor', 'postsByAuthor', 'countAllPages'));
    }

    //BEGIN LISTING POSTS
    public function index()
    {
        $date = \Carbon\Carbon::now()->toDateTimeString();
        $post = Post::where('type', 'post')->where('status', '<', '2')->orderBy('created_at', 'desc');
        $posts = $post->paginate(10);
        $postsByAuthor = auth()->user()->posts()->where('type', 'post')->where('status', '<', '2')->orderBy('created_at', 'desc')->get();
        $countAll = Post::where('type', 'post',)->where('status', '<', '2')->orderBy('created_at', 'desc')->count();
        $countPub = Post::where('status', '1')->where('type', 'post')->get()->count();
        $countDr = Post::where('status', '0')->where('type', 'post')->get()->count();
        $countAu = count($postsByAuthor);
        $countTr = Post::where(['type' => 'post', 'status' => '2'])->get()->count();

        return view('backend.posts.index', compact('posts', 'postsByAuthor', 'countAll', 'countPub', 'countDr', 'countAu', 'countTr'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function my()
    {
        $section = 'Post';
        $post = auth()->user()->posts()->where('type', 'post')->where('status', '<', '2')->orderBy('created_at', 'desc');
        $posts = $post->paginate(10);
        $countAll = Post::where('type', 'post',)->where('status', '<', '2')->get()->count();
        $countPub = Post::where('status', '1')->where('type', 'post')->get()->count();
        $countDr = Post::where('status', '0')->where('type', 'post')->get()->count();
        $countAu = auth()->user()->posts()->where('type', 'post')->where('status', '<', '2')->orderBy('created_at', 'desc')->count();
        $countTr = Post::where(['type' => 'post', 'status' => '2'])->get()->count();
        return view('backend.posts.index', compact('posts', 'countAll', 'countPub', 'countDr', 'countAu', 'countTr'));
    }
    public function draft()
    {
        $section = 'Post';
        $date = \Carbon\Carbon::now()->toDateTimeString();
        $post = Post::where(['type' => 'post', 'status' => '0'])->where('created_at', '<=', $date)->orderBy('created_at', 'desc');
        $posts = $post->paginate(10);
        $postsByAuthor = auth()->user()->posts()->where('type', 'post')->where('status', '<', '2')->orderBy('created_at', 'desc')->get();
        $countAll = Post::where('type', 'post',)->where('status', '<', '2')->get()->count();
        $countPub = Post::where('status', '1')->where('type', 'post')->get()->count();
        $countDr = Post::where(['type' => 'post', 'status' => '0'])->where('created_at', '<=', $date)->orderBy('created_at', 'desc')->get()->count();
        $countAu = count($postsByAuthor);
        $countTr = Post::where(['type' => 'post', 'status' => '2'])->get()->count();
        return view('backend.posts.index', compact('countAll', 'countPub', 'countDr', 'countAu', 'posts', 'countTr'));
    }
    public function pub()
    {
        $section = 'Post';
        $date = \Carbon\Carbon::now()->toDateTimeString();
        $post = Post::where(['type' => 'post', 'status' => '1'])->where('created_at', '<=', $date)->orderBy('created_at', 'desc');
        $posts = $post->paginate(10);
        $postsByAuthor = auth()->user()->posts()->where('type', 'post')->where('status', '<', '2')->orderBy('created_at', 'desc')->get();
        $countAll = Post::where('type', 'post',)->where('status', '<', '2')->get()->count();
        $countPub = Post::where(['status' => '1', 'type' => 'post'])->where('created_at', '<=', $date)->get()->count();
        $countDr = Post::where('status', '0')->where('type', 'post')->get()->count();
        $countAu = count($postsByAuthor);
        $countTr = Post::where(['type' => 'post', 'status' => '2'])->get()->count();
        return view('backend.posts.index', compact('countAll', 'countPub', 'countDr', 'countAu', 'posts', 'countTr'));
    }

    public function trashed()
    {
        $date = \Carbon\Carbon::now()->toDateTimeString();
        $post = Post::where(['type' => 'post', 'status' => '2'])->orderBy('updated_at', 'desc');
        $posts = $post->paginate(10);
        $countAu = auth()->user()->posts()->where('type', 'post')->where('status', '<', '2')->orderBy('created_at', 'desc')->get()->count();
        $countAll = Post::all()->where('type', 'post')->where('status', '<', '2')->count();
        $countPub = Post::where('status', '1')->where('type', 'post')->get()->count();
        $countDr = Post::where('status', '0')->where('type', 'post')->get()->count();
        $countTr = Post::where(['type' => 'post', 'status' => '2'])->orderBy('updated_at', 'desc')->count();
        return view('backend.posts.trashed', compact('countAll', 'countPub', 'countDr', 'countAu', 'posts', 'countTr'));
    }

    //END LISTING POSTS

    //BEGIN NEW POST
    public function create()
    {
        $now = \Carbon\Carbon::now();
        $tags = Tag::all();
        $categories = Category::all();
        return view('backend.posts.new', compact('tags', 'categories', 'now'));
    }
    public function ckupload(Request $request)
    {

        if ($request->hasFile('upload')) {
            $filename = $request->upload->getClientOriginalName();

            //Upload File
            $request->upload->move(public_path('images/posts'), $filename);

            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = '/images/posts/' . $filename;
            $msg = 'Image successfully uploaded';
            $re = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

            // Render HTML output
            @header('Content-type: text/html; charset=utf-8');
            echo $re;
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function store(PostCreateRequest $request, $slug, $id = 0)
    {

        $currentdatetime = \Carbon\Carbon::now()->toDateTimeString();
        if ($request->hasFile('post_file')) {
            $filename = $request->post_file->getClientOriginalName() . '.' . $request->post_file->getClientOriginalExtension();
            $request->post_file->move(public_path('images/posts'), $filename);
        } else {
            $filename = null;
        }

        if (strlen($request->slug) > 3) {
            $slug = Str::slug($request->slug);
        } else {
            $slug = Str::slug($request->title);
        }

        $allSlugs = Post::get('slug');
        if ($allSlugs->contains('slug', $slug)) {
            $newSlug = $slug . '-2';
            $slug = $newSlug;
            if ($allSlugs->contains('slug', $newSlug)) {
                $slug = $newSlug . '-2';
            }
        }

        //dd($request->date);
        $userId = auth()->id();
        $post = new Post();
        $post->title = $request->title;
        $post->slug = $slug;
        $post->content = $request->content;
        $post->user_id =  $userId;
        $post->created_at = $request->date . $request->time;
        $post->file = $filename;
        $post->type = 'post';
        $post->status = $request->status;
        $post->meta = $request->meta;
        $post->save();
        $post->tags()->sync($request->tags);
        $post->categories()->sync($request->categories);
        if ($post) {
            return redirect()->back()->with('success', 'Post Created Successfully!');
        }
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //END NEW POST


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

    //BEGIN EDIT POST
    public function edit($id, Post $post)
    {
        $tags = Tag::all();
        $categories = Category::all();
        $postId = Post::find($id);
        $user = \Auth::user();
        $post = Post::with('tags', 'categories')->find($id);
        if ($user->can('edit', $post)) {
            return view('backend.posts.edit', compact('postId', 'tags', 'categories'));
        } else {
            return redirect()->back()->with('error', 'You Are Not Authorized!');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(PostCreateRequest $request, $id, User $user, Post $post)
    {
        $user = \Auth::user();
        $post = Post::find($id);
        if ($user->can('update', $post)) {
            $current_date_time = \Carbon\Carbon::now()->toDateTimeString();

            if (strlen($request->slug) > 3) {
                $slug = Str::slug($request->slug);
            } else {
                $slug = Str::slug($request->title);
            }

            if ($request->hasFile('post_file')) {
                $filename = uniqid() . '.' . $request->post_file->getClientOriginalExtension();
                $request->post_file->move(public_path('images/posts'), $filename);
            } else {
                $filename = $post->file;
            }

            $userId = auth()->id();
            $post = Post::find($id);
            $post->title = $request->title;
            $post->slug = $slug;
            $post->content = $request->content;
            $post->user_id =  $userId;
            $post->created_at = $request->date . $request->time;
            $post->updated_at = $current_date_time;
            $post->file = $filename;
            $post->status = $request->status;
            $post->meta = $request->meta;
            $post->tags()->sync($request->tags);
            $post->categories()->sync($request->categories);
            $post->save();


            if ($post) {
                return redirect()->back()->with('success', 'Post Updated Successfully!');
            }
        } else {
            echo 'Not Authorized.';
        }
    }
    //END EDIT POST

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function delete(Post $post)
    {
        $post->status = '2';
        $post->save();
        return redirect()->back()->with('success', 'Post moved to trash');
    }

    public function recover(Post $post)
    {
        $post->status = '0';
        $post->save();
        return redirect()->back()->with('success', 'Post recovered from trash');
    }

    public function destroy(Post $post)
    {

        if ($post->file) {

            //Storage::disk('public')->delete('images/posts/'.$post->file);
            unlink('images/posts/' . $post->file);
        }
        $post->delete();
        return redirect()->back()->with('success', 'Post deleted');
    }

    //BEGIN PAGES

    public function page_index()
    {
        $post = Post::where('type', 'page')->where('status', '<', '2')->orderBy('created_at', 'desc');
        $posts = $post->paginate(10);
        $postsByAuthor = auth()->user()->posts()->where('type', 'page')->where('status', '<', '2')->orderBy('created_at', 'desc')->get();
        $countAll = Post::where('type', 'page',)->where('status', '<', '2')->orderBy('created_at', 'desc')->count();
        $countPub = Post::where('status', '1')->where('type', 'page')->get()->count();
        $countDr = Post::where('status', '0')->where('type', 'page')->get()->count();
        $countAu = count($postsByAuthor);
        $countTr = Post::where(['type' => 'page', 'status' => '2'])->get()->count();

        return view('backend.pages.index', compact('posts', 'postsByAuthor', 'countAll', 'countPub', 'countDr', 'countAu', 'countTr'));
    }

    public function page_my()
    {
        $post = auth()->user()->posts()->where('type', 'page')->where('status', '<', '2')->orderBy('created_at', 'desc');
        $posts = $post->paginate(10);
        $countAll = Post::where('type', 'page',)->where('status', '<', '2')->get()->count();
        $countPub = Post::where('status', '1')->where('type', 'page')->get()->count();
        $countDr = Post::where('status', '0')->where('type', 'page')->get()->count();
        $countAu = auth()->user()->posts()->where('type', 'page')->where('status', '<', '2')->orderBy('created_at', 'desc')->count();
        $countTr = Post::where(['type' => 'page', 'status' => '2'])->get()->count();
        return view('backend.pages.index', compact('posts', 'countAll', 'countPub', 'countDr', 'countAu', 'countTr'));
    }
    public function page_draft()
    {
        $date = \Carbon\Carbon::now()->toDateTimeString();
        $post = Post::where(['type' => 'page', 'status' => '0'])->where('created_at', '<=', $date)->orderBy('created_at', 'desc');
        $posts = $post->paginate(10);
        $postsByAuthor = auth()->user()->posts()->where('type', 'page')->where('status', '<', '2')->orderBy('created_at', 'desc')->get();
        $countAll = Post::where('type', 'page',)->where('status', '<', '2')->get()->count();
        $countPub = Post::where('status', '1')->where('type', 'page')->get()->count();
        $countDr = Post::where(['type' => 'page', 'status' => '0'])->where('created_at', '<=', $date)->orderBy('created_at', 'desc')->get()->count();
        $countAu = count($postsByAuthor);
        $countTr = Post::where(['type' => 'page', 'status' => '2'])->get()->count();
        return view('backend.pages.index', compact('countAll', 'countPub', 'countDr', 'countAu', 'posts', 'countTr'));
    }
    public function page_pub()
    {
        $date = \Carbon\Carbon::now()->toDateTimeString();
        $post = Post::where(['type' => 'page', 'status' => '1'])->where('created_at', '<=', $date)->orderBy('created_at', 'desc');
        $posts = $post->paginate(10);
        $postsByAuthor = auth()->user()->posts()->where('type', 'page')->where('status', '<', '2')->orderBy('created_at', 'desc')->get();
        $countAll = Post::where('type', 'page',)->where('status', '<', '2')->get()->count();
        $countPub = Post::where(['status' => '1', 'type' => 'page'])->where('created_at', '<=', $date)->get()->count();
        $countDr = Post::where('status', '0')->where('type', 'page')->get()->count();
        $countAu = count($postsByAuthor);
        $countTr = Post::where(['type' => 'page', 'status' => '2'])->get()->count();
        return view('backend.pages.index', compact('countAll', 'countPub', 'countDr', 'countAu', 'posts', 'countTr'));
    }

    public function page_trashed()
    {
        $post = Post::where(['type' => 'page', 'status' => '2'])->orderBy('updated_at', 'desc');
        $posts = $post->paginate(10);
        $countAu = auth()->user()->posts()->where('type', 'page')->where('status', '<', '2')->orderBy('created_at', 'desc')->get()->count();
        $countAll = Post::all()->where('type', 'page')->count();
        $countPub = Post::where('status', '1')->where('type', 'page')->get()->count();
        $countDr = Post::where('status', '0')->where('type', 'page')->get()->count();
        $countTr = Post::where(['type' => 'page', 'status' => '2'])->orderBy('updated_at', 'desc')->count();
        return view('backend.pages.trashed', compact('countAll', 'countPub', 'countDr', 'countAu', 'posts', 'countTr'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function page_create()
    {
        $now = \Carbon\Carbon::now();
        return view('backend.pages.new', compact('now'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */



    public function page_store(PostCreateRequest $request, $slug, $id = 0)
    {
        $current_date_time = \Carbon\Carbon::now()->toDateTimeString();

        if ($request->hasFile('page_file')) {
            $filename = uniqid() . '.' . $request->page_file->getClientOriginalExtension();
            $request->post_file->move(public_path('images/posts'), $filename);
        } else {
            $filename = null;
        }

        if (strlen($request->slug) > 3) {
            $slug = Str::slug($request->slug);
        } else {
            $slug = Str::slug($request->title);
        }


        $allSlugs = Post::get('slug');
        if ($allSlugs->contains('slug', $slug)) {
            $newSlug = $slug . '-2';
            $slug = $newSlug;
            if ($allSlugs->contains('slug', $newSlug)) {
                $slug = $newSlug . '-2';
            }
        }

        $userId = auth()->id();
        $post = new Post();
        $post->title = $request->title;
        $post->slug = $slug;
        $post->content = $request->content;
        $post->user_id =  $userId;
        $post->created_at = $request->date . $request->time;
        $post->file = $filename;
        $post->type = 'page';
        $post->status = $request->status;
        $post->meta = $request->meta;
        $post->save();

        if ($post) {
            return redirect()->back()->with('success', 'Page Created Successfully!');
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
    public function page_edit($id, Post $post)
    {
        $postId = Post::find($id);
        $user = \Auth::user();
        $post = Post::find($id);
        if ($user->can('edit', $post)) {
            return view('backend.pages.edit', compact('postId'));
        } else {
            return redirect()->back()->with('error', 'You Are Not Authorized!');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function page_update(PostCreateRequest $request, $id, User $user, Post $post)

    {
        $user = \Auth::user();
        $post = Post::find($id);
        if ($user->can('update', $post)) {
            $current_date_time = \Carbon\Carbon::now()->toDateTimeString();

            if (strlen($request->slug) > 3) {
                $slug = Str::slug($request->slug);
            } else {
                $slug = Str::slug($request->title);
            }

            if ($request->hasFile('page_file')) {
                $filename = uniqid() . '.' . $request->page_file->getClientOriginalExtension();
                $request->page_file->move(public_path('images/posts'), $filename);
            } else {
                $filename = $post->file;
            }

            $userId = auth()->id();
            $post = Post::where('id', $id)->update([
                'title' => $request->title,
                'slug' => $slug,
                'content' => $request->content,
                'user_id' => $userId,
                'updated_at' => $current_date_time,
                'file' => $filename,
                'status' => $request->status,
                'meta' => $request->meta,
            ]);

            if ($post) {
                return redirect()->back()->with('success', 'Page Updated Successfully!');
            }
        } else {
            echo 'Not Authorized.';
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function page_destroy(Post $post)
    {
        $post->delete();
        return redirect()->back()->with('success', 'Page deleted');
    }

    //END PAGES

}
