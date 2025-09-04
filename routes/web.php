<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController; // Importa o HomeController

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Gera as rotas de autenticação necessárias (login, logout, registro, etc.)
// E APONTA PARA SUAS VIEWS PERSONALIZADAS DE LOGIN E REGISTRO
Auth::routes([
    'login'    => true,
    'register' => true,
    'reset'    => true,
    'verify'   => false,
]);

// Sobrescreve a rota GET /login para usar sua view 'index.blade.php'
Route::get('/login', function () {
    return view('index'); // Aponta para resources/views/index.blade.php
})->name('login');

// Sobrescreve a rota GET /register para usar sua view 'cadastro.blade.php'
Route::get('/register', function () {
    return view('cadastro'); // Aponta para resources/views/cadastro.blade.php
})->name('register');


// Rota 1: Página inicial (/) redireciona para a tela de login.
Route::get('/', function () {
    return redirect()->route('login');
});

// Rota 2: Acessar '/dashboard' carrega a sua tela principal.
// - Apenas usuários logados podem acessar (middleware('auth')).
// - É controlada pelo método 'index' do HomeController.
Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

// Rota 3: "Pega" o redirecionamento padrão do Laravel para '/home'
// e o envia para o lugar certo, o '/dashboard'.
Route::get('/home', function () {
    return redirect()->route('dashboard');
})->middleware('auth');
