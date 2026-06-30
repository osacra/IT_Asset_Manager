@extends('layouts.app-admin')

@section('content')
<div class="container">

    <h3 class="mb-4">Nova Categoria</h3>

    <div class="card">
        <div class="card-body">

            <form action="{{ route('categorias.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Nome</label>
                    <input type="text"
                           name="nome"
                           class="form-control @error('nome') is-invalid @enderror"
                           value="{{ old('nome') }}">

                    @error('nome')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Descrição</label>
                    <textarea name="descricao"
                              class="form-control @error('descricao') is-invalid @enderror"
                              rows="3">{{ old('descricao') }}</textarea>

                    @error('descricao')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('categorias.index') }}" class="btn btn-secondary">
                        Voltar
                    </a>

                    <button class="btn btn-success">
                        Salvar
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>
@endsection