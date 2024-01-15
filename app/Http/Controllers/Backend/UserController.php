<?php

namespace App\Http\Controllers\Backend;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view ('backend.users.index', compact('users'));
    }

    public function show($id)
    {
    	$user = User::find($id);
    	return view('backend.users.user', compact('user'));
    }
    public function uploadAvatar(Request $request)
    {
      if ($request->hasFile('avatar')) {
          $filename = $request->avatar->getClientOriginalName();
          if (auth()->user()->avatar) {
              Storage::delete('/public/images/' . auth()->user()->avatar);
          }
          $request->avatar->storeAs('images',$filename,'public');
          auth()->user()->update(['avatar' => $filename]);
          return redirect()->back();
      }
    }
}
