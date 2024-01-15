<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Database\Eloquent\Model;
use App\Post;
use App\User;

class CheckOwner
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, Post $post, User $user)
    {       
        
        if (!$user->role=='admin' && $post->user_id =! $user->id) {
            return redirect()->back();
        } else {
        return $next($request);
        }
    }
}
