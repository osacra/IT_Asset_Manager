@extends('layouts.app-admin')

@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <h1 class="h3 mb-0 text-gray-800">Registrar Saída de Ativo</h1>
        <p class="text-muted small">Vincule um equipamento disponível a um colaborador.</p>
    </div>

    @if(session('error'))
        <div class="alert alert-danger border-0 shadow-sm mb-4">
            <i class="fas fa-exclamation-triangle me-2"></i> {{ session('error') }}
        </div>
    @endif

    <div class="card shadow border-0 mb-4">
        <div class="card-body p-4">
            <form action="{{ route('emprestimos.store') }}" method="POST">
                @csrf

                <div class="row g-3">
                    {{-- Seleção do Ativo --}}
                    <div class="col-md-6">
                        <label class="form-label fw-bold small text-muted">Selecione o Ativo (Apenas Disponíveis) *</label>
                        <select name="ativo_id" class="form-select @error('ativo_id') is-invalid @enderror">
                            <option value="">Selecione o equipamento...</option>
                            @foreach($ativos as $ativo)
                                <option value="{{ $ativo->id }}" {{ old('ativo_id') == $ativo->id ? 'selected' : '' }}>
                                    [{{ $ativo->patrimonio }}] {{ $ativo->nome }} - {{ $ativo->marca }}
                                </option>
                            @endforeach
                        </select>
                        @error('ativo_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- Seleção do Colaborador --}}
                    <div class="col-md-6">
                        <label class="form-label fw-bold small text-muted">Selecione o Colaborador *</label>
                        <select name="colaborador_id" class="form-select @error('colaborador_id') is-invalid @enderror">
                            <option value="">Quem está retirando o ativo?</option>
                            @foreach($colaboradores as $colaborador)
                                <option value="{{ $colaborador->id }}" {{ old('colaborador_id') == $colaborador->id ? 'selected' : '' }}>
                                    {{ $colaborador->nome }} ({{ $colaborador->departamento }})
                                </option>
                            @endforeach
                        </select>
                        @error('colaborador_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- Data de Retirada --}}
                    <div class="col-md-4">
                        <label class="form-label fw-bold small text-muted">Data da Entrega *</label>
                        <input type="date" name="data_emprestimo" class="form-control @error('data_emprestimo') is-invalid @enderror" value="{{ old('data_emprestimo', date('Y-m-d')) }}">
                        @error('data_emprestimo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- Observações --}}
                    <div class="col-12">
                        <label class="form-label fw-bold small text-muted">Observações da Entrega</label>
                        <textarea name="observacoes" class="form-control" rows="3" placeholder="Ex: Notebook entregue com carregador e mochila. Possui pequeno risco na tampa.">{{ old('observacoes') }}</textarea>
                    </div>
                </div>

                <div class="mt-4 border-top pt-3 text-end">
                    <a href="{{ route('emprestimos.index') }}" class="btn btn-outline-secondary me-2">Cancelar</a>
                    <button type="submit" class="btn btn-success px-4">
                        <i class="fas fa-check-circle me-1"></i> Confirmar Empréstimo
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection