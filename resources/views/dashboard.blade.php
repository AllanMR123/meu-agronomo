<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Agronomo - Dashboard</title>

    {{-- 1. Usa o helper 'asset()' para carregar o CSS da pasta 'public' --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="dashboard-body">
    <div class="dashboard">
        <aside class="barra-lateral">
            <div class="logo">
                {{-- Usa o helper 'asset()' para a imagem também --}}
                <img src="{{ asset('images/logo.png') }}" alt="logo-meu-agronomo">
            </div>
            <nav>
                <ul>
                    <li><a href="">Início</a></li>
                    <li class="menu-drop">
                        <a href="">Clientes</a>
                        <ul class="submenu">
                            <li><a href="#">Adicionar cliente</a></li>
                            <li><a href="#">Lista de clientes</a></li>
                            <li><a href="#">Relatórios</a></li>
                        </ul>
                    </li>
                    <li class="menu-drop">
                        <a href="">Fornecedores</a>
                        <ul class="submenu">
                            <li><a href="#">Adicionar fornecedor</a></li>
                            <li><a href="#">Lista de fornecedores</a></li>
                            <li><a href="#">Relatórios</a></li>
                        </ul>
                    </li>
                    <li><a href="">Configurações</a></li>
                </ul>
            </nav>
        </aside>

        <main class="conteudo-principal">
            <header class="topo">
                <div class="search">
                    <input type="text" placeholder="Pesquisar...">
                    <button type="submit">+</button>
                </div>

                {{-- 2. Link de Logout Funcional --}}
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                   class="logout">
                    Sair
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </header>

            {{-- 3. Exibe o nome do usuário que está logado dinamicamente --}}
            <h2>Olá, {{ Auth::user()->name }}!</h2>

            <section class="atalhos">
                <h3> Meus atalhos</h3>
                <div class="quadro-atalhos">
                    <div class="atalho">Adicionar Cliente</div>
                    <div class="atalho">Relatório de Cliente</div>
                    <div class="atalho">Adicionar Fornecedor</div>
                </div>
            </section>
            <section class="clientes">
                <h3>Principais clientes</h3>
                <ul>
                    <li>Rafael Casemiro - 111.111.111-11 - 11 visitas</li>
                    <li>João Marcos - 222.222.222-22 - 12 visitas</li>
                    <li>João Pedro - 333.333.333-33 - 13 visitas</li>
                    <li>Joel Oliveira - 444.444.444-44 - 14 visitas</li>
                    <li>Luis Gustavo - 555.555.555-55 - 15 visitas</li>
                </ul>
            </section>
            <section class="indicadores">
                <h3>Meus marcadores</h3>
                <div class="indicadores-grid">
                    <div class="indicador">
                        Clientes prospectados nos últimos 30 dias <br>
                        <strong>26 clientes</strong>
                    </div>
                    <div class="indicador">
                        Vendas realizadas nos últimos 30 dias <br>
                        <strong>R$ 43.962,18</strong>
                    </div>
                    <div class="indicador">
                        Visitas realizadas nos últimos 30 dias <br>
                        <strong>90 visitas</strong>
                    </div>
                </div>
            </section>
        </main>
    </div>
</body>

</html>
