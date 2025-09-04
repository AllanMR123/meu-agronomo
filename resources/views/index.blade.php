<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Agronomo - Login</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="container-login">
        <div class="logo">
            {{-- Também usamos o helper asset() para a imagem --}}
            <img src="{{ asset('images/logo.png') }}" alt="logo-meu-agronomo">
            <h1>Meu Agronomo</h1>
        </div>

        {{-- 2. O 'action' aponta para a rota de login do Laravel e o método é POST --}}
        <form method="POST" action="{{ route('login') }}">
            {{-- 3. '@csrf' é uma diretiva de segurança OBRIGATÓRIA para todos os formulários --}}
            @csrf

            <label for="email">Email</label>
            <input type="email" id="email" name="email" required placeholder="Digite seu email" value="{{ old('email') }}" autofocus>
            {{-- Opcional: Exibe erros de validação para o campo de email --}}
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <label for="password">Senha</label>
            {{-- 4. O 'name' do input de senha foi alterado para 'password' --}}
            <input type="password" name="password" id="senha" required placeholder="Digite sua senha">
            {{-- Opcional: Exibe erros de validação para o campo de senha --}}
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <button type="submit">Entrar</button>
        </form>

        {{-- 5. Links para recuperação de senha e cadastro usam o helper 'route()' --}}
        <a href="{{ route('password.request') }}">Esqueceu sua senha?</a>
        <br>

        <a href="{{ route('register') }}" class="btn-p-acesso">Primeiro acesso? Cadastre-se</a>
    </div>
</body>

</html>
