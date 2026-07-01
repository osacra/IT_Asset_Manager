@extends('layouts.app-admin')

@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ isset($ativo) ? 'Editar Ativo' : 'Novo Ativo' }}</h1>
    </div>

    <div class="card shadow mb-4 border-0">
        <div class="card-body">
            <form action="{{ isset($ativo) ? route('ativos.update', $ativo) : route('ativos.store') }}" method="POST">
                @csrf
                @if(isset($ativo)) @method('PUT') @endif

                <div class="row g-3">
                    <h6 class="m-0 font-weight-bold text-primary border-bottom pb-2">Informações Gerais</h6>
                    
                    <div class="col-md-6">
                        <label class="form-label">Nome do Ativo*</label>
                        <input type="text" name="nome" class="form-control @error('nome') is-invalid @enderror" value="{{ old('nome', $ativo->nome ?? '') }}" placeholder="Ex: Notebook Dell Latitude">
                        @error('nome') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Número de Patrimônio*</label>
                        <input type="text" name="patrimonio" class="form-control @error('patrimonio') is-invalid @enderror" value="{{ old('patrimonio', $ativo->patrimonio ?? '') }}">
                        @error('patrimonio') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Número de Série</label>
                        <input type="text" name="numero_serie" class="form-control @error('numero_serie') is-invalid @enderror" value="{{ old('numero_serie', $ativo->numero_serie ?? '') }}">
                        @error('numero_serie') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Categoria*</label>
                        <select name="categoria_id" class="form-select @error('categoria_id') is-invalid @enderror">
                            <option value="">Selecione...</option>
                            @foreach($categorias as $categoria)
                                <option value="{{ $categoria->id }}" {{ (old('categoria_id', $ativo->categoria_id ?? '') == $categoria->id) ? 'selected' : '' }}>
                                    {{ $categoria->nome }}
                                </option>
                            @endforeach
                        </select>
                        @error('categoria_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Status do Ativo*</label>
                        <select name="status_ativo_id" class="form-select @error('status_ativo_id') is-invalid @enderror">
                            <option value="">Selecione...</option>
                            @foreach($statusAtivos as $status)
                                <option value="{{ $status->id }}" {{ (old('status_ativo_id', $ativo->status_ativo_id ?? '') == $status->id) ? 'selected' : '' }}>
                                    {{ $status->nome }}
                                </option>
                            @endforeach
                        </select>
                        @error('status_ativo_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Localização*</label>
                        <input type="text" name="localizacao" class="form-control @error('localizacao') is-invalid @enderror" value="{{ old('localizacao', $ativo->localizacao ?? '') }}" placeholder="Ex: Estoque TI, Sala 202">
                        @error('localizacao') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <h6 class="m-0 font-weight-bold text-primary border-bottom pb-2 mt-4">Dados de Aquisição e Especificações</h6>

                    <div class="col-md-3">
                        <label class="form-label">Marca*</label>
                        <input type="text" name="marca" class="form-control @error('marca') is-invalid @enderror" value="{{ old('marca', $ativo->marca ?? '') }}">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Modelo*</label>
                        <input type="text" name="modelo" class="form-control @error('modelo') is-invalid @enderror" value="{{ old('modelo', $ativo->modelo ?? '') }}">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Data de Aquisição*</label>
                        <input type="date" name="data_aquisicao" class="form-control @error('data_aquisicao') is-invalid @enderror" value="{{ old('data_aquisicao', $ativo->data_aquisicao ?? '') }}">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Valor de Compra (R$)*</label>
                        <input type="number" step="0.01" name="valor" class="form-control @error('valor') is-invalid @enderror" value="{{ old('valor', $ativo->valor ?? '') }}">
                    </div>

                    <div class="col-12">
                        <label class="form-label">Observações Técnicas</label>
                        <textarea name="observacoes" class="form-control" rows="3">{{ old('observacoes', $ativo->observacoes ?? '') }}</textarea>
                    </div>
                </div>

                <div class="mt-4 border-top pt-3">
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fas fa-save me-1"></i> Salvar Ativo
                    </button>
                    <a href="{{ route('ativos.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection