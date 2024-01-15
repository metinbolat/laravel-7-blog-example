<?php

namespace App\Http\Controllers\Backend;

use App\Tag;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TagController extends Controller
{
    public function index ()
    {
        $tags = Tag::get()->all();
        return view('backend.tag.index', compact('tags'));
    }

    public function store (Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
        ]);

        if (strlen($request->slug)>2) {
            $slug=Str::slug($request->slug);
        } else {
            $slug=Str::slug($request->name);
        }

        $allSlugs = Tag::get('slug');
        $error = 'This tag already exists!';
        if ($allSlugs->contains('slug', $slug)) {
            return redirect()->back()->with('error', $error);
        }
        $newTag = Tag::insert([
            'name' => $request->name,
            'slug' => $slug,
        ]);
        if ($newTag) {
            return redirect()->back()->with('success','Tag Created Successfully!');
        }
    }

    public function edit ($id)
    {
        $tag = Tag::find($id);
        return view('backend.tag.edit', compact('tag'));
    }

    public function update (Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required',
        ]);

        if (strlen($request->slug)>2) {
            $slug=Str::slug($request->slug);
        } else {
            $slug=Str::slug($request->name);
        }

        $allSlugs = Tag::get('slug');
        $error = 'This tag already exists!';
        if ($allSlugs->contains('slug', $slug)) {
            return redirect()->back()->with('error', $error);
        }
        $updateTag = Tag::where('id', $id)->update([
            'name' => $request->name,
            'slug' => $slug,
        ]);
        if ($updateTag) {
            return redirect()->back()->with('success','Tag Updated Successfully!');
        }
    }

    public function create ()
    {
        return view('backend.tag.new');
    }

    public function destroy ($id)
    {
        $delete = Tag::where('id', $id)->delete();
        if ($delete) {
            return redirect()->back()->with('success', 'Tag deleted');
        } else {
            return redirect()->back()->with('error', 'A problem occured');
        }
    }
}
