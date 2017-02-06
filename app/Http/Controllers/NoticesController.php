<?php

namespace App\Http\Controllers;

use App\Models\Notice;
use Illuminate\Http\Request;

class NoticesController extends Controller
{
    public function index()
    {
        $notices = Notice::orderBy('order', 'asc')->orderBy('created_at', 'desc')->paginate(6);
        return view('notices.index', compact('notices'));
    }
}
