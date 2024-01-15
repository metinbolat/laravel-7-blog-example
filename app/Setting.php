<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Setting;
use App\Http\Requests\SettingCreateRequest;

class Setting extends Model
{
    public function getRouteKeyName ()
    {
    	return 'key';
    }

}
