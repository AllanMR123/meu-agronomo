<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Agronomo - Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="dashboard-body">
    <aside class="barra-lateral">
        <div class="logo-dashboard">
            <img src="{{ asset('images/logo.png') }}" alt="logo-meu-agronomo">
            <h1>Meu Agrônomo</h1>
        </div>
        <nav>
            <ul>
                <li><a href="{{ route('dashboard') }}" class="active">Início</a></li>
                <li class="menu-drop">
                    <a href="{{ route('clientes.index') }}">Clientes</a>
                    <ul class="submenu">
                        <li><a href="{{ route('clientes.create') }}">Adicionar cliente</a></li>
                        <li><a href="{{ route('clientes.index') }}">Lista de clientes</a></li>
                        <li><a href="#">Relatórios</a></li>
                    </ul>
                </li>
                 <li class="menu-drop">
                    <a href="#">Fornecedores</a>
                    <ul class="submenu">
                        <li><a href="#">Adicionar fornecedor</a></li>
                        <li><a href="#">Lista de fornecedores</a></li>
                        <li><a href="#">Relatórios</a></li>
                    </ul>
                </li>
                <li><a href="#">Configurações</a></li>
            </ul>
        </nav>
    </aside>

    <main class="conteudo-principal">
        <header class="topo">
            {{-- ALTERAÇÃO 1 APLICADA AQUI --}}
            <h2>Olá, {{ Auth::user()->name }}!</h2>
            <div class="search-logout-area">
                <div class="search-input">
                    <i class="fas fa-search icon-search"></i>
                    <input type="text" placeholder="Pesquisar...">
                </div>
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                   class="logout">
                    Sair
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </header>

        <section class="atalhos">
            <h3>Meus atalhos</h3>
            <div class="quadro-atalhos">
                <a href="{{ route('clientes.create') }}" class="atalho">Adicionar Cliente</a>
                <div class="atalho">Relatório de cliente</div>
                <div class="atalho">Adicionar Fornecedor</div>
            </div>
        </section>

        <section class="principais-clientes-lista">
            <h3>Principais clientes</h3>
            {{-- ALTERAÇÃO 2 APLICADA AQUI --}}
            <ul>
                @forelse ($clientes as $cliente)
                    <li>
                        <span>{{ $cliente->nome }}</span>
                        <span>{{ $cliente->cpf }}</span>
                        <span>{{ $cliente->visitas }} visitas</span>
                    </li>
                @empty
                    <li>Nenhum cliente cadastrado ainda.</li>
                @endforelse
            </ul>
        </section>

        <section class="indicadores">
            <h3>Meus marcadores</h3>
            <div class="indicadores-grid">
                <div class="indicador">
                    <p>Clientes prospectados nos últimos 30 dias</p>
                    <strong>26 clientes</strong>
                </div>
                <div class="indicador">
                    <p>Vendas realizadas nos últimos 30 dias</p>
                    <strong>R$ 43.962,18</strong>
                </div>
                <div class="indicador">
                    <p>Visitas realizadas nos últimos 30 dias</p>
                    <strong>90 visitas</strong>
                </div>
            </div>
        </section>
    </main>

    <script>
        // O seu script do menu pode continuar aqui
    </script>
</body>
</html>
