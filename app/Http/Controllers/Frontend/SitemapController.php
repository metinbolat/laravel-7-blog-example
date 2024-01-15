<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Post;
use App\Category;
use App\Tag;
use Illuminate\Http\Request;

class SitemapController extends Controller
{
    public function index()
    {
        $posts = Post::where('status', 1)->first();
        $categories = Category::all();
        $tags = Tag::all()->first();

        return response()->view('frontend.sitemap.index', [
            'posts' => $posts,
            'categories' => $categories,
            'tags' => $tags,
        ])->header('Content-Type', 'text/xml');
    }

    public function posts()
    {
        $posts = Post::where('status', 1)->latest()->get();
        return response()->view('frontend.sitemap.posts', [
            'posts' => $posts,
        ])->header('Content-Type', 'text/xml');
    }

    public function tags()
    {
        $tags = Tag::all();
        return response()->view('frontend.sitemap.tags', [
            'tags' => $tags,
        ])->header('Content-Type', 'text/xml');
    }

    public function categories()
    {
        $categories = Category::all();
        return response()->view('frontend.sitemap.tags', [
            'categories' => $categories,
        ])->header('Content-Type', 'text/xml');
    }
}
