<?php

namespace App\Http\Controllers\Miaomiao;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests;

class HomeController extends Controller
{
    public function index()
    {
        return view('miaomiao.home', [
            'title' => 'Miaomiao\'s Tools',
            'active' => 'home',
        ]);
    }
}
