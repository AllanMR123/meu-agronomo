<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cliente - Meu Agrônomo</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="dashboard-body">
    <aside class="barra-lateral">
        <div class="logo-dashboard"> {{-- Usando a classe correta para o logo do dashboard --}}
            <img src="{{ asset('images/logo.png') }}" alt="logo-meu-agronomo">
            <h1>Meu Agrônomo</h1>
        </div>
        <nav>
            <ul>
                <li><a href="{{ route('dashboard') }}" class="{{ Request::routeIs('dashboard') ? 'active' : '' }}">Início</a></li>
                {{-- Abrir o submenu de clientes se estivermos em qualquer rota de cliente --}}
                <li class="menu-drop {{ Request::routeIs('clientes.*') ? 'open' : '' }}">
                    <a href="#" class="menu-toggle {{ Request::routeIs('clientes.*') ? 'active' : '' }}">Clientes</a>
                    <ul class="submenu">
                        <li><a href="{{ route('clientes.create') }}" class="{{ Request::routeIs('clientes.create') ? 'active' : '' }}">Adicionar cliente</a></li>
                        <li><a href="{{ route('clientes.index') }}" class="{{ Request::routeIs('clientes.index') || Request::routeIs('clientes.edit') ? 'active' : '' }}">Lista de clientes</a></li>
                        <li><a href="#">Relatórios</a></li>
                    </ul>
                </li>
                <li class="menu-drop">
                    <a href="#" class="menu-toggle">Fornecedores</a>
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
            <h2>Editar Cliente</h2> {{-- Título da página no cabeçalho principal --}}
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

        {{-- O seu formulário de edição --}}
        <section class="form-cliente">
            <h1>Editar Cliente: {{ $cliente->nome }}</h1> {{-- Título secundário dentro da seção --}}

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('clientes.update', $cliente->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="nome">Nome Completo</label>
                    <input type="text" name="nome" id="nome" value="{{ old('nome', $cliente->nome) }}" required>
                </div>

                <div class="form-group">
                    <label for="cpf">CPF</label>
                    <input type="text" name="cpf" id="cpf" value="{{ old('cpf', $cliente->cpf) }}" placeholder="000.000.000-00" maxlength="14" required>
                </div>

                <div class="form-group">
                    <label for="cidade">Cidade</label>
                    <input type="text" name="cidade" id="cidade" value="{{ old('cidade', $cliente->cidade) }}" required>
                </div>

                <div class="form-group">
                    <label for="contato">Contato (Telefone)</label>
                    <input type="text" name="contato" id="contato" value="{{ old('contato', $cliente->contato) }}" placeholder="(00) 00000-0000" maxlength="15" required>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-salvar">Atualizar Cliente</button>
                    <a href="{{ route('clientes.index') }}" class="btn-cancelar">Cancelar</a>
                </div>
            </form>
        </section>
    </main>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.menu-drop .menu-toggle').forEach(item => {
                item.addEventListener('click', function(e) {
                    e.preventDefault();
                    const parentLi = this.closest('.menu-drop');
                    parentLi.classList.toggle('open');
                });
            });

            const currentPath = window.location.pathname;
            document.querySelectorAll('.barra-lateral nav ul li a').forEach(link => {
                const linkHref = new URL(link.href).pathname;
                if (linkHref === currentPath) {
                    link.classList.add('active');
                    const parentSubmenu = link.closest('.submenu');
                    if (parentSubmenu) {
                        parentSubmenu.closest('.menu-drop').classList.add('open');
                    }
                }
            });
        });
    </script>
</body>
</html>
