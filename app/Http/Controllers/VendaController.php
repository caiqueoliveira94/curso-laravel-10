<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormRequestVenda;
use App\Mail\ComprovanteDeVendaEmail;
use App\Models\Cliente;
use App\Models\Produto;
use App\Models\Venda;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class VendaController extends Controller
{
    protected $venda;

    public function __construct(Venda $venda)
    {
        $this->venda = $venda;
    }

    public function index(Request $request)
    {
        $pesquisar = $request->pesquisar;
        $findVendas = $this->venda->getVendasPesquisarIndex(search: $pesquisar ?? '');

        return view('pages.vendas.paginacao', compact('findVendas'));
    }

    public function cadastrarVenda(FormRequestVenda $request)
    {
        $findNumero = Venda::max('numero_da_venda') + 1;
        $findProduto = Produto::all();
        $findCliente = Cliente::all();

        if ($request->method() == 'POST') {
            // criar resgistro
            $data = $request->all();
            $data['numero_da_venda'] = $findNumero;

            Venda::create($data);

            Toastr::success('Dados gravados com sucesso.');

            return redirect()->route('vendas.index');
        }

        return view('pages.vendas.create', compact('findNumero', 'findProduto', 'findCliente'));
    }

    public function enviaComprovanteEmail($id)
    {
        $buscaVenda = Venda::where('id', '=', $id)->first();
        $produtoNome = $buscaVenda->produto->nome;
        $clienteEmail = $buscaVenda->cliente->email;
        $clienteNome = $buscaVenda->cliente->nome;

        $sendMailData = [
            'produtoNome' => $produtoNome,
            'clienteNome' => $clienteNome
        ];

        Mail::to($clienteEmail)->send(new ComprovanteDeVendaEmail($sendMailData));

        Toastr::success('Email enviado com sucesso.');

        return redirect()->route('vendas.index');
    }
}
