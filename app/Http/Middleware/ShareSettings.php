<?php

namespace App\Http\Middleware;
use App\Setting;
use Illuminate\Support\Facades\View;

use Closure;

class ShareSettings
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
        $data['settings'] = Setting::all();
        foreach ($data['settings'] as $key) {
           $settings[$key->key] = $key->value;
        }
            View::share($settings);



        return $next($request);
    }
}
