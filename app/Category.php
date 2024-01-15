<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name','slug'];

    public function posts()
    {
        return $this->belongsToMany('App\Post', 'category_posts')->orderBy('created_at', 'desc')->paginate(5);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
