<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function posts()
    {
        return $this->belongsToMany('App\Post', 'post_tags')->orderBy('created_at', 'desc')->paginate(5);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
