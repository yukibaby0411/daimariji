<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function show($id)
    {
        $user = User::find($id);
        return view('users.show', compact('user'));
    }
}
