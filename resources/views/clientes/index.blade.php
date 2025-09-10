<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meus Clientes - Meu Agrônomo</title>
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
                <li><a href="{{ route('dashboard') }}" class="{{ Request::routeIs('dashboard') ? 'active' : '' }}">Início</a></li>
                {{-- Abrir o submenu de clientes se estivermos em qualquer rota de cliente --}}
                <li class="menu-drop {{ Request::routeIs('clientes.*') ? 'open' : '' }}">
                    <a href="#" class="menu-toggle {{ Request::routeIs('clientes.*') ? 'active' : '' }}">Clientes</a>
                    <ul class="submenu">
                        <li><a href="{{ route('clientes.create') }}" class="{{ Request::routeIs('clientes.create') ? 'active' : '' }}">Adicionar cliente</a></li>
                        {{-- Ativar 'Lista de clientes' se for index ou edit --}}
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
            <h2>Lista de Clientes</h2> {{-- Título da página no cabeçalho principal --}}
            <div class="search-logout-area">
                {{-- FORMULÁRIO DE PESQUISA AGORA AQUI --}}
                <form action="{{ route('clientes.index') }}" method="GET" class="search-input-form">
                    <div class="search-input">
                        <i class="fas fa-search icon-search"></i>
                        <input type="text" name="search" placeholder="Pesquisar clientes" value="{{ request('search') }}">
                    </div>
                    {{-- Botão oculto para enviar a pesquisa ao pressionar Enter, mas visível se quiser --}}
                    <button type="submit" style="display: none;"></button>
                </form>

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

        {{-- Secção para o botão Adicionar Cliente --}}
        <section class="clientes-actions" style="display: flex; justify-content: flex-end; margin-bottom: 20px;">
            <a href="{{ route('clientes.create') }}" class="btn-adicionar">Adicionar Cliente</a>
        </section>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <section>
            <table class="tabela-clientes">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>CPF</th>
                        <th>Cidade</th>
                        <th>Contato</th>
                        <th>Visitas</th> {{-- Não remova, se a coluna existe --}}
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($clientes as $cliente)
                        <tr>
                            <td>{{ $cliente->nome }}</td>
                            <td>{{ $cliente->cpf }}</td>
                            <td>{{ $cliente->cidade }}</td>
                            <td>{{ $cliente->contato }}</td>
                            <td>{{ $cliente->visitas ?? 'N/A' }}</td> {{-- Adicionado 'N/A' caso visitas seja nulo --}}
                            <td class="acoes">
                                <a href="{{ route('clientes.edit', $cliente->id) }}">Editar</a>
                                <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="apagar-btn">Apagar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align: center;">
                                @if(request('search'))
                                    Nenhum cliente encontrado para "{{ request('search') }}".
                                @else
                                    Nenhum cliente registrado.
                                @endif
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
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

            // Lógica de ativação do menu
            const currentPath = window.location.pathname;
            document.querySelectorAll('.barra-lateral nav ul li a').forEach(link => {
                const linkHref = new URL(link.href).pathname;

                // Ativar o link direto se o caminho for exato
                if (linkHref === currentPath) {
                    link.classList.add('active');
                    const parentSubmenu = link.closest('.submenu');
                    if (parentSubmenu) {
                        parentSubmenu.closest('.menu-drop').classList.add('open');
                    }
                }
                // Lógica específica para ativar "Lista de clientes" quando em clientes.edit
                if (linkHref === "{{ route('clientes.index') }}" && currentPath.startsWith("{{ route('clientes.index') }}/")) {
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
