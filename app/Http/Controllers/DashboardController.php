<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Produto;
use App\Models\User;
use App\Models\Venda;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProdutoCadastrado = $this->buscaTotalProdutoCadastrado();
        $totalVendaRealizada = $this->buscaTotalVendaRealizada();
        $totalClienteCadastrado = $this->buscaTotalClienteCadastrado();
        $totalUsuarioCadastrado = $this->buscaTotalUsuarioCadastrado();

        return view('pages.dashboard.dashboard', compact('totalProdutoCadastrado', 'totalVendaRealizada', 'totalClienteCadastrado', 'totalUsuarioCadastrado'));
    }

    public function buscaTotalProdutoCadastrado()
    {
        return Produto::all()->count();
    }

    public function buscaTotalVendaRealizada()
    {
        return Venda::all()->count();
    }

    public function buscaTotalClienteCadastrado()
    {
        return Cliente::all()->count();
    }
    public function buscaTotalUsuarioCadastrado()
    {
        return User::all()->count();
    }
}
