<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Setting;
use App\Http\Controllers\Controller;
use App\Http\Requests\SettingCreateRequest;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settings = Setting::get()->sortBy('must');
        return view('backend.settings.index',compact('settings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($key)
    {
        $setting = Setting::where('key', $key)->first();
        return view('backend.settings.edit', compact(['setting']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SettingCreateRequest $request, Setting $setting, $key)
    {
        
        if ($request->hasFile('value')) {
          $filename = uniqid().'.'.$request->value->getClientOriginalExtension();
          $request->value->move(public_path('/images/settings'),$filename);
          $request->value = $filename;
        }
        $setting=Setting::where('key',$key)->update(['value' => $request->value]);
        if ($setting) {
            $path = 'images/settings/'.$request->oldfile;
            if (file_exists($path)) {
              @unlink(public_path($path));
          }
        }
        return redirect()->back()->with('success','Settings updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
