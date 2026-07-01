@extends('layouts.app-admin')

@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <h1 class="h3 mb-0 text-gray-800">Novo Colaborador</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb small mt-1">
                <li class="breadcrumb-item"><a href="{{ route('colaboradores.index') }}">Colaboradores</a></li>
                <li class="breadcrumb-item active" aria-current="page">Adicionar</li>
            </ol>
        </nav>
    </div>

    <div class="card shadow border-0 mb-4">
        <div class="card-body p-4">
            <form action="{{ route('colaboradores.store') }}" method="POST">
                @csrf

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold small text-muted">Nome Completo *</label>
                        <input type="text" name="nome" class="form-control @error('nome') is-invalid @enderror" value="{{ old('nome') }}" placeholder="Ex: João Silva">
                        @error('nome') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold small text-muted">E-mail Corporativo *</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Ex: joao.silva@empresa.com">
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold small text-muted">Departamento *</label>
                        <input type="text" name="departamento" class="form-control @error('departamento') is-invalid @enderror" value="{{ old('departamento') }}" placeholder="Ex: Recursos Humanos">
                        @error('departamento') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold small text-muted">Cargo *</label>
                        <input type="text" name="cargo" class="form-control @error('cargo') is-invalid @enderror" value="{{ old('cargo') }}" placeholder="Ex: Analista de DP Senior">
                        @error('cargo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="mt-4 border-top pt-3 text-end">
                    <a href="{{ route('colaboradores.index') }}" class="btn btn-outline-secondary me-2">Cancelar</a>
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fas fa-save me-1"></i> Cadastrar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection