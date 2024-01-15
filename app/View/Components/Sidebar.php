<?php

namespace App\View\Components;

use App\Category;
use App\Post;
use App\Tag;
use Illuminate\View\Component;

class Sidebar extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        $date = \Carbon\Carbon::now()->addHours(3)->toDateTimeString();
        $categories = Category::get();
        $tags = Tag::get();
        $recentPosts = Post::all()->where('type', 'post')->where('status','1')->where('created_at', '<=', $date )->sortByDesc('created_at')->take(3);
        return view('components.sidebar', compact('categories', 'tags','recentPosts'));
    }
}
