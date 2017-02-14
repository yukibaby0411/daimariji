<?php

namespace App\Http\Controllers;

use App\Models\Notice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoticesController extends Controller
{
    public function index()
    {
        if(Auth::check() === FALSE) {
            return redirect('/login');
        }
        $notices = Notice::orderBy('order', 'asc')->orderBy('created_at', 'desc')->paginate(6);
        return view('notices.index', compact('notices'));
    }

}
