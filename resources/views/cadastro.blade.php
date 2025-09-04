<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Agronomo - Cadastro</title>

    {{-- 1. APENAS a diretiva @vite é necessária para carregar CSS e JS --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="container-cadastro">
        <div class="logo">
            {{-- 2. A imagem agora usa Vite::asset() para encontrar o caminho correto --}}
            <img src="{{ Vite::asset('public/images/logo.png') }}" alt="logo-meu-agronomo">
            <h1>Meu Agronomo</h1>
        </div>

        <h2>Cadastre-se</h2>
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <label for="name">Nome completo</label>
            <input type="text" name="name" id="name" required placeholder="Digite seu nome completo" value="{{ old('name') }}" autofocus>
            @error('name')
                <span style="color: red; font-size: 0.8em;">{{ $message }}</span>
            @enderror

            <label for="email">Email</label>
            <input type="email" name="email" id="email" required placeholder="Digite seu email" value="{{ old('email') }}">
            @error('email')
                <span style="color: red; font-size: 0.8em;">{{ $message }}</span>
            @enderror

            <label for="data_nascimento">Data de nascimento</label>
            <input type="date" name="data_nascimento" id="data_nascimento" required value="{{ old('data_nascimento') }}">
            @error('data_nascimento')
                <span style="color: red; font-size: 0.8em;">{{ $message }}</span>
            @enderror

            <label for="celular">Celular</label>
            <input type="tel" id="celular" name="celular" placeholder="Digite seu celular" required value="{{ old('celular') }}">
            @error('celular')
                <span style="color: red; font-size: 0.8em;">{{ $message }}</span>
            @enderror

            <label for="password">Senha</label>
            <input type="password" id="password" name="password" placeholder="Digite sua senha" required>
            @error('password')
                <span style="color: red; font-size: 0.8em;">{{ $message }}</span>
            @enderror

            <label for="password-confirm">Repita a senha</label>
            <input type="password" id="password-confirm" name="password_confirmation" placeholder="Digite sua senha novamente" required>

            <button type="submit">Cadastrar</button>
        </form>
    </div>
</body>

</html>
