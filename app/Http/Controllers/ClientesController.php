<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormRequestClientes;
use App\Models\Cliente;
use App\Models\Componentes;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class ClientesController extends Controller
{
    protected $cliente;
    
    public function __construct(Cliente $cliente)
    {
        $this->cliente = $cliente;
    }

    public function index(Request $request)
    {

        $pesquisar = $request->pesquisar;
        $findCliente = $this->cliente->getClientesPesquisarIndex(search: $pesquisar ?? '');

        return view('pages.clientes.paginacao', compact('findCliente'));
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $buscaRegistro = Cliente::find($id);
        $buscaRegistro->delete();
        return response()->json(['success' => true]);
    }

    public function cadastrarCliente(FormRequestClientes $request)
    {
        if ($request->method() == 'POST') {
            // criar resgistro
            $data = $request->all();

            Cliente::create($data);

            Toastr::success('Dados gravados com sucesso.');

            return redirect()->route('clientes.index');
        }

        return view('pages.clientes.create');
    }
    public function atualizarCliente(Request $request, $id)
    {

        if ($request->method() == 'PUT') {
            // atualizar resgistro
            $data = $request->all();
            $componentes = new Componentes();
            $data['valor'] = $componentes->formatacaoMascaraDinheiroDecimal($data['valor']);

            $buscaRegistro = Cliente::find($id);
            $buscaRegistro->update($data);

            Toastr::success('Dados gravados com sucesso.');

            return redirect()->route('clientes.index');
        }
        $findCliente = Cliente::where('id', '=', $id)->first();

        return view('pages.clientes.atualiza', compact('findCliente'));
    }
}
