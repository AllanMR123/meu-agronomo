<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Garante que ele carregue o arquivo 'dashboard.blade.php'
        return view('dashboard');
    }
}
