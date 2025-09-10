<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request; // Importa a classe Request para lidar com requisições HTTP

class ClienteController extends Controller
{
    /**
     * Mostra uma lista de todos os clientes, com opção de pesquisa.
     */
    public function index(Request $request) // O método index agora recebe o objeto Request
    {
        $query = Cliente::query(); // Começa com uma query base para o modelo Cliente

        // Verifica se existe um parâmetro 'search' na URL e se ele não está vazio
        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->search; // Pega o termo de pesquisa da requisição

            // Filtra os clientes: onde o 'nome' ou o 'cpf' contenham o termo de pesquisa
            // O 'like' com '%' permite buscar correspondências parciais
            $query->where('nome', 'like', '%' . $searchTerm . '%')
                  ->orWhere('cpf', 'like', '%' . $searchTerm . '%');
        }

        // Obtém os clientes, ordenados pelos mais recentes, aplicando qualquer filtro existente
        $clientes = $query->latest()->get();

        // Retorna a view 'clientes.index' e passa a coleção de clientes para ela
        return view('clientes.index', compact('clientes'));
    }

    /**
     * Mostra o formulário para criar um novo cliente.
     */
    public function create()
    {
        return view('clientes.create');
    }

    /**
     * Guarda um novo cliente na base de dados.
     */
    public function store(Request $request)
    {
        // Validação dos dados de entrada
        $validatedData = $request->validate([
            'nome' => 'required|string|max:255',
            'cpf' => 'required|string|max:14|unique:clientes', // CPF único na tabela 'clientes'
            'cidade' => 'required|string|max:255',
            'contato' => 'required|string|max:20',
        ]);

        // Cria um novo cliente com os dados validados
        Cliente::create($validatedData);

        // Redireciona para a lista de clientes com uma mensagem de sucesso
        return redirect()->route('clientes.index')
                         ->with('success', 'Cliente adicionado com sucesso!');
    }

    /**
     * Mostra os detalhes de um cliente específico.
     * (Este método ainda não está implementado na sua aplicação)
     */
    public function show(string $id)
    {
        // ... Lógica para mostrar detalhes do cliente ...
    }

    /**
     * Mostra o formulário para editar um cliente existente.
     * Usa Route Model Binding: o Laravel automaticamente encontra o Cliente pelo ID.
     */
    public function edit(Cliente $cliente)
    {
        // Retorna a view 'clientes.edit' e passa o objeto cliente para ela
        return view('clientes.edit', compact('cliente'));
    }

    /**
     * Atualiza um cliente na base de dados.
     * Usa Route Model Binding para encontrar o cliente.
     */
    public function update(Request $request, Cliente $cliente)
    {
        // Validação dos dados.
        // O CPF deve ser único, exceto para o próprio cliente que está a ser atualizado.
        $validatedData = $request->validate([
            'nome' => 'required|string|max:255',
            'cpf' => 'required|string|max:14|unique:clientes,cpf,'.$cliente->id,
            'cidade' => 'required|string|max:255',
            'contato' => 'required|string|max:20',
        ]);

        // Atualiza o cliente com os novos dados validados
        $cliente->update($validatedData);

        // Redireciona para a lista de clientes com uma mensagem de sucesso
        return redirect()->route('clientes.index')
                         ->with('success', 'Cliente atualizado com sucesso!');
    }

    /**
     * Remove um cliente da base de dados.
     * Usa Route Model Binding para encontrar o cliente.
     */
    public function destroy(Cliente $cliente)
    {
        // Apaga o cliente da base de dados
        $cliente->delete();

        // Redireciona para a lista de clientes com uma mensagem de sucesso
        return redirect()->route('clientes.index')
                         ->with('success', 'Cliente apagado com sucesso!');
    }
}
