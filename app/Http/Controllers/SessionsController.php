<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionsController extends Controller
{
    public function create($from, $key, $value) {
        session()->flash($key, $value);
        $from_arr = explode('-', $from);
        return redirect('/'.$from_arr[0].'/'.$from_arr[1].'/'.$from_arr[2]);
    }
}
