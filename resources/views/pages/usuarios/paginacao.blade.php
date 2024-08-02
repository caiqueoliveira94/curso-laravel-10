@extends('index')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Usuários</h1>
    </div>
    <div>
        <form action="{{ route('usuario.index') }}" method="get">
            <input type="text" name="pesquisar" id="" placeholder="Digite o nome">
            <button class="btn btn-primary btn-sm">Pesquisar</button>
            <a type="button" href="{{ route('usuario.cadastrar') }}" class="btn btn-success float-end">Incluir Usuario</a>
        </form>
        
        <div class="table-responsive mt-4">
            @if ($findUsuario->isEmpty())
                <p>Não existe dados.</p>
            @else
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($findUsuario as $usuario)
                        <tr>
                            <td>{{ $usuario->name }}</td>
                            <td>{{ $usuario->email }}</td>
                            
                            <td>
                                <a href="{{ route('usuario.atualizar', $usuario->id) }}" class="btn btn-light btn-sm">Editar</a>
                                <meta name="csrf-token" content="{{csrf_token()}}"/>
                                <a onclick="deleteRegistroPaginacao( '{{ route('usuario.delete') }}', {{$usuario->id}} )" class="btn btn-danger btn-sm">Excluir</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>
    </div>
@endsection
