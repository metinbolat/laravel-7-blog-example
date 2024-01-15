<?php

namespace App\Http\Middleware;

use Closure;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
    
      if (!\Auth::guest() && \Auth::user()->role=='admin') {
        return $next($request);
      }

      else {
        return redirect(route('admin_index'))->with('error','Bu sayfaya erişim yetkiniz bulunmuyor');
      }

        if (\Auth::guest()) {
            return redirect(url('login'));
        }
          
    
    }
}
