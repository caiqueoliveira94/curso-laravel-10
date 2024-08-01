@extends('index')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Incluir Venda</h1>
    </div>
    <div>
        <form class="row g-3" method="POST" action="{{ route('venda.cadastrar') }}">
            @csrf
            <div class="col-md-2">
                <label class="form-label">Número</label>
                <input type="text" disabled value="{{ $findNumero }}" class="form-control @error('numero_da_venda') is-invalid @enderror" name="numero_da_venda">
                @if ($errors->has('numero_da_venda'))
                    <div class="invalid-feedback">{{$errors->first('numero_da_venda')}}</div>
                @endif
            </div>
            <div class="col-md-6">
                <label class="form-label">Produto</label>
                <select class="form-select" name="produto_id">
                    <option selected>Selecionar</option>
                    @foreach ($findProduto as $produto)
                        <option value="{{ $produto->id }}">{{ $produto->nome }}</option>                        
                    @endforeach                    
                  </select>
            </div>
            <div class="col-md-6">
                <label class="form-label">Cliente</label>
                <select class="form-select" name="cliente_id">
                    <option selected>Selecionar</option>
                    @foreach ($findCliente as $cliente)
                        <option value="{{ $cliente->id }}">{{ $cliente->nome }}</option>                        
                    @endforeach                    
                  </select>
            </div>
            
            <div class="col-12">
                <button type="submit" class="btn btn-success">Gravar</button>
            </div>
        </form>
    </div>
@endsection
