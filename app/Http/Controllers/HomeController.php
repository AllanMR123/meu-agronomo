<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente; // 1. Adicionado para poder usar o Model de Cliente

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // 2. Busca os 5 clientes mais recentes no banco de dados
        $clientes = Cliente::latest()->take(5)->get();

        // 3. Envia a variável $clientes para a view 'dashboard'
        return view('dashboard', compact('clientes'));
    }
}
