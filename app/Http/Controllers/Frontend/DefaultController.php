<?php

namespace App\Http\Controllers\Frontend;

use App\Category;
use App\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DefaultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function contact()
    {
        return view('frontend.default.contact');
    }

    public function tag(Tag $tag)
    {
        $data = $tag->posts();
        return view('frontend.posts.index',compact('data'));
    }

    public function category(Category $category)
    {
        $data = $category->posts();
        return view('frontend.posts.index',compact('data'));
    }


}
