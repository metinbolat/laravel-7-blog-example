<?php

namespace App\Http\Controllers\Backend;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index ()
    {
        $categories = Category::get()->all();
        return view('backend.category.index', compact('categories'));
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

        $allSlugs = Category::get('slug');
        $error = 'This category already exists!';
        if ($allSlugs->contains('slug', $slug)) {
            return redirect()->back()->with('error', $error);
        }
    $newCategory = Category::insert([
        'name' => $request->name,
        'slug' => $slug,
    ]);
        if ($newCategory) {
            return redirect()->back()->with('success','Category Created Successfully!');
        }
    }

    public function edit ($id)
    {
        $category = Category::find($id);
        return view('backend.category.edit', compact('category'));
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

        $allSlugs = Category::get('slug');
        $error = 'This category already exists!';
        if ($allSlugs->contains('slug', $slug)) {
            return redirect()->back()->with('error', $error);
        }
        $updateCategory = Category::where('id', $id)->update([
            'name' => $request->name,
            'slug' => $slug,
        ]);
        if ($updateCategory) {
            return redirect()->back()->with('success','Category Updated Successfully!');
        }
    }

    public function create ()
    {
        return view('backend.category.new');
    }

    public function destroy ($id)
    {
        $delete = Category::where('id', $id)->delete();
        if ($delete) {
            return redirect()->back()->with('success', 'Category deleted');
        } else {
            return redirect()->back()->with('error', 'A problem occured');
        }
    }
}
