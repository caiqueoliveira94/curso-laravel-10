<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsuarioFormRequest;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index(Request $request)
    {

        $pesquisar = $request->pesquisar;
        $findUsuario = $this->user->getUsuariosPesquisarIndex(search: $pesquisar ?? '');

        return view('pages.usuarios.paginacao', compact('findUsuario'));
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $buscaRegistro = User::find($id);
        $buscaRegistro->delete();
        return response()->json(['success' => true]);
    }

    public function cadastrarUsuario(UsuarioFormRequest $request)
    {
        if ($request->method() == 'POST') {
            // criar resgistro
            $data = $request->all();
            $data['password'] = Hash::make($data['password']);
            User::create($data);

            Toastr::success('Dados gravados com sucesso.');

            return redirect()->route('usuario.index');
        }

        return view('pages.usuarios.create');
    }

    public function atualizarUsuario(UsuarioFormRequest $request, $id)
    {

        if ($request->method() == 'PUT') {
            // atualizar resgistro
            $data = $request->all();
            $data['password'] = Hash::make($data['password']);            
            $buscaRegistro = User::find($id);
            $buscaRegistro->update($data);

            Toastr::success('Dados gravados com sucesso.');

            return redirect()->route('usuario.index');
        }
        $findUsuario = User::where('id', '=', $id)->first();

        return view('pages.usuarios.atualiza', compact('findUsuario'));
    }
}
