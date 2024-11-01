<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotifyController extends Controller
{
    public function notify(Request $request,$user_id)
    {
        dd($request->reason,$user_id);

    }
}
